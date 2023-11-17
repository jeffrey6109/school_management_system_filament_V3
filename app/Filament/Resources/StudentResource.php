<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\Race;
use App\Enums\Religion;
use App\Enums\Status;
use App\Events\DemoteStudent;
use App\Events\PromoteStudent;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $recordTitleAttribute = 'name';

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
                        TextInput::make('name')
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
            ->defaultSort('name')
            ->columns([
                TextColumn::make('student_id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('standard.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
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
                    ->native(false)
                    ->relationship('standard','name'),
                SelectFilter::make('gender')
                     ->native(false)
                    ->options(Gender::class),
                SelectFilter::make('race')
                    ->options(Race::class)
                    ->native(false),
                SelectFilter::make('religion')
                    ->options(Religion::class)
                    ->native(false),
                SelectFilter::make('status')
                    ->options(Status::class)
                    ->native(false),
            ], layout: FiltersLayout::Modal)->filtersFormColumns(2)

            ->actions([
                Tables\Actions\Action::make('Promote')
                    ->action(function(Student $record) {
                        $record->standard_id = $record->standard_id + 1;
                        $record->save();
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-chevron-up'),
                Tables\Actions\Action::make('Demote')
                    ->action(function(Student $record) {
                        if($record->standard_id > 1) {
                            $record->standard_id = $record->standard_id - 1;
                            $record->save();
                        }
                    })
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-chevron-down'),
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->color('warning'),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('Promote Selected')
                        ->action(function(Collection $records) {
                            $records->each(function ($record) {
                                event(new PromoteStudent($record));
                            });
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->color('success')
                        ->icon('heroicon-o-chevron-double-up'),
                    Tables\Actions\BulkAction::make('Demote Selected')
                        ->action(function(Collection $records) {
                            $records->each(function ($record) {
                                if($record->standard_id > 1) {
                                    event(new DemoteStudent($record));
                                }
                            });
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->color('danger')
                        ->icon('heroicon-o-chevron-double-down'),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           RelationManagers\GuardiansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Student ID' => $record->student_id,
            'Name' => $record->name ,
            'Standard' => $record->standard->name
        ];
    }

    public static function getGlobalSearchResultActions(Model $record): array
{
    return [
        Action::make('view')
            ->icon('heroicon-s-eye')
            ->url(static::getUrl('index')),
    ];
}
}
