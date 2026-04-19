# EmergencyAutodialer: итоги первого этапа

## Что сделано

- Техническое имя модуля заменено на `EmergencyAutodialer`.
- Отображаемое имя в интерфейсе MikoPBX задано как `Автооповещение`.
- Namespace PHP-кода заменен на `Modules\EmergencyAutodialer`.
- Composer autoload обновлен на `Modules\\EmergencyAutodialer\\`.
- Шаблонные классы переименованы:
  - `TemplateConf` -> `EmergencyAutodialerConf`
  - `TemplateMain` -> `EmergencyAutodialerMain`
  - `WorkerTemplateMain` -> `WorkerEmergencyAutodialerDialer`
  - `WorkerTemplateAMI` -> `WorkerEmergencyAutodialerAmi`
- Удалены демонстрационные модель, форма и view с полями шаблона:
  - `Models/ModuleTemplate.php`
  - `App/Forms/ModuleTemplateForm.php`
  - `App/Views/EmergencyAutodialerSettings/modify.volt`
- Добавлены базовые контроллеры:
  - `App/Controllers/SettingsController.php`
  - `App/Controllers/CampaignController.php`
  - `App/Controllers/DiagnosticsController.php`
- Добавлены базовые страницы-заготовки:
  - `App/Views/EmergencyAutodialerSettings/index.volt`
  - `App/Views/EmergencyAutodialerCampaign/index.volt`
  - `App/Views/EmergencyAutodialerDiagnostics/index.volt`
- Меню модуля теперь содержит пункты:
  - Кампании
  - Настройки
  - Диагностика
- Assets переименованы и очищены от шаблонной логики:
  - `emergency-autodialer-index.js`
  - `emergency-autodialer-settings.js`
  - `emergency-autodialer-index.css`
- Русские и английские языковые файлы заполнены актуальными текстами. В остальных языках добавлены базовые английские fallback-ключи.

## Текущие маршруты

- `/emergency-autodialer/campaign/index`
- `/emergency-autodialer/settings/index`
- `/emergency-autodialer/diagnostics/index`

Контроллеры названы коротко (`CampaignController`, `SettingsController`, `DiagnosticsController`), потому что принадлежность к модулю уже задается namespace и первым сегментом маршрута.

## Текущее состояние бизнес-логики

Бизнес-логика пока не реализована. `EmergencyAutodialerMain` содержит только служебные заглушки:

- `processAmiMessage()`
- `processBeanstalkMessage()`
- `checkModuleWorkProperly()`
- `startAllServices()`

Worker-ы уже переименованы и зарегистрированы в `EmergencyAutodialerConf::getModuleWorkers()`, но пока не выполняют реальный обзвон и не обрабатывают результаты кампаний.

## Что важно для второго этапа

Второй этап должен начаться с модели данных. Рекомендуемый набор моделей из ТЗ:

- `Models/EmergencyAutodialerScope.php`
- `Models/EmergencyAutodialerScenario.php`
- `Models/EmergencyAutodialerRecipientList.php`
- `Models/EmergencyAutodialerRecipient.php`
- `Models/EmergencyAutodialerScenarioList.php`
- `Models/EmergencyAutodialerCampaign.php`
- `Models/EmergencyAutodialerCampaignRecipient.php`
- `Models/EmergencyAutodialerCallAttempt.php`

Таблицы лучше именовать с единым префиксом, например:

- `m_EmergencyAutodialerScopes`
- `m_EmergencyAutodialerScenarios`
- `m_EmergencyAutodialerRecipientLists`
- `m_EmergencyAutodialerRecipients`
- `m_EmergencyAutodialerScenarioLists`
- `m_EmergencyAutodialerCampaigns`
- `m_EmergencyAutodialerCampaignRecipients`
- `m_EmergencyAutodialerCallAttempts`

На втором этапе нужно добавить:

- создание/обновление таблиц в `Setup/PbxExtensionSetup.php`;
- базовые связи Phalcon models;
- валидацию обязательных полей;
- инициализацию одного default scope для v1;
- константы статусов кампаний, получателей и попыток;
- минимальные helper-методы для нормализации номера `7XXXXXXXXXX`.

## Принятые соглашения

- Технические имена: `EmergencyAutodialer`.
- UI-имя на русском: `Автооповещение`.
- URL prefix: `emergency-autodialer`.
- Ключи переводов: `emergency_autodialer_*`.
- AMI UserEvent prefix для будущей корреляции событий: `EmergencyAutodialer`.

## Не сделано в первом этапе

- Нет таблиц БД.
- Нет CRUD сценариев и списков получателей.
- Нет CSV-импорта.
- Нет AGI/dialplan запуска по внутреннему номеру.
- Нет AMI Originate.
- Нет учета 15 секунд прослушивания.
- Нет мониторинга реальных кампаний.
