<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateAgendaSubmit extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
          $browser->loginAs(User::find(1))
                  ->visit('/agendas/create')
                  ->select2('.livesearch-plans', 'Lorem')
                  ->select('session', '1')
                  ->select('type_session', 'Free')
                  ->click('#saveBtn')
                  ->assertPathIs('/agendas');
        });
    }
}
