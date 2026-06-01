---
name: Filament v5 API Changes
description: Breaking changes in Filament v5 vs v4 that affect this project
---

## form() method signature changed
Filament v5 uses `Filament\Schemas\Schema` instead of `Filament\Forms\Form`:
```php
// v5 correct
use Filament\Schemas\Schema;
public static function form(Schema $schema): Schema {
    return $schema->components([...]);
}
```
Form components are still `Filament\Forms\Components\*`.

## $navigationIcon property type conflict (PHP 8.4)
PHP 8.4 strict property type checking causes fatal error if child class redeclares `$navigationIcon` with different/incompatible type. **Fix:** Override the method instead of the property:
```php
public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-xxx'; }
```

## Page class names
ListRecords (plural 's') — NOT ListRecord:
- `Filament\Resources\Pages\ListRecords` ✓
- `Filament\Resources\Pages\CreateRecord` ✓
- `Filament\Resources\Pages\EditRecord` ✓
- `Filament\Resources\Pages\ViewRecord` ✓

**Why:** Filament v5 is a major rewrite with Schema-based forms replacing the old Form abstraction.
