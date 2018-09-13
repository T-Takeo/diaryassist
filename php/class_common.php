<?php
class CommonControllClass extends ParentClass{

    /*
     * 品目の取得（＋該当品目の単位）
     * @return array(item_name,unit_name)
     */
    public function FetchItemValue(){
        $arr_item_result = $this->mysql_pdo->SqlSelectJoin(
            "tran_item",
            "item_id,item_name,unit_name",
            "INNER JOIN mst_unit ON tran_item.unit_id=mst_unit.unit_id WHERE user_id=?",
            array($_SESSION['user_id'])
        );
        return $arr_item_result;
    }

    /*
     * 品目の登録
     * @return boolean
     */
    public function SendItem(){
        if(isset($_POST['item_input'])
            && $_POST['item_input']){
            $unit_id = $_POST['unit_input'];
            $item_name = $_POST['item_input'];
            $arr_values = array(
                "user_id" => $_SESSION['user_id'],
                "unit_id" => $unit_id,
                "item_name" => $item_name
            );
            $this->mysql_pdo->SqlInsert("tran_item", $arr_values);
            return true;
        }
        return false;

    }

    /*
     * 肥料、農薬のレコード登録
     * @return array(chemical_id,chemical_name) ←登録したレコード１件
     */
    public function SendPulldownRecord($name,$value){
        //同名のレコードがないか
        $arr_check = $this->mysql_pdo->SqlSelect("tran_{$name}", "{$name}_name", "{$name}_name=? AND user_id=?", array($value,$_SESSION['user_id']), "");
        if(empty($arr_check)){
            $arr_values = array(
                "user_id" => $_SESSION['user_id'],
                "{$name}_name" => $value
            );
            $this->mysql_pdo->SqlInsert("tran_{$name}", $arr_values);

            //追加したレコードを取得
            $arr_return = $this->mysql_pdo->SqlSelect("tran_{$name}", "{$name}_id,{$name}_name", "{$name}_name=? AND user_id=?", array($value,$_SESSION['user_id']), "");
            return $arr_return;
        }
        return array();
    }

    /*
     * プルダウン入力値の取得
     * @return array(optionname,value)
     */
    public function FetchPulldownValues($table,$name,$value,$where,$arr_where_values,$option){
        $arr_result = array();
        if($where != "" && !empty($arr_where_values)){
            $arr_result = $this->mysql_pdo->SqlSelect($table, "{$name},{$value}", $where, $arr_where_values, $option);
        }else{
            $arr_result = $this->mysql_pdo->SqlSelect($table, "{$name},{$value}", "", "",$option);
        }
        $arr_return = array();
        if(!empty($arr_result)){
            foreach ($arr_result as $val){
                $arr_return[$val[$name]] = $val[$value];
            }
        }
        return $arr_return;
    }

    /*
     * 日誌取得
     * @return array
     */
    public function FetchDiary(){
        $arr_result = array();
        $arr_result = $this->mysql_pdo->SqlSelectJoin(
            "tbl_diary",
            "*",
            "LEFT JOIN diaries_chemicals ON tbl_diary.diary_id=diaries_chemicals.diary_id LEFT JOIN diaries_fertilizers ON tbl_diary.diary_id=diaries_fertilizers.diary_id WHERE user_id=? ORDER BY date ASC",
            array($_SESSION['user_id'])
            );
        return $arr_result;
    }

    /*
     * 特定日付の日誌検索
     * @return string diary_id
     */
    public function SearchDiary($date){
        $arr_result = $this->mysql_pdo->SqlSelect("tbl_diary", "diary_id", "user_id=? AND date=?", array($_SESSION['user_id'],$date), "");
        if(!empty($arr_result)){
            return $arr_result[0]["diary_id"];
        }
        return "notfound";
    }

    /*
     * 日誌の投稿
     * @return boolean
     */
    public function SendDiary($arr_diary_field,$arr_chemical_fertilizer){
        $this->mysql_pdo->SqlInsert("tbl_diary ", $arr_diary_field);
        //中間テーブル登録
        $diary_id = $this->mysql_pdo->SqlLastInsertId();
        $arr_chemical_input = array(
            "diary_id" => $diary_id,
            "chemical_id" => $arr_chemical_fertilizer['chemical_id']
        );
        $this->mysql_pdo->SqlInsert("diaries_chemicals ", $arr_chemical_input);
        $arr_fertilizer_input = array(
            "diary_id" => $diary_id,
            "fertilizer_id" => $arr_chemical_fertilizer['fertilizer_id']
        );
        $this->mysql_pdo->SqlInsert("diaries_fertilizers ", $arr_fertilizer_input);
        return true;
    }

    /*
     * 日誌のアップデート
     * @return boolean
     */
    public function UpdateDiary($diary_id,$arr_diary_field,$arr_chemical_fertilizer){
        $this->mysql_pdo->SqlUpdate("tbl_diary", $arr_diary_field, "diary_id=?", array($diary_id));
        $this->mysql_pdo->SqlUpdate("diaries_chemicals", array("chemical_id" => $arr_chemical_fertilizer["chemical_id"]), "diary_id=?", array($diary_id));
        $this->mysql_pdo->SqlUpdate("diaries_fertilizers", array("fertilizer_id" => $arr_chemical_fertilizer["fertilizer_id"]), "diary_id=?", array($diary_id));
        return true;
    }

    /*
     * 日誌の削除
     * @return boolean
     */
    public function DeleteDiary($delete_id){
        $this->mysql_pdo->SqlDelete("diaries_chemicals", "diary_id=?", array($delete_id));
        $this->mysql_pdo->SqlDelete("diaries_fertilizers", "diary_id=?", array($delete_id));
        $this->mysql_pdo->SqlDelete("tbl_diary", "diary_id=?", array($delete_id));

        return true;
    }

    /*
     * ページ設定のセット
     * @return array
     */
    public function SelectPageOption($page_option){
        $arr_option = array();
        switch($page_option){
            case "main":
                $arr_option = array(
                "page_title" => "メインページ",
                "display" => $page_option
                    );
                break;
            case "login":
                $arr_option = array(
                "page_title" => "ログイン",
                "display" => $page_option
                );
                break;
            case "itemregistfirst":
                $arr_option = array(
                "page_title" => "品目登録",
                "display" => $page_option
                );
                break;
        }
        return $arr_option;
    }
}
?>