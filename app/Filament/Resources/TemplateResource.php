<?php
namespace App\Filament\Resources;
use App\Filament\Resources\TemplateResource\Pages;
use App\Models\Template;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;
    protected static ?string $navigationLabel = 'Templates';
    protected static ?int $navigationSort = 2;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-paint-brush'; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required()->live(onBlur: true)->afterStateUpdated(fn($s, $set) => $set('slug', Str::slug($s))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Select::make('category_id')->relationship('category', 'name')->searchable()->preload(),
            TextInput::make('theme_directory')->required()->helperText('Nama folder di resources/views/themes/'),
            Select::make('status')->options(['active'=>'Active','inactive'=>'Inactive'])->default('active'),
            Toggle::make('is_premium')->label('Premium Template'),
            TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('theme_directory'),
            Tables\Columns\TextColumn::make('category.name')->badge(),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn($s) => match($s) { 'active'=>'success', default=>'gray' }),
            Tables\Columns\IconColumn::make('is_premium')->boolean()->label('Premium'),
            Tables\Columns\TextColumn::make('invitations_count')->counts('invitations')->label('Digunakan'),
        ])->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListTemplates::route('/'), 'create' => Pages\CreateTemplate::route('/create'), 'edit' => Pages\EditTemplate::route('/{record}/edit')];
    }
}
