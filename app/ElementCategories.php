<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementCategories extends Model
{
    //
    protected $table='element_categories';

    protected $fillable = array(
        "category_id",
        "category",
    );
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function getCategory()
    {
        $elements_q = \DB::table('element_categories')->get();
        return $elements_q;
    }
}
