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

namespace Modules\EmergencyAutodialer\Lib;

class EmergencyAutodialerRoutes
{
    public const MODULE_UNIQUE_ID = 'EmergencyAutodialer';
    public const ROUTE_PREFIX = 'emergency-autodialer';

    public static function path(string $path = ''): string
    {
        $normalizedPath = trim($path, '/');
        if ($normalizedPath === '') {
            return self::ROUTE_PREFIX;
        }

        return self::ROUTE_PREFIX.'/'.$normalizedPath;
    }

    public static function menu(): array
    {
        return [
            'campaign' => self::path('campaign/index'),
            'settings' => self::path('settings/index'),
            'diagnostics' => self::path('diagnostics/index'),
        ];
    }
}
