<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateCategories extends Model
{
    //
    protected $table='template_categories';

    protected $fillable = array(
        "tempcat_id",
        "tempcat_name",
    );
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function gettempCategory()
    {
        $elements_q = \DB::table('template_categories')->get();
        return $elements_q;
    }
    protected function gettempCatmat()
    {
        $elements_q = \DB::table('template_categories')->get();
        return $elements_q;
    }
}
