<?php

namespace Encore\SmoothTheme;

use Illuminate\Database\Eloquent\Model;
use Stancl\VirtualColumn\VirtualColumn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class SmoothThemeModel extends Model
{
    use VirtualColumn;

    var $table = "admin_theme";

	protected $attributes = [
        'active' => 0,
    ];

    public static function getCustomColumns(){

        return ["id","name","created_at","updated_at"];
    }

    public static function boot()
    {
        parent::boot();

        self::saved(function($model){
            $model->saveRootCss();
        });
    }

    function saveRootCss(){

        if ($this->active == 1){
            $contents = $this->generateCSS();
            Storage::disk('local')->put('/public/admin/root.css', $contents);
        }
    }

    function generateCSS(){

        $ignore = array("id","data","name","updated_at","active","created_at","theme","reset");
        $data =array_diff_key($this->attributes,array_flip($ignore));
        $str = ":root{\n";
        foreach ($data as $key => $value){
            if ($key)
            if (strpos($value,"#") === false && strpos($value,"rgb") === false){
                $value .= "px";
            }
            $str .= "--".str_replace("_","-",$key).": ".$value.";\n";
        }
        return $str."}\n";
    }
}
