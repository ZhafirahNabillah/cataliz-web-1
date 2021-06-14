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

    public function testSubmitFeedbackAllFilled()
    {
      $this->browse(function (Browser $browser) {
        $browser->loginAs(User::find(2));

        //Go to page and wait for TinyMCE to load
        $browser->visit('/agendas/3')
                ->waitFor('#feedback_ifr');

        $browser->driver->executeScript('tinyMCE.get(\'feedback\').setContent(\'<p>Lorem Ipsum dolor sit Amet</p>\')');

        $browser->attach('feedback_attachment', storage_path('app/public/testing_files/Lorem Ipsum Dolor Sit Amet.docx'))
                ->click('#saveBtn')
                ->assertPathIs('/agendas')
                ->assertSee('Success');
      });
    }

    public function testSubmitFeedbackOnlyFeedbackFilled()
    {
      $this->browse(function (Browser $browser) {
        $browser->loginAs(User::find(2));

        //Go to page and wait for TinyMCE to load
        $browser->visit('/agendas/4')
                ->waitFor('#feedback_ifr');

        $browser->driver->executeScript('tinyMCE.get(\'feedback\').setContent(\'<p>Lorem Ipsum dolor sit Amet</p>\')');

        $browser->click('#saveBtn')
                ->assertPathIs('/agendas')
                ->assertSee('Success');
      });
    }

    public function testSubmitFeedbackOnlyFeedbackAttachmentFilled()
    {
      $this->browse(function (Browser $browser) {
        $browser->loginAs(User::find(2));

        //Go to page and wait for TinyMCE to load
        $browser->visit('/agendas/4')
                ->attach('feedback_attachment', storage_path('app/public/testing_files/Lorem Ipsum Dolor Sit Amet.docx'))
                ->click('#saveBtn')
                ->assertPathIs('/agendas')
                ->assertSee('Success');
      });
    }
}
