/*--------------------------------------------------------------------*/
/* global shared */
/*--------------------------------------------------------------------*/

var start_mobile_width = 900;

$(document).ready(function(){
    smooth_theme_custom_page_load();
});

$(document).on('pjax:complete', function (xhr) {
    smooth_theme_custom_page_load();
});

$(document).pjax('.pjax', {
    container: '#pjax-container'
});

function smooth_theme_custom_page_load(){
    smooth_theme_init_crumb();
    smooth_theme_init_mobile_tabs();
    smooth_theme_init_filter_mobile();
}

/*--------------------------------------------------------------------*/
/* keep menu open or closed */
/*--------------------------------------------------------------------*/

(function ($) {

    /* Store sidebar state */
    $('.sidebar-toggle').click(function(event) {

        event.preventDefault();
        if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {
            localStorage.setItem('sidebar-toggle-collapsed', '');
         } else {
            localStorage.setItem('sidebar-toggle-collapsed', '1');
         }
     });
})(jQuery);

/* Recover sidebar state */
 (function () {

    if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {
        $("body").addClass("sidebar-collapse");
    }else{
        $("body").removeClass("sidebar-collapse");
    }
})();

/*--------------------------------------------------------------------*/
/* tab script */
/*--------------------------------------------------------------------*/

function smooth_theme_init_mobile_tabs(){

    $(".nav-tabs-custom").prepend("<a id='show-mobile-tabs' class='btn btn-sm btn-default'>Show tab: ...</a>");
    $("#show-mobile-tabs").click(function(){
        $(".nav-tabs-custom ul.nav-tabs").toggle();
    });
    $(".nav-tabs-custom ul.nav-tabs li").click(function(){

        if ($(window).width() < start_mobile_width){
            $(".nav-tabs-custom ul.nav-tabs").toggle();
        }
    });
}

/*--------------------------------------------------------------------*/
/* filter box */
/*--------------------------------------------------------------------*/

function smooth_theme_init_filter_mobile(){

    if ($(window).width() < start_mobile_width){
        $("#filter-box").addClass("hide");
    }
}

/*--------------------------------------------------------------------*/
/* crumb box */
/*--------------------------------------------------------------------*/

function smooth_theme_init_crumb(){

    var path = window.location.pathname;
    var pathArray = path.split('/');
    var data_page_num = pathArray.length -2;
    var data_path = pathArray.splice(0, data_page_num).join('/');

    if ($(".breadcrumb li:eq("+(data_page_num-2)+") a").length == 0){

        var $li_data_page = $(".breadcrumb li:eq("+(data_page_num-2)+")");
        var data_name = $li_data_page.text();
        $li_data_page.html("<a href='"+data_path+"'>"+data_name+"</a>");
    };
}

/*--------------------------------------------------------------------*/
/* crumb box */
/*--------------------------------------------------------------------*/

function smooth_theme_init_form(){
    setTimeout(function(){
        $(".form-horizontal input").change(function(){
            smooth_theme_set_var(this);
        })

        $(".form-horizontal select").change(function(){
            smooth_theme_set_default(this);
        })

        $(".colorpicker-element").on('changeColor', function(e) {
            $(this).find('input').change();
        });
    },100)
}

function smooth_theme_set_var($this){
    var name = $($this).attr("name");
    var value = $($this).val();
    var_name = name.replaceAll("_","-");

    if (value.indexOf("#") == -1 && value.indexOf("rgb") == -1){
        value += "px";
    }
    console.log(var_name + " = " + value);

    document.documentElement.style.setProperty('--'+var_name, value);
}

function smooth_theme_set_default($this){

    var name = $($this).val();

    var themes = {}
    themes.blue = {
        sidebar_width: "280",
        menu_bg: "#263544",
        menu_active_bg: "#212d3a",
        menu_text: "#a7b1be",
        text_color: "#515151",
        table_color: "#515151",
        field_border_radius: "3",
        primary_color: "#3a96ff",
        primary_border_color: "#2a81e4",
        primary_color_hover: "#2a81e4",
        primary_border_color_hover: "#1c68c0",
        primary_field_focus_border_color: "#2a81e4",
        glow_border: "#3a96ff",
        glow_color: "#3a96ff",
        default_color: "#e7e7e7",
        default_border_color: "#CCC",
        warning_color: "#f0b849",
        warning_border_color: "#e4a424",
        danger_color: "#e26139",
        danger_border_color: "#b82613",
        success_color: "#21c141",
        success_border_color: "#0f9a2a"
    }

    themes.orange = {
        sidebar_width: "280",
        menu_bg: "#263544",
        menu_active_bg: "#212d3a",
        menu_text: "#a7b1be",
        text_color: "#515151",
        table_color: "#515151",
        field_border_radius: "3",
        primary_color: "#FFAA00",
        primary_border_color: "#be7c00",
        primary_color_hover: "#ec9e00",
        primary_border_color_hover: "#ca8700",
        primary_field_focus_border_color: "#ca8700",
        glow_border: "#be7c00",
        glow_color: " be7c00",
        default_color: "#e7e7e7",
        default_border_color: "#CCC",
        warning_color: "#f0b849",
        warning_border_color: "#e4a424",
        danger_color: "#e26139",
        danger_border_color: "#b82613",
        success_color: "#21c141",
        success_border_color: "#0f9a2a"
    }

    theme = themes[name];

    for(i in theme){
        console.log(i);
        value = theme[i];
        $field = $(".form-horizontal input[name="+i+"]");
        $field.val(value).change();
        if (value.indexOf("#") != -1 || value.indexOf("rgb") != -1){
            $field.parent().find("i").css("background-color",value);
        }
    }
}