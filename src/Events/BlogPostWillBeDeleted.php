<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamPost;

/**
 * Class BlogPostWillBeDeleted
 * @package HessamDev\Hessam\Events
 */
class BlogPostWillBeDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamPost */
    public $hessamPost;

    /**
     * BlogPostWillBeDeleted constructor.
     * @param HessamPost $hessamPost
     */
    public function __construct(HessamPost $hessamPost)
    {
        $this->hessamPost=$hessamPost;
    }

}
