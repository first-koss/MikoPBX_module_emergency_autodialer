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
use Modules\EmergencyAutodialer\App\Forms\EmergencyAutodialerSettingsForm;
use Modules\EmergencyAutodialer\Models\EmergencyAutodialerScope;

class SettingsController extends BaseController
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
     * Renders the settings page.
     *
     * @return void
     */
    public function indexAction(): void
    {
        $this->view->scope = null;
        $this->view->form = null;
        $this->view->databaseError = '';
        try {
            $scope = $this->getDefaultScope();
            $this->view->scope = $scope;
            $this->view->form = new EmergencyAutodialerSettingsForm($scope);
        } catch (\Throwable $exception) {
            $this->view->databaseError = $exception->getMessage();
        }

        $headerCollectionCSS = $this->assets->collection(AssetProvider::HEADER_CSS);
        $headerCollectionCSS->addCss('css/cache/'.$this->moduleUniqueID.'/emergency-autodialer-index.css', true);

        $footerCollectionJS = $this->assets->collection(AssetProvider::FOOTER_JS);
        $footerCollectionJS
            ->addJs('js/pbx/main/form.js', true)
            ->addJs('js/cache/'.$this->moduleUniqueID.'/emergency-autodialer-settings.js', true);

        $this->view->pick('Modules/'.$this->moduleUniqueID.'/EmergencyAutodialerSettings/index');
    }

    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            return;
        }

        $scope = $this->getDefaultScope();
        $data = $this->request->getPost();

        $scope->name = trim((string)($data['name'] ?? ''));
        $scope->launch_extension = trim((string)($data['launch_extension'] ?? ''));
        $scope->launch_pin = trim((string)($data['launch_pin'] ?? ''));
        $scope->welcome_sound_id = trim((string)($data['welcome_sound_id'] ?? ''));
        $scope->invalid_sound_id = trim((string)($data['invalid_sound_id'] ?? ''));
        $scope->default_parallel_limit = (int)($data['default_parallel_limit'] ?? 0);
        $scope->default_max_attempts = (int)($data['default_max_attempts'] ?? 0);
        $scope->default_retry_delay_minutes = (int)($data['default_retry_delay_minutes'] ?? 0);
        $scope->default_success_play_seconds = (int)($data['default_success_play_seconds'] ?? 0);

        $errors = $this->validateSettings($scope);
        if ($errors !== []) {
            $this->view->success = false;
            $this->view->messages = $errors;

            return;
        }

        $this->saveEntity($scope);
    }

    private function getDefaultScope(): EmergencyAutodialerScope
    {
        $scope = EmergencyAutodialerScope::findFirst([
            'conditions' => 'code = :code:',
            'bind' => [
                'code' => EmergencyAutodialerScope::DEFAULT_CODE,
            ],
        ]);
        if ($scope !== null) {
            return $scope;
        }

        $scope = new EmergencyAutodialerScope();
        $scope->name = 'Основная точка входа';
        $scope->code = EmergencyAutodialerScope::DEFAULT_CODE;
        $scope->is_active = 1;
        $scope->default_parallel_limit = 3;
        $scope->default_max_attempts = 1;
        $scope->default_retry_delay_minutes = 10;
        $scope->default_success_play_seconds = 15;

        return $scope;
    }

    private function validateSettings(EmergencyAutodialerScope $scope): array
    {
        $errors = [];
        if ($scope->name === '') {
            $errors[] = 'emergency_autodialer_ErrorNameRequired';
        }
        if ($scope->launch_extension === '' || preg_match('/^\d{2,16}$/', $scope->launch_extension) !== 1) {
            $errors[] = 'emergency_autodialer_ErrorLaunchExtension';
        }
        if ($scope->launch_pin === '' || preg_match('/^\d{3,16}$/', $scope->launch_pin) !== 1) {
            $errors[] = 'emergency_autodialer_ErrorLaunchPin';
        }
        if ((int)$scope->default_parallel_limit < 1 || (int)$scope->default_parallel_limit > 100) {
            $errors[] = 'emergency_autodialer_ErrorParallelLimit';
        }
        if ((int)$scope->default_max_attempts < 1 || (int)$scope->default_max_attempts > 10) {
            $errors[] = 'emergency_autodialer_ErrorMaxAttempts';
        }
        if ((int)$scope->default_retry_delay_minutes < 0 || (int)$scope->default_retry_delay_minutes > 1440) {
            $errors[] = 'emergency_autodialer_ErrorRetryDelay';
        }
        if ((int)$scope->default_success_play_seconds < 1 || (int)$scope->default_success_play_seconds > 3600) {
            $errors[] = 'emergency_autodialer_ErrorSuccessPlaySeconds';
        }

        return $errors;
    }
}
