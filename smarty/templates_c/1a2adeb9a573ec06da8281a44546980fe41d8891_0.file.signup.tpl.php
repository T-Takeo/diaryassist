<?php
/* Smarty version 3.1.32, created on 2018-09-07 01:40:30
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\signup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b91587eb551d2_04471029',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a2adeb9a573ec06da8281a44546980fe41d8891' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\signup.tpl',
      1 => 1536224298,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b91587eb551d2_04471029 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="form">
    <form method="post" action="index.php">
        <p>Username</p>
        <p class="signup_username"><input type="text" name="signup_username" /></p>
        <p>Password</p>
        <p class="signup_password"><input type="password" name="signup_password" /></p>
        <input type="hidden" name="create_account" value="1" />
        <p class="submit"><input type="submit" value="アカウント作成" /></p>
    </form>
</div><?php }
}
