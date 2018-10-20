<?php
namespace Con\Task;

final class TaskController implements \Controller{

    use \Mod\Task\TaskModel;

    public $res;
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTotal($id='')
    {
        return $this->total($id);
    }

    public function getList($id='')
    {
        return $this->listTasks($id);
    }

    public function del($id='')
    {
        return $this->deleteTask($id);
    }

    public function create($name='', $desc='', $status='')
    {
        return $this->createTask($name, $desc, $status);
    }

    public function edit($id='', $desc='', $status='')
    {
        return $this->editTask($id, $desc, $status);
    }


}