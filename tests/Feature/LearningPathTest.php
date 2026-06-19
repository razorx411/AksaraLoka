<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Level;
use App\Models\Chapter;
use App\Models\UserLevelProgress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LearningPathTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed DB
        $this->seed(\Database\Seeders\LearningPathSeeder::class);
    }

    public function test_user_can_access_home_with_dynamic_levels()
    {
        $user = User::factory()->create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        $response->assertSee('Mulai: Sugeng Enjang');
    }

    public function test_user_can_access_level_question_page()
    {
        $user = User::factory()->create();
        $level = Level::first();

        $response = $this->actingAs($user)->get("/level/{$level->id}");
        $response->assertStatus(200);
        $response->assertSee($level->title);
    }

    public function test_user_can_complete_level_and_save_progress()
    {
        $user = User::factory()->create([
            'total_points' => 0,
            'streak_count' => 0,
        ]);
        $level = Level::first();

        $response = $this->actingAs($user)->postJson("/level/{$level->id}/complete");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Level selesai!',
            'xp_earned' => $level->xp_reward,
        ]);

        // Assert DB has progress
        $this->assertDatabaseHas('user_level_progress', [
            'user_id' => $user->id,
            'level_id' => $level->id,
            'is_completed' => 1,
        ]);

        // Assert user stats updated
        $user->refresh();
        $this->assertEquals($level->xp_reward, $user->total_points);
        $this->assertEquals(1, $user->streak_count);
    }
}

