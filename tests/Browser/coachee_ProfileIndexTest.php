<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Feedback;
use Tests\DuskTestCase;

class coachee_ProfileIndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoadProfileIndexPage()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/dashboard')
                    ->click('#dropdown-user')
                    ->click('#dropdown-profile')
                    ->assertPathIs('/'.$login_user->id.'/profil')
                    ->assertSee('Profile')
                    ->assertSee($login_user->name);
        });
    }

    public function testChangeTabOnProfileIndexPage()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->click('#feedback-tab')
                    ->assertVisible('#feedback')
                    ->click('#home-tab')
                    ->assertVisible('#home');
        });
    }

    public function testChangePasswordAllFieldWasFilled()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->typeSlowly('old_password', 'coachee123')
                    ->typeSlowly('new_password', 'coachee12345')
                    ->typeSlowly('new_confirm_password', 'coachee12345')
                    ->click('#changePasswordBtn')
                    ->waitFor('.swal2-show')
                    ->assertSeeIn('.swal2-show', 'Your Password updated succesfully!')
                    ->click('.swal2-confirm');
        });
    }

    public function testChangePasswordAllFieldWasEmpty()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->typeSlowly('old_password', '')
                    ->typeSlowly('new_password', '')
                    ->typeSlowly('new_confirm_password', '')
                    ->click('#changePasswordBtn')
                    ->waitForText('The old password field is required.')
                    ->waitForText('The new password field is required.')
                    ->assertSee('The old password field is required.')
                    ->assertSee('The new password field is required.');
        });
    }

    public function testChangePasswordOldPasswordFieldWasEmpty()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->typeSlowly('old_password', '')
                    ->typeSlowly('new_password', 'coachee123')
                    ->typeSlowly('new_confirm_password', 'coachee123')
                    ->click('#changePasswordBtn')
                    ->waitForText('The old password field is required.')
                    ->assertSee('The old password field is required.');
        });
    }

    public function testChangePasswordNewPasswordFieldWasEmpty()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->typeSlowly('old_password', 'coachee123')
                    ->typeSlowly('new_password', '')
                    ->typeSlowly('new_confirm_password', '')
                    ->click('#changePasswordBtn')
                    ->waitForText('The new password field is required.')
                    ->assertSee('The new password field is required.');
        });
    }

    public function testChangePasswordConfirmationPasswordDidntMatch()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->typeSlowly('old_password', 'coachee123')
                    ->typeSlowly('new_password', 'coachee12345')
                    ->typeSlowly('new_confirm_password', 'coachee123')
                    ->click('#changePasswordBtn')
                    ->waitForText('The new confirm password and new password must match.')
                    ->assertSee('The new confirm password and new password must match.');
        });
    }

    public function testChangeOldPasswordWasWrong()
    {
        $login_user = User::find(2);

        $this->browse(function (Browser $browser) use ($login_user){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->typeSlowly('old_password', 'wrong123')
                    ->typeSlowly('new_password', 'wrong12345')
                    ->typeSlowly('new_confirm_password', 'wrong12345')
                    ->click('#changePasswordBtn')
                    ->waitForText('Password is invalid')
                    ->assertSee('Password is invalid');
        });
    }

    public function testClickDetailFeedbackOnProfileIndexPage()
    {
        $login_user = User::find(2);
        $client = $login_user->client;

        $plan = $client->plans;
        $agenda = Agenda::whereIn('plan_id', $plan->pluck('id'))->get();
        $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda->pluck('id'))->get();

        $feedbacks = Feedback::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->Where(function ($query) {
          $query->where('feedback', '!=', null)
            ->orWhere('attachment', '!=', null);
        })->get();
        $feedback = $feedbacks->where('from', 'coach')->first();

        $this->browse(function (Browser $browser) use ($login_user, $feedback){

            $browser->loginAs($login_user)
                    ->visit('/'.$login_user->id.'/profil')
                    ->click('#feedback-tab')
                    ->assertVisible('#feedback')
                    ->click('#detailFeedback[data-id="'.$feedback->id.'"]')
                    ->whenAvailable('#show_feedback', function ($modal) use($login_user, $feedback) {
                        $modal->pause(1000)
                              ->assertSee(implode(' ', array_slice(explode(' ', strip_tags($feedback->feedback)), 0, 5)));
                    });
        });
    }
}
