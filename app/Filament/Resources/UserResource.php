<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

                TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

                TextInput::make('password')
                ->label('Password')
                ->required()
                ->maxLength(255),

                Select::make('role_id')
                ->label('Role')
                ->relationship('role', 'name')
                ->required(),

                Select::make('roles_id')
                    ->label('Role')
                    ->options(Role::all()->pluck('name', 'name'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->afterStateHydrated(function ($component, $state) {
                        $component->state($state[0] ?? null);
                    })
                    ->dehydrated(false)
                    ->live()
                    ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {

                        $set('roles', $state);
                }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                ->label('No.')
                ->rowIndex(),

                TextColumn::make('name')
                ->label('User Name')
                ->searchable()
                ->sortable(),

                TextColumn::make('email')
                ->label('Email Address')
                ->searchable()
                ->sortable(),

                TextColumn::make('role.name')
                ->label('Role')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                //
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

     public static function shouldRegisterNavigation(): bool
{
    return auth()->user()->hasRole('admin');
}

// Uncomment and use this for debugging if needed



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
