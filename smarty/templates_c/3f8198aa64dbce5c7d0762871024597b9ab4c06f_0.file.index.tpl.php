<?php
/* Smarty version 3.1.32, created on 2018-09-12 02:54:42
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b980162821bd1_96123756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f8198aa64dbce5c7d0762871024597b9ab4c06f' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\index.tpl',
      1 => 1536688470,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:meta.tpl' => 1,
    'file:link.tpl' => 1,
    'file:script.tpl' => 1,
  ),
),false)) {
function content_5b980162821bd1_96123756 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
<?php $_smarty_tpl->_subTemplateRender('file:meta.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_subTemplateRender('file:link.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php $_smarty_tpl->_subTemplateRender('file:script.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</head>

<body>
<div id="main">
	<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['display']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</div>
<?php echo '<script'; ?>
>
$(function() {
  $('#main').css('display', 'inline');
});
<?php echo '</script'; ?>
>
<noscript>
<p>JavaScriptを有効にしてください。</p>
</noscript>
</body>
</html><?php }
}
