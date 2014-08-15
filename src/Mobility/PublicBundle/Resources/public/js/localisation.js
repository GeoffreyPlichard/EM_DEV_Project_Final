(function($){

	// Plugin Writestop
	$.event.special.writestop = {
        bindType: 'keyup',
        delegateType: 'keyup',
        handle: function(event) {
                var $this = $(this);
                if(typeof event.data != 'number') {
                        event.data = 1200;
                }
                if(typeof event.handleObj.handler._writestop != 'number') {
                        event.handleObj.handler._writestop = 0;
                } else {
                        event.handleObj.handler._writestop++;
                }
                setTimeout(function(_this, handler, writestop) {
                        if(handler._writestop == writestop) {
                                handler.apply(_this);
                        }

                }, event.data, this, event.handleObj.handler, event.handleObj.handler._writestop);
        }
    };

    $('#from-input').on('keyup', function(){

    	if($(this).val() == ''){
    		$("#form_participation_parcours_coorDepart").val("");
    	}

    });
    $('#to-input').on('keyup', function(){

    	if($(this).val() == ''){
    		$("#form_participation_parcours_coorArrivee").val("");
    	}

    });

    $('#from-input').on('writestop', function(){

		var addressTxt = $(this).val();
		 
		$.getJSON( "http://maps.google.com/maps/api/geocode/json?address="+addressTxt+"&sensor=false", function(data) {

			var lat = data["results"][0]["geometry"]["location"].lat;
          	var lng = data["results"][0]["geometry"]["location"].lng;

          	var coord = lat+','+lng;

          	$("#form_participation_parcours_coorDepart").val(coord);

		});
	});

	$('#to-input').on('writestop', function(){

		var addressTxt = $(this).val();
		 
		$.getJSON( "http://maps.google.com/maps/api/geocode/json?address="+addressTxt+"&sensor=false", function(data) {

			var lat = data["results"][0]["geometry"]["location"].lat;
          	var lng = data["results"][0]["geometry"]["location"].lng;

          	var coord = lat+','+lng;

          	$("#form_participation_parcours_coorArrivee").val(coord);

		});
	});

  //   $('#ges button').on('click', function(event){

  //   	event.preventDefault();

  //   	var origin = $("#form_participation_parcours_coorDepart").val();
  //   	var destination = $("#form_participation_parcours_coorArrivee").val();

  //   	$.getJSON( "http://maps.google.com/maps/api/distancematrix/json?origins="+origin+"&destinations="+destination+"&sensor=false", function(data) {

		// 	console.log(data);

		// });

  //   });


})(jQuery);