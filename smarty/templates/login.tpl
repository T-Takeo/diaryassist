<div id="login_tabs">
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
