<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClickChangeAgendaTabButton extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testChangeAgendaTab()
    {
      $this->browse(function (Browser $browser) {
          $browser->loginAs(User::find(2))
                  ->visit('/agendas')
                  ->waitFor('.sessions-datatable-individual')
                  ->click('#profile-tab')
                  ->assertPresent('.sessions-datatable-group')
                  ->click('#coach-tab')
                  ->assertPresent('.sessions-datatable-individual');
      });
    }

    public function testLoadDetailAgendaPage()
    {
      $this->browse(function (Browser $browser) {
          $browser->loginAs(User::find(2))
                  ->visit('/agendas/10')
                  ->assertSee('Detail Agenda')
                  ->assertSee('Feedback')
                  ->assertSee('Rating');
      });
    }

    public function testSubmitFeedback()
    {
      $this->browse(function (Browser $browser) {
          $browser->loginAs(User::find(2))
                  ->visit('/agendas/3')
                  ->keys('#tinymce', 'Lorem Ipsum dolor sit Amet')
                  ->assertValue('textarea','Lorem Ipsum dolor sit Amet');
      });
    }
}
