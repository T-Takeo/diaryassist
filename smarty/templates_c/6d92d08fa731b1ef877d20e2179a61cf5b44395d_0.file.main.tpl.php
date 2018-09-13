<?php
/* Smarty version 3.1.32, created on 2018-09-14 05:59:07
  from 'C:\pleiades\xampp\htdocs\diaryassist2\smarty\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9acf9b3482a9_59258515',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d92d08fa731b1ef877d20e2179a61cf5b44395d' => 
    array (
      0 => 'C:\\pleiades\\xampp\\htdocs\\diaryassist2\\smarty\\templates\\main.tpl',
      1 => 1536872345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:dialog.tpl' => 1,
  ),
),false)) {
function content_5b9acf9b3482a9_59258515 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\pleiades\\xampp\\php\\includes\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\pleiades\\xampp\\php\\includes\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?><div id="tabs">
<ul>
<li><a href="#tabs-1">入力</a></li>
<li><a href="#tabs-2">グラフ表示</a></li>
</ul>
<div id="tabs-1">
	<h2>こんにちは、<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
さん</h2>
    <form method="post" action="index.php">
    	<input type="hidden" name="logout" value="1" />
        <p class="logout"><input type="submit" value="ログアウト" /></p>
    </form>
	<form id="form_diary">
		<input type="hidden" id="delete_flg" value="<?php echo $_smarty_tpl->tpl_vars['delete_flg']->value;?>
" />
		<input type="hidden" id="delete_id" value="<?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['diary_id'];?>
" />
		<input type="hidden" name="item_id_input" id="item_id_input" value='<?php echo $_smarty_tpl->tpl_vars['arr_item']->value[0]["item_id"];?>
' />
		<input type="hidden" name="date_input" id="date_input" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
" />
		<h3>品目：<?php echo $_smarty_tpl->tpl_vars['arr_item']->value[0]["item_name"];?>
（単位：<?php echo $_smarty_tpl->tpl_vars['arr_item']->value[0]["unit_name"];?>
）</h3>
		<div id="datepicker"></div>
		<div class="form_item">
			<ul>
			<li><label for="weather_input">天気</label></li>
			<li class="input_list"><?php echo smarty_function_html_options(array('name'=>'weather_input','id'=>'weather_input','options'=>$_smarty_tpl->tpl_vars['select_weather']->value,'selected'=>$_smarty_tpl->tpl_vars['arr_today_diary']->value["weather_id"]),$_smarty_tpl);?>
</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="low_temperature_input">気温（最低-最高）</label></li>
			<li class="input_list">
			<input type="text" name="low_temperature_input" id="low_temperature_input" value="<?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['low_temperature'];?>
" max="50" class="validate[optional,custom[number],min[-50],max[50]]" /> -
			<input type="text" name="high_temperature_input" id="high_temperature_input" value="<?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['high_temperature'];?>
" max="50" class="validate[optional,custom[number],min[-50],max[50]]" />
			</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="working_hour_input">作業時間（単位：時間）</label></li>
			<li class="input_list"><input type="text" name="working_hour_input" id="working_hour_input" value="<?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['working_hour'];?>
" max="24" class="validate[optional,custom[number],min[0],max[24]]" /></li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="water_minutes_input">灌水時間（単位：分）</label></li>
			<li class="input_list"><input type="text" name="water_minutes_input" id="water_minutes_input" value="<?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['water_minutes'];?>
" class="validate[optional,custom[integer],min[0],max[360]]" /></li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="yield_input">収穫量（単位：<?php echo $_smarty_tpl->tpl_vars['arr_item']->value[0]["unit_name"];?>
）</label></li>
			<li class="input_list"><input type="text" name="yield_input" id="yield_input" value="<?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['yield'];?>
" class="validate[optional,custom[integer],min[0],max[10000]]" /></li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="chemical_input">使用した農薬</label></li>
			<li class="input_list">
			<?php if (!empty($_smarty_tpl->tpl_vars['select_chemical']->value)) {?>
				<?php echo smarty_function_html_options(array('name'=>'chemical_input','id'=>'chemical_input','options'=>$_smarty_tpl->tpl_vars['select_chemical']->value,'selected'=>$_smarty_tpl->tpl_vars['arr_today_diary']->value["chemical_id"]),$_smarty_tpl);?>

			<?php }?>
			<button id="add_chemical">追加</button>
			</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="fertilizer_input">使用した肥料</label></li>
			<li class="input_list">
			<?php if (!empty($_smarty_tpl->tpl_vars['select_fertilizer']->value)) {?>
				<?php echo smarty_function_html_options(array('name'=>'fertilizer_input','id'=>'fertilizer_input','options'=>$_smarty_tpl->tpl_vars['select_fertilizer']->value,'selected'=>$_smarty_tpl->tpl_vars['arr_today_diary']->value["fertilizer_id"]),$_smarty_tpl);?>

			<?php }?>
			<button id="add_fertilizer">追加</button>
			</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="annotation_input">備考</label></li>
			<li class="input_list"><textarea name="annotation_input" id="annotation_input" class="validate[optional,custom[bannedSpecial]]"><?php echo $_smarty_tpl->tpl_vars['arr_today_diary']->value['annotation'];?>
</textarea></li>
			</ul>
		</div>
		<div class="form_button"><button id="add_diary">投稿</button><button id="remove_record" value="remove_record">削除</button></div>
		<div class="result"></div>
	</form>
</div>
<div id="tabs-2">
<div id="datepicker_chart"></div>
<canvas id="chart_temperature"></canvas>
<canvas id="chart_working_hour"></canvas>
<canvas id="chart_water_minutes"></canvas>
<canvas id="chart_yield"></canvas>
</div>
</div>
<?php $_smarty_tpl->_subTemplateRender('file:dialog.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
