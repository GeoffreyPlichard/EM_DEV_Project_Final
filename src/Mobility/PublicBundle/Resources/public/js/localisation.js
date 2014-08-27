(function($){

  // Données voiture VS bus
  // http://www.evolucite.mesges.ca/Saviez-vous_que.asp

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

    /*$('#from-input').on('keyup', function(){

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
	});*/

  function distanceCalculation(){

    var origin = $('#participate-form').find('.from-input').val();
    var destination = $('#participate-form').find('.to-input').val();

    var origins      = [];
    var destinations = [];
    origins.push(origin);
    destinations.push(destination);
    var typeValue = $('#participate-form').find('select').val();
    var ges = 0;

    var distanceMatrix  = new google.maps.DistanceMatrixService();
    var distanceRequest = { origins: origins, destinations: destinations, travelMode: google.maps.TravelMode.DRIVING, unitSystem: google.maps.UnitSystem.METRIC, avoidHighways: false, avoidTolls: false };
    distanceMatrix.getDistanceMatrix(distanceRequest, function(response, status) {
        if (status != google.maps.DistanceMatrixStatus.OK) {
            alert('Error was: ' + status);
        }
        else {
            var origins      = response.originAddresses; 
            var destinations = response.destinationAddresses;
            var distance = response.rows[0].elements[0].distance.value; // Distance entre le départ et l'arrivée
            var distance = distance / 1000; // Conversion en mètres en km

            // Calcul en fonction de la distance et du type de véhicule
            switch(typeValue){
              case '0': // A pied
                ges = distance * 0;
                break;
              case '1': // En voiture
                ges = distance * 0.2435;
                break;
              case '2': // A vélo
                ges = distance * 0;
                break;
              case '3': // En transport en commun
                ges = (distance * 0.2435) / 4;
                break;
              default:
                ges = 0;

            }
            console.log(distance);
            console.log(ges.toFixed(3));
            $('.ges-input').val(ges.toFixed(3));
        }
    });

  }

  $('.to-input').on('writestop', distanceCalculation );
  $('.to-input').on('blur', distanceCalculation );
  $('#participate-form').find('select').on('change', distanceCalculation )

  //   $('#ges button').on('click', function(event){

  //   	event.preventDefault();

  //   	var origin = $("#form_participation_parcours_coorDepart").val();
  //   	var destination = $("#form_participation_parcours_coorArrivee").val();

  //   	$.getJSON( "http://maps.google.com/maps/api/distancematrix/json?origins="+origin+"&destinations="+destination+"&sensor=false", function(data) {

		// 	console.log(data);

		// });

  //   });


})(jQuery);