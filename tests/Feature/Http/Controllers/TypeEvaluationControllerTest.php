<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TypeEvaluation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TypeEvaluationController
 */
class TypeEvaluationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $typeEvaluations = TypeEvaluation::factory()->count(3)->create();

        $response = $this->get(route('type-evaluation.index'));
    }
}
