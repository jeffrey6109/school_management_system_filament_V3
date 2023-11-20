<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use App\Enums\RelationType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GuardiansRelationManager extends RelationManager
{
    protected static string $relationship = 'guardians';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ic_no')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('contact_number')
                    ->required()
                    ->tel()
                    ->maxLength(20),
                Forms\Components\Select::make('relation_type')
                    ->native(false)
                    ->required()
                    ->options(RelationType::class),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('ic_no')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('contact_number'),
                Tables\Columns\TextColumn::make('relation_type'),
            ])
            ->filters([
                SelectFilter::make('relation_type')
                    ->native(false)
                    ->multiple()
                    ->options(RelationType::class),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
