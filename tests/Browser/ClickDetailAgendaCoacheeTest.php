<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class ClickDetailAgendaCoachee extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                ->visit('/agendas')
                ->waitFor('#rowIndividualButton3')
                ->click('#rowIndividualButton3')
                ->click('#detailIndividualAgendaButton3')
                ->assertPathIs('/agendas/3')
                ->assertSee('Detail Agenda');
        });
    }
}
