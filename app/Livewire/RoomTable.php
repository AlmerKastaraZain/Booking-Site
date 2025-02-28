<?php

namespace App\Livewire;

use App\Models\Room;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class RoomTable extends PowerGridComponent
{
    public string $tableName = 'room-table-mxkiqz-table';

    public string $sortField = 'name'; 

    public ?string $rental;
    public ?string $roomtype;
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
        return Room::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name', function ($room) {
                return 'Room ' . $room->name;
            })
            ->add('room_type_id', function ($room) {
                return $room->RoomTypeId->name;
            })
            ->add('rental_id', function ($room) {
                return $room->RentalId->name;
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Unit', 'name'),
            Column::make('Rental', 'rental_id'),
            Column::make('Room Type', 'room_type_id'),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('check_in'),
            Filter::datepicker('check_out'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Room $row): array
    {
        return [
            Button::make('Delete')
                ->slot('Delete')
                ->id()
                ->class('text-red-500 font-bold hover:text-red-400')
                ->route('delete.room', ['rental' => $this->rental,'roomtype' => $this->roomtype,'room' => $row->id]),
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
