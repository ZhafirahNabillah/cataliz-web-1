<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClickDetailAgendaButton extends DuskTestCase
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
                ->visit('/agendas')
                ->waitFor('#rowIndividualButton3')
                ->click('#rowIndividualButton3')
                ->click('#detailIndividualAgendaButton3')
                ->assertPathIs('/agendas/3')
                ->assertSee('Detail Agenda');
      });
    }
}
