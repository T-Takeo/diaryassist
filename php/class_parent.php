<?php
require_once 'php/class_sql.php';
require_once 'php/class_sign.php';
require_once 'php/class_common.php';

class ParentClass{
    protected $mysql_pdo;
    public function __construct(){
        $this->mysql_pdo = new MysqlOperateClass();
    }

    public function EndPageLoad(){
        $this->mysql_pdo->SqlClose();
        return;
    }
}
?>