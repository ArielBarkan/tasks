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
        $sql = "SELECT status FROM tasks";

        $this->db->stmt = $this->db->pdo->prepare($sql);
        $this->db->stmt->execute();

        $this->res['total']['count'] = $this->db->stmt->rowCount();
        $this->res['total']['completed'] = $this->res['total']['remaining'] = 0;

        if($this->db->stmt->rowCount() == 0){
            $this->res['total'] = array();
        }
        else{

            foreach($this->db->stmt->fetchAll() as $k=>$v){
                switch($v['status']){
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                        $this->res['total']['remaining']++;
                    break;

                    case 5:
                        $this->res['total']['completed']++;
                    break;
                }

            }
        }
    }

    public function list()
    {
           $sql = "SELECT * FROM tasks";

       $this->db->stmt = $this->db->pdo->prepare($sql);
       $this->db->stmt->execute();

       if($this->db->stmt->rowCount() == 0){
           $this->res['list'] = array();
       }
       else{
           $this->res['list'] = $this->db->stmt->fetchAll();
       }
    }

    // Insert data to "send_log_aggregated" and then delete data from "send_log"
    public function send_log_aggregated()
    {
/*        // Insert
        $sql = '
            INSERT INTO `send_log_aggregated` 
            
            SELECT 
            ""
            ,log.usr_id
            ,numbers.cnt_id
            ,log.log_created
            ,SUM(IF(log.log_success = 1,1,0))
            ,SUM(IF(log.log_success = 0,1,0))
            
            FROM send_log AS log
            
            LEFT JOIN numbers ON numbers.num_id = log.num_id
            LEFT JOIN countries ON countries.cnt_id = numbers.cnt_id
            
            GROUP BY log.usr_id, numbers.cnt_id
        ';

        $this->db->stmt = $this->db->pdo->prepare($sql);
        $this->db->stmt->execute();

        // Delete
        $this->db->stmt = $this->db->pdo->prepare('DELETE FROM send_log');
        $this->db->stmt->execute();*/

    }

    protected function listUsers(){
     /*   $sql = "
            SELECT 
            usr_id `id`
            ,usr_name `title`
            
            FROM users
        ";

        $this->db->stmt = $this->db->pdo->prepare($sql);
        $this->db->stmt->execute();

        if($this->db->stmt->rowCount() == 0){
            $this->res['usr'] = array();
        }
        else{
            $this->res['usr'] = $this->db->stmt->fetchAll();
        }*/
    }

    protected function listCountries(){
    /*    $sql = "
            SELECT 
            cnt_code `id`
            ,cnt_title `title`
            
            FROM countries
        ";

        $this->db->stmt = $this->db->pdo->prepare($sql);
        $this->db->stmt->execute();

        if($this->db->stmt->rowCount() == 0){
            $this->res['cnt'] = array();
        }
        else{
            $this->res['cnt'] = $this->db->stmt->fetchAll();
        }*/
    }

    // Getting information from the new aggregated log
    protected function agrLog($from='', $to='', $usr='', $cnt='') {

        /*$bindParams = [];
        $where = [];
        $groupBy = [];

        if(empty($from) || empty($to)){
            $this->res['check'] = false;
            $this->res['error'] = 'You Need to Select `Start Date` and `End Date`.';
            return $this->res;
        }
        else{
            $this->res['check'] = true;
            $bindParams[':from'] =  $from;
            $bindParams[':to'] =  $to;
        }



        if(!empty($cnt)){
            $where[] = "agr.cnt_id = :cnt";
            $groupBy[] = "agr.cnt_id";
            $bindParams[':cnt'] =  $cnt;
        }

        if(!empty($usr)){
            $where[] = "agr.usr_id = :usr";
            $groupBy[] = "agr.usr_id";
            $bindParams[':usr'] =  $usr;
        }

        $sql = "
            SELECT 
            agr.day `date`
            ,IF(SUM(agr.sent)>0,FORMAT(SUM(agr.sent),0),'-') `success`
            ,IF(SUM(agr.failed)>0,FORMAT(SUM(agr.failed),0),'-') `failed`
            
            FROM send_log_aggregated AS agr
            
            WHERE agr.day >= :from AND agr.day <= :to
          
            
        ";

        if(!empty($where)){
            $sql.= 'AND '.implode($where,' AND ');
        }

        $sql.= ' GROUP BY agr.day ';

        if(!empty($groupBy)){
            $sql.= ','.implode($groupBy,',');
        }


        $this->db->stmt = $this->db->pdo->prepare($sql);
        $this->db->stmt->execute($bindParams);

        if($this->db->stmt->rowCount() == 0){
            $this->res['data'] = array();
        }
        else{
            $this->res['data'] = $this->db->stmt->fetchAll();
        }

        return $this->res;*/
    }


}