<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextCategory extends Model
{
    //
    protected $table='text_categories';

    protected $fillable = array(
        "textcat_id",
        "textcat_name",
    );
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function getTextCategory()
    {
        $elements_q = \DB::table('text_categories')->get();
        return $elements_q;
    }
}
