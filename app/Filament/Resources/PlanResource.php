<?php
namespace App\Filament\Resources;
use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;
    protected static ?string $navigationLabel = 'Paket';
    protected static ?int $navigationSort = 5;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-credit-card'; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->live(onBlur: true)->afterStateUpdated(fn($s, $set) => $set('slug', Str::slug($s))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Textarea::make('description'),
            TextInput::make('price')->numeric()->default(0)->prefix('Rp'),
            TextInput::make('max_invitations')->numeric()->default(1),
            TextInput::make('max_gallery_images')->numeric()->default(10),
            Toggle::make('can_use_premium_templates')->label('Template Premium'),
            Toggle::make('can_use_gallery')->label('Upload Foto Galeri'),
            Toggle::make('can_upload_music')->label('Upload Musik'),
            Toggle::make('can_use_custom_domain')->label('Custom Domain'),
            Toggle::make('is_active')->default(true),
            TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->sortable(),
            Tables\Columns\TextColumn::make('price')->money('IDR'),
            Tables\Columns\TextColumn::make('max_invitations')->label('Max Undangan'),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
        ])->actions([Tables\Actions\EditAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListPlans::route('/'), 'create' => Pages\CreatePlan::route('/create'), 'edit' => Pages\EditPlan::route('/{record}/edit')];
    }
}
