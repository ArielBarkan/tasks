<?php
namespace System\Route;

use System\Controller\Controller as Controller;

class RouteController extends Controller {

    // Core vars
    public $klein;
    public $viewFile;

    // models
    public $Task;

    public function __construct()
    {
        parent::__construct();

        $this->klein = new \Klein\Klein();

        /**
         * Routes:
         */

        // HomePage
        $this->klein->respond('GET', '/', function () {
            $this->Task = new \Con\Task\TaskController($this->db);
            $this->Task->total();
            $this->Task->listTasks();
 /*           $this->Task->TaskExecute();
            $this->Task->getUsers();
            $this->Task->getCountries();*/

            $this->viewFile = 'Task/index.php';
        });

        $this->klein->respond('POST', '/Task', function ($request, $response) {
            header('Content-Type: application/json');
            $this->Task = new \Con\Task\TaskController($this->db);

            $act = $_POST['act'] ?? '';
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $desc = $_POST['desc'] ?? '';
            $status = $_POST['status'] ?? '';

            switch($act){
                case 'list':
                    $res = $this->Task->getList();
                break;

                case 'total':
                    $res = $this->Task->getTotal();
                break;

                case 'del':
                    $res = $this->Task->del($id);
                break;

                case 'create':
                    $res = $this->Task->create($name,$desc,$status);
                break;

                case 'edit':
                    $res = $this->Task->edit($id,$desc,$status);
                break;
            }
            echo json_encode($res);

/*            $agrLog = $this->Task->getAgrLog($from, $to, $usr, $cnt);
            echo json_encode($agrLog);*/
        });

        /** Invoke Routing */
        $request = \Klein\Request::createFromGlobals();
        $uri = $request->server()->get('REQUEST_URI');
        $request->server()->set('REQUEST_URI', substr($uri, strlen(APP_PATH)));
        $this->klein->dispatch($request);

    }

}