<?php

namespace App\Livewire;

use App\Models\Rental;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PropertyTable extends PowerGridComponent
{
    public string $tableName = 'property-table-a6xagz-table';

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
        return Rental::query();
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
            ->add('property_type_id', fn ($rental) => e($rental->PropertyTypeId->type))
            ->add('team_id', fn ($rental) => e($rental->TeamId->name))
            ->add('description')
            ->add('phone_number')
            ->add('full_address')            
            ->add('status_id', function ($rental) {
                if ($rental->status_id === 1) {
                    return '<div class="flex justify-center items-center"> <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div>' . $rental->StatusId->status . '</div>';
                } elseif ($rental->status_id === 2) {
                    return '<div class="flex justify-center items-center">  <div class="h-2.5 w-2.5 rounded-full bg-yellow-500 me-2"></div>' . $rental->StatusId->status . '</div>';
                } elseif ($rental->status_id === 3) {
                    return '<div class="flex justify-center items-center">  <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>' . $rental->StatusId->status . '</div>';
                } else return "STATUS NOT FOUND | CONTACT THE ADMINSTRATOR";
            })
            ->add('longitude')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Property type', 'property_type_id')
                ->sortable(),

            Column::make('Team', 'team_id'),

            Column::make('Description', 'description'),

            Column::make('Phone number', 'phone_number')
                ->searchable(),

            Column::make('Address', 'full_address')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status_id')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable(),

            Column::action('Action'),

        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    public function actions(Rental $row): array
    {
        return [
            Button::make('Approve')
                ->slot('Approve')
                ->id()
                ->class('text-teal-600 font-bold hover:text-teal-500')
                ->route('admin.approve', ['rental' => $row->id]),
            Button::make('Disapprove')
                ->slot('Disapprove')
                ->id()
                ->class('text-red-500 font-bold hover:text-red-400')
                ->route('admin.disapprove', ['rental' => $row->id]),
            Button::make('View In Webpage')
                ->slot('View In Webpage')
                ->id()
                ->class('text-teal-500 hover:underline')
                ->route('show.rental', ['rental' => $row->id]),
            Button::make('Delete')
                ->slot('Delete')
                ->id()
                ->class('text-red-500 font-bold hover:text-red-400')
                ->route('delete.rental', ['rental' => $row->id]),
        ];
    }

    public function actionRules($row): array
    {
       return [
            Rule::button('Approve')
                ->when(fn($row) => $row->status_id !== 2)
                ->hide(),
            Rule::button('Disapprove')
                ->when(fn($row) => $row->status_id !== 2)
                ->hide(),
        ];
    }
}
