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

class EmergencyAutodialerRecipient extends ModulesModelsBase
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
    public $list_id;

    /**
     * @Column(type="string", nullable=false)
     */
    public $full_name = '';

    /**
     * @Column(type="string", nullable=false)
     */
    public $phone_raw = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $comment = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $department = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $position = '';

    /**
     * @Column(type="string", nullable=true)
     */
    public $external_id = '';

    /**
     * @Column(type="integer", default="1", nullable=true)
     */
    public $is_active = 1;

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
        $this->setSource('m_EmergencyAutodialerRecipients');
        $this->belongsTo('list_id', EmergencyAutodialerRecipientList::class, 'id', [
            'alias' => 'RecipientList',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_RESTRICT],
        ]);
        $this->hasMany('id', EmergencyAutodialerCampaignRecipient::class, 'source_recipient_id', [
            'alias' => 'CampaignRecipients',
            'foreignKey' => ['action' => Relation::NO_ACTION],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        $this->full_name = trim((string)$this->full_name);
        $this->phone_raw = EmergencyAutodialerPhone::normalize((string)$this->phone_raw);
        $now = date('Y-m-d H:i:s');
        if (empty($this->created_at)) {
            $this->created_at = $now;
        }
        $this->updated_at = $now;

        return $this->full_name !== '' && $this->phone_raw !== '' && (int)$this->list_id > 0;
    }
}
