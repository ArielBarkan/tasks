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

    public function TaskExecute()
    {
        $this->send_log_aggregated();
    }

    public function getAgrLog($from='', $to='', $usr='', $cnt='')
    {
        return $this->agrLog($from, $to, $usr, $cnt);
    }

    public function getUsers()
    {
        return $this->listUsers();
    }

    public function getCountries()
    {
        return $this->listCountries();
    }

}