<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use App\Models\User;
use Tests\DuskTestCase;

class coachee_CoachesMenuTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoadCoachesIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $coach = User::find(1);
            $browser->loginAs(User::find(2))
                    ->visit('/dashboard')
                    ->click('@list-user')
                    ->waitFor('tbody > tr')
                    ->assertSee('Coach List')
                    ->assertSee($coach->name);
        });
    }

    public function testClickDetailCoachOnIndexPage()
    {
      $this->browse(function (Browser $browser) {
          $coach = User::find(1);
          $browser->loginAs(User::find(2))
                  ->visit('/clients')
                  ->waitFor('tbody > tr')
                  ->click('.detailCoach')
                  ->whenAvailable('#modals-slide-in-coach', function ($modal) use($coach) {
                    $modal->pause(3000)
                          ->assertSee($coach->name)
                          ->click('.close');
                  });
      });
    }

    public function testSearchCoachUsingDatatableSearchBox()
    {
      $this->browse(function (Browser $browser) {
          $coach = User::find(1);
          $browser->loginAs(User::find(2))
                  ->visit('/clients')
                  ->waitFor('tbody > tr')
                  ->type('.dataTables_filter input', 'user')
                  ->pause(3000)
                  ->assertSee($coach->name);
      });
    }
}
