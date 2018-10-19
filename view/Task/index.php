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

<div class="boxes">
    <div>
        <span class="title">Total Tasks</span>
        <span class="data blue"><?=$t_Task->res['total']['count']?></span>
    </div>
    <div>
        <span class="title">Completed Tasks</span>
        <span class="data green"><?=$t_Task->res['total']['completed']?></span>
    </div>
    <div>
        <span class="title">Remaining Tasks</span>
        <span class="data red"><?=$t_Task->res['total']['remaining']?></span>
    </div>
</div>

<div class="mainData">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Task Name</th>
            <th>Date</th>
            <th>Edit / Delete</th>
            <th><button class="create">Add New Task +</button></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($t_Task->res['list'] as $v){
            ?>
            <tr>
                <td class="id"><?=$v['id']?></td>
                <td class="name"><?=$v['name']?></td>
                <td class="date"><?=$v['date']?></td>
                <td class="desc" style="display: none"><?=$v['description']?></td>
                <td class="status" style="display: none"><?=$v['status']?></td>
                <td><a class="edit" href="">Edit</a> / <a class="edit" href="">Delete</a></td>
                <td></td>
            </tr>

            <?
        }

        ?>


        </tbody>

    </table>
</div>
<div class="task" style="display: none">
    <div class="title"></div>
    <form action="?" method="POST">
        <input type="hidden" name="id" value="1">
        <label>Name:</label> <input type="text" name="title">
        <label>Description:</label>
        <textarea name="desc" cols="30" rows="10"></textarea>
        <label>Status:</label>
        <select name="status">
            <option value="1">Specification</option>
            <option value="2">On work</option>
            <option value="3">Waiting</option>
            <option value="4">QA</option>
            <option value="5">Complete</option>
        </select>
        <button type="submit">Save</button>
    </form>
</div>