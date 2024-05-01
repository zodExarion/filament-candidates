<?php

namespace App\Filament\Resources;

use App\Models\Language;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
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
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use App\Filament\Resources\CandidatesResource\RelationManagers;

class CandidatesResource extends Resource
{
    protected static ?string $model = Candidates::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
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
                TextColumn::make('email')->label('E-mail')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('telephone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_of_birth')
                    ->toggleable()
                    ->label('Age')
                    ->formatStateUsing(fn($record) => Carbon::parse($record->date_of_birth)->age)
                    ->searchable(),
                TextColumn::make('languages_names')
                    ->label('Languages')
                    ->toggleable(),
                TextColumn::make('projects_titles')
                    ->label('Projects')
                    ->toggleable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form(self::getFormSchema())
                    ->slideOver()
                    ->modalWidth('md'),
                Tables\Actions\EditAction::make()
                    ->form(self::getFormSchema())
                    ->slideOver()
                    ->modalWidth('md'),
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
        ];
    }

    public static function getFormSchema()
    {
        return [
            TextInput::make('first_name')
                ->label('First Name'),
            TextInput::make('last_name')
                ->label('Last Name'),
            TextInput::make('email')
                ->label('E-mail'),
            TextInput::make('telephone_number')
                ->tel(),
            TextInput::make('phone_number')
                ->label('Phone Number')
                ->tel(),
            Select::make('sex')->options([
                'male' => 'Male',
                'female' => 'Female',
            ])->label('Sex'),
            DatePicker::make('date_of_birth')
                ->label('Date of Birth'),
            TextInput::make('position')
                ->label('Position'),
            Select::make('languages')
                ->options(Language::all()->pluck('name', 'id'))
                ->multiple(),
            Grid::make('transport')
                ->schema([
                    Checkbox::make('own_transport')
                        ->label('Own Transport')
                        ->live(),
                    FileUpload::make('driving_license')
                        ->image()
                        ->hidden(fn(Get $get) => !$get('own_transport')),
                ])
                ->columns(1)
                ->columnSpan(1),
            FileUpload::make('cv')
                ->label('CV Upload')
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ])
                ->downloadable(),
            Textarea::make('notes'),
            Repeater::make('projects')
                ->schema([
                    TextInput::make('title'),
                    Textarea::make('description'),
                    TextInput::make('url')->url(),
                    DatePicker::make('start_date'),
                    DatePicker::make('end_date'),
                ])
                ->defaultItems(0),
            Hidden::make('is_working')
                ->default(true)
                ->label('Is Working'),
        ];
    }
}
