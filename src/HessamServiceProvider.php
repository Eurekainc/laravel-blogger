<?php

namespace HessamDev\Hessam;

use Illuminate\Support\ServiceProvider;
use Swis\Laravel\Fulltext\ModelObserver;
use HessamDev\Hessam\Models\HessamPost;

class HessamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if (config("hessam.search.search_enabled") == false) {
            // if search is disabled, don't allow it to sync.
            ModelObserver::disableSyncingFor(HessamPost::class);
        }

        if (config("hessam.include_default_routes", true)) {
            include(__DIR__ . "/routes.php");
        }


        foreach ([
                     '2018_05_28_224023_create_hessam_posts_table.php',
                     '2018_09_16_224023_add_author_and_url_hessam_posts_table.php',
                     '2018_09_26_085711_add_short_desc_textrea_to_hessam.php',
                     '2018_09_27_122627_create_hessam_uploaded_photos_table.php',
                     '2020_05_27_104123_add_parameters_hessam_categories_table.php'
                 ] as $file) {

            $this->publishes([
                __DIR__ . '/../migrations/' . $file => database_path('migrations/' . $file)
            ]);

        }

        $this->publishes([
            __DIR__ . '/Views/hessam' => base_path('resources/views/vendor/hessam'),
            __DIR__ . '/Config/hessam.php' => config_path('hessam.php'),
            __DIR__ . '/css/hessam_admin_css.css' => public_path('hessam_admin_css.css'),
            __DIR__ . '/css/hessam-blog.css' => public_path('hessam-blog.css'),
            __DIR__ . '/js/hessam-blog.js' => public_path('hessam-blog.js'),
        ]);


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // for the admin backend views ( view("hessam_admin::BLADEFILE") )
        $this->loadViewsFrom(__DIR__ . "/Views/hessam_admin", 'hessam_admin');

        // for public facing views (view("hessam::BLADEFILE")):
        // if you do the vendor:publish, these will be copied to /resources/views/vendor/hessam anyway
        $this->loadViewsFrom(__DIR__ . "/Views/hessam", 'hessam');
    }

}
