$(function() {  
	var themes = new Array('afterdark', 'afternoon', 'afterwork', 'aristo', 'black-tie', 'blitzer', 'bluesky', 'bootstrap', 'casablanca', 'cruze',  
	'cupertino', 'dark-hive', 'dot-luv', 'eggplant', 'excite-bike', 'flick', 'glass-x', 'home', 'hot-sneaks', 'humanity', 'le-frog', 'midnight',  
	'mint-choc', 'overcast', 'pepper-grinder', 'redmond', 'rocket', 'sam', 'smoothness', 'south-street', 'start', 'sunny', 'swanky-purse', 'trontastic',  
	'ui-darkness', 'ui-lightness', 'vader');
$('#basic').puidropdown({change:function(event){$('form').append('<input id="action" name="action" type="hidden" value="basicChangeEvent();"  />');$('form').submit();$('#action').remove();}});$('#basic2').puidropdown({change:function(event){$('form').append('<input id="action" name="action" type="hidden" value="basic2ChangeEvent();"  />');$('form').submit();$('#action').remove();}});$('#save').puibutton({click:function(event){$('form').append('<input id="action" name="action" type="hidden" value="save();"  />');$('form').submit();$('#action').remove();}});});