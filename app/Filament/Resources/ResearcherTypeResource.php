<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearcherTypeResource\Pages;
use App\Filament\Resources\ResearcherTypeResource\RelationManagers;
use App\Models\ResearcherType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResearcherTypeResource extends Resource
{
    protected static ?string $model = ResearcherType::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Researcher Type Name')
                ->required()
                ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No.')
                ->rowIndex(),
                
                Tables\Columns\TextColumn::make('name')
                ->label('Researcher Type Name')
                ->searchable()
                ->sortable(),
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
            'index' => Pages\ListResearcherTypes::route('/'),
            'create' => Pages\CreateResearcherType::route('/create'),
            'edit' => Pages\EditResearcherType::route('/{record}/edit'),
        ];
    }
}
