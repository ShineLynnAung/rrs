<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public static function canViewAny(): bool
    {
        return Auth::user()->hasRole('admin'); 
    }
    protected function afterCreate(): void
    {
        $record = $this->record;
        $data = $this->form->getState();


        $roleNames = $data['role_names'] ?? [];
        $roleIds = \App\Models\Role::whereIn('name', $roleNames)->pluck('id');

        \DB::table('model_has_roles')
            ->where('model_id', $record->id)
            ->where('model_type', get_class($record))
            ->delete();

        foreach ($roleIds as $roleId) {
            \DB::table('model_has_roles')->insert([
                'role_id' => $roleId,
                'model_type' => get_class($record),
                'model_id' => $record->id,
            ]);
        }
    }
}
