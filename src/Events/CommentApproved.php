<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamComment;

/**
 * Class CommentApproved
 * @package HessamDev\Hessam\Events
 */
class CommentApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamComment */
    public $comment;

    /**
     * CommentApproved constructor.
     * @param HessamComment $comment
     */
    public function __construct(HessamComment $comment)
    {
        $this->comment=$comment;
        // you can get the blog post via $comment->post
    }

}
