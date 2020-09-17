<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamPost;

/**
 * Class BlogPostEdited
 * @package HessamDev\Hessam\Events
 */
class BlogPostEdited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamPost */
    public $hessamPost;

    /**
     * BlogPostEdited constructor.
     * @param HessamPost $hessamPost
     */
    public function __construct(HessamPost $hessamPost)
    {
        $this->hessamPost=$hessamPost;
    }

}
