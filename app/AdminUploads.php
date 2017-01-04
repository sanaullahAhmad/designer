<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUploads extends Model
{
    //
    protected $table='adminuploads';

    protected $fillable = array(
        "id",
        "imgpath",
    );
    protected function getAllRecords()
    {
        $records = $this->all();
        return $records;
    }
    protected function getUploadImages($position,$item_per_page)
    {
        $elements_q = \DB::table('adminuploads')
            ->orderBy('id', 'asc')
            ->offset($position)
            ->limit($item_per_page)
            ->get();
        return $elements_q;
    }
}
