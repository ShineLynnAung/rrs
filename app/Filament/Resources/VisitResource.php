<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitResource\Pages;
use App\Filament\Resources\VisitResource\RelationManagers;
use App\Models\Visit;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    public static ?string $label = 'Visitors';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('researcher_id')
                    ->label('Researcher')
                    ->relationship('researcher', 'name')
                    ->required(),

                    Select::make('copy_type_id')
                    ->label('Copy Type')
                    ->relationship('copyType', 'name')
                    ->required(),

                    Select::make('group_id')
                    ->label('Group')
                    ->options(\App\Models\Group::all()->pluck('name', 'id'))
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $group = \App\Models\Group::find($state);
                        if ($group) {
                            $set('group_code', $group?->group_code);
                            $set('archives_group', $group->name);
                        }
                    }),
                
                
                Hidden::make('archives_group'),

                TextInput::make('group_code')
                    ->label('Group Code')
                    ->disabled()
                    ->default(null),
                

               TextInput::make('fees')
                    ->label('Copying Fee')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                    TextInput::make('no_of_pages')
                    ->label('Number of Pages')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                    TextInput::make('accession_no')
                    ->label('Accession Number')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                    DatePicker::make('visit_date')
                ->label('Visit Date')
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                ->label('No.')
                ->rowIndex(),

                TextColumn::make('researcher.name')
                ->label('Researcher Name')
                ->sortable()
                ->searchable(),

                TextColumn::make('archives_group')
                ->label('Archives Group')
                ->sortable()
                ->searchable(),

                TextColumn::make('accession_no')
                ->label('Accession Number')
                ->searchable()
                ->sortable(),

                TextColumn::make('copyType.name')
                ->label('Copy Type')
                ->sortable()
                ->searchable(),

                TextColumn::make('no_of_pages')
                ->label('Number of Pages')
                ->sortable()
                ->searchable(),
                
                
            ])
            ->filters([
                
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
