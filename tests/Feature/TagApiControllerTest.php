<?php

use App\Models\Tag;
use App\Models\User;

test('returns a list of tags ordered by name', function () {
    $user = User::factory()->create();
    Tag::factory()->create(['name' => 'Zebra']);
    Tag::factory()->create(['name' => 'Apple']);
    Tag::factory()->create(['name' => 'Banana']);

    $response = $this->actingAs($user)->getJson('/api/tags');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonPath('data.0.name', 'Apple')
        ->assertJsonPath('data.1.name', 'Banana')
        ->assertJsonPath('data.2.name', 'Zebra');
});

test('returns tags with correct structure', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create([
        'name' => 'Test Tag',
        'color' => '#FF0000'
    ]);

    $response = $this->actingAs($user)->getJson('/api/tags');

    $response->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $tag->id)
        ->assertJsonPath('data.0.name', 'Test Tag')
        ->assertJsonPath('data.0.color', '#FF0000');
});

test('returns empty array when no tags exist', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->getJson('/api/tags');
    $response->assertStatus(200)
        ->assertJsonCount(0, 'data')
        ->assertJson([], );
});

test('includes tags with null color', function () {
    $user = User::factory()->create();
    Tag::factory()->create([
        'name' => 'Tag Without Color',
        'color' => null
    ]);

    $response = $this->actingAs($user)->getJson('/api/tags');

    $response->assertStatus(200)
        ->assertJsonCount(1);
});

test('excludes soft deleted tags from results', function () {
    $user = User::factory()->create();
    $activeTag = Tag::factory()->create(['name' => 'Active Tag']);
    $deletedTag = Tag::factory()->create(['name' => 'Deleted Tag']);

    $deletedTag->delete();

    $response = $this->actingAs($user)->getJson('/api/tags');

    $response->assertStatus(200)
        ->assertJsonCount(1);
});

test('returns correct content type header', function () {
    $user = User::factory()->create();
    Tag::factory()->create();

    $response = $this->actingAs($user)->getJson('/api/tags');

    $response->assertStatus(200)
        ->assertHeader('content-type', 'application/json');
});


test('returns 401 for unauthenticated requests', function () {
    $response = $this->getJson('/api/tags');

    $response->assertStatus(401);
});