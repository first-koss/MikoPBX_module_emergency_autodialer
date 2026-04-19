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

class EmergencyAutodialerScenarioList extends ModulesModelsBase
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
    public $scenario_id;

    /**
     * @Column(type="integer", nullable=false)
     */
    public $list_id;

    public function initialize(): void
    {
        $this->setSource('m_EmergencyAutodialerScenarioLists');
        $this->belongsTo('scenario_id', EmergencyAutodialerScenario::class, 'id', [
            'alias' => 'Scenario',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_CASCADE],
        ]);
        $this->belongsTo('list_id', EmergencyAutodialerRecipientList::class, 'id', [
            'alias' => 'RecipientList',
            'foreignKey' => ['allowNulls' => false, 'action' => Relation::ACTION_CASCADE],
        ]);
        parent::initialize();
        $this->useDynamicUpdate(true);
    }

    public function beforeValidation(): bool
    {
        return (int)$this->scenario_id > 0 && (int)$this->list_id > 0;
    }
}
