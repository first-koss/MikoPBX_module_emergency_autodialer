# EmergencyAutodialer: итоги этапов 1 и 2

## Этап 1: каркас модуля

На первом этапе шаблон MikoPBX был превращен в модуль `EmergencyAutodialer`:

- техническое имя модуля: `EmergencyAutodialer`;
- отображаемое имя в MikoPBX: `Автооповещение`;
- namespace: `Modules\EmergencyAutodialer`;
- URL prefix: `emergency-autodialer`;
- удалены демонстрационные модель, форма, views и assets шаблона;
- добавлены страницы-заготовки настроек, кампаний и диагностики;
- переименованы config/main/worker-классы;
- добавлен `first_stage_readme.md`.

## Этап 2: базовая модель данных

На втором этапе добавлен доменный слой для будущего автодозвона.

Созданы модели:

- `Models/EmergencyAutodialerScope.php`
- `Models/EmergencyAutodialerScenario.php`
- `Models/EmergencyAutodialerRecipientList.php`
- `Models/EmergencyAutodialerRecipient.php`
- `Models/EmergencyAutodialerScenarioList.php`
- `Models/EmergencyAutodialerCampaign.php`
- `Models/EmergencyAutodialerCampaignRecipient.php`
- `Models/EmergencyAutodialerCallAttempt.php`

Создаваемые таблицы:

- `m_EmergencyAutodialerScopes`
- `m_EmergencyAutodialerScenarios`
- `m_EmergencyAutodialerRecipientLists`
- `m_EmergencyAutodialerRecipients`
- `m_EmergencyAutodialerScenarioLists`
- `m_EmergencyAutodialerCampaigns`
- `m_EmergencyAutodialerCampaignRecipients`
- `m_EmergencyAutodialerCallAttempts`

Что добавлено в моделях:

- поля из ТЗ для scope, сценариев, списков, получателей, кампаний, снимков получателей и попыток вызова;
- связи `belongsTo` / `hasMany` между сущностями;
- базовые константы статусов кампаний, получателей кампаний и попыток;
- простая нормализация и валидация получателей по формату хранения `7XXXXXXXXXX`;
- timestamps для сущностей, где они предусмотрены ТЗ;
- `useDynamicUpdate(true)` для моделей.

Добавлен helper:

- `Lib/EmergencyAutodialerPhone.php`

Он умеет:

- нормализовать телефон в формат хранения `7XXXXXXXXXX`;
- проверять формат хранения;
- форматировать телефон для интерфейса как `+7(XXX)XXX-XX-XX`.

## Установка и начальные данные

В `Setup/PbxExtensionSetup.php` добавлен `installDB()`:

- вызывает `createSettingsTableByModelsAnnotations()`;
- регистрирует модуль через `registerNewModule()`;
- добавляет модуль в sidebar через `addToSidebar()`;
- создает default scope с кодом `default`, если он еще не существует.

Default scope:

- `name`: `Основная точка входа`;
- `code`: `default`;
- `default_parallel_limit`: `3`;
- `default_max_attempts`: `1`;
- `default_retry_delay_minutes`: `10`;
- `default_success_play_seconds`: `15`.

## Что можно проверить после второго этапа

После упаковки и установки/обновления модуля в MikoPBX можно проверить:

- модуль устанавливается без ошибок;
- модуль отображается как `Автооповещение`;
- модуль добавляется в sidebar;
- открывается `/emergency-autodialer/settings/index`;
- на странице настроек виден default scope и его значения по умолчанию;
- открывается `/emergency-autodialer/campaign/index`;
- на странице кампаний видны счетчики кампаний, получателей кампаний и попыток;
- открывается `/emergency-autodialer/diagnostics/index`;
- диагностика показывает готовность всех восьми моделей и количество записей;
- в sqlite базе модуля появляются таблицы `m_EmergencyAutodialer*`;
- в исполняемом коде не осталось старых шаблонных имен `ModuleTemplate`, `module-template`, `module_template`.

## Ограничения текущего состояния

На конец второго этапа модуль еще не умеет:

- редактировать настройки точки входа;
- создавать сценарии;
- создавать списки получателей;
- импортировать CSV;
- запускать кампанию по телефону;
- выполнять AMI Originate;
- учитывать 15 секунд прослушивания;
- показывать историю реальных попыток.

## План третьего этапа

Третий этап по исходному roadmap: экран настроек модуля.

Рекомендуемый объем:

- создать `App/Forms/EmergencyAutodialerSettingsForm.php`;
- заменить placeholder настроек на реальную форму редактирования default scope;
- добавить сохранение:
  - внутренний номер запуска;
  - PIN подтверждения;
  - приветственное сообщение;
  - сообщение ошибки/неверного ввода;
  - лимит параллельности по умолчанию;
  - число попыток по умолчанию;
  - задержку повтора;
  - порог успешного прослушивания;
- добавить серверную валидацию числовых параметров;
- подготовить выбор существующих звуковых файлов MikoPBX;
- оставить архитектурную возможность позже иметь несколько scope, но в UI v1 редактировать только `default`.

## Commit message для второго этапа

```text
Add EmergencyAutodialer data model

- add scope, scenario, recipient list, recipient, campaign and call attempt models
- define Phalcon relationships and basic model validation
- add phone normalization and display formatting helper
- create module tables from model annotations during installDB
- seed default scope for v1 configuration
- show model readiness and counters on settings, campaign and diagnostics pages
- document stage 2 results and next setup-screen plan
```
