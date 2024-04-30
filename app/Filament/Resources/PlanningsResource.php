<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanningsResource\Pages;
use App\Filament\Resources\PlanningsResource\RelationManagers;
use App\Models\Plannings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanningsResource extends Resource
{
    protected static ?string $model = Plannings::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPlannings::route('/'),
            'create' => Pages\CreatePlannings::route('/create'),
            'edit' => Pages\EditPlannings::route('/{record}/edit'),
        ];
    }
}
