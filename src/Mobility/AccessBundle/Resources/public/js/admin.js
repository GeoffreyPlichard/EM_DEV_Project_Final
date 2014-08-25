(function($){

	$('.glyphicon-remove').on('click', function(){
		if(confirm("Vous allez supprimer cet élément.")){
		}else{
			return false;
		}
	});

})(jQuery);