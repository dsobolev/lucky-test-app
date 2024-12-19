<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinkTest extends TestCase
{
    public function test_redirect_when_no_link(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/register');
    }

    public function test_redirect_when_link_does_not_exist(): void
    {
        $response = $this->get('/123');

        $response->assertRedirect('/register');
    }

}
