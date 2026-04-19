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
use Modules\EmergencyAutodialer\Lib\EmergencyAutodialerPhone;
use Phalcon\Mvc\Model\Relation;

class EmergencyAutodialerCampaignRecipient extends ModulesModelsBase
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_CALLING = 'calling';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAILED = 'failed';
    public const STATUS_RETRY = 'retry';

    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false)
     */
    public $id;

    /**
     * @Column(type="integer", nullable=false)
     */
    public $campaign_id;

    /**
     * @Column(type="integer", nullable=true)
     */
    public $source_recipient_id;

    /**
     * @Column(type="string", nullable=false)
     */
    public $full_name = '';

    /**
     * @Column(type="string", nullable=false)
     */
    public $phone_raw = '';

    /**
     * @Column(type="string", nullable=false)
     */
    public $status = self::STATUS_PENDING;

    /**
     * @Column(type="integer", default="0", nullable=true)
     */
    public $attempts_used = 0;

    /**
     * @Column(type="string", nullable=true)
     */
    public $last_attempt_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $success_at = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $final_disposition = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $created_at = '';

    public function initialize(): void
    {
        $this->setSource('m_EmergencyAutodialerCampaignRecipients');
        $this->belongsTo('campaign_id', EmergencyAutodialerCampaign::class, 'id', [
            'alias' => 'Campaign',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_CASCADE],
        ]);
        $this->belongsTo('source_recipient_id', EmergencyAutodialerRecipient::class, 'id', [
            'alias' => 'SourceRecipient',
            'foreignKey' => ['allowNulls' => true, 'action' => Relation::NO_ACTION],
        ]);
        $this->hasMany('id', EmergencyAutodialerCallAttempt::class, 'campaign_recipient_id', [
            'alias' => 'CallAttempts',
            'foreignKey' => ['action' => Relation::ACTION_CASCADE],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        $this->full_name = trim((string)$this->full_name);
        $this->phone_raw = EmergencyAutodialerPhone::normalize((string)$this->phone_raw);
        if (empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }

        return $this->full_name !== ''
            && $this->phone_raw !== ''
            && (int)$this->campaign_id > 0
            && trim((string)$this->status) !== '';
    }
}
