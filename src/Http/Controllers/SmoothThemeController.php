<?php

namespace Encore\SmoothTheme\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\SmoothTheme\SmoothThemeModel;
use Encore\Admin\Controllers\AdminController;

class SmoothThemeController extends AdminController
{
    protected $title = "Smooth themes";


    protected function grid()
    {

        $grid = new Grid(new SmoothThemeModel());

        $states = [
            '0' => ['value' => 1, 'text' => 'on', 'color' => 'primary'],
            '1' => ['value' => 0, 'text' => 'off', 'color' => 'default'],
        ];

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('active', __('Active'))->switch();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }


    function detail(){

    }


    protected function form()
    {
        $form = new Form(new SmoothThemeModel);

        $form->display('id', __('ID'));

        $form->select("reset","Reset theme")->placeholder("reset to")->options(["blue"=>"blue","orange"=>"orange"]);
        $form->text("title","Title");
        $form->switch("active","Active");
        $form->number("sidebar_width")->default(280);
        $form->number("field_border_radius")->default(3);

        $form->color("menu_bg")->default('#263544');
        $form->color("menu_active_bg")->default('#212d3a');
        $form->color("menu_text")->default('#a7b1be');
        $form->color("text_color")->default('#515151');
        $form->color("table_color")->default('#515151');
        $form->color("primary_color")->default('#3a96ff');
        $form->color("primary_border_color")->default('#2a81e4');
        $form->color("primary_color_hover")->default('#2a81e4');
        $form->color("primary_border_color_hover")->default('#1c68c0');
        $form->color("primary_field_focus_border_color")->default('#2a81e4');
        $form->color("glow_border")->default('#3a96ff');
        $form->color("glow_color")->default('#3a96ff');
        $form->color("default_color")->default('#e7e7e7');
        $form->color("default_border_color")->default('#CCC');
        $form->color("warning_color")->default('#f0b849');
        $form->color("warning_border_color")->default('#e4a424');
        $form->color("danger_color")->default('#e26139');
        $form->color("danger_border_color")->default('#b82613');
        $form->color("success_color")->default('#21c141');
        $form->color("success_border_color")->default('#0f9a2a');

        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        $form->html(function(){
            return '<script>$(document).ready(function(){smooth_theme_init_form();});</script>';
        });

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });


        return $form;
    }
}
