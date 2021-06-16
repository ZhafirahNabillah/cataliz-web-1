<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Models\Client;
use Tests\DuskTestCase;

class coachee_DetailPlanPageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoadPlansDetailIndividualPage()
    {
        $this->browse(function (Browser $browser) {
            $client = Client::where('user_id', 2)->first();
            $plan_individual = $client->plans->where('group_id', null)->first();
            $coach = $plan_individual->owner;
            $coach_data = $coach->user;
            // $plan_group = $client->plans->where('client_id', null)->first();

            $browser->loginAs(User::find(2))
                    ->visit('/plans/'.$plan_individual->id)
                    ->pause(3000)
                    ->assertSee($coach_data->name)
                    ->assertSee($client->name)
                    ->click('#headingCollapse1')
                    ->assertVisible('#collapse1')
                    ->click('#headingCollapse2')
                    ->assertVisible('#collapse2')
                    ->click('#headingCollapse3')
                    ->assertVisible('#collapse3')
                    ->click('#headingCollapse4')
                    ->assertVisible('#collapse4');
        });
    }

    public function testLoadPlansDetailGroupPage()
    {
        $this->browse(function (Browser $browser) {
            $client = Client::where('user_id', 2)->first();
            // $plan_individual = $client->plans->where('group_id', null)->first();
            $plan_group = $client->plans->where('client_id', null)->first();
            $coach = $plan_group->owner;
            $coach_data = $coach->user;

            $browser->loginAs(User::find(2))
                    ->visit('/plans/'.$plan_group->id)
                    ->pause(3000)
                    ->assertSee($coach_data->name)
                    ->assertSee($client->name)
                    ->click('#headingCollapse1')
                    ->assertVisible('#collapse1')
                    ->click('#headingCollapse2')
                    ->assertVisible('#collapse2')
                    ->click('#headingCollapse3')
                    ->assertVisible('#collapse3')
                    ->click('#headingCollapse4')
                    ->assertVisible('#collapse4');
        });
    }
}
