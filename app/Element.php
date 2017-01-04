<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    //
    protected $table='element';

    protected $fillable = array(
        "id",
        "cat_id",
        "element_name",
        "element_path",
        "element_json"
        );
    public function elementCategories(){

        return $this->belongsTo('element_categories');
    }
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function getelEmentPath($selected_cat)
    {
        $records  = \DB::table('element')->select('element_path')->where('cat_id', '=', $selected_cat)->get();
        return $records;
    }
    protected function getCatImages($limit,$last_ele_id)
    {
        if(isset($_GET['category']) && $_GET['category'] != '') {
            $elements_q = \DB::table('element')->where([
                    ['cat_id', '=', $_GET['category']],
                    ['id', '>', $last_ele_id]
                ])
                ->orderBy('id', 'asc')
                ->limit($limit)
                ->get();
        } else {
            $elements_q = \DB::table('element')->where('id', '>', $last_ele_id)
                ->orderBy('id', 'asc')
                ->limit($limit)
                ->get();
        }
        return $elements_q;
    }
}
