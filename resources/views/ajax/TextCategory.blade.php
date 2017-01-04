<select id="textcat-select">
<?php
if (sizeof($elements_q)>0)
{
foreach ($elements_q as $category)
{
echo '<option value="' . $category->textcat_id . '" >' . $category->textcat_name . '</option>';
}
}
else
{
echo "<option style='padding:8px;'>No categories</option>";
}
?>
</select>
<script>
    $('select').material_select();
    $('#textcat-select').on('change',  (function() {
        Istextselected = true;
        $('#text_container').empty();
        getTexts($(this).val());
    }));

</script>
