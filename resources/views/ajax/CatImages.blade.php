@if (!Auth::guest())
    <select id="cat-select">
    <?php
        if ($element_categories)
        {
            foreach ($element_categories as $category)
            {
                echo "<option  value=" . $category->category_id ;
                if(isset($_GET['category']) && $_GET['category']==$category->category_id){ echo " selected";}
                echo  "><a href='#'>" . $category->category . "</a></option>";
            }
        }
        else
        {
            echo "<option style='padding:10px;'><a href='#'>No categories</a></option>";
        }
    ?>
    </select>
    <div style="clear: both;; min-height: 40px;"><button onclick="togglethis('elementdmanipulate')" class="btn leftmenubutton" style="float: right;min-width: 50px;">+</button></div>

    <div id='elementdmanipulate' style="display: none;"  class="">
        <button class="btn leftmenubutton" id="addCategory">New Category</button>
        <button class="btn leftmenubutton" id="addElement">New Element</button>
        <button  class="btn leftmenubutton" id="saveElement">Save from Selection</button>
        <button class="btn leftmenubutton" id="deleteCategory">Delete Category</button>
    </div>
    <script>
        $("#addCategory").click(function() {
            $("#Addcategoryodal").openModal('show');
        });
        $("#addElement").click(function() {
            $("#AddelementModal").openModal('show');
        });
        $("#saveElement").click(function() {
            $('#saveelement_modal').openModal('show');
        });
        $("#deleteCategory").click(function() {
            var sel_catid = $('#cat-select').val();
            if (sel_catid != '') {
                $("#Del_catmodal").openModal('show');
            } else {
                $("#alertModal").openModal('show');
                $('#responceMessage').html('Please select the Category, you wish to delete.');
            }
        });
        $('#cat-select').on('change',  (function() {
            Iscatselected = true;
            //$('#catimage_container').empty();
            $('.albumGallery').empty();
            getcatimages($(this).val());
        }));
        $('select').material_select();
    </script>
@endif
<?php
if(sizeof($elements_q)>0)
{
foreach($elements_q as $row)
{
?>
<?php if($row->element_json != '') { ?>
<li style="float: left; padding: 0px 5px;" class="on">
    <a style="opacity: 1;" class="">
        <img style="width: 70px;height: 80px;" data-imgsrc="<?php echo url('').'/'.$row->element_path; ?>" src="<?php echo url('').'/'.$row->element_path; ?>" crossorigin="anonymous" height="550" width="389" class="img-responsive">
        {{--<span class="price poa">
                            <span class="inner">$</span>
                        </span>
        <span class="info">
                            <span class="price poa">
                                <span class="inner">$</span>
                            </span>
                            <span class="moreInfo" title="Show more info">i</span>
                        </span>--}}
    </a>
</li>

<?php } else { ?>

<li style="float: left; padding: 0px 5px;"  class="on">
    <a style="opacity: 1;" class="">
        <img style="width: 70px;height: 80px;" data-imgsrc="<?php echo url('').'/'.$row->element_path; ?>" src="<?php echo url('').'/'.$row->element_path; ?>" crossorigin="anonymous" height="550" width="389" class="catImage img-responsive">
        {{--<span class="price poa">
                            <span class="inner">$</span>
                        </span>
        <span class="info">
                            <span class="price poa">
                                <span class="inner">$</span>
                            </span>
                            <span class="moreInfo" title="Show more info">i</span>
                        </span>--}}
    </a>
</li>
<?php } ?>

<?php
}
}
?>