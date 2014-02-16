$(document).ready(function(){
	$('#submit_button').click(function(){
		if($('#url').val()){
			$.post('createUrl.php', { url : $('#url').val() }, function(data){
				$('.result').html(data);
				$('.result').show();
			});
		}
	});
});