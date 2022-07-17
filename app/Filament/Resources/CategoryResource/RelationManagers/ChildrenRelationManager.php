<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\RelationManagers\RelationManager;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    public static function getTitle(): string
    {
        return __('Children Categories');
    }

    public static function getModelLabel(): string
    {
        return __('Sottocategoria');
    }

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $inverseRelationship = 'parent';

    protected static bool $shouldPreloadAssociateFormRecordSelectOptions = true;

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (Category $record): string => route('filament.resources.categories.edit', ['record' => $record]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label(__('Name'))
                    ->required(),
                Forms\Components\Textarea::make('description')->label(__('Description'))
                    ->rows(3)
                    ->maxLength(255)
                    ->autosize(true),
                Forms\Components\SpatieMediaLibraryFileUpload::make('hero')->label(__('Hero'))
                    ->collection('hero'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('Name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')->label(__('Description'))
                    ->wrap()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('hero')->label(__('Hero'))
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AssociateAction::make()
                    ->preloadRecordSelect(true),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DissociateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DissociateBulkAction::make(),
            ]);
    }
}
