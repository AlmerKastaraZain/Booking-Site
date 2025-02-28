<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class AdminTable extends PowerGridComponent
{
    public string $tableName = 'admin-table-xvosty-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query()->where('type', '=', 'admin');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('type')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable(),

            Column::make('Email', 'email')
                ->searchable(),

            Column::make('Type', 'type'),

            Column::make('Created at', 'created_at')
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    public function actions(User $row): array
    {
        return [
            Button::make('Delete')
                ->slot('Delete')
                ->id()
                ->class('text-red-500 font-bold hover:text-red-400')
                ->route('admin.delete', ['user' => $row->id]),
        ];
    }

    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('Delete')
                ->when(fn($row) => $row->id === Auth::user()->id)
                ->hide()
        ];
    }
}
