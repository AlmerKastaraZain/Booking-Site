<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateRental;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateRentalTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CreateRental::class)
            ->assertStatus(200);
    }
}
