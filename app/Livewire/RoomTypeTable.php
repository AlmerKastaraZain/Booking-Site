<?php

namespace App\Livewire;

use App\Models\Rental;
use App\Models\RoomType;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class RoomTypeTable extends PowerGridComponent
{
    public string $tableName = 'room-type-table-q1oaph-table';
    public ?string $rental; 
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
        return RoomType::query()->with('RentalId')->where('rental_id', '=', $this->rental);
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
            ->add('description')
            ->add('rental_id', fn ($roomType) => e($roomType->RentalId->name))
            ->add('price', fn ($roomType) => e('USD. ' . $roomType->price))
            ->add('wide')
            ->add('adult')
            ->add('child')
            ->add('bed')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable(),

            Column::make('Description', 'description'),

            Column::make('Rental', 'rental_id'),
            Column::make('Price', 'price')
                ->sortable(),

            Column::make('Wide', 'wide')
                ->sortable(),

            Column::make('Adult', 'adult')
                ->sortable(),

            Column::make('Child', 'child')
                ->sortable(),

            Column::make('Bed', 'bed')
                ->sortable(),

            Column::make('Created at', 'created_at'),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(RoomType $row): array
    {
        return [
            Button::make('edit')
                ->slot('Edit')
                ->id()
                ->class('text-teal-600 font-bold hover:text-teal-500')
                ->route('edit.roomtype', [Rental::query()->find($this->rental), 'roomtype' =>  RoomType::query()->find($row->id)]),
            Button::make('Delete')
                ->slot('Delete')
                ->id()
                ->class('text-red-500 font-bold hover:text-red-400')
                ->route('delete.roomtype', [Rental::query()->find($this->rental), 'roomtype' => RoomType::query()->find($row->id)]),
            Button::make('Manage Images')
                ->slot('Manage Images')
                ->id()
                ->route('image.roomtype', [Rental::query()->find($this->rental), 'roomtype' => RoomType::query()->find($row->id)])
                ->class('text-teal-500 hover:underline')
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
