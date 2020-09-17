<?php

namespace HessamDev\Hessam\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use HessamDev\Hessam\Models\HessamPost;

/**
 * Class UploadedImage
 * @package HessamDev\Hessam\Events
 */
class UploadedImage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var  HessamPost|null */
    public $hessamPost;
    /**
     * @var
     */
    public $image;

    public $source;
    public $image_filename;

    /**
     * UploadedImage constructor.
     *
     * @param $image_filename - the new filename
     * @param HessamPost $hessamPost
     * @param $image
     * @param $source string|null  the __METHOD__  firing this event (or other string)
     */
    public function __construct(string $image_filename, $image,HessamPost $hessamPost=null,string $source='other')
    {
        $this->image_filename = $image_filename;
        $this->hessamPost=$hessamPost;
        $this->image=$image;
        $this->source=$source;
    }

}
