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
use MikoPBX\AdminCabinet\Providers\AssetProvider;
use MikoPBX\Modules\PbxExtensionUtils;
use Modules\EmergencyAutodialer\Lib\EmergencyAutodialerRoutes;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerCallAttempt;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerCampaign;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerCampaignRecipient;

class CampaignController extends BaseController
{
    private string $moduleUniqueID = EmergencyAutodialerRoutes::MODULE_UNIQUE_ID;
    private string $moduleDir;

    /**
     * Basic initial class
     */
    public function initialize(): void
    {
        $this->moduleDir = PbxExtensionUtils::getModuleDir($this->moduleUniqueID);
        $this->view->logoImagePath = $this->url->get().'assets/img/cache/'.$this->moduleUniqueID.'/logo.svg';
        $this->view->submitMode = null;
        $this->view->moduleMenu = EmergencyAutodialerRoutes::menu();
        $this->view->activeMenuItem = 'campaign';
        parent::initialize();
    }

    /**
     * Renders campaigns placeholder page.
     */
    public function indexAction(): void
    {
        $this->view->databaseError = '';
        $this->view->counters = [
            'campaigns' => 0,
            'campaignRecipients' => 0,
            'callAttempts' => 0,
        ];
        try {
            $this->view->counters = [
                'campaigns' => EmergencyAutodialerCampaign::count(),
                'campaignRecipients' => EmergencyAutodialerCampaignRecipient::count(),
                'callAttempts' => EmergencyAutodialerCallAttempt::count(),
            ];
        } catch (\Throwable $exception) {
            $this->view->databaseError = $exception->getMessage();
        }

        $headerCollectionCSS = $this->assets->collection(AssetProvider::HEADER_CSS);
        $headerCollectionCSS->addCss('css/cache/'.$this->moduleUniqueID.'/emergency-autodialer-index.css', true);

        $footerCollectionJS = $this->assets->collection(AssetProvider::FOOTER_JS);
        $footerCollectionJS->addJs('js/cache/'.$this->moduleUniqueID.'/emergency-autodialer-index.js', true);

        $this->view->pick('Modules/'.$this->moduleUniqueID.'/EmergencyAutodialerCampaign/index');
    }
}
