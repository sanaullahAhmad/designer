<?php
if(sizeof($elements_q)>0)
{
foreach($elements_q as $row)
{
?>

<li class="col-lg-6 col-md-8 col-xs-12 thumb" id="<?php echo $row->text_id; ?>" >
    <a class="" title="<?php echo $row->text_name; ?>" href='javascript:loadText(<?php echo $row->text_id; ?>);' style="margin-bottom: 0;">
        <img class="textImage img-responsive" src="<?php echo $row->text_thumbnail; ?>" alt="" style="width:80px;">
    </a><?php /*<input type="checkbox" class="textimg-checkbox" id="<?php echo $row->text_id; ?>" value="<?php echo $row->text_id; ?>" /> */ ?>
</li>



<?php
}
}
?>
@if (!Auth::guest())
    <div style="clear: both;"></div>
    <button onclick="togglethis('bgmanipulate')" class="btn leftmenubutton" style="float: right;min-width: 50px;">+</button>
    <div id='bgmanipulate'  class="" style="display: none;">
        <button id="addTextCategory" class="btn leftmenubutton">New Category</button>
        <button id="saveText" class="btn leftmenubutton">Save from Selection</button>
        <button id="deletetextcat" class="btn leftmenubutton">Delete Category</button>
    </div>
    <script>

        $("#addTextCategory").click(function() {
            $("#AddTextcategoryModal").openModal('show');
        });

        $("#saveText").click(function() {
            $('#savetext_modal').openModal('show');
        });
        $("#deletetextcat").click(function() {
            var sel_textcatid = $('#textcat-select').val();
            if (sel_textcatid != '') {
                $("#Del_textcatmodal").openModal('show');
            } else {
                $("#alertModal").openModal('show');
                $('#responceMessage').html('Please select the Category, you wish to delete.');
            }
        });
    </script>
@endif
