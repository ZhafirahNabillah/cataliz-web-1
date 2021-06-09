<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClickEditAgendaButton extends DuskTestCase
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
                ->click('#editIndividualAgendaButton3')
                ->assertPathIs('/agendas/3/edit')
                ->assertSee('Edit Agenda');
      });
    }
}
