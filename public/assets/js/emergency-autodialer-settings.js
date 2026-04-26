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

/* global globalRootUrl, globalTranslate, Form */
const EmergencyAutodialerSettings = {
	$formObj: $('#emergency-autodialer-settings-form'),
	$checkBoxes: $('#emergency-autodialer-settings-form .ui.checkbox'),
	$dropDowns: $('#emergency-autodialer-settings-form .ui.dropdown'),
	validateRules: {
		name: {
			identifier: 'name',
			rules: [
				{
					type: 'empty',
					prompt: globalTranslate.emergency_autodialer_ErrorNameRequired,
				},
			],
		},
		launchExtension: {
			identifier: 'launch_extension',
			rules: [
				{
					type: 'regExp[/^\\d{2,16}$/]',
					prompt: globalTranslate.emergency_autodialer_ErrorLaunchExtension,
				},
			],
		},
		launchPin: {
			identifier: 'launch_pin',
			rules: [
				{
					type: 'regExp[/^\\d{3,16}$/]',
					prompt: globalTranslate.emergency_autodialer_ErrorLaunchPin,
				},
			],
		},
		defaultParallelLimit: {
			identifier: 'default_parallel_limit',
			rules: [
				{
					type: 'integer[1..100]',
					prompt: globalTranslate.emergency_autodialer_ErrorParallelLimit,
				},
			],
		},
		defaultMaxAttempts: {
			identifier: 'default_max_attempts',
			rules: [
				{
					type: 'integer[1..10]',
					prompt: globalTranslate.emergency_autodialer_ErrorMaxAttempts,
				},
			],
		},
		defaultRetryDelay: {
			identifier: 'default_retry_delay_minutes',
			rules: [
				{
					type: 'integer[0..1440]',
					prompt: globalTranslate.emergency_autodialer_ErrorRetryDelay,
				},
			],
		},
		defaultSuccessPlaySeconds: {
			identifier: 'default_success_play_seconds',
			rules: [
				{
					type: 'integer[1..3600]',
					prompt: globalTranslate.emergency_autodialer_ErrorSuccessPlaySeconds,
				},
			],
		},
	},

	initialize() {
		EmergencyAutodialerSettings.$checkBoxes.checkbox();
		EmergencyAutodialerSettings.$dropDowns.dropdown();
		if (EmergencyAutodialerSettings.$formObj.length > 0) {
			EmergencyAutodialerSettings.initializeForm();
		}
	},

	cbBeforeSendForm(settings) {
		const result = settings;
		result.data = EmergencyAutodialerSettings.$formObj.form('get values');
		return result;
	},

	cbAfterSendForm() {

	},

	initializeForm() {
		Form.$formObj = EmergencyAutodialerSettings.$formObj;
		Form.url = EmergencyAutodialerSettings.$formObj.attr('action');
		Form.validateRules = EmergencyAutodialerSettings.validateRules;
		Form.cbBeforeSendForm = EmergencyAutodialerSettings.cbBeforeSendForm;
		Form.cbAfterSendForm = EmergencyAutodialerSettings.cbAfterSendForm;
		Form.initialize();
	},
};

$(document).ready(() => {
	EmergencyAutodialerSettings.initialize();
});
