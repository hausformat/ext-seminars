<?php

declare(strict_types=1);

namespace OliverKlee\Seminars\Hooks;

use OliverKlee\Seminars\Hooks\Interfaces\DataSanitization;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * This class holds functions used to validate submitted forms in the back end.
 *
 * These functions are called from DataHandler via hooks.
 *
 * phpcs:disable PSR1.Methods.CamelCapsMethodName
 */
class DataHandlerHook
{
    /**
     * @var string
     */
    private const TABLE_EVENTS = 'tx_seminars_seminars';

    /**
     * @var string
     */
    private const TABLE_TIME_SLOTS = 'tx_seminars_timeslots';

    /**
     * @var string
     */
    private const TABLE_PLACES_ASSOCIATION = 'tx_seminars_seminars_place_mm';

    /**
     * @var DataHandler
     */
    private $dataHandler;

    /**
     * Handles data after everything had been written to the database.
     *
     * This method is called once for all records together.
     */
    public function processDatamap_afterAllOperations(DataHandler $dataHandler): void
    {
        $this->dataHandler = $dataHandler;
        $this->processEvents();
    }

    /**
     * Processes all events.
     */
    private function processEvents(): void
    {
        /** @var array[] $map */
        $map = (array)($this->dataHandler->datamap[self::TABLE_EVENTS] ?? []);

        /** @var int|string $possibleUid */
        foreach ($map as $possibleUid => $data) {
            $uid = $this->createRealUid($possibleUid);
            $this->processSingleEvent($uid);
        }
    }

    /**
     * @param int|string $possibleUid
     */
    private function createRealUid($possibleUid): int
    {
        return $this->isRealUid($possibleUid)
            ? (int)$possibleUid
            : (int)$this->dataHandler->substNEWwithIDs[$possibleUid];
    }

    /**
     * @param int|string $uid
     */
    private function isRealUid($uid): bool
    {
        return \is_int($uid) || MathUtility::canBeInterpretedAsInteger($uid);
    }

    /**
     * Processes a single event.
     */
    private function processSingleEvent(int $uid): void
    {
        /** @var array|bool $originalData */
        $originalData = $this->getConnectionForTable(self::TABLE_EVENTS)
            ->select(['*'], self::TABLE_EVENTS, ['uid' => $uid])->fetch();
        if (!\is_array($originalData)) {
            return;
        }

        $updatedData = $originalData;
        $this->copyPlacesFromTimeSlots($uid, $updatedData);
        $this->copyDatesFromTimeSlots($uid, $updatedData);
        $this->sanitizeEventDates($updatedData);

        $dataSanitizationHookProvider = GeneralUtility::makeInstance(HookProvider::class, DataSanitization::class);
        $updatedData = array_merge(
            $updatedData,
            $dataSanitizationHookProvider->executeHookReturningMergedArray('sanitizeEventData', $uid, $updatedData)
        );

        if ($updatedData !== $originalData) {
            $this->getConnectionForTable(self::TABLE_EVENTS)->update(self::TABLE_EVENTS, $updatedData, ['uid' => $uid]);
        }
    }

    private function copyPlacesFromTimeSlots(int $uid, array &$data): void
    {
        if ((int)$data['timeslots'] === 0) {
            return;
        }

        $timeSlots = $this->getConnectionForTable(self::TABLE_TIME_SLOTS)
            ->select(['*'], self::TABLE_TIME_SLOTS, ['seminar' => $uid])->fetchAll();

        /** @var array<int, int> $placesUids */
        $placesUids = [];
        foreach ($timeSlots as $timeSlot) {
            $placeUid = (int)$timeSlot['place'];
            if ($placeUid === 0) {
                continue;
            }
            $placesUids[] = $placeUid;
        }

        $connection = $this->getConnectionForTable(self::TABLE_PLACES_ASSOCIATION);
        $connection->delete(self::TABLE_PLACES_ASSOCIATION, ['uid_local' => $uid]);
        foreach (\array_unique($placesUids, SORT_NUMERIC) as $placeUid) {
            $connection->insert(self::TABLE_PLACES_ASSOCIATION, ['uid_local' => $uid, 'uid_foreign' => $placeUid]);
        }

        $data['place'] = \count($placesUids);
    }

    private function copyDatesFromTimeSlots(int $uid, array &$data): void
    {
        if ((int)$data['timeslots'] === 0) {
            return;
        }

        $this->copyBeginDateFromTimeSlots($uid, $data);
        $this->copyEndDateFromTimeSlots($uid, $data);
    }

    private function copyBeginDateFromTimeSlots(int $uid, array &$data): void
    {
        $query = $this->getQueryBuilderForTable(self::TABLE_TIME_SLOTS);
        $result = $query->addSelectLiteral($query->expr()->min('begin_date', 'begin_date'))
            ->from(self::TABLE_TIME_SLOTS)
            ->where($query->expr()->eq('seminar', $uid))
            ->execute()->fetch();

        if (\is_array($result)) {
            $data['begin_date'] = (int)$result['begin_date'];
        }
    }

    private function copyEndDateFromTimeSlots(int $uid, array &$data): void
    {
        $query = $this->getQueryBuilderForTable(self::TABLE_TIME_SLOTS);
        $result = $query->addSelectLiteral($query->expr()->max('end_date', 'end_date'))
            ->from(self::TABLE_TIME_SLOTS)
            ->where($query->expr()->eq('seminar', $uid))
            ->execute()->fetch();

        if (\is_array($result)) {
            $data['end_date'] = (int)$result['end_date'];
        }
    }

    /**
     * @param array $data data, might get changed
     */
    private function sanitizeEventDates(array &$data): void
    {
        $beginDate = (int)$data['begin_date'];
        $registrationDeadline = (int)$data['deadline_registration'];
        $earlyBirdDeadline = (int)$data['deadline_early_bird'];

        if ($registrationDeadline > $beginDate) {
            $registrationDeadline = 0;
            $data['deadline_registration'] = 0;
        }
        if ($earlyBirdDeadline > $beginDate || $earlyBirdDeadline > $registrationDeadline) {
            $data['deadline_early_bird'] = 0;
        }
    }

    protected function getQueryBuilderForTable(string $table): QueryBuilder
    {
        return $this->getConnectionPool()->getQueryBuilderForTable($table);
    }

    protected function getConnectionForTable(string $table): Connection
    {
        return $this->getConnectionPool()->getConnectionForTable($table);
    }

    private function getConnectionPool(): ConnectionPool
    {
        return GeneralUtility::makeInstance(ConnectionPool::class);
    }
}
