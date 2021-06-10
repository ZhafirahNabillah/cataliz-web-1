<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class CreatePlansTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($first, $second) {

            // Login as Coach and Check the Plans Page
            $first->loginAs(User::find(1))
                ->visitRoute('plans.index');

            // // Check the Add New Plans Button Redirect 
            // $first->clickLink('Add New')
            //     ->visitRoute('plans.create')
            //     ->assertSee('Coaching Plans');

            // // Check Submit Button When Form is Totaly Null
            // $first->press('Submit')
            //     ->assertRouteIs('plans.index');
        });
    }
}
