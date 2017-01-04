<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Texts extends Model
{
    //
    protected $table='texts';

    protected $fillable = array(
        "text_id",
        "text_name",
        "text_thumbnail",
        "text_json",
        "cat_id"
    );
    protected function getTexts($limit,$last_text_id)
    {
        if(isset($_GET['textid']) && $_GET['textid'] != '') {
            $elements_q = \DB::table('texts')->where([
                ['cat_id', '=', $_GET['textid']],
                /*['text_id', '=', $last_text_id]*/
            ])
                ->orderBy('cat_id', 'asc')
                ->limit($limit)
                ->get();
        } else {
            $elements_q = \DB::table('texts')->where('cat_id', '>', $last_text_id)
                ->orderBy('cat_id', 'asc')
                ->limit($limit)
                ->get();
        }
        return $elements_q;
    }
    protected function getloadtext($text_id)
    {
        $elements_q = \DB::table('texts')->select('text_json')->where('text_id', '=', $text_id)
            ->get();
        return $elements_q;
    }
}
