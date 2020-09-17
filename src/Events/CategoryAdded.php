<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamCategory;

/**
 * Class CategoryAdded
 * @package HessamDev\Hessam\Events
 */
class CategoryAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamCategory */
    public $hessamCategory;

    /**
     * CategoryAdded constructor.
     * @param HessamCategory $hessamCategory
     */
    public function __construct(HessamCategory $hessamCategory)
    {
        $this->hessamCategory=$hessamCategory;
    }

}
