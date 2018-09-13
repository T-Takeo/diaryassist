<?php
/* Smarty version 3.1.32, created on 2018-09-12 04:16:56
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9814a8c64762_40237039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e053dc573b6e6ed46baadd1424678b8f2e0850d0' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\login.tpl',
      1 => 1536693415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9814a8c64762_40237039 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="login_tabs">
	<ul>
		<li><a href="#login_tabs-1">ログイン</a></li>
		<li><a href="#login_tabs-2">新規登録</a></li>
	</ul>
	<div id="login_tabs-1">
	    <form method="post" action="index.php" id="form_login">
	    	<div class="form_item"><input type="text" name="username" placeholder="UserName" class="validate[required,maxSize[50],custom[onlyLetterNumber]]" /></div>
	        <div class="form_item"><input type="password" name="password" placeholder="Password" class="validate[required,minSize[5],maxSize[50],custom[onlyLetterNumber]]" /></div>
	        <div class="form_item"><input type="checkbox" id="autologin" name="autologin" value="1" /><p>次回から自動的にログインする</p></div>
	        <div class="form_button"><input type="submit" value="ログイン" /></div>
	    </form>
	</div>
	<div id="login_tabs-2">
	    <form method="post" action="index.php" id="form_signup">
	   		<div class="form_item"><input type="text" name="signup_username" placeholder="UserName" class="validate[required,maxSize[50],custom[onlyLetterNumber]]" /></div>
	        <div class="form_item"><input type="password" name="signup_password" id="password" placeholder="Password" class="validate[required,minSize[5],maxSize[50],custom[onlyLetterNumber]]" /></div>
	        <div class="form_item"><input type="password" name="signup_password_re" placeholder="Retype the Password" class="validate[required,minSize[5],maxSize[50],equals[password]]" /></div>
	        <input type="hidden" name="create_account" value="1" />
	        <div class="form_button"><input type="submit" value="アカウント作成" /></div>
	    </form>
	</div>
</div>
<?php }
}
