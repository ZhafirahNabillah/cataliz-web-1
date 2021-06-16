<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Models\Client;
use Tests\DuskTestCase;

class coachee_CreatePlanPageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
     // public function __construct()
     // {
     //    $this->testLoadPlansIndexPage();
     //    $this->changeTabOnPlansIndexPage();
     // }


     public function testLoadPlansIndexPage()
     {
         $this->browse(function (Browser $browser) {
             $client = Client::where('user_id', 2)->first();
             $plan = $client->plans->where('group_id', null)->first();

             $browser->loginAs(User::find(2))
                     ->visit('/dashboard')
                     ->click('@list-plan')
                     ->waitFor('tbody > tr')
                     ->assertSee('Coaching Plans')
                     ->assertSee(strip_tags($plan->objective));
         });
     }

     public function testChangeTabOnPlansIndexPage()
     {
       $this->browse(function (Browser $browser) {
           $client = Client::where('user_id', 2)->first();
           $plan_individual = $client->plans->where('group_id', null)->first();
           $plan_group = $client->plans->where('client_id', null)->first();

           $browser->loginAs(User::find(2))
                   ->visit('/plans')
                   ->waitFor('tbody > tr')
                   ->click('#profile-tab')
                   ->pause(3000)
                   ->assertSee(strip_tags($plan_group->objective))
                   ->click('#coach-tab')
                   ->pause(3000)
                   ->assertSee(strip_tags($plan_individual->objective));
       });
     }

     public function testClickDetailPlanOnindexPage()
     {
       $this->browse(function (Browser $browser) {
           $client = Client::where('user_id', 2)->first();
           $plan_individual = $client->plans->where('group_id', null)->first();
           $plan_group = $client->plans->where('client_id', null)->first();

           $browser->loginAs(User::find(2))
                   ->visit('/plans')
                   ->waitFor('tbody > tr')
                   ->click('#profile-tab')
                   ->pause(3000)
                   ->click('@dropdown-group-plan-btn-'.$plan_group->id)
                   ->click('@detail-group-plan-btn-'.$plan_group->id)
                   ->assertPathIs('/plans/'.$plan_group->id)
                   ->back()
                   ->waitFor('tbody > tr')
                   ->click('@dropdown-individual-plan-btn-'.$plan_individual->id)
                   ->click('@detail-individual-plan-btn-'.$plan_individual->id)
                   ->assertPathIs('/plans/'.$plan_individual->id);
       });
     }
}
