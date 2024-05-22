<?php

namespace App\Jobs;

use App\Events\GotMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;


class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Message $message) {
        //
    }

    public function handle(): void {
            GotMessage::dispatch(
                [
                    'id' => $this->message->id,
                    'user_id' => $this->message->user_id,
                    'text' => $this->message->text,
                    'time' => $this->message->time,
                ]
            );
    }
}
