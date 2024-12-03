<?php

namespace App\Events;

use App\Models\Task;
use Brick\Math\BigInteger;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Filament\Notifications\Notification;
use JetBrains\PhpStorm\ArrayShape;

class TaskStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Task $task;
    public string $userId;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->userId = $task['user_id'];

        // Send Filament Notification
        Notification::make()
            ->title('Task Status Updated')
            ->body("The status of your task '{$task['title']}' has been updated to '{$task['status']}'.")
            ->sendToDatabase($task['user']);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.' . $this->userId),
        ];
    }

    #[ArrayShape(['task' => "\App\Models\Task", 'status' => "mixed"])] public function broadcastWith(): array
    {
        return [
            'task' => $this->task,
            'status' => $this->task['status'],
        ];
    }
}
