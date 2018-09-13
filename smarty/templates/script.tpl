<script type="text/javascript" src="js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery-ui.js" charset="utf-8"></script>
<script type="text/javascript" src="js/datepicker-ja.js" charset="utf-8"></script>
<script type="text/javascript" src="js/touchPunch.js" charset="utf-8"></script>
<script type="text/javascript" src="js/chart.js" charset="utf-8"></script>
<script type="text/javascript" src="js/toggleSwitch.js" charset="utf-8"></script>
<script type="text/javascript" src="js/MonthPicker.js" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-ja.js"></script>
<script type="text/javascript" src="js/func.js" charset="utf-8"></script>
<script type="text/javascript"charset="utf-8">
var entered_date = [{$entered_date}];
entered_date = entered_date.sort();
var code = "";
{if isset($create_acocunt)}
code = "{$create_acocunt}";
{/if}
var error = "";
{if isset($login_error)}
error = "{$login_error}";
{/if}
</script>
