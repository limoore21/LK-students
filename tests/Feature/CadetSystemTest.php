<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CadetSystemTest extends TestCase
{
    use RefreshDatabase; // Очищает БД перед каждым тестом

    public function test_curator_can_view_students_list(): void
    {
        $curator = User::factory()->create(['role' => 'curator']);
        $student = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($curator)->get('/curator/students');

        $response->assertStatus(200);
        $response->assertSee($student->name);
    }

    public function test_cadet_cannot_access_curator_panel(): void
    {
        $student = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($student)->get('/curator/students');

        $response->assertStatus(403); // Запрещено
    }

    public function test_curator_can_update_student_profile(): void
    {
        $curator = User::factory()->create(['role' => 'curator']);
        $student = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($curator)->put("/curator/students/{$student->id}", [
            'last_name' => 'Иванов',
            'first_name' => 'Иван',
            'middle_name' => 'Иванович',
            'date_of_birth' => '2000-01-01',
            'course' => 2,
            'group_name' => 'ИС-21',
        ]);

        $response->assertRedirect('/curator/students');

        $this->assertDatabaseHas('student_profiles', [
            'user_id' => $student->id,
            'last_name' => 'Иванов',
            'group_name' => 'ИС-21',
        ]);
    }

    public function test_avatar_moderation_logic(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.jpg');

        // Курсант грузит аву
        $cadet = User::factory()->create(['role' => 'user']);
        $this->actingAs($cadet)->post('/avatar/upload', ['avatar' => $file]);

        $this->assertEquals('pending', $cadet->fresh()->avatar_status);

        // Старшина грузит аву
        $sergeant = User::factory()->create(['role' => 'sergeant']);
        $this->actingAs($sergeant)->post('/avatar/upload', ['avatar' => $file]);

        $this->assertEquals('approved', $sergeant->fresh()->avatar_status);
    }
}
