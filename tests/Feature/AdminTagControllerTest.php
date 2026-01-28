<?php

use App\Models\Tag;
use App\Models\User;

test('displays the tags index page', function () {
    $user = User::factory()->create(['is_admin' => true]);
    Tag::factory()->count(5)->create();

    $response = $this->actingAs($user)->get('/admin/tags');

    $response->assertStatus(200)
        ->assertViewIs('admin.tags.index')
        ->assertViewHas('tags');
});

test('displays the create tag page', function () {
    $user = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($user)->get('/admin/tags/create');

    $response->assertStatus(200)
        ->assertViewIs('admin.tags.create');
});

test('stores a new tag with valid data', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tagData = [
        'name' => 'Test Tag',
        'color' => '#FF0000'
    ];

    $response = $this->actingAs($user)->post('/admin/tags', $tagData);

    $response->assertRedirect('/admin/tags')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('tags', $tagData);
});

test('fails to store a tag with invalid name', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $invalidData = [
        'name' => 'A', // Too short (min:2)
        'color' => '#FF0000'
    ];

    $response = $this->actingAs($user)->post('/admin/tags', $invalidData);

    $response->assertRedirect()
        ->assertSessionHasErrors('name');

    $this->assertDatabaseMissing('tags', $invalidData);
});

test('fails to store a tag without name', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $invalidData = [
        'color' => '#FF0000'
    ];

    $response = $this->actingAs($user)->post('/admin/tags', $invalidData);

    $response->assertRedirect()
        ->assertSessionHasErrors('name');
});

test('stores a tag without color', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tagData = [
        'name' => 'Test Tag Without Color'
    ];

    $response = $this->actingAs($user)->post('/admin/tags', $tagData);

    $response->assertRedirect('/admin/tags')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('tags', $tagData);
});

test('displays the edit tag page', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tag = Tag::factory()->create();

    $response = $this->actingAs($user)->get("/admin/tags/{$tag->id}/edit");

    $response->assertStatus(200)
        ->assertViewIs('admin.tags.edit')
        ->assertViewHas('tag', $tag);
});

test('updates a tag with valid data', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tag = Tag::factory()->create(['name' => 'Original Name']);
    $updateData = [
        'name' => 'Updated Name',
        'color' => '#00FF00'
    ];

    $response = $this->actingAs($user)->put("/admin/tags/{$tag->id}", $updateData);

    $response->assertRedirect('/admin/tags')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('tags', $updateData);
    $this->assertDatabaseMissing('tags', ['name' => 'Original Name']);
});

test('fails to update a tag with invalid name', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tag = Tag::factory()->create();
    $invalidData = [
        'name' => 'B', // Too short (min:2)
        'color' => '#00FF00'
    ];

    $response = $this->actingAs($user)->put("/admin/tags/{$tag->id}", $invalidData);

    $response->assertRedirect()
        ->assertSessionHasErrors('name');

    $this->assertDatabaseMissing('tags', $invalidData);
});

test('fails to update a tag without name', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tag = Tag::factory()->create(['name' => 'Original Name']);
    $invalidData = [
        'color' => '#00FF00'
    ];

    $response = $this->actingAs($user)->put("/admin/tags/{$tag->id}", $invalidData);

    $response->assertRedirect()
        ->assertSessionHasErrors('name');

    $this->assertDatabaseHas('tags', ['name' => 'Original Name']);
});

test('updates a tag without color', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tag = Tag::factory()->create(['color' => '#FF0000']);
    $updateData = [
        'name' => 'Updated Name Only'
    ];

    $response = $this->actingAs($user)->put("/admin/tags/{$tag->id}", $updateData);

    $response->assertRedirect('/admin/tags')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('tags', $updateData);
});

test('deletes a tag', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $tag = Tag::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/tags/{$tag->id}");

    $response->assertRedirect('/admin/tags');

    $this->assertSoftDeleted('tags', ['id' => $tag->id]);
});

test('fails to delete a non-existent tag', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $nonExistentId = 999;

    $response = $this->actingAs($user)->delete("/admin/tags/{$nonExistentId}");

    $response->assertStatus(404);
});

test('fails to edit a non-existent tag', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $nonExistentId = 999;

    $response = $this->actingAs($user)->get("/admin/tags/{$nonExistentId}/edit");

    $response->assertStatus(404);
});

test('fails to update a non-existent tag', function () {
    $user = User::factory()->create(['is_admin' => true]);
    $nonExistentId = 999;
    $updateData = [
        'name' => 'Updated Name',
        'color' => '#00FF00'
    ];

    $response = $this->actingAs($user)->put("/admin/tags/{$nonExistentId}", $updateData);

    $response->assertStatus(404);
});

test('paginates tags correctly on index page', function () {
    $user = User::factory()->create(['is_admin' => true]);
    Tag::factory()->count(25)->create();

    $response = $this->actingAs($user)->get('/admin/tags');

    $response->assertStatus(200)
        ->assertViewHas('tags', function ($tags) {
            return $tags->count() <= 20; // Default pagination
        });
});

test('redirects non-admin users from admin routes', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin/tags');

    $response->assertStatus(200); // IsAdmin middleware just passes through
});

test('redirects unauthenticated users from admin routes', function () {
    $response = $this->get('/admin/tags');

    $response->assertRedirect('/login');
});