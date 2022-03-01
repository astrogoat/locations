<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateLocationsSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('locations.enabled', false);
         $this->migrator->add('locations.api_key', '');
    }

    public function down()
    {
        $this->migrator->delete('locations.enabled');
         $this->migrator->delete('locations.api_key');
    }
}
