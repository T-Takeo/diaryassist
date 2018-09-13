<div id="tabs">
<ul>
<li><a href="#tabs-1">入力</a></li>
<li><a href="#tabs-2">グラフ表示</a></li>
</ul>
<div id="tabs-1">
	<h2>こんにちは、{$user_name}さん</h2>
    <form method="post" action="index.php">
    	<input type="hidden" name="logout" value="1" />
        <p class="logout"><input type="submit" value="ログアウト" /></p>
    </form>
	<form id="form_diary">
		<input type="hidden" id="delete_flg" value="{$delete_flg}" />
		<input type="hidden" id="delete_id" value="{$arr_today_diary['diary_id']}" />
		<input type="hidden" name="item_id_input" id="item_id_input" value='{$arr_item[0]["item_id"]}' />
		<input type="hidden" name="date_input" id="date_input" value="{$smarty.now|date_format:'%Y-%m-%d'}" />
		<h3>品目：{$arr_item[0]["item_name"]}（単位：{$arr_item[0]["unit_name"]}）</h3>
		<div id="datepicker"></div>
		<div class="form_item">
			<ul>
			<li><label for="weather_input">天気</label></li>
			<li class="input_list">{html_options name=weather_input id=weather_input options=$select_weather selected=$arr_today_diary["weather_id"]}</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="low_temperature_input">気温（最低-最高）</label></li>
			<li class="input_list">
			<input type="text" name="low_temperature_input" id="low_temperature_input" value="{$arr_today_diary['low_temperature']}" max="50" class="validate[optional,custom[number],min[-50],max[50]]" /> -
			<input type="text" name="high_temperature_input" id="high_temperature_input" value="{$arr_today_diary['high_temperature']}" max="50" class="validate[optional,custom[number],min[-50],max[50]]" />
			</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="working_hour_input">作業時間（単位：時間）</label></li>
			<li class="input_list"><input type="text" name="working_hour_input" id="working_hour_input" value="{$arr_today_diary['working_hour']}" max="24" class="validate[optional,custom[number],min[0],max[24]]" /></li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="water_minutes_input">灌水時間（単位：分）</label></li>
			<li class="input_list"><input type="text" name="water_minutes_input" id="water_minutes_input" value="{$arr_today_diary['water_minutes']}" class="validate[optional,custom[integer],min[0],max[360]]" /></li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="yield_input">収穫量（単位：{$arr_item[0]["unit_name"]}）</label></li>
			<li class="input_list"><input type="text" name="yield_input" id="yield_input" value="{$arr_today_diary['yield']}" class="validate[optional,custom[integer],min[0],max[10000]]" /></li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="chemical_input">使用した農薬</label></li>
			<li class="input_list">
			{if !empty($select_chemical)}
				{html_options name=chemical_input id=chemical_input options=$select_chemical selected=$arr_today_diary["chemical_id"]}
			{/if}
			<button id="add_chemical">追加</button>
			</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="fertilizer_input">使用した肥料</label></li>
			<li class="input_list">
			{if !empty($select_fertilizer)}
				{html_options name=fertilizer_input id=fertilizer_input options=$select_fertilizer selected=$arr_today_diary["fertilizer_id"]}
			{/if}
			<button id="add_fertilizer">追加</button>
			</li>
			</ul>
		</div>
		<div class="form_item">
			<ul>
			<li><label for="annotation_input">備考</label></li>
			<li class="input_list"><textarea name="annotation_input" id="annotation_input" class="validate[optional,custom[bannedSpecial]]">{$arr_today_diary['annotation']}</textarea></li>
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
{include file='dialog.tpl'}