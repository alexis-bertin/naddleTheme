//OBFURCATIONS LIENS FOOTER ET RS
document.addEventListener("DOMContentLoaded", function(event) {
	var classname = document.getElementsByClassName("loutreCannibale");
	for (var i = 0; i < classname.length; i++) {
		classname[i].addEventListener('click', zbeubZbeub, false);
	}
});
var zbeubZbeub = function() {
	var attribute = this.getAttribute("data-loutre");
	document.location.href= decodeURIComponent(window.atob(attribute));
};


/**************ATTENTE CHARGEMENT DOCUMENT***********/
$(document).ready(function() {
/*****************************************************/		

// SMOOTHING SCROLL
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

$(document).ready(function() {
	//STICKY MENU
	if(!$.trim($('#menuTopSticky').html())=='') {
		var stickyNavTop = $('#menuTopSticky').offset().top;
		var stickyNav = function() {
			var scrollTop = $(window).scrollTop();
			if (scrollTop > stickyNavTop) { 
				$('#menuTopSticky').addClass('sticky');
			} 
			else {
				$('#menuTopSticky').removeClass('sticky'); 
			}
		};
		stickyNav();
		$(window).scroll(function() {	
			stickyNav();
		});
	}


	//STICKY MENU RESPONSIVE
	if(!$.trim($('#burgerMenuSticky').html())=='') {
		var stickyNavTopBurger = $('#burgerMenuSticky').offset().top;
		var stickyNavBurger = function() {
			var scrollTop = $(window).scrollTop();
			if (scrollTop > stickyNavTopBurger) { 
				$('#burgerMenuSticky').addClass('stickyBurger');
			} 
			else {
				$('#burgerMenuSticky').removeClass('stickyBurger'); 
			}
		};
		stickyNavBurger();
		$(window).scroll(function() {	
			stickyNavBurger();
		});
	}
});


// HOVER POUR DROPDOWN MENU
$(".dropdown").hover(
	function() {
	  $( this ).addClass('show');
	  $(".dropdown-menu", this).addClass('show');
	}, function() {
		$( this ).removeClass('show');
		$(".dropdown-menu", this).removeClass('show');
	}
);
$(".open").removeClass("open");


/*****************************************************/	
});
/*****************************************************/	

// ANIMATION CROIX MENU / MENU RESPONSIVE
function menuResponsive(x) {
	$('.menuResponsiveHeight').css({
		top: '0'
	})
}
function menuResponsive2() {
	$('.menuResponsiveHeight').css({
		top: '-120vh'
	})
}

//////////////////////////////FONCTIONS MAPS//////////////////////////////////////////////////
	 
	//Transforme une zone de texte en zone autocomplétion
	//Le paramètre à passer est l'id de la zone de texte
	function placeAutocomplete(adresseAutocomplete){

		var options={
			bounds:null,
			//Types:['establishment']
		}

		var autocomplete=new google.maps.places.Autocomplete(document.getElementById(adresseAutocomplete),options);

	}


	 //Fonction qui crée une map centrée sur une adresse avec un marqueur sur cette adresse
	//La fonction renvoie true si la geoloc a reussi sinon renvoie false
	//Zone adresse -> l'adresse du centre de la carte
	//Zone Map -> l'identifiant de la div qui affichera la map
	//icon -> Le chemin de l'image du marqueur qui apparaitra au centre la carte 
	//Zoom grossissement de la carte
	//Info l'information afficher si l'on clique sur le marqueur
	function createMapIcon(zoneAdresse,zoneMap,icon,zoom,info){

		//on genere un geocoder
		var geocoder=new google.maps.Geocoder();
		//Géocode l'adresse saisie dans zone adresse passé en premier paramètre
		geocoder.geocode(
			{ 
				address: zoneAdresse
			},
			//Le deuxiémé paramètre est une fonction qui localise l'adresse passée en premier paramètre
			function(results,status){
				//Si la géoloc a réussi
				if(status==google.maps.GeocoderStatus.OK){
					//On calcule la latitude longitude (latlng)
					var latlng=results[0].geometry.location;
					//alert(latlng);
					//On prépare les options de création de la map (zoom, latlng, et le type de map)
					var mapOptions = {
						zoom      : zoom,
						center  :  latlng,
                        mapTypeId : google.maps.MapTypeId.ROADMAP,
						disableDefaultUI : true,
						gestureHandling : 'none',
						draggableCursor: 'default',
						clickableIcons : false,
						streetViewControl: false,
						scaleControl: false,
						styles: 	[
							{
								"featureType": "administrative",
								"elementType": "all",
								"stylers": [
									{
										"visibility": "on"
									},
									{
										"lightness": 33
									}
								]
							},
							{
								"featureType": "administrative",
								"elementType": "labels",
								"stylers": [
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "administrative",
								"elementType": "labels.text",
								"stylers": [
									{
										"gamma": "0.75"
									}
								]
							},
							{
								"featureType": "administrative.neighborhood",
								"elementType": "labels.text.fill",
								"stylers": [
									{
										"lightness": "-37"
									}
								]
							},
							{
								"featureType": "landscape",
								"elementType": "geometry",
								"stylers": [
									{
										"color": "#f9f9f9"
									}
								]
							},
							{
								"featureType": "landscape.man_made",
								"elementType": "geometry",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"lightness": "40"
									},
									{
										"visibility": "off"
									}
								]
							},
							{
								"featureType": "landscape.natural",
								"elementType": "labels.text.fill",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"lightness": "-37"
									}
								]
							},
							{
								"featureType": "landscape.natural",
								"elementType": "labels.text.stroke",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"lightness": "100"
									},
									{
										"weight": "2"
									}
								]
							},
							{
								"featureType": "landscape.natural",
								"elementType": "labels.icon",
								"stylers": [
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "poi",
								"elementType": "geometry",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"lightness": "80"
									}
								]
							},
							{
								"featureType": "poi",
								"elementType": "labels",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"lightness": "0"
									}
								]
							},
							{
								"featureType": "poi.attraction",
								"elementType": "geometry",
								"stylers": [
									{
										"lightness": "-4"
									},
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "poi.park",
								"elementType": "geometry",
								"stylers": [
									{
										"color": "#c5dac6"
									},
									{
										"visibility": "on"
									},
									{
										"saturation": "-95"
									},
									{
										"lightness": "62"
									}
								]
							},
							{
								"featureType": "poi.park",
								"elementType": "labels",
								"stylers": [
									{
										"visibility": "on"
									},
									{
										"lightness": 20
									}
								]
							},
							{
								"featureType": "road",
								"elementType": "all",
								"stylers": [
									{
										"lightness": 20
									}
								]
							},
							{
								"featureType": "road",
								"elementType": "labels",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"gamma": "1.00"
									}
								]
							},
							{
								"featureType": "road",
								"elementType": "labels.text",
								"stylers": [
									{
										"gamma": "0.50"
									}
								]
							},
							{
								"featureType": "road",
								"elementType": "labels.icon",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"gamma": "0.50"
									}
								]
							},
							{
								"featureType": "road.highway",
								"elementType": "geometry",
								"stylers": [
									{
										"color": "#c5c6c6"
									},
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "road.highway",
								"elementType": "geometry.stroke",
								"stylers": [
									{
										"lightness": "-13"
									}
								]
							},
							{
								"featureType": "road.highway",
								"elementType": "labels.icon",
								"stylers": [
									{
										"lightness": "0"
									},
									{
										"gamma": "1.09"
									}
								]
							},
							{
								"featureType": "road.arterial",
								"elementType": "geometry",
								"stylers": [
									{
										"color": "#e4d7c6"
									},
									{
										"saturation": "-100"
									},
									{
										"lightness": "47"
									}
								]
							},
							{
								"featureType": "road.arterial",
								"elementType": "geometry.stroke",
								"stylers": [
									{
										"lightness": "-12"
									}
								]
							},
							{
								"featureType": "road.arterial",
								"elementType": "labels.icon",
								"stylers": [
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "road.local",
								"elementType": "geometry",
								"stylers": [
									{
										"color": "#fbfaf7"
									},
									{
										"lightness": "77"
									}
								]
							},
							{
								"featureType": "road.local",
								"elementType": "geometry.fill",
								"stylers": [
									{
										"lightness": "-5"
									},
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "road.local",
								"elementType": "geometry.stroke",
								"stylers": [
									{
										"saturation": "-100"
									},
									{
										"lightness": "-15"
									}
								]
							},
							{
								"featureType": "transit.station.airport",
								"elementType": "geometry",
								"stylers": [
									{
										"lightness": "47"
									},
									{
										"saturation": "-100"
									}
								]
							},
							{
								"featureType": "water",
								"elementType": "all",
								"stylers": [
									{
										"visibility": "on"
									},
									{
										"color": "#acbcc9"
									}
								]
							},
							{
								"featureType": "water",
								"elementType": "geometry",
								"stylers": [
									{
										"saturation": "53"
									}
								]
							},
							{
								"featureType": "water",
								"elementType": "labels.text.fill",
								"stylers": [
									{
										"lightness": "-42"
									},
									{
										"saturation": "17"
									}
								]
							},
							{
								"featureType": "water",
								"elementType": "labels.text.stroke",
								"stylers": [
									{
										"lightness": "61"
									}
								]
							}
						]
					}
					//Et enfin on genere la map
                    var map = new google.maps.Map(document.getElementById(zoneMap), mapOptions);
					//On prépare les options de création du marker (la map de destination, la latlng, le marqueur)
					var markerOptions = {
						map: map,
                        position: latlng,
                        optimized: false,
                        draggable: false, 
                        flat: true,
						icon:icon
					};
					//On genere le marker
					var marker = new google.maps.Marker(markerOptions);
					return true;
				}else{
					return false
				}
			}
		)

	}

	
	//Fonction qui crée une map centrée sur une adresse  (sans marqueur)
	//La fonction renvoie l'objet Map si la geoloc a reussi sinon renvoie false
	//Zone adresse -> l'adresse du centre de la carte
	//Zone Map -> l'identifiant de la div qui affichera la map
	//Zoom grossissement de la carte
	//la fonction fn se déclenchera dès que la map aura été générée ou en cas d'erreur
	function createMap(zoneAdresse,zoneMap,zoom,fn){

		//on genere un geocoder
		var geocoder=new google.maps.Geocoder();
		//Géocode l'adresse saisie dans zone adresse passé en premier paramètre
		geocoder.geocode(
			{ 
				address: zoneAdresse
			},
			//Le deuxiémé paramètre est une fonction qui localise l'adresse passée en premier paramètre
			function(results,status){
				//Si la géoloc a réussi
				if(status==google.maps.GeocoderStatus.OK){
					//On calcule la latitude longitude (latlng)
					var latlng=results[0].geometry.location;
					//alert(latlng);
					//On prépare les options de création de la map (zoom, latlng, et le type de map)
					var mapOptions = {
						zoom      : zoom,
						center  :  latlng,
						mapTypeId : google.maps.MapTypeId.ROADMAP
					}
					//Et enfin on genere la map
					var map = new google.maps.Map(document.getElementById(zoneMap), mapOptions);
					//map.setZoom(16);
			    	//map.setCenter(latlng);
					return fn(null,map);
				}else{
					return fn(true,null);
				}
			}
		)

	}

	//Fonction qui positionne un marqueur (icone) sur une map déjà créée
	//Zone adresse -> l'adresse du marqueur à positionner sur la carte
	//Map -> Objet google map déjà créé
	//Icon -> chemin de l'cone qui servira de marqueur	
	//Info l'information afficher si l'on clique sur le marqueur
	function positionneIconMap(zoneAdresse,map,icon,info){

		//on genere un geocoder
		var geocoder=new google.maps.Geocoder();
		//Géocode l'adresse saisie dans zone adresse passé en premier paramètre
		geocoder.geocode(
			{ 
				address: zoneAdresse
			},
			//Le deuxiémé paramètre est une fonction qui localise l'adresse passée en premier paramètre
			function(results,status){
				//Si la géoloc a réussi
				if(status==google.maps.GeocoderStatus.OK){
					//On calcule la latitude longitude (latlng)
					var latlng=results[0].geometry.location;
					//alert(latlng);
					//On prépare les options de création du marker (la map de destination, la latlng, le marqueur)
					var markerOptions = {
						position: latlng,
						icon:icon
					};
					//On genere le marker
					var marker = new google.maps.Marker(markerOptions);
					//On le raccroche à la map
					marker.setMap(map);
					///////////////AFFICHE L'ADRESSE LORS D'UN CLIC/////////////////
					var contentString =zoneAdresse ;
					var infowindow = new google.maps.InfoWindow({
					   content: info
					});
					marker.addListener('click', function() {
					    	infowindow.open(map, marker);
					});
					//////////////////////////////////////////////////////////////////
					return true;
				}else{
					return false
				}
			}
		)
	}


	// latlngStr2LatLng prend un paramètre un latlng format chaine de caractère (49.302917, -1.2445361000000048)
	// et le transforme en objet LatLng
	function latlngStr2LatLng(latlngStr){
		strposition= latlngStr;
		strposition=strposition.replace('(', '');
  		strposition=strposition.replace(')', '');
  		lat=strposition.split(",")[0];
  		lng=strposition.split(",")[1];
  		return new google.maps.LatLng(lat,lng)
	}

	//La fonction calculate trace un itinéraire et calcule une distance
	//origin -> latlng au format string (49.302917, -1.2445361000000048)
	//destination -> latlng au format string (49.302917, -1.2445361000000048)
	//map objet map
	function calculate(origin,destination,map,fn){
	    if(origin && destination){
	        var request = {
	            origin      : origin,
	            destination : destination,
	            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Type de transport
	        }
	        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
	        var direction = new google.maps.DirectionsRenderer({
			    map   : map 
			    //panel : panel 
			});
	        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
	            if(status == google.maps.DirectionsStatus.OK){
	                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours	            	
					var km=response.routes["0"].legs["0"].distance.value;//Distance en metres
					var temps=response.routes["0"].legs["0"].duration.value;//temps en secondes
					var res= {'km':km,'temps':temps};
					return fn(null,res);
	            }else{
	            	return fn(true,null);
	            }
	        });
    	} 
	};

////////////////////////////////////////////////////////////////////////////////////
