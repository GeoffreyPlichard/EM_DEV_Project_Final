$(function () {

	function resizeAll($window){
	}

	function resizeDesktop($window){
	}

	function resizePad($window){
	}

	function resizeMobile($window){
	}

	function init(){
	}


	/* RESIZE WINDOW */
		$(window).resize(function(event){
			$window = $(this);
			resizeAll($window);
			if($window.width()>=960){
				resizeDesktop($window);
			}else if($window.width()>=768 && $(window).width()<960){
				resizePad($window);
			}else{
				resizeMobile($window);
			}
		});
		resizeAll($(window));
		if($(window).width()>=960){
			resizeDesktop($(window));
		}else if($(window).width()>=768 && $(window).width()<960){
			resizePad($(window));
		}else{
			resizeMobile($(window));
		}

	init();

	//$( window ).load(function() {});

});