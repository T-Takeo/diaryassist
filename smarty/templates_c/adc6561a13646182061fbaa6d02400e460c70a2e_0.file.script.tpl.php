<?php
/* Smarty version 3.1.32, created on 2018-09-13 21:33:11
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\script.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9a5907c85468_99547693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'adc6561a13646182061fbaa6d02400e460c70a2e' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\script.tpl',
      1 => 1536841990,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9a5907c85468_99547693 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="js/jquery.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-ui.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/datepicker-ja.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/touchPunch.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/chart.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/toggleSwitch.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/MonthPicker.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.validationEngine.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.validationEngine-ja.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="js/func.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript"charset="utf-8">
var entered_date = [<?php echo $_smarty_tpl->tpl_vars['entered_date']->value;?>
];
entered_date = entered_date.sort();
var code = "";
<?php if (isset($_smarty_tpl->tpl_vars['create_acocunt']->value)) {?>
code = "<?php echo $_smarty_tpl->tpl_vars['create_acocunt']->value;?>
";
<?php }?>
var error = "";
<?php if (isset($_smarty_tpl->tpl_vars['login_error']->value)) {?>
error = "<?php echo $_smarty_tpl->tpl_vars['login_error']->value;?>
";
<?php }
echo '</script'; ?>
>
<?php }
}
