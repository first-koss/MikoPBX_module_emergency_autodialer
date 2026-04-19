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

namespace Modules\EmergencyAutodialer\Models;

use MikoPBX\Modules\Models\ModulesModelsBase;
use Phalcon\Mvc\Model\Relation;

class EmergencyAutodialerScope extends ModulesModelsBase
{
    public const DEFAULT_CODE = 'default';

    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false)
     */
    public $id;

    /**
     * @Column(type="string", nullable=false)
     */
    public $name = '';

    /**
     * @Column(type="string", nullable=false)
     */
    public $code = '';

    /**
     * @Column(type="integer", default="1", nullable=true)
     */
    public $is_active = 1;

    /**
     * @Column(type="string", nullable=true)
     */
    public $launch_extension = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $launch_pin = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $welcome_sound_id = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $invalid_sound_id = '';

    /**
     * @Column(type="integer", default="3", nullable=true)
     */
    public $default_parallel_limit = 3;

    /**
     * @Column(type="integer", default="1", nullable=true)
     */
    public $default_max_attempts = 1;

    /**
     * @Column(type="integer", default="10", nullable=true)
     */
    public $default_retry_delay_minutes = 10;

    /**
     * @Column(type="integer", default="15", nullable=true)
     */
    public $default_success_play_seconds = 15;

    public function initialize(): void
    {
        $this->setSource('m_EmergencyAutodialerScopes');
        $this->hasMany('id', EmergencyAutodialerScenario::class, 'scope_id', [
            'alias' => 'Scenarios',
            'foreignKey' => ['action' => Relation::ACTION_RESTRICT],
        ]);
        $this->hasMany('id', EmergencyAutodialerRecipientList::class, 'scope_id', [
            'alias' => 'RecipientLists',
            'foreignKey' => ['action' => Relation::ACTION_RESTRICT],
        ]);
        $this->hasMany('id', EmergencyAutodialerCampaign::class, 'scope_id', [
            'alias' => 'Campaigns',
            'foreignKey' => ['action' => Relation::ACTION_RESTRICT],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        $this->name = trim((string)$this->name);
        $this->code = trim((string)$this->code);

        return $this->name !== '' && $this->code !== '';
    }
}
