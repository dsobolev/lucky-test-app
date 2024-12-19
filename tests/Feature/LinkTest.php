<?php

namespace Tests\Feature;

use App\Models\User;
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

    public function test_redirects_when_link_expired(): void
    {
        // created in DatabaseSeeder
        $user = User::where('username', 'expired_tst_1')->first();

        $response = $this->get('/' . $user->link_token);

        $response->assertRedirect('/register');
    }

    public function test_shows_lucky_page_when_link_valid(): void
    {
        $username = 'valid_tst_1';
        $user = User::factory()->create([
            'username' => $username,
            'expired_at' => new \DateTimeImmutable('tomorrow'),
        ]);

        $response = $this->get('/' . $user->link_token);

        $response->assertStatus(200);
        $response->assertViewHas('username', $username);

        $user->delete();
    }
}
