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

class EmergencyAutodialerCampaign extends ModulesModelsBase
{
    public const STATUS_NEW = 'new';
    public const STATUS_RUNNING = 'running';
    public const STATUS_FINISHED = 'finished';
    public const STATUS_FAILED = 'failed';

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
    public $scenario_id;

    /**
     * @Column(type="string", nullable=false)
     */
    public $status = self::STATUS_NEW;

    /**
     * @Column(type="string", nullable=true)
     */
    public $started_by_type = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $started_by_extension = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $started_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $finished_at = '';

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $total_recipients = 0;

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $processed_recipients = 0;

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $success_recipients = 0;

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $failed_recipients = 0;

    /**
     * @Column(type="string", nullable=true)
     */
    public $created_at = '';

    public function initialize(): void
    {
        $this->setSource('m_EmergencyAutodialerCampaigns');
        $this->belongsTo('scope_id', EmergencyAutodialerScope::class, 'id', [
            'alias' => 'Scope',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_RESTRICT],
        ]);
        $this->belongsTo('scenario_id', EmergencyAutodialerScenario::class, 'id', [
            'alias' => 'Scenario',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_RESTRICT],
        ]);
        $this->hasMany('id', EmergencyAutodialerCampaignRecipient::class, 'campaign_id', [
            'alias' => 'CampaignRecipients',
            'foreignKey' => ['action' => Relation::ACTION_CASCADE],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        return (int)$this->scope_id > 0 && (int)$this->scenario_id > 0 && trim((string)$this->status) !== '';
    }
}
