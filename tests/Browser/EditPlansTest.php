<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\Client;

use function PHPSTORM_META\type;

class EditPlansTest extends DuskTestCase
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
            $client = Client::where('user_id', 4)->first();
            $plan_individual = $client->plans->where('group_id', null)->first();

            $first->assertPresent('.plan-datatable-individual')
                ->visit('/plans/' . $plan_individual->id . '/edit')
                ->pause(3000)
                ->select2('.livesearch-plans', 'User')
                ->driver->executeScript('tinyMCE.get(\'plans\$plan_individual->id\edit\').setContent(\'<p>Lorem Ipsum dolor sit Amet</p>\')')
                ->type('date','2021-06-27');
                // ->press('Submit')
                // ->assertRouteIs('plans.index');
        });
    }
}
