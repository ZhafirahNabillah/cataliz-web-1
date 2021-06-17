<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class coachee_DashboardTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoadDashboardPage()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/dashboard')
                    ->assertSee('Welcome, '.$login_user->name.', You are logged in!');
        });
    }

    public function testChangeTabOnUpcomingEventTable()
    {

      $login_user = User::find(2);
      $client = $login_user->client;

      //first upcoming individual session
      $plan_individual = $client->plans->where('group_id', null);
      $agenda_individual = Agenda::whereIn('plan_id', $plan_individual->pluck('id'))->get();
      $agenda_detail_individual = Agenda_detail::whereIn('agenda_id', $agenda_individual->pluck('id'))->whereIn('status', ['scheduled', 'rescheduled'])->first();

      //first upcoming group session
      $plan_group = $client->plans->where('client_id', null);
      $agenda_group = Agenda::whereIn('plan_id', $plan_group->pluck('id'))->get();
      $agenda_detail_group = Agenda_detail::whereIn('agenda_id', $agenda_group->pluck('id'))->whereIn('status', ['scheduled', 'rescheduled'])->first();

      $this->browse(function (Browser $browser) use($login_user, $agenda_detail_group, $agenda_detail_individual){

          $browser->loginAs($login_user)
                  ->visit('/dashboard')
                  ->click('#upcoming-group-tab')
                  ->waitFor('.upcoming-datatable-group tbody > tr')
                  ->assertSee($agenda_detail_group->session_name)
                  ->click('#upcoming-individual-tab')
                  ->waitFor('.upcoming-datatable-individual tbody > tr')
                  ->assertSee($agenda_detail_individual->session_name);
      });
    }

    public function testChangeTabOnListAgendaTable()
    {

      $login_user = User::find(2);
      $client = $login_user->client;

      //first agenda individual session
      $plan_individual = $client->plans->where('group_id', null);
      $agenda_individual = Agenda::whereIn('plan_id', $plan_individual->pluck('id'))->get();
      $agenda_detail_individual = Agenda_detail::whereIn('agenda_id', $agenda_individual->pluck('id'))->first();

      //first agenda group session
      $plan_group = $client->plans->where('client_id', null);
      $agenda_group = Agenda::whereIn('plan_id', $plan_group->pluck('id'))->get();
      $agenda_detail_group = Agenda_detail::whereIn('agenda_id', $agenda_group->pluck('id'))->first();

      $this->browse(function (Browser $browser) use($login_user, $agenda_detail_group, $agenda_detail_individual){

          $browser->loginAs($login_user)
                  ->visit('/dashboard')
                  ->click('#agenda-group-tab')
                  ->waitFor('.agenda-datatable-group tbody > tr')
                  ->assertSee($agenda_detail_group->session_name)
                  ->click('#agenda-individual-tab')
                  ->waitFor('.agenda-datatable-individual tbody > tr')
                  ->assertSee($agenda_detail_individual->session_name);
      });
    }

    public function testClickDashboardSummaryBtn()
    {
      $login_user = User::find(2);

      $this->browse(function (Browser $browser) use ($login_user) {

          $browser->loginAs($login_user)
                  ->visit('/dashboard')
                  ->click('#TotalCoachingHourBtn')
                  ->assertPathIs('/agendas')
                  ->back()
                  ->click('#TotalCoachesBtn')
                  ->assertPathIs('/clients')
                  ->back()
                  ->click('#TotalSessionsBtn')
                  ->assertPathIs('/agendas')
                  ->back();
      });
    }

    public function testClickCalendarDate()
    {
      $login_user = User::find(2);

      $this->browse(function (Browser $browser) use ($login_user) {

          $browser->loginAs($login_user)
                  ->visit('/dashboard')
                  ->waitFor('.fc-day')
                  ->scrollIntoView('#calendar')
                  ->click('td[data-date="2021-06-05"]')
                  ->waitForTextIn('#list_event_wrapper', '2021-06-05')
                  ->assertSeeIn('#list_event_wrapper', '2021-06-05');
      });
    }
}
