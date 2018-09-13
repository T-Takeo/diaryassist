<?php
/* Smarty version 3.1.32, created on 2018-09-13 21:35:40
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\dialog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9a599cc48d06_38597307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7a1fcfc1dce9cf7c7a5d443da6834f8110fdd12' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\dialog.tpl',
      1 => 1536841665,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9a599cc48d06_38597307 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="add_chemical_dialog" title="農薬を追加する">
<form>
  <label for="name">農薬名</label>
  <input type="text" name="add_chemical_name" id="add_chemical_name" class="text ui-widget-content ui-corner-all" />
</form>
</div>

<div id="add_fertilizer_dialog" title="肥料を追加する">
<form>
  <label for="name">肥料名</label>
  <input type="text" name="add_fertilizer_name" id="add_fertilizer_name" class="text ui-widget-content ui-corner-all" />
</form>
</div>
<div id="delete_dialog" title="日誌情報の削除" style="display: none;">削除してよろしいですか？</div>
<div id="add_done"></div><?php }
}
