<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamPost;

/**
 * Class BlogPostAdded
 * @package HessamDev\Hessam\Events
 */
class BlogPostAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamPost */
    public $hessamPost;

    /**
     * BlogPostAdded constructor.
     * @param HessamPost $hessamPost
     */
    public function __construct(HessamPost $hessamPost)
    {
        $this->hessamPost=$hessamPost;
    }

}
