---
name: Filament v5 API Changes
description: Breaking changes in Filament v5 vs v4 that affect this project
---

## form() method signature changed
Filament v5 uses `Filament\Schemas\Schema` instead of `Filament\Forms\Form` for Resources:
```php
// v5 correct (Resources)
use Filament\Schemas\Schema;
public static function form(Schema $schema): Schema {
    return $schema->components([...]);
}
// v5 correct (custom Pages with HasForms)
use Filament\Forms\Form;
public function form(Form $form): Form { ... }
```
Form components are still `Filament\Forms\Components\*`.

## Table Actions namespace moved
In Filament v5, `Filament\Tables\Actions\EditAction` etc. do NOT exist.
All actions live in `Filament\Actions\*`:
```php
// WRONG (v4 style)
use Filament\Tables;
Tables\Actions\EditAction::make()

// CORRECT (v5)
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
EditAction::make()
```
**Why:** v5 consolidates all actions into a single `filament/actions` package; `Tables\Actions` only retains `HeaderActionsPosition`.

## $navigationIcon property type conflict (PHP 8.4)
PHP 8.4 strict property type checking causes fatal error if child class redeclares `$navigationIcon`. **Fix:** Override the method:
```php
public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-xxx'; }
```

## $view property on custom Pages
`Filament\Pages\Page::$view` is non-static in v5. Redeclaring it as `protected static string $view` in a child page causes a fatal "Cannot redeclare non static as static" error.
**Fix:** Override `getView()` method instead:
```php
public function getView(): string { return 'filament.pages.my-page'; }
```

## Page class names
- `Filament\Resources\Pages\ListRecords` ✓  (plural 's')
- `Filament\Resources\Pages\CreateRecord` ✓
- `Filament\Resources\Pages\EditRecord` ✓
- `Filament\Resources\Pages\ViewRecord` ✓

**Why:** Filament v5 is a major rewrite with Schema-based forms replacing the old Form abstraction.
