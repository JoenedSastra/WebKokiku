<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_home_page(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_is_redirected_from_login_page_to_dashboard(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/user');
    }

    public function test_authenticated_admin_is_redirected_from_login_page_to_admin_dashboard(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/login');

        $response->assertRedirect('/admin');
    }

    public function test_admin_settings_page_renders_without_missing_variable_errors(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/settings');

        $response->assertStatus(200);
    }

    public function test_admin_settings_can_be_saved_via_ajax_request(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->postJson('/admin/settings', [
            'hero_title' => 'Judul Uji Otomatis',
            'hero_subtitle' => 'Subjudul Uji Otomatis',
            'hero_text' => 'Deskripsi uji otomatis',
            'hero_title_color' => '#ff0000',
            'hero_title_weight' => '700',
            'hero_title_size' => '56px',
            'hero_subtitle_color' => '#00ff00',
            'hero_subtitle_weight' => '500',
            'hero_subtitle_size' => '28px',
            'hero_text_color' => '#0000ff',
            'hero_text_weight' => '400',
            'hero_text_size' => '20px',
            'about_title' => 'Tentang Kami Uji',
            'about_title_color' => '#123456',
            'about_title_weight' => '700',
            'about_title_size' => '36px',
            'about_paragraph1' => 'Paragraf 1 uji otomatis',
            'about_paragraph2' => 'Paragraf 2 uji otomatis',
            'about_paragraph_color' => '#654321',
            'about_paragraph_weight' => '600',
            'about_paragraph_size' => '18px',
            'nav_link_color' => '#000000',
            'nav_link_bg_color' => '#ffc107',
        ]);

        $response->assertOk();
        $this->assertSame('Judul Uji Otomatis', Setting::get('hero_title'));
    }
}
