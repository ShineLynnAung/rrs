<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearcherResource\Pages;
use App\Filament\Resources\ResearcherResource\RelationManagers;
use App\Models\Researcher;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ResearcherResource extends Resource
{
    protected static ?string $model = Researcher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            TextInput::make('name')
                ->label('Researcher Name')
                ->required()
                ->maxLength(255),

            FileUpload::make('photo')
                ->label('Researcher Photo')
                ->directory('researchers')
                ->visibility('public')
                ->required(),

            TextInput::make('nrc_or_passport_no')
                ->label('NRC or Passport Number')
                ->required()
                ->maxLength(255),

            FileUpload::make('nrc_front')
                ->label('NRC Front Image'),
                
                FileUpload::make('nrc_back')
                ->label('NRC Front Image'),

            Select::make('country_id')
                ->label('Country')
                ->relationship('country', 'name')
                ->searchable()
                ->preload()
                ->required(),

            DatePicker::make('dob')
                ->label('Date of Birth')
                ->required()
                ->maxDate(now()),
            
                DatePicker::make('registration_date')
                ->label('Registration Date')
                ->required()
                ->maxDate(now()),

            Radio::make('gender')
                ->label('Gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->required(),

            Textarea::make('current_address')
                ->label('Current Address')
                ->required()
                ->maxLength(255),

            Textarea::make('permanent_address')
                ->label('Permanent Address')
                ->required()
                ->maxLength(255),

            TextInput::make('designation')
                ->label('Designation')
                ->required()
                ->maxLength(255),

                TextInput::make('organization_id')
                ->label('Organization')
                ->required(),

            TextInput::make('department')
                ->label('Department')
                ->required()
                ->maxLength(255),

            Select::make('researcher_type_id')
                ->label('Researcher Type')
                ->relationship('researcherType', 'name')
                ->required(),

            DatePicker::make('expire_date')
                ->label('Expiry Date'),

            TextInput::make('member_no')
                ->label('Member Number')
                ->required()
                ->maxLength(255),

            TextInput::make('registration_fees')
                ->label('Registration Fees')
                ->numeric()
                ->required(),

            TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255),

            FileUpload::make('attach')
                ->label('Researcher Attachment')
                ->directory('researchers/attachments'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Researcher Name')
                ->searchable()
                ->sortable(),

                ImageColumn::make('photo')
                ->getStateUsing(fn ($record) => asset('storage/' . $record->photo))
                ->width(50)
                ->height(50),

            Tables\Columns\TextColumn::make('nrc_or_passport_no')
                ->label('NRC or Passport Number')
                ->searchable(),

            Tables\Columns\TextColumn::make('country.name')
                ->label('Country')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('dob')
                ->label('Date of Birth')
                ->sortable(),

            Tables\Columns\TextColumn::make('gender')
                ->label('Gender')
                ->sortable(),

            Tables\Columns\TextColumn::make('organization.name')
                ->label('Organization')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('researcherType.name')
                ->label('Researcher Type')
                ->sortable(),

            Tables\Columns\TextColumn::make('expire_date')
                ->label('Expire Date')
                ->sortable(),

            Tables\Columns\TextColumn::make('member_no')
                ->label('Member Number')
                ->sortable(),

            Tables\Columns\TextColumn::make('registration_fees')
                ->label('Registration Fees')
                ->sortable(),
        ])
        ->filters([
            // Define filters here if needed
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListResearchers::route('/'),
            'create' => Pages\CreateResearcher::route('/create'),
            'edit' => Pages\EditResearcher::route('/{record}/edit'),
        ];
    }
}
