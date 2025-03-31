<?php

use App\Models\ClassType;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;

use Illuminate\Foundation\Testing\RefreshDatabase;

test('instuctor_is_redirected_to_instructor_dashboard', function () {
    $user = User::factory()->create([
        'role' => 'instructor',
    ]);
    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertRedirectToRoute('instructor.dashboard');

    // $this->followRedirects($response)->assertSeeText('Instructor Youre logged in!');
});

test('instructor_can_schedule_a_class', function () {
    $user = User::factory()->create([
        'role' => 'instructor',
    ]);

    $this->seed(ClassTypeSeeder::class);

    $response = $this->actingAs($user)->post('instructor/schedule', [
        'class_type_id' => ClassType::first()->id,
        'date' => '2025-04-01',
        'time' => '10:00:00',
    ]);
    $response->assertRedirectToRoute('schedule.index');
});
