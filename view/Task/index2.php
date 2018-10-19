<?php
//todo: change all smsreport to task
$t_Task = $route->Task;
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="view/Task/functions.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="view/Task/style.css">
<form id="formFilter">
    <fieldset>
        <legend>Filters</legend>
        <span class="required">Date Start:</span> <input type="text" name="from" class="datePicker">
        <span class="required">Date End:</span> <input type="text" name="to" class="datePicker">
        <span>User:</span>
        <select name="usr">
            <option value="" selected></option>
            <?php
                foreach($t_Task->res['usr'] as $v){
                    echo "<option value='{$v['id']}'>{$v['title']}</option>";
                }

            ?>
        </select>

        <span>Country:</span>
        <select name="cnt">
            <option value="" selected></option>
            <?php
            foreach($t_Task->res['cnt'] as $v){
                echo "<option value='{$v['id']}'>{$v['title']}</option>";
            }
            ?>
        </select>
        <button class="filter">Filter</button>
    </fieldset>
</form>

<div class="result">

</div>
