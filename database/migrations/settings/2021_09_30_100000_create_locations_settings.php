<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateLocationsSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('locations.enabled', false);
        // $this->migrator->add('locations.url', '');
        // $this->migrator->addEncrypted('locations.access_token', '');
    }

    public function down()
    {
        $this->migrator->delete('locations.enabled');
        // $this->migrator->delete('locations.url');
        // $this->migrator->delete('locations.access_token');
    }
}
