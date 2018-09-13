<?php
class MysqlOperateClass{
    /*
     * DBCONNECT
     */
    public function __construct() {
        $dsn = "mysql:host=localhost;dbname=db_diaryassist;charset=utf8";
        $username = "root";
        $passwd = "";
        $this->dbh = new PDO($dsn,$username,$passwd);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /*
     * SELECT
     * @return array SELECT結果の連想配列
     */
    public function SqlSelect($table,$column,$where,$arr_where_values,$option){
        $sql = "SELECT {$column} FROM {$table}";
        if($where != ""){
            $sql .=  " WHERE {$where}";
            if($option != ""){
                $sql .= " {$option}";
            }
            //クエリ実行
            if($stmt = $this->dbh->prepare($sql)){
                $stmt->execute($arr_where_values);
            }
        }else{
            //クエリ実行（全件取得）
            if($option != ""){
                $sql .= " {$option}";
            }
            $stmt = $this->dbh->query($sql);
        }
        //SELECT結果の取り出し
        $arr_result = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($arr_result, $row);
        }
        return $arr_result;
    }

    /*
     * SELECT(JOIN)
     * @return array
     */
    public function SqlSelectJoin($table,$column,$option,$arr_value){
        $sql = "SELECT {$column} FROM {$table} {$option}";
        //クエリ実行
        if($stmt = $this->dbh->prepare($sql)){
            $stmt->execute($arr_value);
        }
        //SELECT結果の取り出し
        $arr_result = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($arr_result, $row);
        }
        return $arr_result;
    }

    /*
     * LASTINSERTID
     * @return string
     */
    public function SqlLastInsertId(){
        $res = $this->dbh->lastInsertId();
        return $res;
    }

    /*
     * INSERT
     * @return boolean
     */
    public function SqlInsert($table,$arr_values){

        //SQL文の成形
        $placeholder = "";
        $column = "";
        $arr_insert_values = array();
        foreach ($arr_values as $key => $value){
            $placeholder .= "?,";
            $column .= $key.",";
            $arr_insert_values[] = $value;
        }
        $placeholder = substr($placeholder, 0, -1);
        $column = substr($column, 0, -1);
        $sql = "INSERT INTO {$table}({$column}) VALUES({$placeholder})";

        //クエリ実行
        if($stmt = $this->dbh->prepare($sql)){
            $stmt->execute($arr_insert_values);
            return true;
        }
        return false;
    }

    /*
     * UPDATE
     * @return boolean
     */
    public function SqlUpdate($table,$arr_update_values,$where,$arr_where_values){
        $sql = "UPDATE {$table} SET ";
        $arr_values = array();
        foreach($arr_update_values as $key => $value) {
           $sql .= "{$key}=?,";
           $arr_values[] = $value;
        }
        $sql = substr($sql, 0,  -1);
        $sql .= " WHERE {$where}";
        $arr_datas = array_merge($arr_values,$arr_where_values);

        //クエリ実行
        if($stmt = $this->dbh->prepare($sql)){
            $stmt->execute($arr_datas);
            return true;
        }
        return false;

    }

    /*
     * DELETE
     * @return boolean
     */
    public function SqlDelete($table,$where,$arr_where_values){
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $arr_values = array();
        foreach($arr_where_values as $value) {
            $arr_values[] = $value;
        }

        //クエリ実行
        if($stmt = $this->dbh->prepare($sql)){
            $stmt->execute($arr_values);
            return true;
        }
        return false;
    }

    /*
     * CLOSE
     */
    public function SqlClose(){
        $this->dbh = null;
        return;
    }
}
