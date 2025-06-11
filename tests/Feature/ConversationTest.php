<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ConversationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_conversation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/conversations', [
            'title' => 'Test Conversation',
        ]);

        $response->assertRedirect('/conversations');
        $this->assertDatabaseHas('conversations', [
            'title' => 'Test Conversation',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_post_message_with_file()
    {
        Storage::fake('private');
        $user = User::factory()->create();
        $conversation = Conversation::create(['user_id' => $user->id, 'title' => 'Chat']);

        $file = UploadedFile::fake()->create('test.txt', 10);

        $response = $this->actingAs($user)->post("/conversations/{$conversation->id}/messages", [
            'content' => 'hello',
            'attachments' => [$file],
        ]);

        $response->assertRedirect("/conversations/{$conversation->id}");
        $this->assertDatabaseHas('messages', ['conversation_id' => $conversation->id, 'content' => 'hello']);
        $this->assertDatabaseCount('message_attachments', 1);
    }
}
