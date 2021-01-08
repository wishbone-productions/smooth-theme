<?php

namespace Encore\SmoothTheme;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Encore\SmoothTheme\SmoothThemeModel;
use Illuminate\Support\Facades\Storage;

class SmoothThemeServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(SmoothTheme $extension)
    {
        if (! SmoothTheme::boot()) {
            //return ;
        }
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'smooth-theme');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/smooth-theme')],
                'smooth-theme'
            );
            $this->publishes([
                __DIR__.'/../resources/assets/css/none.min.css' => public_path('vendor/laravel-admin/AdminLTE/dist/css/skins/none.min.css'),
            ], 'smooth-theme-2');
        }

        config(['admin.skin' => 'none','admin.grid_action_class'=>\Encore\Admin\Grid\Displayers\Actions::class]);

        Admin::booting(function () {

            Admin::js('vendor/laravel-admin-ext/smooth-theme/js/admin-overwrites.js');
            Admin::css('vendor/laravel-admin-ext/smooth-theme/css/admin-smooth.css');

            if (Storage::disk('local')->exists('public/admin/root.css')){
                Admin::css(Storage::url('public/admin/root.css'));
            }
        });
    }
}