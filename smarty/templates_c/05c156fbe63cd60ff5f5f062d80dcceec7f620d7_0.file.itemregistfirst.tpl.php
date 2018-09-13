<?php
/* Smarty version 3.1.32, created on 2018-09-13 21:39:56
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\itemregistfirst.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9a5a9cca1431_11119410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05c156fbe63cd60ff5f5f062d80dcceec7f620d7' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\itemregistfirst.tpl',
      1 => 1536842393,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9a5a9cca1431_11119410 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\pleiades\\xampp\\php\\includes\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?><div id="tabs">
	<ul>
	<li><a href="#tabs-1">品目登録</a></li>
	</ul>
	<div id="tabs-1">
		<h2>こんにちは、<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
さん</h2>
	    <form method="post" action="index.php">
	    	<input type="hidden" name="logout" value="1" />
	        <p class="submit"><input type="submit" value="ログアウト" /></p>
	    </form>
		<h3>まずは品目を登録しましょう！</h3>
		<form method="post" action="index.php">
			<div class="form_item"><ul><li class="input_list"><input type="text" name="item_input" /></li></ul></div>
			<div class="form_item"><ul><li class="input_list"><?php echo smarty_function_html_options(array('name'=>'unit_input','options'=>$_smarty_tpl->tpl_vars['select_unit']->value),$_smarty_tpl);?>
</li></ul></div>
			<input type="hidden" name="add_item" value="1" />
	        <div class="form_button"><input type="submit" value="登録" /></div>
		</form>
	</div>
</div><?php }
}
