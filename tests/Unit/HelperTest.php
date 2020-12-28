<?php

namespace Tests\Unit;

// use Brick\Math\Internal\Calculator;
use App\Models\Eleve;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use SebastianBergmann\Complexity\Calculator;
use Tests\TestCase;

class HelperTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function check_if_all_thinks_work()
    {
        
        $this->assertEquals("Bonjour ",dire_bonjour());
    }

    /**
    * @test
    **/

    public function check_set_active_route(){


    	

        $this->assertTrue(true);
    }
}
