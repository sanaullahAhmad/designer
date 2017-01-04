<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
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
    protected function getBgImages($limit,$last_bg_id)
    {
        if(isset($_GET['category']) && $_GET['category'] != '') {
            $elements_q = \DB::table('background')->where([
                ['bgcat_id', '=', $_GET['category']],
                ['id', '>', $last_bg_id]
            ])->orderBy('id', 'asc')->limit($limit)->get()->toArray();
        } else {
            $elements_q = \DB::table('background')->where('id', '>', $_GET['limit'])->orderBy('id', 'asc')->limit($limit)->get()->toArray();
        }
        return $elements_q;
    }

    protected function getBgPath($selected_bgcat)
    {
        $records  = \DB::table('background')->select('bg_path')->where('bgcat_id', '=', $selected_bgcat)->get();
        return $records;
    }
    protected function deleteBackground($bgid)
    {
        $elements_q = \DB::table('background')->select('bg_path')->whereIn('id', [$bgid])->get();
        if ($elements_q)
        {
            foreach ($elements_q as $result)
            {
                //echo dirname(dirname(__FILE__));exit;
                $m_img_path = dirname(dirname(__FILE__))."/public/".$result->bg_path;
                unlink($m_img_path);
            }
        }
        \DB::table('background')->whereIn('id', [$bgid])->delete();
        echo "Background(s) Deleted Successfully.";
    }
}
