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


namespace Modules\EmergencyAutodialer\App\Controllers;

use MikoPBX\AdminCabinet\Controllers\BaseController;
use MikoPBX\Modules\PbxExtensionUtils;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerCallAttempt;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerCampaign;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerCampaignRecipient;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerRecipient;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerRecipientList;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerScenario;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerScenarioList;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerScope;

class DiagnosticsController extends BaseController
{
    private string $moduleUniqueID = 'EmergencyAutodialer';
    private string $moduleDir;

    /**
     * Basic initial class
     */
    public function initialize(): void
    {
        $this->moduleDir = PbxExtensionUtils::getModuleDir($this->moduleUniqueID);
        $this->view->logoImagePath = $this->url->get().'assets/img/cache/'.$this->moduleUniqueID.'/logo.svg';
        $this->view->submitMode = null;
        parent::initialize();
    }

    /**
     * Index page controller
     */
    public function indexAction(): void
    {
        $this->view->modelStatuses = $this->collectModelStatuses();
        $this->view->pick('Modules/'.$this->moduleUniqueID.'/EmergencyAutodialerDiagnostics/index');
    }

    private function collectModelStatuses(): array
    {
        $models = [
            'EmergencyAutodialerScope' => EmergencyAutodialerScope::class,
            'EmergencyAutodialerScenario' => EmergencyAutodialerScenario::class,
            'EmergencyAutodialerRecipientList' => EmergencyAutodialerRecipientList::class,
            'EmergencyAutodialerRecipient' => EmergencyAutodialerRecipient::class,
            'EmergencyAutodialerScenarioList' => EmergencyAutodialerScenarioList::class,
            'EmergencyAutodialerCampaign' => EmergencyAutodialerCampaign::class,
            'EmergencyAutodialerCampaignRecipient' => EmergencyAutodialerCampaignRecipient::class,
            'EmergencyAutodialerCallAttempt' => EmergencyAutodialerCallAttempt::class,
        ];

        $statuses = [];
        foreach ($models as $name => $className) {
            try {
                $statuses[] = [
                    'name' => $name,
                    'ready' => true,
                    'count' => $className::count(),
                    'error' => '',
                ];
            } catch (\Throwable $exception) {
                $statuses[] = [
                    'name' => $name,
                    'ready' => false,
                    'count' => 0,
                    'error' => $exception->getMessage(),
                ];
            }
        }

        return $statuses;
    }
}
