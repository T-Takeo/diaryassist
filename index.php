<?php
session_start();
require_once("Smarty/libs/smarty.class.php");
require_once("php/class_parent.php");

$smarty = new Smarty();
$sign = new SignControllClass();
$common = new CommonControllClass();

$arr_page_option = array();
$entered_date = "";

//Smarty設定
$smarty->template_dir = "smarty/templates/";
$smarty->compile_dir = "smarty/templates_c/";
$smarty->config_dir = "smarty/configs/";
$smarty->cache_dir = "smarty/cache/";

//AJAX通信かどうか
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    //農薬追加処理
    if(isset($_POST['add_chemical_name'])){
        $arr_add_chemical_result = array();
        $arr_add_chemical_result = $common->SendPulldownRecord("chemical",$_POST['add_chemical_name']);
        $arr_output = array();
        if(!empty($arr_add_chemical_result)){
            $arr_output = array(
                "result" => true,
                "dialog_message" => "農薬：{$arr_add_chemical_result[0]['chemical_name']}を登録しました",
                "chemical_id" => $arr_add_chemical_result[0]['chemical_id'],
                "chemical_name" => $arr_add_chemical_result[0]['chemical_name']
            );
        }else{
            $arr_output = array(
                "result" => false,
                "dialog_message" => "{$_POST['add_chemical_name']}は既に登録されています"
            );
        }
        echo json_encode($arr_output);
    }
    //肥料追加処理
    if(isset($_POST['add_fertilizer_name'])){
        $arr_add_fertilizer_result = array();
        $arr_add_fertilizer_result = $common->SendPulldownRecord("fertilizer",$_POST['add_fertilizer_name']);
        if(!empty($arr_add_fertilizer_result)){
            $arr_output = array(
                "result" => true,
                "dialog_message" => "肥料：{$arr_add_fertilizer_result[0]['fertilizer_name']}を登録しました",
                "fertilizer_id" => $arr_add_fertilizer_result[0]['fertilizer_id'],
                "fertilizer_name" => $arr_add_fertilizer_result[0]['fertilizer_name']
            );
        }else{
            $arr_output = array(
                "result" => false,
                "dialog_message" => "{$_POST['add_fertilizer_name']}は既に登録されています"
            );
        }
        echo json_encode($arr_output);
    }

    //カレンダー日付押下時
    if(isset($_POST['date_input']) && !isset($_POST['post_flg'])){
        $date = $_POST['date_input'];
        //セッションから日誌データを取得する
        $arr_session_diary = $_SESSION['diaries'];
        $output = array(
            "diary_id" => "",
            "search_result" => false,
            "weather_id" => "1",
            "low_temperature" => "",
            "high_temperature" => "",
            "working_hour" => "",
            "water_minutes" => "",
            "yield" => "",
            "annotation" => "",
            "chemical_id" => "",
            "fertilizer_id" => ""
        );
        foreach ($arr_session_diary as $key){
            if($key["date"] == $date){
                $output = array("search_result" => true);
                $output = array_merge($output,$key);
                break;
            }
        }
        echo json_encode($output);

    }

    //日誌投稿処理
    if(isset($_POST['post_flg'])){
        $arr_diary_field = array(
            'user_id' => $_SESSION['user_id'],
            'item_id' => $_POST['item_id_input'],
            'weather_id' => $_POST['weather_input'],
            'date' => $_POST['date_input'],
            'low_temperature' => $_POST['low_temperature_input'],
            'high_temperature' => $_POST['high_temperature_input'],
            'working_hour' => $_POST['working_hour_input'],
            'water_minutes' => $_POST['water_minutes_input'],
            'yield' => $_POST['yield_input'],
            'annotation' => $_POST['annotation_input']
        );
        $arr_chemical_fertilizer = array(
            "chemical_id" => $_POST['chemical_input'],
            "fertilizer_id" => $_POST['fertilizer_input']
        );
        //該当日付のレコードが存在した場合、アップデートする
        $diary_id = $common->SearchDiary($arr_diary_field["date"]);
        if($diary_id != "notfound"){
            $common->UpdateDiary($diary_id, $arr_diary_field, $arr_chemical_fertilizer);
        }else{
            $common->SendDiary($arr_diary_field,$arr_chemical_fertilizer);
        }
        //セッション値のリセット
        unset($_SESSION['diaries']);
        //日誌の取得
        $_SESSION['diaries'] = $common->FetchDiary();
        //日付のみを取得
        foreach ($_SESSION['diaries'] as $key){
            $entered_date .= "'{$key["date"]}',";
        }
        $entered_date = substr($entered_date, 0, -1);
        //入力した日付にセット
        echo $_POST['date_input'];
    }

    //日誌削除処理
    if(isset($_POST['delete_flg'])){
        $common->DeleteDiary($_POST['delete_id']);
        //セッション値のリセット
        unset($_SESSION['diaries']);
        //日誌の取得
        $_SESSION['diaries'] = $common->FetchDiary();

        echo "削除しました";
    }

    //グラフ表示
    if(isset($_POST['chart_flg'])){
        $arr_chart = array();
        foreach ($_SESSION['diaries'] as $key){
            $arr_chart[] = array(
                "date" => $key["date"],
                "low_temperature" => $key["low_temperature"],
                "high_temperature" => $key["high_temperature"],
                "working_hour" => $key["working_hour"],
                "water_minutes" => $key["water_minutes"],
                "yield" => $key["yield"]
            );
        }
        echo json_encode($arr_chart);
    }
}else{
    //ログアウト処理
    if(isset($_POST['logout'])){
        $sign->LogoutProcess();
        header( "HTTP/1.1 301 Moved Permanently" );
        header( "Location: /diaryassist2/" );
        exit();
    }

    //自動ログイン処理
    if($sign->CheckCookie()){
        $arr_page_option = $common->SelectPageOption("main");
    }

    //ユーザー新規登録処理
    if(isset($_POST['create_account'])){
        if($sign->CreateAccount()){
            $smarty->assign("create_acocunt", "success");
        }else{
            $smarty->assign("create_acocunt", "error");
        }
    }
    //セッションチェック
    if(isset($_SESSION['user_id'])){
        $arr_page_option = $common->SelectPageOption("main");
    }else{
        //ログイン
        if(isset($_POST['username'])
            && isset($_POST['password'])){
            if($sign->LoginAuth()){
                //ログイン成功
                $arr_page_option = $common->SelectPageOption("main");
            }else{
                //入力はあったがログインできなかった
                $arr_page_option = $common->SelectPageOption("login");
                $smarty->assign("login_error", "1");
            }
        }else{
            //初期画面表示
            $arr_page_option = $common->SelectPageOption("login");
        }
    }
    //品目の登録処理
    if(isset($_POST['add_item'])){
        $common->SendItem();
    }

    //メイン画面
    if($arr_page_option['display'] == "main"){
        $arr_item = $common->FetchItemValue();
        //品目の登録がなかった場合
        if(empty($arr_item)){
            $arr_page_option = $common->SelectPageOption("itemregistfirst");
            $arr_select_unit = $common->FetchPulldownValues(
                "mst_unit",
                "unit_id",
                "unit_name",
                "",
                "",
                "ORDER BY unit_id ASC"
                );
            $smarty->assign("select_unit", $arr_select_unit);
        }else{
            //日誌の取得
            if(!isset($_SESSION['diaries'])){
                $arr_diary = $common->FetchDiary();
                $_SESSION['diaries'] = $arr_diary;
            }
            //日付のみを取得
            foreach ($_SESSION['diaries'] as $key){
                $entered_date .= "'{$key["date"]}',";
            }
            $entered_date = substr($entered_date, 0, -1);

            //初回接続時、今日の日誌レコードの取得
            $date = date("Y-m-d");
            $arr_today_diary = array();
            foreach ($_SESSION['diaries'] as $value){
                if($value["date"] == $date){
                    $arr_today_diary = $value;
                    break;
                }
            }
            if(empty($arr_today_diary)){
                $arr_today_diary = array(
                    "diary_id" => "",
                    "weather_id" => "1",
                    "low_temperature" => "",
                    "high_temperature" => "",
                    "working_hour" => "",
                    "water_minutes" => "",
                    "yield" => "",
                    "annotation" => "",
                    "chemical_id" => "",
                    "fertilizer_id" => ""
                );
                $smarty->assign("delete_flg", "");
            }else{
                $smarty->assign("delete_flg", "1");
            }
            $smarty->assign("arr_today_diary", $arr_today_diary);


            //プルダウンメニュー生成
            //item
            /*
            $arr_select_item = array();
            foreach ($arr_item as $key){
                $arr_select_item[$key["item_id"]] = "{$key["item_name"]}（単位：{$key["unit_name"]}）";
            }
            $smarty->assign("arr_select_item", $arr_select_item);
            */
            $smarty->assign("arr_item", $arr_item);
            //weather
            $arr_select_weather = $common->FetchPulldownValues(
                "mst_weather",
                "weather_id",
                "weather_name",
                "",
                "",
                "ORDER BY weather_name ASC"
                );
            $smarty->assign("select_weather", $arr_select_weather);
            //chemical
            $arr_select_chemical = $common->FetchPulldownValues(
                "tran_chemical",
                "chemical_id",
                "chemical_name",
                "user_id=?",
                array($_SESSION['user_id']),
                ""
                );
                $smarty->assign("select_chemical", $arr_select_chemical);
            //fertilizer
            $arr_select_fertilizer = $common->FetchPulldownValues(
                "tran_fertilizer",
                "fertilizer_id",
                "fertilizer_name",
                "user_id=?",
                array($_SESSION['user_id']),
                ""
                );
                $smarty->assign("select_fertilizer", $arr_select_fertilizer);
        }
        $smarty->assign("user_name", $_SESSION['user_name']);
    }
    $smarty->assign("entered_date", $entered_date);
    $smarty->assign("page_title", $arr_page_option['page_title']);
    $smarty->assign("display", $arr_page_option['display'].".tpl");

    $smarty->display("index.tpl");
}
$common->EndPageLoad();
?>