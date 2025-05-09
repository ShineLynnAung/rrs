<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RenewResource\Pages;
use App\Filament\Resources\RenewResource\RelationManagers;
use App\Models\Renew;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $resercher = \App\Models\Researcher::find($state);
                        $set('nrc_or_passport_no', $resercher?->nrc_or_passport_no);
                        $set('member_no', $resercher?->member_no);
                        $set('country_id', $resercher?->country_id);
                        $set('department', $resercher?->department);
                        $set('researcher_type_id', $resercher?->researcher_type_id);
                        $set('expire_date', $resercher?->expire_date);
                        $set('title', $resercher?->title);
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

                    TextInput::make('expire_date')
                    ->label('Expire Date')
                    ->disabled()
                    ->default(null),

                    TextInput::make('title')
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
                ->directory('researchers/attachments'),
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
            'index' => Pages\ListRenews::route('/'),
            'create' => Pages\CreateRenew::route('/create'),
            'edit' => Pages\EditRenew::route('/{record}/edit'),
        ];
    }
}
