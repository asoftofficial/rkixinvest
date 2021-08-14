<?php

namespace Chwaqas\Laramail\Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class MailablesControllerTest extends TestCase
{
    public function test_page_loads_in_allowed_environments()
    {
        Config::set('laramail.allowed_environments', ['staging', 'testing', 'local']);

        $this->get('laramail/mailables')
            ->assertOk();
    }

    public function test_returns_error_when_viewing_in_prohibited_env_by_default()
    {
        Config::set('laramail.allowed_environments', ['staging', 'local']);

        $this->get('laramail/mailables')
            ->assertStatus(403);
    }
}
