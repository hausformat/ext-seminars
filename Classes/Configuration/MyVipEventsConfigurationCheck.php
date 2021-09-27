<?php

declare(strict_types=1);

namespace OliverKlee\Seminars\Configuration;

/**
 * Configuration check for the "my events" list.
 */
class MyVipEventsConfigurationCheck extends AbstractFrontEndConfigurationCheck
{
    protected function checkAllConfigurationValues(): void
    {
        $this->checkRegistrationsVipListPid();
        $this->checkDefaultEventVipsFeGroupID();
        $this->checkMayManagersEditTheirEvents();
        $this->checkAllowCsvExportOfRegistrationsInMyVipEventsView();

        if ($this->configuration->getAsBoolean('mayManagersEditTheirEvents')) {
            $this->checkEventEditorPID();
        }
    }

    private function checkRegistrationsVipListPid(): void
    {
        $this->checkIfPositiveInteger(
            'registrationsVipListPID',
            'This value specifies the page that contains the list of registrations for an event.
            If this value is not set correctly, the link to that page will not work.'
        );
    }

    private function checkMayManagersEditTheirEvents(): void
    {
        $this->checkIfBoolean(
            'mayManagersEditTheirEvents',
            'This value specifies whether VIPs may edit their events.
            If this value is incorrect, VIPs may be allowed to edit their events although they should not be allowed to
            (or vice versa).'
        );
    }

    private function checkAllowCsvExportOfRegistrationsInMyVipEventsView(): void
    {
        $this->checkIfBoolean(
            'allowCsvExportOfRegistrationsInMyVipEventsView',
            'This value specifies whether managers are allowed to access the CSV export of registrations
            from the &quot;my VIP events&quot; view.
            If this value is incorrect, managers may be allowed to access the CSV export of registrations
            from the &quot;my VIP events&quot; view although they should not be allowed to (or vice versa).'
        );
    }

    private function checkEventEditorPID(): void
    {
        $this->checkIfSingleFePageNotEmpty(
            'eventEditorPID',
            'This value specifies the page that contains the plug-in for editing event records in the front end.
            If this value is not set correctly, the <em>edit</em> link in the <em>events which I have entered</em> list
            will not work.'
        );
    }
}
