<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useruploads extends Model
{
    //
    protected $table='useruploads';

    protected $fillable = array(
        "id",
        "useruploads",
    );
    public function store($id, $imgpath)
    {
        DB::table('useruploads')->insert(
            ['id' => $id, 'useruploads' => $imgpath]
        );
    }
    public function getUploadImages($position, $item_per_page)
    {
        $elements_q = \DB::table('useruploads')
            ->offset($position)
            ->limit($item_per_page)
            ->get();
        return $elements_q;
    }
}
