<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClickDeleteAgendaButton extends DuskTestCase
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
                ->waitFor('#rowIndividualButton13')
                ->click('#rowIndividualButton13')
                ->click('#deleteIndividualAgendaButton13')
                ->waitFor('.swal2-modal')
                ->click('.swal2-confirm')
                ->waitFor('.swal2-modal');
                // ->assertSee('Deleted Successfully');
      });
    }
}
