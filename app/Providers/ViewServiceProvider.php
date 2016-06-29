<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use App\NewsPortal\Repository\Category\PostCategoryRepository;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        if (Schema::hasTable('post_categories'))
//        {
//            $categoryRepo = new PostCategoryRepository();

            $globalData['appTitle'] = 'Library Management System';
            $globalData['app'] = 'Library';
            $globalData['appShort'] = 'Library';
            $globalData['today'] = date('l, d M', strtotime('NOW'));
//            $globalData['category'] = $categoryRepo->getAllCategory();

            view()->share('common', $globalData);
//        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
