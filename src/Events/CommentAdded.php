<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamComment;
use HessamDev\Hessam\Models\HessamPost;

/**
 * Class CommentAdded
 * @package HessamDev\Hessam\Events
 */
class CommentAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamPost */
    public $hessamPost;
    /** @var  HessamComment */
    public $newComment;

    /**
     * CommentAdded constructor.
     * @param HessamPost $hessamPost
     * @param HessamComment $newComment
     */
    public function __construct(HessamPost $hessamPost, HessamComment $newComment)
    {
        $this->hessamPost=$hessamPost;
        $this->newComment=$newComment;
    }

}
