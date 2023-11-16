<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\Race;
use App\Enums\Religion;
use App\Enums\Status;
use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\GlobalSearch\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Student details')
                    ->schema([
                        TextInput::make('student_id')
                            ->default('STD-'.strtoupper(uniqid()))
                            ->readonly(true)
                            ->required(),
                        TextInput::make('first_name')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('last_name')
                            ->maxLength(255)
                            ->required(),
                        Radio::make('gender')
                            ->options(Gender::class)
                            ->required(),
                        DatePicker::make('date_of_birth')
                            ->format('j M, Y')
                            ->native(false)
                            ->required(),
                        Select::make('race')
                            ->options(Race::class)
                            ->native(false)
                            ->required(),
                        Select::make('religion')
                            ->options(Religion::class)
                            ->native(false)
                            ->required(),
                        TextInput::make('nationality')
                            ->required(),
                        TextInput::make('ic_no')
                            ->required(),
                        Select::make('status')
                            ->options(Status::class)
                            ->native(false)
                            ->required(),
                        Select::make('standard_id')
                            ->required()
                            ->native(false)
                            ->relationship('standard', 'name'),
                    ])->columns(2),

                Section::make('Contact details')
                    ->schema([
                        TextInput::make('home_phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                        TextInput::make('mobile_phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                        TextInput::make('email')
                            ->email(),
                        TextInput::make('address_1')
                            ->required(),
                        TextInput::make('address_2')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('first_name')
            ->columns([
                TextColumn::make('student_id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('standard.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('last_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('gender')
                    ->sortable()
                    ->badge(),
                TextColumn::make('date_of_birth')
                    ->date('j M, Y')
                    ->sortable(),
                TextColumn::make('ic_no')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('race')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('religion')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nationality')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('home_phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('mobile_phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('address_1')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('address_2')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('Standard')
                    ->relationship('standard','name'),
                SelectFilter::make('gender')
                    ->options(Gender::class),
                SelectFilter::make('race')
                    ->options(Race::class),
                SelectFilter::make('religion')
                    ->options(Religion::class),
                SelectFilter::make('status')
                    ->options(Status::class),
            ], layout: FiltersLayout::Modal)->filtersFormColumns(2)

            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListStudents::route('/'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Student ID' => $record->student_id,
            'Name' => $record->first_name . ' ' . $record->last_name,
            'Standard' => $record->standard->name
        ];
    }

    public static function getGlobalSearchResultActions(Model $record): array
{
    return [
        Action::make('view')
            ->icon('heroicon-s-eye')
            ->url(static::getUrl('view', ['record' => $record])),
    ];
}
}
