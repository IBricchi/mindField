$(function(){
	$('div.contPointCount').children('div').click(function(argument) {
		$(this).children('form').submit();
	})
})