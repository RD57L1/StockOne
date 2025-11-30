<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn (): bool => auth()->user()?->can('delete', $this->record) ?? false),
        ];
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);
        
        // Verificar se o usuário tem permissão para editar este registro
        abort_unless(auth()->user()?->can('update', $this->record), 403);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Se o usuário não é admin, remover is_admin dos dados (proteção extra)
        if (!auth()->user()?->is_admin) {
            unset($data['is_admin']);
            // Manter o valor original do is_admin
            $data['is_admin'] = $this->record->is_admin;
        }
        
        return $data;
    }
}
