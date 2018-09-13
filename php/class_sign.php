<?php
class SignControllClass extends ParentClass{

    /*
     * ログイン認証
     * @return boolean
     */
    public function LoginAuth(){
        $user_name = $_POST['username'];
        $password = $_POST['password'];
        $arr_user_info = array(
            $user_name
        );
        $arr_login_result = $this->mysql_pdo->SqlSelect("tran_user", "user_id,user_name,user_pass", "user_name=?", $arr_user_info,"");
        if(!empty($arr_login_result)){
            //パスワード照合
            if(password_verify($password,$arr_login_result[0]['user_pass'])){
                //自動ログイン有効化
                if(isset($_POST['autologin'])){
                    $hash = password_hash($user_name, PASSWORD_DEFAULT);
                    $arr_values = array(
                        "cookie_hash" => $hash
                    );
                    $this->mysql_pdo->SqlUpdate("tran_user", $arr_values,"user_name=?",array($user_name));
                    setcookie("autologin", $hash,time()+259200);
                }
                $_SESSION['user_id'] = $arr_login_result[0]['user_id'];
                $_SESSION['user_name'] = $arr_login_result[0]['user_name'];
                //初回ログイン時にtran_chemicalとtran_fertilizerに「未選択」を追加する
                $arr_check = array();
                $arr_check = $this->mysql_pdo->SqlSelect("tran_chemical", "chemical_id", "user_id=?", array($_SESSION['user_id']),"");
                if(empty($arr_check)){
                    $arr_chemical = array(
                        "user_id" => $_SESSION['user_id'],
                        "chemical_name" => "未選択"
                    );
                    $this->mysql_pdo->SqlInsert("tran_chemical", $arr_chemical);
                    $arr_fertilizer = array(
                        "user_id" => $_SESSION['user_id'],
                        "fertilizer_name" => "未選択"
                    );
                    $this->mysql_pdo->SqlInsert("tran_fertilizer", $arr_fertilizer);
                }
                return true;

            }
        }
        return false;
    }

    /*
     * 自動ログイン
     * @return boolean
     */
    public function CheckCookie(){
        if(isset($_COOKIE['autologin'])){
            $arr_autologin_result = $this->mysql_pdo->SqlSelect("tran_user", "user_id,user_name", "cookie_hash=?", array($_COOKIE['autologin']),"");
            if(!empty($arr_autologin_result)){
                $_SESSION['user_id'] = $arr_autologin_result[0]['user_id'];
                $_SESSION['user_name'] = $arr_autologin_result[0]['user_name'];
                return true;
            }
        }
        return false;
    }

    /*
     * アカウント作成
     * @return boolean
     */
    public function CreateAccount(){
        //入力値が存在するか
        if(isset($_POST['signup_username'])
            && isset($_POST['signup_password'])
            && $_POST['signup_username']
            && $_POST['signup_password']){
            $user_name = $_POST['signup_username'];
            $password = $_POST['signup_password'];
            //同名のアカウントがないか
            $arr_input_values = array(
                $user_name
            );
            $arr_search_result = $this->mysql_pdo->SqlSelect("tran_user", "user_id", "user_name=?", $arr_input_values, "");
            if(!empty($arr_search_result)){
                return false;
            }else{
                //アカウント登録
                $password = password_hash($password, PASSWORD_DEFAULT);
                $arr_values = array(
                    "user_name" => $user_name,
                    "user_pass" => $password
                );
                $this->mysql_pdo->SqlInsert("tran_user", $arr_values);
                return true;
            }
            return false;
        }
    }

    /*
     * ログアウト処理
     * @return boolean
     */
    public function LogoutProcess() {
        $_SESSION = array();
        session_destroy();
        setcookie("autologin");
        return true;
    }
}
