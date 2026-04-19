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

namespace Modules\EmergencyAutodialer\App\Forms;

use MikoPBX\AdminCabinet\Forms\BaseForm;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;

class EmergencyAutodialerSettingsForm extends BaseForm
{
    public function initialize($entity = null, $options = null): void
    {
        $this->add(new Hidden('id', ['value' => $entity->id ?? '']));
        $this->add(new Text('name', [
            'value' => $entity->name ?? '',
        ]));
        $this->add(new Text('launch_extension', [
            'value' => $entity->launch_extension ?? '',
            'maxlength' => 16,
        ]));
        $this->add(new Password('launch_pin', [
            'value' => $entity->launch_pin ?? '',
            'maxlength' => 16,
            'autocomplete' => 'new-password',
        ]));
        $this->add(new Text('welcome_sound_id', [
            'value' => $entity->welcome_sound_id ?? '',
        ]));
        $this->add(new Text('invalid_sound_id', [
            'value' => $entity->invalid_sound_id ?? '',
        ]));
        $this->add(new Numeric('default_parallel_limit', [
            'value' => $entity->default_parallel_limit ?? 3,
            'min' => 1,
            'max' => 100,
        ]));
        $this->add(new Numeric('default_max_attempts', [
            'value' => $entity->default_max_attempts ?? 1,
            'min' => 1,
            'max' => 10,
        ]));
        $this->add(new Numeric('default_retry_delay_minutes', [
            'value' => $entity->default_retry_delay_minutes ?? 10,
            'min' => 0,
            'max' => 1440,
        ]));
        $this->add(new Numeric('default_success_play_seconds', [
            'value' => $entity->default_success_play_seconds ?? 15,
            'min' => 1,
            'max' => 3600,
        ]));
    }
}
