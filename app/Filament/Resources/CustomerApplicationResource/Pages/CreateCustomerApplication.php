<?php

namespace App\Filament\Resources\CustomerApplicationResource\Pages;

use App\Filament\Resources\CustomerApplicationResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomerApplication extends CreateRecord
{

    protected function getFormActions(): array
    {
        return [
            $this->getCancelFormAction(),
        ];
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
            ->url($this->previousUrl ?? static::getResource()::getUrl())
            ->requiresConfirmation(true)
            ->color('gray');
    }

    protected static string $resource = CustomerApplicationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['branch_id'] = auth()->user()->branch_id;
        $data['author_id'] = auth()->user()->id;
        $data['application_type'] = "walk-in";
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data);
    }

}