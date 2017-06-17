<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * Correct login.
     *
     * @return void
     */
    public function testcorrectLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
            ->pause(500)
            ->type('email', 'admin@eqs.de')
            ->type('password', 'admin')
            ->press('Login')
            ->waitFor('.active')
            ->assertSee('Dashboard');

        });
    }

    /**
     * Test wrong login.
     *
     * @return void
     */
    public function testInvalidLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->pause(500)
                ->type('email', 'admssin@eqs.de')
                ->type('password', 'adminsasas')
                ->press('Login')
                ->pause(1000)
                ->assertSee('These credentials do not match our records');

        });
    }
}
