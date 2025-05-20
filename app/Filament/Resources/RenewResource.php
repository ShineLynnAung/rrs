<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RenewResource\Pages;
use App\Filament\Resources\RenewResource\RelationManagers;
use App\Models\Renew;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RenewResource extends Resource
{
    protected static ?string $model = Renew::class;

    public static ?string $label = 'Membership Renew';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('researcher_id')
                    ->label('Researcher')
                    ->relationship('researcher', 'name')
                    ->required()
                    ->afterStateHydrated(function ($state, callable $set) {
                        $resercher = \App\Models\Researcher::find($state);
                        $set('nrc_or_passport_no', $resercher?->nrc_or_passport_no);
                        $set('member_no', $resercher?->member_no);
                        $set('country_id', $resercher?->country_id);
                        $set('department', $resercher?->department);
                        $set('researcher_type_id', $resercher?->researcher_type_id);
                        $set('oexpire_date', $resercher?->expire_date);
                        $set('otitle', $resercher?->title);
                    }),

                    TextInput::make('member_no')
                    ->label('Member Number')
                    ->disabled()
                    ->default(null),

                    TextInput::make('nrc_or_passport_no')
                    ->label('NRC or Passport Number')
                    ->disabled()
                    ->default(null),

                    Select::make('country_id')
                    ->label('Country')
                    ->relationship('country', 'name')
                    ->disabled()
                    ->default(null),

                    TextInput::make('department')
                    ->label('Department')
                    ->disabled()
                    ->default(null),

                    Select::make('researcher_type_id')
                    ->label('Researcher Type')
                    ->relationship('researcher_type', 'name')
                    ->disabled()
                    ->default(null),

                    TextInput::make('oexpire_date')
                    ->label('Expire Date')
                    ->disabled()
                    ->default(null),

                    TextInput::make('otitle')
                    ->label('Subject/Title')
                    ->disabled()
                    ->default(null),

                    \Filament\Forms\Components\Placeholder::make('separator')
                        ->disableLabel(),

                    DatePicker::make('renew_date')
                    ->label('Renew Date')
                    ->required(),

                    DatePicker::make('expire_date')
                    ->label('Expire Date')
                    ->required(),

                    TextInput::make('title')
                    ->label('Subject/Title')
                    ->required(),

                    FileUpload::make('attach')
                ->label('Attachment')
                ->required()
                ->directory('researchers/attachments'),

                Hidden::make('created_by')
                ->default(auth()->user()->name),

                Hidden::make('updated_by')
                ->default(auth()->user()->name),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('index')
                ->label('No.')
                ->sortable()
                ->rowIndex(),
            TextColumn::make('researcher.name')
                ->label('Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('title')
                ->label('Subject/Title')
                ->sortable()
                ->searchable(),
            TextColumn::make('renew_date')
                ->label('Renew Date')
                ->sortable()
                ->searchable(),
            TextColumn::make('expire_date')
                ->label('Expire Date')
                ->sortable(),
            TextColumn::make('createdBy.name')
                ->label('Created By')
                ->sortable()
                ->default('N/A'),
        ])
        ->filters([
            Filter::make('renew_date')
                ->label('Renew Date')
                ->form([
                    DatePicker::make('from_date')
                        ->label('From Date'),
                    DatePicker::make('to_date')
                        ->label('To Date'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['from_date'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('renew_date', '>=', $date)
                        )
                        ->when(
                            $data['to_date'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('renew_date', '<=', $date)
                        );
                }),
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
            'index' => Pages\ListRenews::route('/'),
            'create' => Pages\CreateRenew::route('/create'),
            'edit' => Pages\EditRenew::route('/{record}/edit'),
        ];
    }
}
