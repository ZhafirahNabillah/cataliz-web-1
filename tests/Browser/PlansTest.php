<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Tests\Browser\Pages\Dashboard;

class PlansTest extends DuskTestCase
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

            // Check the Individual Plans Table and the Data 
            $first->with('.plan-datatable-individual', function ($table) {
                $table->waitFor('.odd')
                    ->assertPresent('.odd');
            });

            // Check the Group Plans Button, Table, and the Data 
            $first->clickLink('Group')
                ->assertPresent('.plan-datatable-group')
                ->with('.plan-datatable-group', function ($table) {
                    $table->waitFor('.odd')
                        ->assertPresent('.odd');
                });

            // Login as Coachee and Check the Plans Page
            $second->loginAs(User::find(2))
                ->visit('/plans');
        });
    }
}
