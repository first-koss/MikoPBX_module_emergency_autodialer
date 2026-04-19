<?php
return [
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
    'repEmergencyAutodialer' => 'Auto notification - %repesent%',
    'mo_ModuleEmergencyAutodialer' => 'Auto notification',
    'BreadcrumbEmergencyAutodialer' => 'Auto notification',
    'SubHeaderEmergencyAutodialer' => 'Mass voice notification through MikoPBX',
    'emergency_autodialer_ValidateValueIsEmpty' => 'Check the field, it looks empty',
    'emergency_autodialer_MenuItem' => 'Auto notification',
    'emergency_autodialer_Settings' => 'Settings',
    'emergency_autodialer_Campaigns' => 'Campaigns',
    'emergency_autodialer_Diagnostics' => 'Diagnostics',
    'emergency_autodialer_SettingsPlaceholder' => 'Entry point settings will be available after the data model is added.',
    'emergency_autodialer_CampaignsPlaceholder' => 'Campaigns will be available after the data model and scenario launch service are added.',
    'emergency_autodialer_DiagnosticsPlaceholder' => 'Diagnostics will be available after workers and the AMI handler are connected.',
    'emergency_autodialer_NoDefaultScope' => 'Default entry point has not been created yet. Reinstall or update the module.',
    'emergency_autodialer_ScopeName' => 'Entry point name',
    'emergency_autodialer_ScopeCode' => 'Entry point code',
    'emergency_autodialer_LaunchExtension' => 'Launch extension',
    'emergency_autodialer_DefaultParallelLimit' => 'Default parallel calls',
    'emergency_autodialer_DefaultMaxAttempts' => 'Default max attempts',
    'emergency_autodialer_DefaultRetryDelay' => 'Retry delay, minutes',
    'emergency_autodialer_DefaultSuccessPlaySeconds' => 'Successful playback threshold, seconds',
    'emergency_autodialer_CampaignRecipients' => 'Campaign recipients',
    'emergency_autodialer_CallAttempts' => 'Call attempts',
    'emergency_autodialer_Model' => 'Model',
    'emergency_autodialer_Status' => 'Status',
    'emergency_autodialer_Records' => 'Records',
    'emergency_autodialer_Ready' => 'Ready',
    'emergency_autodialer_LaunchPin' => 'Launch confirmation PIN',
    'emergency_autodialer_WelcomeSound' => 'Welcome sound file',
    'emergency_autodialer_InvalidSound' => 'Invalid input sound file',
    'emergency_autodialer_EntryPointSection' => 'Entry point',
    'emergency_autodialer_SoundsSection' => 'Sound messages',
    'emergency_autodialer_DefaultsSection' => 'Default values',
    'emergency_autodialer_SoundsPlaceholder' => 'This stage stores sound file identifiers. The MikoPBX sound-file dropdown will be connected after the sound model is clarified.',
    'emergency_autodialer_ErrorNameRequired' => 'Enter the entry point name',
    'emergency_autodialer_ErrorLaunchExtension' => 'Launch extension must contain 2 to 16 digits',
    'emergency_autodialer_ErrorLaunchPin' => 'PIN must contain 3 to 16 digits',
    'emergency_autodialer_ErrorParallelLimit' => 'Parallel call limit must be between 1 and 100',
    'emergency_autodialer_ErrorMaxAttempts' => 'Max attempts must be between 1 and 10',
    'emergency_autodialer_ErrorRetryDelay' => 'Retry delay must be between 0 and 1440 minutes',
    'emergency_autodialer_ErrorSuccessPlaySeconds' => 'Successful playback threshold must be between 1 and 3600 seconds',
];
