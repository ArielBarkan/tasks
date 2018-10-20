<?php
namespace Mod\Task;

trait TaskModel{

    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function total()
    {
        $res['total'] = array();
        $res['total']['completed'] = $res['total']['remaining'] = 0;
        $sql = "SELECT status FROM tasks";

        try{
            $this->db->stmt = $this->db->pdo->prepare($sql);
            $this->db->stmt->execute();
        } catch (\Exception $e) {
            $res['err'] = 1;
        }

        $res['total']['count'] = $this->db->stmt->rowCount();

        if($this->db->stmt->rowCount() != 0){

            foreach($this->db->stmt->fetchAll(\PDO::FETCH_ASSOC) as $k=>$v){
                switch($v['status']){
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                        $res['total']['remaining']++;
                    break;

                    case 5:
                        $res['total']['completed']++;
                    break;
                }

            }
        }
        return $res;
    }

    public function listTasks()
    {
       $sql = "SELECT * FROM tasks";

        try{
            $this->db->stmt = $this->db->pdo->prepare($sql);
            $this->db->stmt->execute();
        } catch (\Exception $e) {
            $res['err'] = 1;
            $res['msg'] = 'There was an error.';
        }

       if($this->db->stmt->rowCount() == 0){
           $res['list'] = array();
       }
       else{
           $res['list'] = $this->db->stmt->fetchAll(\PDO::FETCH_ASSOC);
       }

       return $res;
    }

    public function deleteTask($id)
    {
        $sql = "DELETE FROM tasks WHERE id = :id";

        $bindParams[':id'] =  $id;

        try{
            $this->db->stmt = $this->db->pdo->prepare($sql);
            $this->db->stmt->execute($bindParams);
        } catch (\Exception $e) {
            $res['status'] = 0;
            $res['msg'] = 'There was a problem.';
        }

        $sql = "SELECT id FROM tasks WHERE id = :id";

        try{
            $this->db->stmt = $this->db->pdo->prepare($sql);
            $this->db->stmt->execute($bindParams);
            $exists = $this->db->stmt->fetch();
        } catch (\Exception $e) {
            $res['status'] = 0;
            $res['msg'] = 'There was a problem.';
        }

        if(is_array($exists)){
            $res['status'] = 0;
            $res['msg'] = 'There was a problem.';
        }
        else{
            $res['status'] = 1;
            $res['msg'] = 'The task has been removed.';
        }

        return $res;
    }

    public function createTask($name, $desc, $status)
    {
        $sql = "
            INSERT INTO tasks 
            (`name`, `description`, `status`, `date`)
            VALUES(:name, :desc, :status, NOW())
        ";

        $bindParams[':name'] =  $name;
        $bindParams[':desc'] =  $desc;
        $bindParams[':status'] =  $status;

        try{
            $this->db->stmt = $this->db->pdo->prepare($sql);
            $this->db->stmt->execute($bindParams);
            $res['status'] = 1;
            $res['msg'] = 'The task has been added.';

        } catch (\Exception $e) {
            $res['status'] = 0;
            $res['msg'] = 'There was a problem.';
        }

        return $res;
    }

    public function editTask($id, $desc, $status)
    {

        $sql = "
            UPDATE tasks 
            SET `description` = :desc, `status` = :status, `date` = NOW()
            WHERE id = :id
        ";

        $bindParams[':id'] =  $id;
        $bindParams[':desc'] =  $desc;
        $bindParams[':status'] =  $status;

        try{
            $this->db->stmt = $this->db->pdo->prepare($sql);
            $this->db->stmt->execute($bindParams);
            $res['status'] = 1;
            $res['msg'] = 'The task has been updated.';

        } catch (\Exception $e) {
            $res['status'] = 0;
            $res['msg'] = 'There was a problem.';
        }

        return $res;
    }



}