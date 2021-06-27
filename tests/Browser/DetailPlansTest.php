<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class DetailPlansTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($first) {
            // Login as Coach and Check the Plans Page
            $first->loginAs(User::find(1))
                ->visitRoute('plans.index');

            // Check the Individual Plans Table and the Data 
            $first->with('.plan-datatable-individual', function ($table) {
                $table->waitFor('.odd')
                    ->assertPresent('.odd');
            });

            // Check the Group Plans Button, Table, and the Data 
            $first->assertPresent('.plan-datatable-individual')
                ->with('.plan-datatable-individual', function ($table) {
                    $table->waitFor('.odd')
                        ->assertPresent('.odd')
                        ->click('.pr-1')
                        ->click('.dropdown-item');
                });

            // Login as Coachee and Check the Plans Page
            // $second->loginAs(User::find(2))
            //     ->visit('/plans');
        });
    }
}
