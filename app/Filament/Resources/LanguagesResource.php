<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LanguagesResource\Pages;
use App\Filament\Resources\LanguagesResource\RelationManagers;
use App\Models\Language;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Laravel\Prompts\select;

class LanguagesResource extends Resource
{
    protected static ?string $model = Language::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('level'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->form(self::getFormSchema())
                ->slideOver()
                ->modalWidth('sm'),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->form(self::getFormSchema())
                    ->slideOver()
                    ->modalWidth('sm'),
            ])
            ;
    }

    public static function getFormSchema()
    {
        return [
            Forms\Components\TextInput::make('name'),
            Forms\Components\TextInput::make('level')
                ->numeric(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLanguages::route('/'),
        ];
    }
}
