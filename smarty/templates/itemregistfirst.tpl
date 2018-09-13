<div id="tabs">
	<ul>
	<li><a href="#tabs-1">品目登録</a></li>
	</ul>
	<div id="tabs-1">
		<h2>こんにちは、{$user_name}さん</h2>
	    <form method="post" action="index.php">
	    	<input type="hidden" name="logout" value="1" />
	        <p class="submit"><input type="submit" value="ログアウト" /></p>
	    </form>
		<h3>まずは品目を登録しましょう！</h3>
		<form method="post" action="index.php">
			<div class="form_item"><ul><li class="input_list"><input type="text" name="item_input" /></li></ul></div>
			<div class="form_item"><ul><li class="input_list">{html_options name=unit_input options=$select_unit}</li></ul></div>
			<input type="hidden" name="add_item" value="1" />
	        <div class="form_button"><input type="submit" value="登録" /></div>
		</form>
	</div>
</div>