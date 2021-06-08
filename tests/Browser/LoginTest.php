<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
      $this->browse(function (Browser $browser) {
        $browser->loginAs(User::find(1))
                ->visit('/dashboard')
                ->assertSee('Dashboard');
      });
    }
}
