<?php

namespace Tests\Browser;

use App\Models\Plan;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class coach_UsersMenuTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testClientIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $coachee = User::find(2);
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->waitFor('tbody > tr')
                ->assertSee('Client List')
                ->assertSee($coachee->name);
        });
    }

    public function testClientGroupIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $group_code = Plan::find(2);
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->clickLink('Client Group')
                // ->waitFor('tbody >= 1')
                ->assertSee($group_code->group_id);
        });
    }

    public function testTrainerIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->clickLink('Trainer');

            $browser->with('.coach-datatable-trainer', function ($table) {
                $table->waitFor('.odd')
                    ->assertPresent('.odd')
                    ->assertSee('User Trainer');
            });
        });
    }

    public function testMentorIndexPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->clickLink('Mentor');

            $browser->with('.coach-datatable-mentor', function ($table) {
                $table->waitFor('.odd')
                    ->assertPresent('.odd')
                    ->assertSee('User Mentor');
            });
        });
    }

    public function testClickDetailClientIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients');
            // ->waitFor('tbody > tr');

            $browser->with('.yajra-datatable', function ($table) {
                $table->waitFor('.odd')
                    ->click('.dropdown-toggle')
                    ->click('.detailClient');
                // ->visit('/clients/4')

            });

            $coachee = User::find(2);
            $browser->assertSee($coachee->name);
        });
    }

    public function testClickDetailClientGroupIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->clickLink('Client Group');

            $browser->with('.client-datatable-group', function ($table) {
                $table->waitFor('.odd')
                    ->click('.dropdown-toggle')
                    ->click('.detailGroup');
            });

            $coach = User::find(1);
            $browser->assertSee($coach->name)
                ->assertSee('Group Member');
        });
    }

    public function testClickDetailTrainerIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->clickLink('Client Trainer');

            $browser->with('.coach-datatable-trainer', function ($table) {
                $trainer = User::find(5);
                $table->waitFor('.odd')
                    ->click('.detailTrainer')
                    ->whenAvailable('#modals-slide-in-coach', function ($modal) use ($trainer) {
                        $modal->pause(3000)
                            ->assertSee($trainer->name)
                            ->click('.close');
                    });
            });
        });
    }

    public function testClickDetailMentorIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients')
                ->clickLink('Client Mentor');

            $browser->with('.coach-datatable-mentor', function ($table) {
                $mentor = User::find(5);
                $table->waitFor('.odd')
                    ->click('.detailMentor')
                    ->whenAvailable('#modals-slide-in-coach', function ($modal) use ($mentor) {
                        $modal->pause(3000)
                            ->assertSee($mentor->name)
                            ->click('.close');
                    });
            });
        });
    }

    public function testClickCreateAgendaClientIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients');

            $browser->with('.client-datatable-group', function ($table) {
                $table->waitFor('.odd')
                    ->click('.dropdown-toggle')
                    ->click('.createAgenda')
                    ->assertSee('Coaching Plans')
                    ->assertSee('Create Plan');
            });
        });
    }

    public function testClickCreateAgendaClientGroupIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/clients');

            $browser->with('.yajra-datatable', function ($table) {
                $table->waitFor('.odd')
                    ->click('.dropdown-toggle')
                    ->click('.createAgenda')
                    ->assertSee('Coaching Plans')
                    ->assertSee('Create Plan');
            });
        });
    }
}
