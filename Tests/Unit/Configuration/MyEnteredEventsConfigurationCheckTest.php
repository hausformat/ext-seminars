<?php

declare(strict_types=1);

namespace OliverKlee\Seminars\Tests\Unit\Configuration;

use Nimut\TestingFramework\TestCase\UnitTestCase;
use OliverKlee\Oelib\Configuration\AbstractConfigurationCheck;
use OliverKlee\Oelib\Configuration\DummyConfiguration;
use OliverKlee\Seminars\Configuration\MyEnteredEventsConfigurationCheck;

/**
 * @covers \OliverKlee\Seminars\Configuration\MyEnteredEventsConfigurationCheck
 */
final class MyEnteredEventsConfigurationCheckTest extends UnitTestCase
{
    /**
     * @var MyEnteredEventsConfigurationCheck
     */
    private $subject;

    protected function setUp(): void
    {
        $this->subject = new MyEnteredEventsConfigurationCheck(new DummyConfiguration(), 'plugin.tx_seminars_pi1');
    }

    /**
     * @test
     */
    public function isConfigurationCheck(): void
    {
        self::assertInstanceOf(AbstractConfigurationCheck::class, $this->subject);
    }
}
