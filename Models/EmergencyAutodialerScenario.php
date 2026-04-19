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

class EmergencyAutodialerScenario extends ModulesModelsBase
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false)
     */
    public $id;

    /**
     * @Column(type="integer", nullable=false)
     */
    public $scope_id;

    /**
     * @Column(type="integer", nullable=false)
     */
    public $scenario_number;

    /**
     * @Column(type="string", nullable=false)
     */
    public $name = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $description = '';

    /**
     * @Column(type="integer", default="1", nullable=true)
     */
    public $is_active = 1;

    /**
     * @Column(type="string", nullable=true)
     */
    public $message_sound_id = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $announce_sound_id = '';

    /**
     * @Column(type="integer", default="1", nullable=true)
     */
    public $max_attempts = 1;

    /**
     * @Column(type="integer", default="10", nullable=true)
     */
    public $retry_delay_minutes = 10;

    /**
     * @Column(type="integer", default="3", nullable=true)
     */
    public $parallel_limit = 3;

    /**
     * @Column(type="integer", default="15", nullable=true)
     */
    public $success_play_seconds = 15;

    /**
     * @Column(type="string", nullable=true)
     */
    public $created_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $updated_at = '';

    public function initialize(): void
    {
        $this->setSource('m_EmergencyAutodialerScenarios');
        $this->belongsTo('scope_id', EmergencyAutodialerScope::class, 'id', [
            'alias' => 'Scope',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_RESTRICT],
        ]);
        $this->hasMany('id', EmergencyAutodialerScenarioList::class, 'scenario_id', [
            'alias' => 'ScenarioLists',
            'foreignKey' => ['action' => Relation::ACTION_CASCADE],
        ]);
        $this->hasMany('id', EmergencyAutodialerCampaign::class, 'scenario_id', [
            'alias' => 'Campaigns',
            'foreignKey' => ['action' => Relation::ACTION_RESTRICT],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        $this->name = trim((string)$this->name);
        $now = date('Y-m-d H:i:s');
        if (empty($this->created_at)) {
            $this->created_at = $now;
        }
        $this->updated_at = $now;

        return $this->name !== '' && (int)$this->scope_id > 0 && (int)$this->scenario_number > 0;
    }
}
