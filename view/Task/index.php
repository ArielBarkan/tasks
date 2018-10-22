<?php
$t_Task = $route->Task;
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="view/Task/functions.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="view/Task/style.css">

<div class="boxes">
    <div class="total count">
        <span class="title">Total Tasks</span>
        <span class="data blue"><?=$t_Task->res['total']['count']?></span>
    </div>
    <div class="total completed">
        <span class="title">Completed Tasks</span>
        <span class="data green"><?=$t_Task->res['total']['completed']?></span>
    </div>
    <div class="total remaining">
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
        <tbody class="fetchList">



        </tbody>

    </table>
</div>
<div class="task" style="display: none">
    <div class="title"></div>
    <form action="?" method="POST">
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