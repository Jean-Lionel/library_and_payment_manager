<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LevelController
 */
class LevelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $levels = Level::factory()->count(3)->create();

        $response = $this->get(route('level.index'));

        $response->assertOk();
        $response->assertViewIs('level.index');
        $response->assertViewHas('levels');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LevelController::class,
            'store',
            \App\Http\Requests\LevelStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('level.store'), [
            'name' => $name,
        ]);

        $levels = Level::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $levels);
        $level = $levels->first();

        $response->assertRedirect(route('level.index'));
        $response->assertSessionHas('level.name', $level->name);
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('level.create'));

        $response->assertOk();
        $response->assertViewIs('level.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $level = Level::factory()->create();

        $response = $this->get(route('level.edit', $level));

        $response->assertOk();
        $response->assertViewIs('level.edit');
        $response->assertViewHas('level');
    }
}
