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
        $this->browse(function (Browser $browser) {
            // Login as Coach and Check the Plans Page
            $browser->loginAs(User::find(1))
                ->visitRoute('plans.index');

            // Check the Individual Plans Table and the Data 
            $browser->with('.plan-datatable-individual', function ($table) {
                $table->waitFor('.odd')
                    ->assertPresent('.odd');
            });

            // Check the Individual Plans Table, Forms and Submit 
            $client = Client::where('user_id', 4)->first();
            $plan_individual = $client->plans->where('group_id', null)->first();

            $browser->assertPresent('.plan-datatable-individual')
                ->visit('/plans/' . $plan_individual->id . '/edit')
                ->type('id', $plan_individual->id)
                ->select2('.livesearch-plans', 'Dummy 2')
                ->type('date', '2021-06-30')
                ->waitFor('#objective_ifr')
                ->waitFor('#success_indicator_ifr')
                ->waitFor('#development_areas_ifr')
                ->waitFor('#support_ifr');

            $browser->driver->executeScript('tinyMCE.get(\'objective\').setContent(\'<p>Halo</p>\')');
            $browser->driver->executeScript('tinyMCE.get(\'success_indicator\').setContent(\'<p>Halo</p>\')');
            $browser->driver->executeScript('tinyMCE.get(\'development_areas\').setContent(\'<p>Halo</p>\')');
            $browser->driver->executeScript('tinyMCE.get(\'support\').setContent(\'<p>Halo</p>\')');

            $browser->pause(9000);

            $browser->press('Submit')
                ->assertRouteIs('plans.index');
        });
    }
}
