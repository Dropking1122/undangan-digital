<?php
namespace App\Filament\Resources;
use App\Filament\Resources\InvitationResource\Pages;
use App\Models\Invitation;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class InvitationResource extends Resource
{
    protected static ?string $model = Invitation::class;
    protected static ?string $navigationLabel = 'Undangan';
    protected static ?int $navigationSort = 4;
    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-envelope'; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')->relationship('user','name')->searchable()->preload()->required(),
            Select::make('template_id')->relationship('template','name')->searchable()->preload()->required(),
            TextInput::make('title')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Select::make('status')->options(['draft'=>'Draft','published'=>'Published','archived'=>'Archived'])->default('draft'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('User'),
            Tables\Columns\TextColumn::make('template.name')->label('Template'),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn($s) => match($s) { 'published'=>'success','draft'=>'warning','archived'=>'gray', default=>'gray' }),
            Tables\Columns\TextColumn::make('rsvps_count')->counts('rsvps')->label('RSVP'),
            Tables\Columns\TextColumn::make('created_at')->since()->sortable(),
        ])->actions([
            ViewAction::make(),
            DeleteAction::make(),
        ])->bulkActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvitations::route('/'),
            'view'  => Pages\ViewInvitation::route('/{record}'),
        ];
    }
}
