<?php

namespace Encore\SmoothTheme;

use Encore\Admin\Extension;
use Encore\Admin\Admin;
use Encore\SmoothTheme\SmoothThemeModel;
use Encore\SmoothTheme\Http\Controllers\SmoothThemeController;

class SmoothTheme extends Extension
{
    public $name = 'smooth-theme';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';


    public $menu = [
        'title' => 'Smooth theme',
        'path'  => 'smooth-theme',
        'icon'  => 'fa-paint-brush',
    ];

    public static function boot()
    {
        static::registerRoutes();
        Admin::extend('smooth-theme', __CLASS__);
    }

    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            $router->resource('smooth-theme', SmoothThemeController::class);
        });
    }

    public static function import()
    {
        parent::createMenu('Smooth Theme', 'smooth-theme', 'fa-paint-brush');
        parent::createPermission('Smooth Theme', 'ext.smooth-theme', 'smooth-theme*');

        self::install_default_themes();
    }

    public static function install_default_themes(){

        $data = json_decode ('{"sidebar_width":"280","menu_bg":"#263544","menu_active_bg":"#212d3a","menu_text":"#a7b1be","text_color":"#515151","table_color":"#515151","field_border_radius":"3","primary_color":"#3a96ff","primary_border_color":"#2a81e4","primary_color_hover":"#2a81e4","primary_border_color_hover":"#1c68c0","primary_field_focus_border_color":"#2a81e4","glow_border":"#3a96ff","glow_color":"#3a96ff","default_color":"#e7e7e7","default_border_color":"#CCC","warning_color":"#f0b849","warning_border_color":"#e4a424","danger_color":"#e26139","danger_border_color":"#b82613","success_color":"#21c141","success_border_color":"#0f9a2a"}');

        $theme = new SmoothThemeModel();
        $theme->id = 1;
        $theme->name = "Blue";
        foreach ($data as $key => $value){
            $theme->$key = $value;
        }
        $theme->active = 1;
        $theme->save();

        $data = json_decode ('{"sidebar_width":"280","menu_bg":"#263544","menu_active_bg":"#212d3a","menu_text":"#a7b1be","text_color":"#515151","table_color":"#515151","field_border_radius":"3","primary_color":"#3a96ff","primary_border_color":"#2a81e4","primary_color_hover":"#2a81e4","primary_border_color_hover":"#1c68c0","primary_field_focus_border_color":"#2a81e4","glow_border":"#3a96ff","glow_color":"#3a96ff","default_color":"#e7e7e7","default_border_color":"#CCC","warning_color":"#f0b849","warning_border_color":"#e4a424","danger_color":"#e26139","danger_border_color":"#b82613","success_color":"#21c141","success_border_color":"#0f9a2a"}');
        $theme = new SmoothThemeModel();
        $theme->id = 2;
        $theme->name = "Orange";
        foreach ($data as $key => $value){
            $theme->$key = $value;
        }
        $theme->active = 0;
        $theme->save();

    }


}