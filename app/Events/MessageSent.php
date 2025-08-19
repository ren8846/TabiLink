<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // ← 即時配信
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    /** クライアントへ渡すデータ */
    public array $payload;

    /** 受信者（プライベートchのID） */
    protected int $toUserId;

    public function __construct(array $payload, int $toUserId)
    {
        $this->payload  = $payload;
        $this->toUserId = $toUserId;
    }

    /** 送信先チャンネル：dm.{受信者ユーザーID} */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('dm.'.$this->toUserId);
    }

    /** クライアント側のイベント名 */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    /** 実際に送るデータ */
    public function broadcastWith(): array
    {
        return $this->payload;
    }
}
