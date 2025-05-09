<?php

namespace App\Filament\Resources\ResearcherTypeResource\Pages;

use App\Filament\Resources\ResearcherTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearcherTypes extends ListRecords
{
    protected static string $resource = ResearcherTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
