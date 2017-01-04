<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
    protected $table='template';

    protected $fillable = array(
        "template_id",
        "template_name",
        "canvas_thumbnail",
    );
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function getTemplates($limit,$last_temp_id)
    {
        if(isset($_GET['tempid']) && $_GET['tempid'] != '') {
            $elements_q = \DB::table('template')->where([
                ['cat_id', '=',  $_GET['tempid']],
                ['template_id', '>', $last_temp_id]
            ])
                ->orderBy('template_id', 'asc')
                ->limit($limit)
                ->get();
        } else {
            $elements_q = \DB::table('template')
                ->orderBy('template_id', 'asc')
                ->limit($limit)
                ->get();
        }
        return $elements_q;
    }
    protected function getTemplateName()
    {
            $elements_q = \DB::table('template')->select('template_id','template_name')
                ->get();

        return $elements_q;
    }
    protected function canvas_json()
    {
            $elements_q = \DB::table('template')->select('canvas_json')->where('template_id', '=', $_GET['id'])
                ->get();
        return $elements_q;
    }
}
