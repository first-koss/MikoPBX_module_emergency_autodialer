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

return [
    'repEmergencyAutodialer' => 'Автооповещение - %repesent%',
    'mo_ModuleEmergencyAutodialer' => 'Автооповещение',
    'BreadcrumbEmergencyAutodialer' => 'Автооповещение',
    'SubHeaderEmergencyAutodialer' => 'Массовое голосовое оповещение через MikoPBX',
    'emergency_autodialer_MenuItem' => 'Автооповещение',
    'emergency_autodialer_Settings' => 'Настройки',
    'emergency_autodialer_Campaigns' => 'Кампании',
    'emergency_autodialer_Diagnostics' => 'Диагностика',
    'emergency_autodialer_SettingsPlaceholder' => 'Настройте основную точку входа для запуска автооповещения.',
    'emergency_autodialer_CampaignsPlaceholder' => 'Кампании будут доступны после добавления модели данных и сервиса запуска сценариев.',
    'emergency_autodialer_DiagnosticsPlaceholder' => 'Диагностика модуля будет доступна после подключения рабочих процессов и AMI-обработчика.',
    'emergency_autodialer_ValidateValueIsEmpty' => 'Проверьте поле, оно не заполнено',
    'emergency_autodialer_NoDefaultScope' => 'Основная точка входа пока не создана. Переустановите или обновите модуль.',
    'emergency_autodialer_ScopeName' => 'Название точки входа',
    'emergency_autodialer_ScopeCode' => 'Код точки входа',
    'emergency_autodialer_LaunchExtension' => 'Внутренний номер запуска',
    'emergency_autodialer_DefaultParallelLimit' => 'Параллельных вызовов по умолчанию',
    'emergency_autodialer_DefaultMaxAttempts' => 'Попыток по умолчанию',
    'emergency_autodialer_DefaultRetryDelay' => 'Задержка повтора, минут',
    'emergency_autodialer_DefaultSuccessPlaySeconds' => 'Порог успешного прослушивания, секунд',
    'emergency_autodialer_LaunchPin' => 'PIN подтверждения запуска',
    'emergency_autodialer_WelcomeSound' => 'Звуковой файл приветствия',
    'emergency_autodialer_InvalidSound' => 'Звуковой файл ошибки ввода',
    'emergency_autodialer_EntryPointSection' => 'Точка входа',
    'emergency_autodialer_SoundsSection' => 'Звуковые сообщения',
    'emergency_autodialer_DefaultsSection' => 'Значения по умолчанию',
    'emergency_autodialer_SoundsPlaceholder' => 'В этом этапе сохраняются идентификаторы звуковых файлов. Выпадающий список файлов MikoPBX будет подключен после уточнения модели звуков.',
    'emergency_autodialer_CampaignRecipients' => 'Получатели кампаний',
    'emergency_autodialer_CallAttempts' => 'Попытки дозвона',
    'emergency_autodialer_Model' => 'Модель',
    'emergency_autodialer_Status' => 'Статус',
    'emergency_autodialer_Records' => 'Записей',
    'emergency_autodialer_Ready' => 'Готово',
    'emergency_autodialer_ErrorNameRequired' => 'Укажите название точки входа',
    'emergency_autodialer_ErrorLaunchExtension' => 'Внутренний номер запуска должен содержать от 2 до 16 цифр',
    'emergency_autodialer_ErrorLaunchPin' => 'PIN должен содержать от 3 до 16 цифр',
    'emergency_autodialer_ErrorParallelLimit' => 'Лимит параллельных вызовов должен быть от 1 до 100',
    'emergency_autodialer_ErrorMaxAttempts' => 'Число попыток должно быть от 1 до 10',
    'emergency_autodialer_ErrorRetryDelay' => 'Задержка повтора должна быть от 0 до 1440 минут',
    'emergency_autodialer_ErrorSuccessPlaySeconds' => 'Порог успешного прослушивания должен быть от 1 до 3600 секунд',
];
