<?php
/*
 * MikoPBX - free phone system for small business
 * Copyright © 2017-2023 Alexey Portnov and Nikolay Beketov
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program.
 * If not, see <https://www.gnu.org/licenses/>.
 */

namespace Modules\EmergencyAutodialer\Setup;

use MikoPBX\Modules\Setup\PbxExtensionSetupBase;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerScope;

/**
 * Class PbxExtensionSetup
 * Module installer and uninstaller
 *
 * @package Modules\EmergencyAutodialer\Setup
 */
class PbxExtensionSetup extends PbxExtensionSetupBase
{
    public function installDB(): bool
    {
        $result = $this->createSettingsTableByModelsAnnotations();
        if ($result) {
            $result = $this->registerNewModule();
        }
        if ($result) {
            $result = $this->addToSidebar();
        }
        if ($result) {
            $result = $this->ensureDefaultScope();
        }

        return $result;
    }

    private function ensureDefaultScope(): bool
    {
        $scope = EmergencyAutodialerScope::findFirst([
            'conditions' => 'code = :code:',
            'bind' => [
                'code' => EmergencyAutodialerScope::DEFAULT_CODE,
            ],
        ]);
        if ($scope !== null) {
            return true;
        }

        $scope = new EmergencyAutodialerScope();
        $scope->name = 'Основная точка входа';
        $scope->code = EmergencyAutodialerScope::DEFAULT_CODE;
        $scope->is_active = 1;
        $scope->launch_extension = '';
        $scope->launch_pin = '';
        $scope->welcome_sound_id = '';
        $scope->invalid_sound_id = '';
        $scope->default_parallel_limit = 3;
        $scope->default_max_attempts = 1;
        $scope->default_retry_delay_minutes = 10;
        $scope->default_success_play_seconds = 15;

        return $scope->save();
    }
}
