<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Feedback;
use Tests\DuskTestCase;

class coach_ProfileIndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoadProfileIndexPage()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/dashboard')
                ->click('#dropdown-user')
                ->click('#dropdown-profile')
                ->assertPathIs('/' . $login_user->id . '/profil')
                ->assertSee('Profile')
                ->assertSee($login_user->name);
        });
    }

    public function testChangePasswordAllFieldWasFilled()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
                ->typeSlowly('old_password', 'coach123')
                ->typeSlowly('new_password', 'coach12345')
                ->typeSlowly('new_confirm_password', 'coach12345')
                ->click('#changePasswordBtn')
                ->waitFor('.swal2-show')
                ->assertSeeIn('.swal2-show', 'Your Password updated succesfully!')
                ->click('.swal2-confirm');
        });
    }

    public function testChangePasswordAllFieldWasEmpty()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
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
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
                ->typeSlowly('old_password', '')
                ->typeSlowly('new_password', 'coach123')
                ->typeSlowly('new_confirm_password', 'coach123')
                ->click('#changePasswordBtn')
                ->waitForText('The old password field is required.')
                ->assertSee('The old password field is required.');
        });
    }

    public function testChangePasswordNewPasswordFieldWasEmpty()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
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
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
                ->typeSlowly('old_password', 'coach123')
                ->typeSlowly('new_password', 'coach12345')
                ->typeSlowly('new_confirm_password', 'coach123')
                ->click('#changePasswordBtn')
                ->waitForText('The new confirm password and new password must match.')
                ->assertSee('The new confirm password and new password must match.');
        });
    }

    public function testChangeOldPasswordWasWrong()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
                ->typeSlowly('old_password', 'wrong123')
                ->typeSlowly('new_password', 'wrong12345')
                ->typeSlowly('new_confirm_password', 'wrong12345')
                ->click('#changePasswordBtn')
                ->waitForText('Password is invalid')
                ->assertSee('Password is invalid');
        });
    }

    public function testChangeProfileInformationOnProfileIndexPage()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
                ->click('#edit_profil')
                ->whenAvailable('#modals_profil', function ($modal) use ($login_user) {
                    $modal->pause(1000)
                        ->click('#btn_edit_profil');
                })
                ->typeSlowly('name', 'Testing')
                ->click('#saveProfileCoachBtn')
                ->assertSee('Testing');
        });
    }

    public function testChangeProfileBackgroundOnProfileIndexPage()
    {
        $login_user = User::find(1);

        $this->browse(function (Browser $browser) use ($login_user) {

            $browser->loginAs($login_user)
                ->visit('/' . $login_user->id . '/profil')
                ->click('#edit_profil')
                ->whenAvailable('#modals_profil', function ($modal) use ($login_user) {
                    $modal->pause(1000)
                        ->click('#btn_edit_background');
                })
                ->attach('background_picture', storage_path('app/public/testing_files/profile_background.jpg'))
                ->click('#saveBackgroundPictureBtn');

            $login_user_update = User::find(2);

            $browser->visit('/' . $login_user->id . '/profil')
                ->assertAttribute('.profile-header img', 'src', 'https://cataliz-s3.s3.ap-southeast-1.amazonaws.com/images/background_picture/' . $login_user_update->background_picture);
        });
    }
}
