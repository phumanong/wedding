$(document).ready(function(){

	$('.img_menu').click(function(){
		$('.show_menu').css('display','none');	
		$('.content_menu').toggle({ direction: 'right' },"slide", '1000');
	})
	$('.hide_menu').click(function(){
		$('.content_menu').hide({ direction: 'left' },"slide", '1000');
		$('.show_menu').css('display','block');
	})
}); 