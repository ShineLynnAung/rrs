<?php

namespace App\Filament\Resources\ResearcherResource\Pages;
use Filament\Pages\Actions\Action;
use App\Filament\Resources\ResearcherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearcher extends EditRecord
{
    protected static string $resource = ResearcherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Action::make('view_pdf')
                ->label('View Attachment')
                ->url(fn ($record) => asset('storage/' . $record->attach))
                ->openUrlInNewTab()
                ->icon('heroicon-o-document-text'),
        ];
    }
}
