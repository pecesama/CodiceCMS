$(function(){
	
	$('.option_grid_trigger').click(function(){
		if($(this).next().is('.option_grid')){
			$(this).next().toggle();
			if($(this).next().is(':visible')){
				equalHeight($(this).next('.option_grid').find('.column'));
			}
			
		}
		return false;
	});
	
	
	$('.option_grid').hide();
	
	$('a.lock_show').click(function(){
		$(this).parent().parent().next('tr').toggle();
		return false;
	});
});

function equalHeight(group) {
    tallest = 0;
    group.each(function() {
        thisHeight = $(this).height();
        if(thisHeight >= tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}
