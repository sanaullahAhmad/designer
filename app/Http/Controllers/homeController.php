<?php

namespace App\Http\Controllers;

use App\Background;
use App\Element;
use App\TextCategory;
use App\Template;
use App\Texts;
use App\TemplateCategories;
use App\ElementCategories;
use App\BgCategories;
use App\AdminUploads;
use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    public function create()
    {
        return view('index');
    }
    public function getBgImages()
    {
        $limit = $_GET['limit'];
        $last_bg_id = $_GET['offset'];
        $results=Background::getBgImages($limit,$last_bg_id);
        $bg_catigories=BgCategories::get_bg_categories();
        return view('ajax.BgImages',[  'elements_q'=> $results, 'bg_catigories'=> $bg_catigories]);
    }

    public function getTextCategory()
    {
        $results = TextCategory::all();
        return view('ajax.TextCategory',[  'elements_q'=> $results]);
    }
    public function getCatImages()
    {
        $limit = $_GET['limit'];
        $last_ele_id = $_GET['offset'];
        $results=Element::getCatImages($limit,$last_ele_id);
        $element_categories=ElementCategories::getCategory();
        return view('ajax.CatImages',[  'elements_q'=> $results, 'element_categories'=> $element_categories]);
    }
    public function get_texts()
    {
        $limit = $_GET['limit'];
        $last_text_id = $_GET['offset'];
        $results=Texts::getTexts($limit,$last_text_id);
        return view('ajax.Texts',[  'elements_q'=> $results]);
    }
    public function deletetempcategory()
    {
        $selected_cat = $_POST["categoty"];

        $delete_Ele = "DELETE FROM template WHERE cat_id = $selected_cat";
        \DB::statement($delete_Ele);
        //second table
        $delete_Query = "DELETE FROM template_categories WHERE tempcat_id = $selected_cat";
        $run_Query = \DB::statement($delete_Query);
        if ($run_Query)
        {
            echo "Category Deleted Successfully.";
        }
    }
    public function deletecategory()
    {
        $selected_cat = $_POST["categoty"];
        $results=Element::getelEmentPath($selected_cat);
        if ($results)
        {
            foreach ($results as $result)
            {
                $m_img_path = "../" . $result->element_path;
                if(fileExists($m_img_path))
                {
                    unlink($m_img_path);
                }

            }
        }

        $delete_Ele = "DELETE FROM element WHERE cat_id = $selected_cat";
        \DB::statement($delete_Ele);

        $delete_Query = "DELETE FROM element_categories WHERE category_id = $selected_cat";
        $run_Query =  \DB::statement($delete_Query);
        if ($run_Query)
        {
            echo "Category Deleted Successfully.";
        }
    }
    public function deletebgcategory()
    {
        $selected_bgcat = $_POST["bgcategoty"];
        $results=Background::getBgPath($selected_bgcat);
        if ($results)
        {
            foreach ($results as $result)
            {
                $m_img_path = "../" . $result->bg_path;
                if(fileExists($m_img_path))
                {
                    unlink($m_img_path);
                }
            }
        }

        $delete_Ele = "DELETE FROM background WHERE bgcat_id = $selected_bgcat";
        \DB::statement($delete_Ele);

        $delete_Query = "DELETE FROM bg_categories WHERE bgcat_id = $selected_bgcat";
        $run_Query =  \DB::statement($delete_Query);
        if ($run_Query)
        {
            echo "Category Deleted Successfully.";
        }
    }
    public function deletetextcategory()
    {
        $selected_textcat = $_POST["textcategoty"];
        $delete_Query = "DELETE FROM text_categories WHERE textcat_id = $selected_textcat";
        $run_Query =  \DB::statement($delete_Query);
        if ($run_Query)
        {
            echo "Category Deleted Successfully.";
        }
    }
    public function loadtext()
    {
        $text_id = $_GET['id'];
        $results=Texts::getloadtext($text_id);
        //dd($results);
        if($results)	{
            foreach( $results as $row ) {
                echo '{"objects":['.$row->text_json.']}';
                break;
            }
        }
    }
    public function get_uploadimages()
    {
        //sanitize post value
        if(isset($_POST["page"])){
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
            if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
        }else{
            $page_number = 1;
        }
        $item_per_page=10;
        $position = (($page_number-1) * $item_per_page);
        $results=AdminUploads::getUploadImages($position,$item_per_page);

        foreach ($results as $row )
        {
            $image = str_replace("admin/","",$row->imgpath);
            echo "<div class='thumb' style='padding:5px;'>";
            echo "<a class='thumbnail' href='#' style='margin-bottom: 0;'>";
            echo "<img class='addImage img-responsive' data-imgsrc='".$image."'. src='".$image."' alt='' width='80px'>";
            echo "</a>";
            echo "<i class='tiny material-icons deleteUploadImg' id='".$row->id."'>delete</i>";
            echo "</div>";

        }
    }
    public function gettempCategory()
    {
        $results=TemplateCategories::gettempCategory();
        if ($results)
        {
            foreach ($results as $category)
            {
                echo "<option id=" . $category->tempcat_id . "  value=" . $category->tempcat_id . "><a href='javascript:void(0);'  value=" . $category->tempcat_id . ">" . $category->tempcat_name . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:10px;'><a href='#'>No categories</a></option>";
        }
    }
    public function gettempCatmat()
    {
        $results=TemplateCategories::gettempCatmat();
        if ($results)
        {
            foreach ($results as $category)
            {
                echo "<option id=" . $category->tempcat_id . "  value=" . $category->tempcat_id . "><a href='javascript:void(0);'  value=" . $category->tempcat_id . ">" . $category->tempcat_name . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:10px;'><a href='#'>No categories</a></option>";
        }
    }
    public function getCategory()
    {
        $results=ElementCategories::getCategory();
        if ($results)
        {
            foreach ($results as $category)
            {
                echo "<option  value=" . $category->category_id . "><a href='#'>" . $category->category . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:10px;'><a href='#'>No categories</a></option>";
        }
    }
    public function bg_categories()
    {
        $results=BgCategories::get_bg_categories();
        if ($results)
        {
            foreach ($results as $category)
            {
                echo "<option value=" . $category->bgcat_id . "><a href='#'>" . $category->bgcat_name . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:8px;'><a href='#'>No categories</a></option>";
        }
    }
    public function getTemplates()
    {
        $limit = $_GET['limit'];
        $last_temp_id = $_GET['offset'];
        $results=Template::getTemplates($limit,$last_temp_id);
        $tempCategories=TemplateCategories::gettempCategory();
        return view('ajax.Template',[  'elements_q'=> $results, 'tempCategories'=>$tempCategories]);
    }
    public function getTemplateName()
    {
        $results=Template::getTemplateName();
        if ($results)
        {
            echo "<option value=''>Select Template</option>";
            foreach ($results as $category )
            {
                echo "<option value=" . $category->template_id . ">" . $category->template_name . "</option>";
            }
        }
        else
        {
            echo "<div style='padding:8px;'>No Template</div>";
        }
    }
    public function loadtemplate()
    {
        $results=Template::canvas_json();

        if(sizeof($results)>0) {
            foreach ($results as $row) {
                $templatespath = $row->canvas_json;
                //echo $templatespath;exit;
                $json = file_get_contents($templatespath);
                echo $json;
            }
        }
    }
    public function uploadimage()
    {
        $fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
        if ($fn) {
            // AJAX call
            file_put_contents(
                'uploads/' . $fn,
                file_get_contents('php://input')
            );
            $insert_image=Useruploads::store('', 'uploads/'. $fn );
            $run_Query = mysqli_query($conn,$insert_image) or die("ERROR: " . $insert_image);
            if($insert_image)
            {
                echo "Upload image is Added Successfully.";
            }
            exit();
        }
        else
        {
            // form submit
            $files = $_FILES['fileselect'];
            foreach ($files['error'] as $id => $err) {
                if ($err == UPLOAD_ERR_OK) {
                    $fn = $files['name'][$id];
                    move_uploaded_file(
                        $files['tmp_name'][$id],
                        'uploads/' . $fn
                    );
                    echo "<p>File $fn uploaded.</p>";
                }
            }
        }
    }
    public function getUploadImages()
    {
        if(isset($_POST["page"])){
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
            if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
        }else{
            $page_number = 1;
        }

//get current starting point of records
        $position = (($page_number-1) * $item_per_page);

//Limit our results within a specified range.
        $results=Useruploads::getUploadImages($position, $item_per_page );

//output results from database

        foreach($results as $row)
        {
            echo "<div class='thumb' style='padding:5px;'>";
            echo "<a class='thumbnail' href='#' style='margin-bottom: 0;'>";
            echo "<img class='addImage img-responsive' data-imgsrc='".$row->imgpath."' src='".$row->imgpath."' alt='' width='80px'>";
            echo "</a>";
            echo "<i class='tiny material-icons deleteUploadImg' id='".$row->id."'>delete</i>";
            echo "</div>";
        }
    }
    public function deleteBackground()
    {
        if (isset($_POST['bgid']) && $_POST['bgid'] != '')
        {
            $results=Background::deleteBackground($_POST['bgid']);
        }
    }
    public function addcategory()
    {
        if(isset($_POST["categoty"]) && $_POST["categoty"] != '') {
            $rescategory =$_POST["categoty"];

            $insert_Query = "INSERT INTO element_categories( category) values ('$rescategory')";
            $run_Query = \DB::statement($insert_Query);
            if($run_Query)
            {
                echo "New Category Added Successfully.";
            }

        } else if(isset($_POST["templatecat"]) && $_POST["templatecat"] != '') {

            $tempcategory = $_POST["templatecat"];

            $insert_Query = "INSERT INTO template_categories(tempcat_name) values ('$tempcategory')";
            $run_Query = \DB::statement($insert_Query);
            if($run_Query)
            {
                echo "New Category Added Successfully.";
            }

        }  else if(isset($_POST["bgcategoty"]) && $_POST["bgcategoty"] != '') {

            $bgcategory = $_POST["bgcategoty"];

            $insert_Query = "INSERT INTO bg_categories(bgcat_name) values ('$bgcategory')";
            $run_Query = \DB::statement($insert_Query);
            if($run_Query)
            {
                echo "New Category Added Successfully.";
            }

        }   else if(isset($_POST["textcategoty"]) && $_POST["textcategoty"] != '') {

            $textcategory = $_POST["textcategoty"];

            $insert_Query = "INSERT INTO text_categories(textcat_name) values ('$textcategory')";
            $run_Query = \DB::statement($insert_Query);
            if($run_Query)
            {
                echo "New Text Category Added Successfully.";
            }

        } else { }
    }

}
