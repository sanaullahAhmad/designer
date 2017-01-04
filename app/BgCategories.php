<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BgCategories extends Model
{
    //
    protected $table='bg_categories';

    protected $fillable = array(
        "bgcat_id",
        "bgcat_name",
    );
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function get_bg_categories()
    {
        $elements_q = \DB::table('bg_categories')->get();
        return $elements_q;
    }
}
