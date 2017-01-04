
@if (Auth::guest())
    <?php
if(sizeof($elements_q)>0){
    foreach($elements_q as $row)
    { ?>

    <li class="col-lg-6 col-md-8 col-xs-12 " id="<?php  echo $row->id; ?>" style="padding:5px;">
        <a class="thumbnail2" href="#" style="margin-bottom: 0;">
            <img class="bgImage img-responsive" data-imgsrc="<?php  echo url('').'/'.$row->bg_path; ?>" src="<?php  echo url('').'/'.$row->bg_path; ?>" alt="" style="height:80px; width:80px; ">
        </a><input type="checkbox" class="bgimg-checkbox" id="<?php  echo $row->id; ?>" value="<?php  echo $row->id; ?>" />
    </li>

    <?php
    }
}
?>
@else

    <select id="bgcat-select">
    <?php
        if ($bg_catigories)
        {
            foreach ($bg_catigories as $category)
            {
                echo "<option value=" . $category->bgcat_id ;
                if(isset($_GET['category']) && $_GET['category']==$category->bgcat_id){ echo " selected";}
                echo "><a href='#'>" . $category->bgcat_name . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:8px;'>No categories</option>";
        }
    ?>
    </select>
    <div style="clear: both;; min-height: 40px;">
        <button onclick="togglethis('backgroundmanipulate')" class="btn leftmenubutton" style="float: right;min-width: 50px;">+</button></div>
    <div id='backgroundmanipulate' style="display: none;"   class="">
        <button class="btn leftmenubutton" id="addBGCategory">New Category</button>
        <button class="btn leftmenubutton" id="addBackground">New Background</button>
        <button class="btn leftmenubutton" id="deleteBGCategory">Delete Category</button>
        </br>
    </div>
    <script>
        $("#addBGCategory").click(function() {
            //alert('success');
            $("#AddBGcategoryodal").openModal('show');
        });
        $("#addBackground").click(function() {
            $("#AddbackgroundModal").openModal('show');
        });
        $("#deleteBGCategory").click(function() {
            var sel_bgcatid = $('#bgcat-select').val();
            if (sel_bgcatid != '') {
                $("#Del_bgcatmodal").openModal('show');
            } else {
                $("#alertModal").openModal('show');
                $('#responceMessage').html('Please select the Category, you wish to delete.');
            }
        });
        $("#sel_bg_cat").click(function() {
            $("#sel_bg_catmodal").openModal('show');
        });
        $('#bgcat-select').on('change',  (function() {
            IsBgselected = true;
            $('#background_container').empty();
            getbgimages($(this).val());
        }));
        $('select').material_select();
    </script>
    <?php
    if(sizeof($elements_q)>0){
    foreach($elements_q as $row)
    { ?>
    <li class="col-lg-6 col-md-8 col-xs-12 " id="<?php  echo $row->id; ?>">
        <a class="thumbnail2" href="#" style="margin-bottom: 0;">
            <img class="bgImage img-responsive" data-imgsrc="<?php  echo $row->bg_path; ?>" src="<?php  echo $row->bg_path; ?>" alt="" style="width:80px; height:80px;">
        </a>
        <i class="tiny material-icons deleteBg" id="<?php echo $row->id; ?>">delete</i>
    </li>


    <?php
    }
    }
    ?>
@endif