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
        $this->browse(function (Browser $browser) {

            // Login as Coach and Check the Plans Page
            $browser->loginAs(User::find(1))
                ->visitRoute('plans.index');

            // Check the Add New Plans Button Redirect 
            $browser->clickLink('Add New')
                ->visitRoute('plans.create')
                ->assertSee('Coaching Plans')
                ->select2('.livesearch-plans', 'Dummy 2')
                ->type('date', '2021-06-29')
                ->waitFor('#objective_ifr')
                ->waitFor('#success_indicator_ifr')
                ->waitFor('#development_areas_ifr')
                ->waitFor('#support_ifr');

            $browser->driver->executeScript('tinyMCE.get(\'objective\').setContent(\'<p>Ha</p>\')');
            $browser->driver->executeScript('tinyMCE.get(\'success_indicator\').setContent(\'<p>Ha</p>\')');
            $browser->driver->executeScript('tinyMCE.get(\'development_areas\').setContent(\'<p>Ha</p>\')');
            $browser->driver->executeScript('tinyMCE.get(\'support\').setContent(\'<p>Ha</p>\')');

            $browser->pause(9000);
            $browser->press('Submit')
                ->assertRouteIs('plans.index');
        });
    }
}
