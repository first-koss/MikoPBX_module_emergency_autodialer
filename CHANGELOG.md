# Changelog

All notable changes to `EmergencyAutodialer` are tracked in this file.

Versioning follows `MAJOR.MINOR.PATCH`:

- `MAJOR` changes for incompatible data model, route, or behavior changes.
- `MINOR` changes for new module functionality and implementation stages.
- `PATCH` changes for fixes, translation updates, and small internal improvements.

## [0.3.0] - 2026-04-19

### Added

- Added editable settings form for the default `EmergencyAutodialerScope`.
- Added server-side validation and saving for:
  - entry point name;
  - launch extension;
  - launch confirmation PIN;
  - welcome sound identifier;
  - invalid input sound identifier;
  - default parallel call limit;
  - default max attempts;
  - default retry delay;
  - default successful playback threshold.
- Added client-side form validation for settings.
- Added `third_stage_readme.md` with stage 3 summary, test checklist, and next-stage plan.

### Changed

- Replaced read-only settings view with an editable form.
- Updated developer metadata to `firstkoss` and support contact to `firstkoss@yandex.ru`.
- Updated Composer package ownership and support/source URLs to `firstkoss`.

### Not Implemented Yet

- Dropdown selection of MikoPBX sound files. Sound fields currently store identifiers as text until the core sound-file model is connected.

## [0.2.0] - 2026-04-19

### Added

- Added the core data model for emergency auto notification:
  - scopes;
  - scenarios;
  - recipient lists;
  - recipients;
  - scenario-list bindings;
  - campaigns;
  - campaign recipient snapshots;
  - call attempts.
- Added Phalcon model relationships and basic validation.
- Added phone normalization, validation, and display formatting helper.
- Added module database installation through model annotations.
- Added default `default` scope initialization during module install/update.
- Added model readiness diagnostics and basic campaign counters.
- Added `second_stage_readme.md` with stage 2 summary and next-stage plan.

### Changed

- Settings, campaigns, and diagnostics pages now read from module models where possible.
- Translation files include keys for model diagnostics and default scope display.
- Minimum MikoPBX version in `module.json` is aligned with `composer.json` at `2023.2.160`.

### Not Implemented Yet

- Settings form saving.
- Scenario and recipient list CRUD.
- CSV import/export.
- Phone launch flow.
- AMI Originate dialing.
- Playback-threshold result tracking.

## [0.1.0] - 2026-04-19

### Added

- Converted the MikoPBX template into the `EmergencyAutodialer` module.
- Set the Russian UI display name to `Автооповещение`.
- Added initial settings, campaigns, and diagnostics placeholder pages.
- Renamed module namespace, metadata, config, main, and worker classes.
- Removed template demo model, form, views, labels, and assets.
- Added `first_stage_readme.md` with stage 1 summary and stage 2 notes.
