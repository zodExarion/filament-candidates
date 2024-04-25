<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Candidates;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CandidatesResource\Pages;
use App\Filament\Resources\CandidatesResource\RelationManagers;

class CandidatesResource extends Resource
{
    protected static ?string $model = Candidates::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')->label('E-mail'),
                TextInput::make('phone_number')->label('Phone Number'),
                TextInput::make('first_name')->label('First Name'),
                TextInput::make('last_name')->label('Last Name'),
                Select::make('sex')->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ])->label('Sex'),
                DatePicker::make('date_of_birth')->label('Date of Birth'),
                TextInput::make('position')->label('Position'),
                Textarea::make('language_knowledge')->label('Language Knowledge'),
                FileUpload::make('driving_license')
                    ->label('Driving License Image')
                    ->image()
                    ->downloadable()
                    ->previewable(),


                Checkbox::make('own_transport')->label('Own Transport'),
                FileUpload::make('cv')->label('CV Upload')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ])
                    ->downloadable(),

                Hidden::make('is_working')->label('Is Working'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name', 'Name')
                    ->getStateUsing(function (Model $record) {
                        return $record->first_name . ' ' . $record->last_name;
                    })
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')->label('E-mail')->searchable(),
                TextColumn::make('phone_number')->label('Phone Number')->searchable(),
                TextColumn::make('date_of_birth')
                    ->label('Age')
                    ->formatStateUsing(fn ($record) => Carbon::parse($record->date_of_birth)->age)
                    ->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidates::route('/create'),
            'edit' => Pages\EditCandidates::route('/{record}/edit'),
        ];
    }
}
