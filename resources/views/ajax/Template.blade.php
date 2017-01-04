@if (!Auth::guest())
    <select id="tempcat-select">
        <?php
        if ($tempCategories)
        {
            foreach ($tempCategories as $category)
            {
                echo "<option  value=" . $category->tempcat_id ;
                if(isset($_GET['tempid']) && $_GET['tempid']==$category->tempcat_id){ echo " selected";}
                echo  "><a href='#'>" . $category->tempcat_name . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:10px;'><a href='#'>No categories</a></option>";
        }

        ?>
    </select>
    <div style="clear: both; min-height: 40px;">&nbsp;<button onclick="togglethis('tempmanipulate')" class="btn leftmenubutton" style="float: right;min-width: 50px;">+</button></div>


    <div id="tempmanipulate" style="display: none;" class="">
        <button id="addTemplateCategory" class="btn  leftmenubutton" >New Category</button>
        <button onclick="javascript:location.href='{{ url('') }}/administrator'" class="btn  leftmenubutton">New Flyer</button>
        <button id="deletetempcat" class="btn  leftmenubutton">Delete Category</button>
    </div>
    <script>
        $('select').material_select();
        $('#tempcat-select').on('change',  (function() {
            Istempselected = true;
            $('#template_container').empty();
            getTemplates($(this).val());
        }));
        $("#addTemplateCategory").click(function() {
            $("#AddTemplatecategoryModal").openModal('show');
        });
        $("#deletetempcat").click(function() {
            var sel_tempcatid = $('#tempcat-select').val();
            if (sel_tempcatid != '') {
                $("#Del_templatecatmodal").openModal('show');
            } else {
                $("#alertModal").openModal('show');
                $('#responceMessage').html('Please select the Category, you wish to delete.');
            }
        });
    </script>
@endif
<?php
/**
 * Created by PhpStorm.
 * User: Designer
 * Date: 11/26/2016
 * Time: 5:49 PM
 */
	//$res = mysqli_query($conn,"SELECT template_id, template_name FROM template");

    if(sizeof($elements_q)>0)
    {
        foreach($elements_q as $row)
        {
            ?>

            <div class="col s12 l3"="<?php echo $row->template_id; ?>" style="padding:5px;height:270px;">

            <a class="thumbnail" title="<?php echo $row->template_name; ?>" href='javascript:loadTemplate(<?php echo $row->template_id; ?>,<?php echo $row->product_id; ?>);' style="margin-bottom: -5px;">

            <?php
            if(isset($_GET['refresh']) && $_GET['refresh'] == true) {
            ?>
            <!--<img class="tempImage img-responsive" src="{{ url('') }}/<?php echo $row->canvas_thumbnail.'?'.rand(); ?>" alt="" style="width:100px; height:100px;">-->
                <img class="tempImage img-responsive" src="{{ url('') }}/<?php echo $row->canvas_thumbnail ?>" alt="" style="width:170px;">
                <?php
                } else {
                ?>
                <img class="tempImage img-responsive" src="{{ url('') }}/<?php echo $row->canvas_thumbnail; ?>" alt="" style="width:85px;">
                <?php
                }
                ?>

                <span style="margin-left:-150px;color:#444;vertical-align:0px;padding-left:200px;">
                            <?php echo $row->template_name; ?>
                        </span>

            </a><!--<i class="tiny material-icons deleteTemp" id="<?php echo $row->template_id; ?>">delete</i>-->

            </div>
        <?php
        }
    }
    else
    {
        echo "<div style='padding:8px;'>No Template</div>";
    }

?>