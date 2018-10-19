<?php
namespace System\Controller;

use System\DB\Database as db;

class Controller {

    protected $db;

    protected function __construct()
    {
        $this->db = new db;
        $this->db->initialize();
    }
}
