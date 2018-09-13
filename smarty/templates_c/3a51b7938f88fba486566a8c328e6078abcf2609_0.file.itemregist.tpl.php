<?php
/* Smarty version 3.1.32, created on 2018-09-06 07:16:40
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\itemregist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9055c8336547_15396655',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a51b7938f88fba486566a8c328e6078abcf2609' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\itemregist.tpl',
      1 => 1536185640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9055c8336547_15396655 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\pleiades\\xampp\\php\\includes\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>日報支援</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=1280">
<meta http-equiv="Content-Style-Type" content="text/css" />

<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="" charset="utf-8"><?php echo '</script'; ?>
>

<link rel="stylesheet" href="css/login.css" type="text/css" />
</head>

<body>
<div id="main">
	<h2>こんにちは、<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
さん！</h2>
	<h3>まずは品目を登録しましょう！</h3>
	<form class="form_item" method="post" action="index.php">
		<p class="item_input"><input type="text" name="item_input" /></p>
		<p class="unit_input"><?php echo smarty_function_html_options(array('name'=>'unit_input','options'=>$_smarty_tpl->tpl_vars['select_unit']->value),$_smarty_tpl);?>
</p>
		<input type="hidden" name="add_item" value="1" />
        <p class="submit"><input type="submit" value="登録" /></p>
	</form>
</div>
<div id="form">
    <form method="post" action="index.php">
    	<input type="hidden" name="logout" value="1" />
        <p class="submit"><input type="submit" value="ログアウト" /></p>
    </form>
</div>
</body><?php }
}
