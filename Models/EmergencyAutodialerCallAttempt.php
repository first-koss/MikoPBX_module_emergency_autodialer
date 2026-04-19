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

class EmergencyAutodialerCallAttempt extends ModulesModelsBase
{
    public const STATUS_CREATED = 'created';
    public const STATUS_ORIGINATED = 'originated';
    public const STATUS_ANSWERED = 'answered';
    public const STATUS_SUCCESS = 'success';
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
    public $campaign_recipient_id;

    /**
     * @Column(type="integer", nullable=false)
     */
    public $attempt_number;

    /**
     * @Column(type="string", nullable=true)
     */
    public $ami_action_id = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $channel = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $uniqueid = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $linkedid = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $started_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $answered_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $playback_started_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $ended_at = '';

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $billable_seconds = 0;

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $playback_seconds = 0;

    /**
     * @Column(type="string", nullable=false)
     */
    public $status = self::STATUS_CREATED;

    /**
     * @Column(type="string", nullable=true)
     */
    public $hangup_cause = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $hangup_description = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $created_at = '';

    public function initialize(): void
    {
        $this->setSource('m_EmergencyAutodialerCallAttempts');
        $this->belongsTo('campaign_recipient_id', EmergencyAutodialerCampaignRecipient::class, 'id', [
            'alias' => 'CampaignRecipient',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_CASCADE],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        return (int)$this->campaign_recipient_id > 0
            && (int)$this->attempt_number > 0
            && trim((string)$this->status) !== '';
    }
}
