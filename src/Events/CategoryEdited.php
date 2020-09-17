<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamCategory;

/**
 * Class CategoryEdited
 * @package HessamDev\Hessam\Events
 */
class CategoryEdited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamCategory */
    public $hessamCategory;

    /**
     * CategoryEdited constructor.
     * @param HessamCategory $hessamCategory
     */
    public function __construct(HessamCategory $hessamCategory)
    {
        $this->hessamCategory=$hessamCategory;
    }

}
