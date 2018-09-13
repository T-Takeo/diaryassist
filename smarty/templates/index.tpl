<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>{$page_title}</title>
{include file='meta.tpl'}

{include file='link.tpl'}

{include file='script.tpl'}
</head>

<body>
<div id="main">
	{include file=$display}
</div>
<script>
$(function() {
  $('#main').css('display', 'inline');
});
</script>
<noscript>
<p>JavaScriptを有効にしてください。</p>
</noscript>
</body>
</html>