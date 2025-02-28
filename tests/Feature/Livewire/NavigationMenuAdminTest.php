<?php

namespace Tests\Feature\Livewire;

use App\Livewire\NavigationMenuAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavigationMenuAdminTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(NavigationMenuAdmin::class)
            ->assertStatus(200);
    }
}
