<?php

namespace App\Livewire;

use App\Models\Rental;
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

final class RentalTable extends PowerGridComponent
{
    public string $tableName = 'rental-table-ei3nm3-table';

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
        return Rental::query()->where('team_id', '=', Auth::user()->currentTeam->id)
            ->with('PropertyTypeId');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('Id')
            ->add('name')
            ->add('property_type_id', fn ($rental) => e($rental->PropertyTypeId->type))
            ->add('team_id', fn ($rental) => e($rental->TeamId->name))
            ->add('description')
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

            Column::make('Property', 'property_type_id'),
            Column::make('Vendor', 'team_id'),

            Column::make('Address', 'full_address')
                ->searchable(),

            Column::make('Status', 'status_id')
                ->sortable(),


            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
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
            Button::make('Edit')
                ->slot('Edit')
                ->id()
                ->class('text-teal-600 font-bold hover:text-teal-500')
                ->route('edit.rental', ['rental' => $row->id]),
            Button::make('Resubmit')
                ->slot('Resubmit')
                ->id()
                ->class('text-teal-600 font-bold hover:text-teal-500')
                ->route('resubmit.rental', ['rental' => $row->id]),
            Button::make('Delete')
                ->slot('Delete')
                ->id()
                ->class('text-red-500 font-bold hover:text-red-400')
                ->route('delete.rental', ['rental' => $row->id]),
            Button::make('View In Webpage')
                ->slot('View In Webpage')
                ->id()
                ->class('text-teal-500 hover:underline')
                ->route('show.rental', ['rental' => $row->id])

        ];
    }

    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('Resubmit')
                ->when(fn($row) => $row->status_id !== 3)
                ->hide(),
        ];
    }
}
