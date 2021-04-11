/* Sticky header */
jQuery(document).ready(function () {
	if(true)//jQuery(window).width()>=768)
	{
		/* Desktop */
		if(jQuery('body.admin-bar').length > 0)
		{
			if(jQuery(window).width()<768)
			{
				if(jQuery('.cabecera_linea_900').length > 0)
				{
					jQuery('#Top_bar').css('top','80px');
					jQuery('body').css('padding-top',jQuery('#Top_bar').height()+jQuery('#wpadminbar').height()+jQuery('.cabecera_linea_900').height());
				}
				else
				{
					jQuery('#Top_bar').css('top','32px');
					jQuery('body').css('padding-top',jQuery('#Top_bar').height()+jQuery('#wpadminbar').height());
				}
			}
			else
			{
				jQuery('#Top_bar').css('top','32px');
				jQuery('body').css('padding-top',jQuery('#Top_bar').height()+jQuery('#wpadminbar').height());
			}
		}
		else
		{
			if(jQuery(window).width()<768)
			{
				if(jQuery('.cabecera_linea_900').length > 0)
				{
					jQuery('#Top_bar').css('top','35px');
					jQuery('body').css('padding-top',jQuery('#Top_bar').height()+jQuery('.cabecera_linea_900').height());
				}
				else
				{
					jQuery('body').css('padding-top',jQuery('#Top_bar').height());
				}
			}
			else
			{
				jQuery('body').css('padding-top',jQuery('#Top_bar').height());
			}
		}
	}
});
/* Fin sticky header */

//Código para el slider de precio del buscador. Recibe un json llamado price_range que incluye el precio máximo y mínimo actual

if(typeof price_range != 'undefined')
{
	jQuery(function(){
		jQuery('.zona_filtro #slider-range').slider({
			range: true,
			min: Number(price_range.min_price),
			max: Number(price_range.max_price),
			values: [ price_range.current_min, price_range.current_max ],
			create: function( event, ui ) {
				jQuery('.zona_filtro #max_price').val(price_range.current_max).attr('value',price_range.current_max);
				jQuery('.zona_filtro #min_price').val(price_range.current_min).attr('value',price_range.current_min);
			},
			slide: function( event, ui ) {
				jQuery('.zona_filtro #amount').val(ui.values[ 0 ] + ' € - ' + ui.values[ 1 ] + ' €');
				jQuery('.zona_filtro #min_price').val(ui.values[ 0 ]);
				jQuery('.zona_filtro #max_price').val(ui.values[ 1 ]);
			}
		});
		jQuery('#amount').val(jQuery('.zona_filtro #slider-range').slider('values', 0 ) +  ' € - ' + jQuery('.zona_filtro #slider-range').slider('values', 1) + ' €' );
	});
}

//Para el datepicker:
jQuery(function(){
	if(typeof selected_date != 'undefined' && selected_date != '')
	{
		jQuery('#datepicker').val(selected_date).attr('value',selected_date);
		jQuery('#datepicker').datepicker({
			minDate: 0,
			altField: '#fechaalt',
			altFormat: 'yymmdd',
			setDate: selected_date_value
		});
		jQuery('#fechaalt').val(selected_date_value);
	}
	else
	{
		jQuery('#datepicker').val('Fecha de inicio').attr('value','Fecha de inicio');
		jQuery('#datepicker').datepicker({
			minDate: 0,
			altField: '#fechaalt',
			altFormat: 'yymmdd'
		});
	}

	if(typeof selected_end_date != 'undefined' && selected_end_date != '')
	{
		jQuery('#datepicker_end').val(selected_end_date).attr('value',selected_end_date);
		jQuery('#datepicker_end').datepicker({
			minDate: 0,
			altField: '#fechafinalt',
			altFormat: 'yymmdd',
			setDate: selected_end_date_value
		});
		jQuery('#fechafinalt').val(selected_end_date_value);
	}
	else
	{
		/*jQuery('#datepicker_end').val('¿Cuándo te caduca?').attr('value','¿Cuándo te caduca?');*/
		jQuery('#datepicker_end').val('Caducidad').attr('value','Caducidad');
		jQuery('#datepicker_end').datepicker({
			minDate: 0,
			altField: '#fechafinalt',
			altFormat: 'yymmdd'
		});
	}

	jQuery('#datepicker').on('change', function() {
		var fecha_elegida=jQuery('#fechaalt').val();
		var anyo_elegido=fecha_elegida.substr(0,4);
		var mes_elegido=fecha_elegida.substr(4,2);
		var dia_elegido=fecha_elegida.substr(6);
		var fecha_nueva=new Date(anyo_elegido, mes_elegido - 1, dia_elegido);
		jQuery('#datepicker_end').datepicker( "option", "minDate", fecha_nueva ).val('¿Cuándo te caduca?').attr('value','¿Cuándo te caduca?');
	});


	jQuery('.elemento.fecha').on({
		mouseenter: function(){
			jQuery('.elemento.fecha').addClass('ui-state-hover');
		},
		mouseleave: function(){
			jQuery('.elemento.fecha').removeClass('ui-state-hover');
		}
	});
});

//Para los select:
jQuery(function(){
	jQuery(".elemento select").selectmenu({ icons: { button: "ui-icon-plus" } });
});

//Para mover el sequra de sitio
jQuery('.formas_de_pago .sequra .detalles').append(jQuery('.bkat-product #sequra_partpayment_teaser'));
/* NOS CARGAMOS EL SEQURA */
jQuery('.bkat-product #sequra_partpayment_teaser').remove();

if(jQuery('.bkat2019v').length > 0)
{
	jQuery('.single_block#financiar .detalles').html(jQuery('.bkat-product #sequra_partpayment_teaser'));
}

/*jQuery(document).ready(function(){
	alert(jQuery('.bkat-product .instalment_total-js').text());
});*/

jQuery('.cerrar_sidebar').on('click',function(){
	jQuery( '#Side_slide' ).animate({ 'right':-250 },300);
	jQuery('body').animate({ 'left':0 },300);
	jQuery( '#body_overlay' ).fadeOut(300);
});

//Para el sticky del mapa de los resultados
/*jQuery(document).ready(function(e) {
    jQuery('.acf-map.listado').clone().appendTo('.sticky_map_container');
});*/
/*if(jQuery(window).width()>=768)
{
	jQuery(window).scroll(function()
	{
		var thescroll = jQuery(window).scrollTop();
		if (thescroll >= 230)
		{
			jQuery('.sticky_map_container').addClass('active');
			jQuery('.zona_ubicacion .mapa.panel').css('opacity','0').css('z-index','-10');
			/*jQuery('.sticky_map_container').fadeIn();*/
			/*jQuery(".woocommerce-page .zona_ubicacion").addClass("custom_sticky");*/
		/*}
		else
		{
			jQuery('.sticky_map_container').removeClass('active');
			jQuery('.zona_ubicacion .mapa.panel').css('opacity','1').css('z-index','100');
			/*jQuery('.sticky_map_container').fadeOut();*/
			/*jQuery(".woocommerce-page .zona_ubicacion").removeClass("custom_sticky");*/
		/*}
	});
}*/
jQuery(document).ready(function(e) {
    jQuery('.mapa.panel').clone().appendTo('.sticky_map_container');
});
if(jQuery(window).width()>=768)
{
	jQuery(window).scroll(function()
	{
		var thescroll = jQuery(window).scrollTop();
		if (thescroll >= 700)
		{
			jQuery('.sticky_map_container').addClass('active');
			jQuery('.zona_ubicacion .mapa.panel').css('opacity','0').css('z-index','-10');
			/*jQuery('.sticky_map_container').fadeIn();*/
			/*jQuery(".woocommerce-page .zona_ubicacion").addClass("custom_sticky");*/
		}
		else
		{
			jQuery('.sticky_map_container').removeClass('active');
			jQuery('.zona_ubicacion .mapa.panel').css('opacity','1').css('z-index','100');
			/*jQuery('.sticky_map_container').fadeOut();*/
			/*jQuery(".woocommerce-page .zona_ubicacion").removeClass("custom_sticky");*/
		}
	});
}

//JS para Google Maps

(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {

	// var
	var $markers = $el.find('.marker');
	var $markers_empty = $el.find('.marker_empty');


	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};


	// create map
	var map = new google.maps.Map( $el[0], args);


	// add a markers reference
	map.markers = [];


	// add markers
	$markers_empty.each(function(){

    	add_marker( $(this), map );

	});
	$markers.each(function(){

    	add_marker( $(this), map );

	});


	// center map
	center_map( map );


	// return
	return map;

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {
	
	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	//if($marker.context.className == 'marker')
	if($marker[0].className == 'marker')
	{
		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon		: '/wp-content/uploads/2018/07/icon-map-new.png'
		});
	}
	else
	{
		// create empty marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon		: '/wp-content/uploads/2018/07/icon-map_empty.png'
		});
	}

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);

//Fin JS para Google Maps

//Para el search box de google places
var defaultBounds = new google.maps.LatLngBounds(
	new google.maps.LatLng(35.559639,-10.528125),
	new google.maps.LatLng(43.349682,4.714182)
);
var options = {
	bounds: defaultBounds,
	types: ['(regions)'],
	componentRestrictions: {country: 'es'}
};
if(jQuery('#pac-input').length>0)
{
	var input = document.getElementById('pac-input');
	var autocomplete = new google.maps.places.Autocomplete(input, options);
	autocomplete.addListener('place_changed', fillInAddress);
	function fillInAddress()
	{
		var place = autocomplete.getPlace();
		/*console.log(place.geometry.location.lat());*/
		jQuery('input#direccion_c').val(place.formatted_address);
		jQuery('input#direccion_c').attr('value',place.formatted_address);
		
		var adm_level1 = '';
		var adm_level2 = '';
		jQuery.each(place.address_components,function(i,val){
			if(val.types[0] == 'locality')
			{
				jQuery('input#places_locality').val(val.long_name);
				jQuery('input#places_locality').attr('value',val.long_name);
			}
			else if(val.types[0] == 'administrative_area_level_2')
			{
				adm_level2=val.long_name;
			}
			else if(val.types[0] == 'administrative_area_level_1')
			{
				adm_level1=val.long_name;
			}
		});
		if(adm_level2 != '')
		{
			jQuery('input#provincia').val(adm_level2);
			jQuery('input#provincia').attr('value',adm_level2);
		}
		else
		{
			jQuery('input#provincia').val(adm_level1);
			jQuery('input#provincia').attr('value',adm_level1);
		}
		
		jQuery('input#places_locality_lat').val(place.geometry.location.lat());
		jQuery('input#places_locality_lat').attr('value',place.geometry.location.lat());
		jQuery('input#places_locality_lng').val(place.geometry.location.lng());
		jQuery('input#places_locality_lng').attr('value',place.geometry.location.lng());
	}
}
if(jQuery('#pac-input-search-centro').length>0)
{
	var input2 = document.getElementById('pac-input-search-centro');
	var autocomplete2 = new google.maps.places.Autocomplete(input2, options);
	autocomplete2.addListener('place_changed', fillInAddress2);
	function fillInAddress2()
	{
		var place = autocomplete2.getPlace();
		/*console.log(place);*/
		/*console.log(place.address_components);*/
		
		jQuery('input#municipio-search-centro').val('');
		jQuery('input#municipio-search-centro').attr('value','');
		jQuery('input#provincia-search-centro').val('');
		jQuery('input#provincia-search-centro').attr('value','');
		jQuery('input#places_search-centro_lat').val(place.geometry.location.lat());
		jQuery('input#places_search-centro_lat').attr('value',place.geometry.location.lat());
		jQuery('input#places_search-centro_lng').val(place.geometry.location.lng());
		jQuery('input#places_search-centro_lng').attr('value',place.geometry.location.lng());
		
		var adm_level1 = '';
		var adm_level2 = '';
		
		jQuery.each(place.address_components,function(i,val){
			if(val.types[0] == 'locality')
			{
				jQuery('input#municipio-search-centro').val(val.long_name);
				jQuery('input#municipio-search-centro').attr('value',val.long_name);
			}
			else if(val.types[0] == 'administrative_area_level_2')
			{
				adm_level2=val.long_name;
			}
			else if(val.types[0] == 'administrative_area_level_1')
			{
				adm_level1=val.long_name;
			}
		});
		
		if(adm_level2 != '')
		{
			jQuery('input#provincia-search-centro').val(adm_level2);
			jQuery('input#provincia-search-centro').attr('value',adm_level2);
		}
		else
		{
			jQuery('input#provincia-search-centro').val(adm_level1);
			jQuery('input#provincia-search-centro').attr('value',adm_level1);
		}
	}
}
if(jQuery('#pac-input-landing-course-type').length>0)
{
	var input3 = document.getElementById('pac-input-landing-course-type');
	var autocomplete3 = new google.maps.places.Autocomplete(input3, options);
	autocomplete3.addListener('place_changed', fillInAddress3);
	function fillInAddress3()
	{
		var place = autocomplete3.getPlace();
		/*console.log(place);*/
		jQuery('input#direccion_c-landing-course-type').val(place.formatted_address);
		jQuery('input#direccion_c-landing-course-type').attr('value',place.formatted_address);
		jQuery('input#places_locality-landing-course-type').val(place.address_components[0].long_name);
		jQuery('input#places_locality-landing-course-type').attr('value',place.address_components[0].long_name);
		jQuery('input#provincia-landing-course-type').val(place.address_components[1].long_name);
		jQuery('input#provincia-landing-course-type').attr('value',place.address_components[1].long_name);
		jQuery('input#places_locality_lat-landing-course-type').val(place.geometry.location.lat());
		jQuery('input#places_locality_lat-landing-course-type').attr('value',place.geometry.location.lat());
		jQuery('input#places_locality_lng-landing-course-type').val(place.geometry.location.lng());
		jQuery('input#places_locality_lng-landing-course-type').attr('value',place.geometry.location.lng());
	}
}

//Para el formulario flotante
jQuery(document).ready(function(e) {
    jQuery('#aviso.telefono .escribenos').on('click',function(ev){
		ev.preventDefault();
		ev.stopPropagation();
		jQuery('#formulario_flotante').css('right','0').addClass('active');
		jQuery('body').addClass('modal_active');
	});
	jQuery('#formulario_flotante .cerrar').on('click',function(ev){
		ev.preventDefault();
		ev.stopPropagation();
		jQuery('#formulario_flotante').css('right','-150%').removeClass('active');
		jQuery('body').removeClass('modal_active');
	});
});
jQuery(document.body).click( function(ev) {
	/*console.log(ev.target.type);
	if((ev.target.id != 'formulario_flotante') &&
	   (ev.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.id != 'formulario_flotante') &&
	   (ev.target.name != 'quiz-148') &&
	   (ev.target.type != 'submit') &&
	   (ev.target.type != 'checkbox') &&
	   (ev.target.parentNode.type != 'select-one') )
	{
    	jQuery('#formulario_flotante').css('right','-150%').removeClass('active');
		jQuery('body').removeClass('modal_active');
	}*/
});



jQuery(document).ready(function(e) {
	//Rellenamos población en el formulario de no hay resultados. Recibe un JSON llamado 'direccion'
	if(typeof direccion != 'undefined')
	{
		jQuery('input[name="poblacion"]').val(direccion);
		jQuery('input[name="poblacion"]').attr(direccion);
	}
	//Añadimos enlace al botón de curso más cercano en Renovación CAP
	if(typeof link_centro_mas_cercano != 'undefined')
	{
		jQuery('.boton-renovacion-cap.centro-mas-cercano').attr("href", link_centro_mas_cercano);
	}
	// Mandamos formulario single bkat a página de gracias (de la forma normal no funciona, pero así sí)
	var currentURL=window.location.href;
	if(currentURL.indexOf('f1085')!=-1)
	{
		location = 'https://www.academiadeltransportista.com/gracias-reserva-plaza/';
	}
});

//Evita que el formulario se envíe al seleccionar una opción del Google Places autocomplete searchbox pulsando el intro
if(jQuery('#pac-input').length > 0)
{
	var input= document.getElementById('pac-input');
	google.maps.event.addDomListener(input, 'keydown', function(e) {
		if (e.keyCode == 13 && jQuery('.pac-container:visible').length) {
			e.preventDefault();
		}
	});
}

//Añadimos un logo de "loading" al pinchar buscar curso
jQuery('form.main_search_form').submit(function(e){
	if(jQuery('.buscador_principal #provincia').val() == '')
	{
		e.preventDefault();
		alert('Por favor, escriba y seleccione una ciudad.');
	}
	else
	{
		jQuery('.buscador_principal .button .spinner').css('opacity','1');
	}
});
/*jQuery('.buscador_principal .button').on('click',function(){
	jQuery('.buscador_principal .button .spinner').addClass('active');	
});*/
jQuery('.course_search_form #boton_buscar').on('click',function(){
	jQuery('#boton_buscar .spinner').addClass('active');
});

/* Evitamos que el buscador de centros por ciudad se envíe si no se ha seleccionado una ciudad */
jQuery('form.buscador_centros_por_ciudad').submit(function(e){
	if(jQuery('form.buscador_centros_por_ciudad #provincia-search-centro').val() == '')
	{
		e.preventDefault();
		alert('Por favor, escribe y selecciona una ciudad.');
	}
});

/* Para burger menú. Las páginas de NO BKAT hay que añadirlas a mano en scripts.js o no funcionará en esas páginas. ¯\_(ツ)_/¯ */
jQuery(function() {
	if( (jQuery('body.bkat_search_results').length > 0) || (jQuery('.bkat-item').length > 0) )
	{
		jQuery('button.hamburger').on('click', function(){
			if(jQuery('.menu_movil.cursos_submenu_movil').hasClass('active'))
			{
				jQuery('.menu_movil.cursos_submenu_movil').removeClass('active');
				jQuery('button.cursos_submenu i').toggleClass('active');
			}
			jQuery('button.hamburger').toggleClass('is-active');
			jQuery('.menu_movil.principal').toggleClass('active');
		});
		jQuery('button.cursos_submenu').on('click',function(){
			if(jQuery('button.hamburger').hasClass('is-active'))
			{
				jQuery('button.hamburger').removeClass('is-active');
			}
			if(jQuery('.menu_movil.principal').hasClass('active'))
			{
				jQuery('.menu_movil.principal').removeClass('active');
			}
			jQuery('.menu_movil.cursos_submenu_movil').toggleClass('active');
			jQuery('button.cursos_submenu i').toggleClass('active');
		});
	}
});

/* Cambiamos de sitio los bloques del single BKAT para móvil */
if(jQuery(window).width() < 768)
{
	jQuery('.column.entry-summary').after(jQuery('.column.autoescuela_info'));
	jQuery('.column.producto-mapa-movil .autoescuela_texto').after(jQuery('.column.producto-mapa-movil .autoescuela_mapa'));
}

/* Cambios botones */
if(jQuery('.postid-325').length > 0 || jQuery('.postid-120').length > 0)
{
	jQuery('.FormOnlinePdtPageFormOnline .wpcf7-submit').attr('value','ME INTERESA ESTE CURSO');
}
/* Fin botones */

/* Función que saca elementos aleatorios en el DOM */
(function($){
    $.fn.shuffle = function() {
        var allElems = this.get(),
            getRandom = function(max) {
                return Math.floor(Math.random() * max);
            },
            shuffled = $.map(allElems, function(){
                var random = getRandom(allElems.length),
                    randEl = $(allElems[random]).clone(true)[0];
                allElems.splice(random, 1);
                return randEl;
           });
        this.each(function(i){
            $(this).replaceWith($(shuffled[i]));
        });
        return $(shuffled);
    };
})(jQuery);

/* Ponemos dos de los cursos destacados que encontremos, en orden al azar, en su lugar de cursos destacados */
if(jQuery('.zona_cursos').length > 0)
{
	if(jQuery('.bkat_search_results_2019').length > 0 || jQuery('.page-template-page-template-cursos-ciudades').length > 0)
	{
		/* Estamos en listados de CURSOS */
	}
	else
	{
		/* Estamos en listado autoescuelas */
		jQuery('.zona_cursos .products li').shuffle();
	}
	
	jQuery.fn.random = function(){
		return this.eq(Math.floor(Math.random() * this.length));
	}

	var i;
	for(i=1;i<=2;i++)
	{
		var elemento=jQuery('.zona_cursos_resto .curso-destacado').random();
		if(elemento.length > 0)
		{
			jQuery('.zona_cursos_destacados .products').append(elemento);
		}
	}
	
	/* utilizamos el mismo enganche para ordenar los cursos por nivel de microsite autoescuela Y POR MUNICIPIO 22/07/2020 */
	/* Primero ordenamos por municipio y nivel de centro */
	if(jQuery('.zona_cursos_resto .municipio-actual').length > 0)
	{
		jQuery('.zona_cursos_resto .municipio-actual').each(function(index, element) {
			if(jQuery('.bkat_search_results_2019').length > 0 /*|| jQuery('.page-template-page-template-cursos-ciudades').length > 0*/)
			{
				/* Estamos en listados de CURSOS */
			}
			else
			{
				/* Estamos en listado autoescuelas */
				if(jQuery(element).hasClass('curso-exclusive'))
				{
					jQuery('.zona_cursos_exclusive_municipio .products').append(jQuery(element));
				}
				else if(jQuery(element).hasClass('curso-premium'))
				{
					jQuery('.zona_cursos_premium_municipio .products').append(jQuery(element));
				}
				else if(jQuery(element).hasClass('curso-pro'))
				{
					jQuery('.zona_cursos_pro_municipio .products').append(jQuery(element));
				}
				else
				{
					jQuery('.zona_cursos_resto_municipio .products').append(jQuery(element));
				}
			}
			
		});
	}
	if(jQuery('.zona_cursos_resto .curso-pro').length > 0)
	{
		/*jQuery('.zona_cursos_pro').show();
		jQuery('.zona_cursos_resto .curso-pro').each(function(index, element) {
			jQuery('.zona_cursos_pro .products').append(jQuery(element));
		});*/
		jQuery('.zona_cursos_pro').show();
		jQuery('.zona_cursos_resto .curso-pro').each(function(index, element) {
			if(jQuery('.bkat_search_results_2019').length > 0 || jQuery('.page-template-page-template-cursos-ciudades').length > 0)
			{
				/* Estamos en listados de CURSOS */
				/*var centros_pro = new Array();
				var i=0;
				var autoescuela=jQuery(this).attr('autoescuela');
				if(!centros_pro.includes(autoescuela))
				{
					jQuery('.zona_cursos_pro .products').append(jQuery(element));
					centros_pro[i]=autoescuela;
					i++;
				}*/
			}
			else
			{
				/* Estamos en listado autoescuelas */
				jQuery('.zona_cursos_pro .products').append(jQuery(element));
			}
		});
	}
	if(jQuery('.zona_cursos_resto .curso-premium').length > 0)
	{
		/*jQuery('.zona_cursos_premium').show();
		jQuery('.zona_cursos_resto .curso-premium').each(function(index, element) {
			jQuery('.zona_cursos_premium .products').append(jQuery(element));
		});*/
		
		jQuery('.zona_cursos_premium').show();
		var centros_premium = new Array();
		var i=0;
		jQuery('.zona_cursos_resto .curso-premium').each(function(index, element) {
			if(jQuery('.bkat_search_results_2019').length > 0 || jQuery('.page-template-page-template-cursos-ciudades').length > 0)
			{
				var autoescuela=jQuery(this).attr('autoescuela');
				if(!centros_premium.includes(autoescuela))
				{
					jQuery('.zona_cursos_premium .products').append(jQuery(element));
					centros_premium[i]=autoescuela;
					i++;
				}
				else
				{
					/* Si este centro ya tiene un curso en la zona destacada de arriba, vemos si los hermanos mayores de este curso empiezan en la misma fecha y entonces lo colocamos arriba de ellos */
					var hermanosmayores=jQuery(element).prevAll('.bkat-item');
					var fechaelementoactual=jQuery(element).find('.dia').text();
					jQuery(hermanosmayores).each(function(index, hermanomayor) {
						if(!jQuery(hermanomayor).hasClass('.curso-exclusive') && !jQuery(hermanomayor).hasClass('.curso-premium'))
						{
							var fechahermanomayor=jQuery(hermanomayor).find('.dia').text();
							if(fechaelementoactual == fechahermanomayor)
							{
								jQuery(hermanomayor).before(jQuery(element));
							}
						}
					});
				}
			}
			else
			{
				/* Estamos en listado autoescuelas */
				jQuery('.zona_cursos_premium .products').append(jQuery(element));
			}
		});
	}
	if(jQuery('.zona_cursos_resto .curso-exclusive').length > 0)
	{
		jQuery('.zona_cursos_exclusive').show();
		var centros_exclusive = new Array();
		var i=0;
		jQuery('.zona_cursos_resto .curso-exclusive').each(function(index, element) {
			if(jQuery('.bkat_search_results_2019').length > 0 || jQuery('.page-template-page-template-cursos-ciudades').length > 0)
			{
				var autoescuela=jQuery(this).attr('autoescuela');
				if(!centros_exclusive.includes(autoescuela))
				{
					jQuery('.zona_cursos_exclusive .products').append(jQuery(element));
					centros_exclusive[i]=autoescuela;
					i++;
				}
				else
				{
					/* Si este centro ya tiene un curso en la zona destacada de arriba, vemos si los hermanos mayores de este curso empiezan en la misma fecha y entonces lo colocamos arriba de ellos */
					var hermanosmayores=jQuery(element).prevAll('.bkat-item');
					var fechaelementoactual=jQuery(element).find('.dia').text();
					jQuery(hermanosmayores).each(function(index, hermanomayor) {
						if(!jQuery(hermanomayor).hasClass('.curso-exclusive'))
						{
							var fechahermanomayor=jQuery(hermanomayor).find('.dia').text();
							if(fechaelementoactual == fechahermanomayor)
							{
								jQuery(hermanomayor).before(jQuery(element));
							}
						}
					});
				}
			}
			else
			{
				/* Estamos en listado autoescuelas */
				jQuery('.zona_cursos_exclusive .products').append(jQuery(element));
			}
		});
	}
	/*ordenamos cursos por nivel en los cursos del radio*/
	if(jQuery('.zona_cursos_radio_resto .curso-pro').length > 0)
	{
		jQuery('.zona_cursos_radio_pro').show();
		var centros_radio_pro = new Array();
		var i=0;
		jQuery('.zona_cursos_radio_resto .curso-pro').each(function(index, element) {
			var autoescuela=jQuery(this).attr('autoescuela');
			if(!centros_radio_pro.includes(autoescuela))
			{
				jQuery('.zona_cursos_radio_pro .products').append(jQuery(element));
				centros_radio_pro[i]=autoescuela;
				i++;
			}
		});
	}
	if(jQuery('.zona_cursos_radio_resto .curso-premium').length > 0)
	{
		jQuery('.zona_cursos_radio_premium').show();
		var centros_radio_premium = new Array();
		var i=0;
		jQuery('.zona_cursos_radio_resto .curso-premium').each(function(index, element) {
			var autoescuela=jQuery(this).attr('autoescuela');
			if(!centros_radio_premium.includes(autoescuela))
			{
				jQuery('.zona_cursos_radio_premium .products').append(jQuery(element));
				centros_radio_premium[i]=autoescuela;
				i++;
			}
		});
	}
	if(jQuery('.zona_cursos_radio_resto .curso-exclusive').length > 0)
	{
		jQuery('.zona_cursos_radio_exclusive').show();
		var centros_radio_exclusive = new Array();
		var i=0;
		jQuery('.zona_cursos_radio_resto .curso-exclusive').each(function(index, element) {
			var autoescuela=jQuery(this).attr('autoescuela');
			if(!centros_radio_exclusive.includes(autoescuela))
			{
				jQuery('.zona_cursos_radio_exclusive .products').append(jQuery(element));
				centros_radio_exclusive[i]=autoescuela;
				i++;
			}
		});
	}
}
/* Mostramos/ocultamos la fecha de caducidad del cap en el formulario de alta del club AT  */
jQuery('.form_club_at input[type=radio]').change(function(){
	jQuery('.form_club_at .wpcf7-list-item').removeClass('active');
	jQuery(this).closest('.wpcf7-list-item').addClass('active');
	if(this.value == 'Sí')
	{
		jQuery('.fecha-form').slideDown();
	}
	else
	{
		jQuery('.fecha-form').slideUp();
	}
});
/*jQuery('#wpcf7-f2336-p2263-o6 input[type=radio]').change(function(){
	jQuery('#wpcf7-f2336-p2263-o6 .wpcf7-list-item').removeClass('active');
	jQuery(this).closest('.wpcf7-list-item').addClass('active');
	if(this.value == 'Sí')
	{
		jQuery('.fecha-form').slideDown();
	}
	else
	{
		jQuery('.fecha-form').slideUp();
	}
});*/

/* Para el cupón de Sequra disponible */
jQuery(document).ajaxComplete(function( event, xhr, settings ) {
	if(jQuery('.woocommerce-checkout').length > 0)
	{
		if(jQuery('.cart-discount.coupon-sequra-disponible').length > 0)
		{
			/* Si está activo el cupón sequra-disponible eliminamos los otros métodos de pago */
			jQuery('li.wc_payment_method:not(.payment_method_sequra_pp)').remove();
		}
		else
		{
			/* Si no está activo el cupón sequra-disponible eliminamos el método de pago de sequra */
			jQuery('li.payment_method_sequra_pp').remove();
		}
	}
});

/* Para el cupón de Pagantis disponible */
jQuery(document).ready(function(e) {
	setTimeout(function() {
		if(jQuery('.woocommerce-checkout').length > 0)
		{
			if(jQuery('.cart-discount.coupon-pagantis-disponible').length > 0)
			{
				/* Si está activo el cupón sequra-disponible eliminamos los otros métodos de pago */
				jQuery('li.wc_payment_method:not(.payment_method_pagantis)').remove();
			}
			else
			{
				/* Si no está activo el cupón sequra-disponible eliminamos el método de pago de sequra */
				jQuery('li.payment_method_pagantis').remove();
			}
		}
	},1500);
});

/* Rellenamos campo URL formularios */
if(jQuery('input[name="current-url"]').length > 0)
{
	setTimeout(function() {
		jQuery('input[name="current-url"]').val(window.location.href);
		jQuery('input[name="current-url"]').attr('value',window.location.href);
	},5000);
}

/* Rellenamos campo referer URL formularios */
if(jQuery('input[name="referer-url"]').length > 0)
{
	setTimeout(function() {
		jQuery('input[name="referer-url"]').val(document.referrer);
		jQuery('input[name="referer-url"]').attr('value',document.referrer);
	},5000);
}

/* Rellenamos campo referer URL formularios */
if(jQuery('input[name="current-microsite-level"]').length > 0)
{
	setTimeout(function() {
		if(jQuery('.icono_pulgar').hasClass('autoescuela_oro'))
		{
			jQuery('input[name="current-microsite-level"]').val('Centro ORO');
			jQuery('input[name="current-microsite-level"]').attr('value','Centro ORO');
		}
		else if(jQuery('.icono_pulgar').hasClass('autoescuela_plata'))
		{
			jQuery('input[name="current-microsite-level"]').val('Centro PLATA');
			jQuery('input[name="current-microsite-level"]').attr('value','Centro PLATA');
		}
	},5000);
}

/* Rellenamos campos de datos del curso */
setTimeout(function() {
	if(jQuery('input[name="nombre-curso"]').length > 0)
	{
		jQuery('input[name="nombre-curso"]').val(jQuery('.product_title').text());
		jQuery('input[name="nombre-curso"]').attr('value',jQuery('.product_title').text());
	}
	if(jQuery('input[name="nombre-autoescuela"]').length > 0)
	{
		jQuery('input[name="nombre-autoescuela"]').val(jQuery('.texto_autoescuela .title').text());
		jQuery('input[name="nombre-autoescuela"]').attr('value',jQuery('.texto_autoescuela .title').text());
	}
	if(jQuery('input[name="fecha-inicio"]').length > 0)
	{
		jQuery('input[name="fecha-inicio"]').val(jQuery('.info_curso .fecha_inicio').text());
		jQuery('input[name="fecha-inicio"]').attr('value',jQuery('.info_curso .fecha_inicio').text());
	}
	if(jQuery('input[name="fecha-fin"]').length > 0)
	{
		jQuery('input[name="fecha-fin"]').val(jQuery('.info_curso .fecha_fin').text());
		jQuery('input[name="fecha-fin"]').attr('value',jQuery('.info_curso .fecha_fin').text());
	}
	if(jQuery('input[name="horario"]').length > 0)
	{
		jQuery('input[name="horario"]').val(jQuery('.info_curso .horario').text());
		jQuery('input[name="horario"]').attr('value',jQuery('.info_curso .horario').text());
	}
},5000);
/* Rellenamos campo ID actual */
if(jQuery('input[name="current-id"]').length > 0)
{
	setTimeout(function() {
		jQuery('input[name="current-id"]').val(jQuery('.post_id_custom').attr('post_id'));
		jQuery('input[name="current-id"]').attr('value',jQuery('.post_id_custom').attr('post_id'));
	},5000);
}
/*if(jQuery('input[name="current-id"]').length > 0)
{
	jQuery('input[name="current-id"]').val(jQuery('.info_curso .horario').text());
	jQuery('input[name="current-id"]').attr('value',jQuery('.info_curso .horario').text());
}*/
/* Rellenamos campo autoescuela actual */
if(jQuery('input[name="current-centro"]').length > 0)
{
	setTimeout(function() {
		jQuery('input[name="current-centro"]').val(jQuery('h1.titulo').text());
		jQuery('input[name="current-centro"]').attr('value',jQuery('h1.titulo').text());
	},5000);
}
/* Rellenamos campo ciudad actual */
if(jQuery('input[name="current-ciudad"]').length > 0)
{
	setTimeout(function() {
		var texto=jQuery('.title .title-ciudad').text();
		texto=texto.replace('CAP','');
		texto=texto.trim();
		jQuery('input[name="current-ciudad"]').val(texto);
		jQuery('input[name="current-ciudad"]').attr('value',texto);
	},5000);
}
if(jQuery('input[name="current-ciudad-producto"]').length > 0)
{
	setTimeout(function() {
		var texto=jQuery('.texto_autoescuela .ubicacion .provincia').text();
		jQuery('input[name="current-ciudad-producto"]').val(texto);
		jQuery('input[name="current-ciudad-producto"]').attr('value',texto);
	},5000);
}

/* Anchura dinámica de formulario interior */
if(jQuery('.inner_search_form').length > 0)
{
	var num_elementos=jQuery('.inner_search_form .elemento').length;
	var porcentaje=100/num_elementos;
	jQuery('.inner_search_form .elemento').css('width',porcentaje+'%');
}

if(jQuery('.grow-column').length > 0)
{
	jQuery('.grow-column').each(function(index, element) {
        if(jQuery(element).height() > 200)
		{
			jQuery(element).css('max-height','200px');
			jQuery(element).next('.read_more').css('display','block');
		}
    });
	jQuery('.read_more').click(function(e) {
		e.preventDefault();
		
		if(jQuery(e.target).prev('.grow-column').hasClass('active'))
		{
			jQuery(e.target).prev('.grow-column').toggleClass('active');
			jQuery(e.target).text('Leer más');
		}
		else
		{
			jQuery(e.target).prev('.grow-column').toggleClass('active');
			jQuery(e.target).text('Cerrar');
		}
    });
}

/* Nueva funcionalidad vídeos */
jQuery('.video_container img').on('click',function(e){
	var video_cod=jQuery(this).closest('.video_container').attr('video_cod');
	if(video_cod != '')
	{
		if(!jQuery(this).closest('.video_container').hasClass('full_width'))
		{
			jQuery(this).closest('.video_container').find('img').fadeTo(0.1,0);
		}
		jQuery(this).closest('.video_container').find('.the_video').css('display','block');
		jQuery(this).closest('.video_container').find('.the_video').html('<iframe width="560" height="315" src="https://www.youtube.com/embed/'+video_cod+'?autoplay=1&rel=0" frameborder="0" allow="accelerometer; autoplay; allow="autoplay" encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
	}
});

/*cambiamos posición estrellas en la home tras ajax*/
if(jQuery('.contenedor_autoescuelas_destacadas').length > 0)
{
	jQuery( document ).ajaxComplete(function( event, xhr, settings ) {
		if(settings.url.indexOf('ajax-block-home') > 0)
		{
			jQuery('.contenedor_autoescuelas_destacadas .ItemMainCourse').each(function(index, element) {
				var espacio_peq=25;
				left=0;
				jQuery(element).find('.gdrts-rating-element .gdrts-stars-empty > svg').each(function(index, element) {
					/*console.log(index);*/
					jQuery(element).css('left',left+'px');
					left=left+espacio_peq;
				});
				left=0;
				jQuery(element).find('.gdrts-rating-element .gdrts-stars-current > svg').each(function(index, element) {
					jQuery(element).css('left',left+'px');
					left=left+espacio_peq;
				});
			});
		}
	});
}
/*fin cambiamos posición estrellas en la home tras ajax*/

jQuery(document).ready( function(){
	if(jQuery('body.single-autoescuela').length > 0)
	{
		var color_microsite=jQuery('#Content').attr('microsite-color');
		var color_texto=jQuery('#Content').attr('color-texto');
		/* Las estrellas */
		
		/* Movemos svgs a su lugar para sustituir al background, que es con lo que lo hace el plugin */
		var i;
		for(i=0;i<5;i++)
		{
			jQuery('.las_estrellas svg').clone().appendTo(jQuery('.header_microsite .gdrts-stars-empty'));
			jQuery('.las_estrellas svg').clone().appendTo(jQuery('.header_microsite .gdrts-stars-current'));
			jQuery('.las_estrellas svg').clone().appendTo(jQuery('.header_microsite .gdrts-stars-active'));
		}
		jQuery('.las_estrellas svg').remove();
		/* Al terminar el voto, recargamos la página */
		jQuery( document ).ajaxComplete(function(event,xhr,settings) {
			if(settings.url.indexOf('gdrts_live_handler') != -1)
			{
				location.reload();
			}
		});
		/* Movemos los png con posición absoluta a su lugar */
		var espacio=35;
		var left=0;
		jQuery('.single-autoescuela .header_microsite .gdrts-with-image.gdrts-image-star .gdrts-stars-empty > svg').each(function(index, element) {
			jQuery(element).css('left',left+'px');
			left=left+espacio;
		});
		left=0;
		jQuery('.single-autoescuela .header_microsite .gdrts-with-image.gdrts-image-star .gdrts-stars-active > svg').each(function(index, element) {
			jQuery(element).css('left',left+'px');
			left=left+espacio;
		});
		left=0;
		jQuery('.single-autoescuela .header_microsite .gdrts-with-image.gdrts-image-star .gdrts-stars-current > svg').each(function(index, element) {
			jQuery(element).css('left',left+'px');
			left=left+espacio;
		});
		jQuery('.listado_cursos .listado_cursos_inner .curso').each(function(index, element) {
			var espacio_peq=25;
			left=0;
			jQuery(element).find('.gdrts-rating-element .gdrts-stars-empty > svg').each(function(index, element) {
				/*console.log(index);*/
				jQuery(element).css('left',left+'px');
				left=left+espacio_peq;
			});
			left=0;
			jQuery(element).find('.gdrts-rating-element .gdrts-stars-current > svg').each(function(index, element) {
				jQuery(element).css('left',left+'px');
				left=left+espacio_peq;
			});
		});
		
		/* Modificamos color de las estrellas */
		/*jQuery('.single-autoescuela .gdrts-with-image.gdrts-image-star .gdrts-stars-active > svg path').attr('fill','#'+color_microsite);
		jQuery('.single-autoescuela .gdrts-with-image.gdrts-image-star .gdrts-stars-current > svg path').attr('fill','#'+color_microsite);*/
		
		/* Fin las estrellas */
		/* Iconos microsite */
		
		/* Modificamos color iconos */
		jQuery('.cursos_genericos .icon svg path').attr('fill','#'+color_microsite);
		jQuery('.cursos_genericos .icon svg circle').attr('fill','#'+color_microsite);
		jQuery('.valoraciones .mas_valoraciones svg *').attr('fill','#'+color_microsite);
		jQuery('.contacto_cabecera svg *').attr('fill','#'+color_microsite);
		jQuery('.sin_cursos svg *').attr('fill','#'+color_microsite);
		
		jQuery('.detalles_autoescuela svg path').attr('fill','#'+color_microsite);
		jQuery('.detalles_autoescuela svg path').attr('stroke','#'+color_microsite);
		jQuery('.detalles_autoescuela svg *').attr('fill','#'+color_microsite);
		
		/* Fin iconos microsite */
		
		/* Datepickers */
		if(jQuery('.elDatePicker').length > 0)
		{
			jQuery(function(){
				jQuery(".elDatePicker").datepicker();
				jQuery(".elDatePicker").datepicker('option','dateFormat','dd/mm/yy');
			});
			jQuery(".elDatePicker").each(function() {
				var fecha=jQuery(this)[0].defaultValue;
				var year=fecha.substr(0,4);
				var month=fecha.substr(4,2);
				var day=fecha.substr(6,2);
				jQuery(this).datepicker().datepicker('setDate',new Date(year+'-'+month+'-'+day));
			});
		}
		
		/* Funcionalidad formulario microsites */
		jQuery('.microsite_form_trigger:not(.trigger_curso)').click(function(e) {
			jQuery('.input_container.curso_text_input input').val('').attr('value','');
			jQuery('.input_container.curso_text_input').hide();
			jQuery('.input_container.curso_textarea').show();
		});
		jQuery('.microsite_form_trigger.trigger_curso').click(function(e) {
			jQuery('.input_container.curso_textarea select').val('').attr('value','');
            var curso=jQuery(this).prev('.titulo').text();
			jQuery('.input_container.curso_textarea').hide();
			jQuery('.input_container.curso_text_input input').val('Curso: '+curso).attr('value','Curso: '+curso);
			jQuery('.input_container.curso_text_input').show();
        });
		if(jQuery('#Content.microsite-premium').length > 0 || jQuery('#Content.microsite-exclusive').length > 0)
		{
			jQuery('input[name="additional-email"]').val(jQuery('.mail.elemento p').text()).attr('value',jQuery('.mail.elemento p').text());
		}
		if(jQuery('.microsite-pro').length > 0 || jQuery('.microsite-premium').length > 0 || jQuery('.microsite-exclusive').length > 0)
		{
			jQuery('.mascara.tlf').click(function(e) {
				jQuery('.mascara.tlf').fadeOut();
			});
			jQuery('.mascara.mov').click(function(e) {
				jQuery('.mascara.mov').fadeOut();
			});
			jQuery('.mascara.mail').click(function(e) {
				jQuery('.mascara.mail').fadeOut();
			});
		}
		else
		{
			jQuery('.mascara').click(function(e) {
				alert('No disponible. Por favor, utilice otros botones de contacto.');
			});
		}
		jQuery(".nuevo_curso .radios input[type=radio]").click(function(){
			jQuery('.nuevo_curso .selector_tipo_curso').slideUp();
			jQuery('.nuevo_curso .selector_tipo_curso').find('select').val('');
			jQuery('.nuevo_curso .tipo_adr_texto').slideUp();
			jQuery('.nuevo_curso [name="tipo_adr_texto_curso_nuevo"]').val('');
			var radioValue = jQuery(this).val();
			
			if(radioValue=="cap-inicial")
			{
				jQuery('.nuevo_curso .tipo_cap_inicial').slideDown();
			}
			else if(radioValue=="cap-ampliacion")
			{
				jQuery('.nuevo_curso .tipo_cap_ampliacion').slideDown();
			}
			else if(radioValue.indexOf("adr") >= 0)
			{
				jQuery('.nuevo_curso .tipo_adr').slideDown();
			}
		});
		jQuery('.nuevo_curso select[name="tipo_adr_curso_nuevo"]').change(function(e) {
            if(jQuery(this).val() == 'otros')
			{
				jQuery('.nuevo_curso .tipo_adr_texto').slideDown();
			}
			else
			{
				jQuery('.nuevo_curso .tipo_adr_texto').slideUp();
				jQuery('.nuevo_curso [name="tipo_adr_texto_curso_nuevo"]').val('');
			}
        });
		
		jQuery('.cursos_actuales .curso .radios input[type=radio]').click(function(){
			jQuery(this).closest('.curso').find('.selector_tipo_curso').slideUp();
			jQuery(this).closest('.curso').find('.selector_tipo_curso').find('select').val('');
			jQuery(this).closest('.curso').find('.tipo_adr_texto').slideUp('');
			jQuery(this).closest('.curso').find('.tipo_adr_texto').find('input').val('');
			
			var radioValue = jQuery(this).val();
			
			console.log(radioValue);
			
			if(radioValue=="cap-inicial")
			{
				jQuery(this).closest('.curso').find('.tipo_cap_inicial').slideDown();
			}
			else if(radioValue=="cap-ampliacion")
			{
				jQuery(this).closest('.curso').find('.tipo_cap_ampliacion').slideDown();
			}
			else if(radioValue.indexOf("adr") >= 0)
			{
				jQuery(this).closest('.curso').find('.tipo_adr').slideDown();
			}
		});
		jQuery('.cursos_actuales .curso .tipo_adr select').change(function(e) {
            if(jQuery(this).val() == 'otros')
			{
				jQuery(this).closest('.curso').find('.tipo_adr_texto').slideDown();
			}
			else
			{
				jQuery(this).closest('.curso').find('.tipo_adr_texto').slideUp();
				jQuery(this).closest('.curso').find('.tipo_adr_texto').find('input').val('');
			}
        });
		
		jQuery(".radios input:checked").each(function(index, element)
		{
			var checked_element=jQuery(element).val();
			if(checked_element.indexOf("adr") >= 0)
			{
				jQuery(this).closest('.the_input').siblings('.tipo_adr').slideDown();
			}
        });
		
		/* Reubicamos mensaje valoracion */
		jQuery('.cabecera_contenido .mensaje_valoracion').appendTo('.message_placeholder');
		
		/* Quitamos posibilidad de votar en single sin condidiones */
		jQuery('#Content.default_template .gdrts-stars-empty').unbind('click');
		jQuery('#Content.default_template .gdrts-stars-empty').unbind('mousemove');
		jQuery('#Content.default_template .gdrts-stars-empty').unbind('mouseout');
		jQuery('#Content.default_template .gdrts-stars-empty').css('cursor','default');
	}
	if(jQuery('.bkat2019v .nota_autoescuela').length > 0 || 
		jQuery('.bkat_search_results_2019 .nota_autoescuela').length > 0 ||
		jQuery('.page-template-template-archive-autoescuela').length > 0 ||
		jQuery('.page-template-page-template-autoescuelas-ciudades').length > 0 ||
		jQuery('.page-template-page-template-cursos-ciudades').length > 0
	)
	{
		var espacio_peq=25;
		/*left=0;
		jQuery('.nota_autoescuela').find('.gdrts-rating-element .gdrts-stars-empty > svg').each(function(index, element) {
			jQuery(element).css('left',left+'px');
			left=left+espacio_peq;
		});
		left=0;
		jQuery('.nota_autoescuela').find('.gdrts-rating-element .gdrts-stars-current > svg').each(function(index, element) {
			jQuery(element).css('left',left+'px');
			left=left+espacio_peq;
		});*/
		jQuery('.nota_autoescuela').each(function(index, element) {
            left=0;
			jQuery(element).find('.gdrts-rating-element .gdrts-stars-empty > svg').each(function(index, element) {
				jQuery(element).css('left',left+'px');
				left=left+espacio_peq;
			});
			left=0;
			jQuery(element).find('.gdrts-rating-element .gdrts-stars-current > svg').each(function(index, element) {
				jQuery(element).css('left',left+'px');
				left=left+espacio_peq;
			});
        });
	}
	
	/* STICKY FORM OTROS CURSOS */
	if(jQuery('.product_archive_form').length > 0 && jQuery(window).width() >= 1239)
	{
		var distance = jQuery('.product_archive_form').offset().top,
		/*$header_offset=115,*/
		$header_offset=147,
		$window = jQuery(window);
		$window.scroll(function() {
			if($window.scrollTop()+$header_offset >= distance)
			{
				if(!jQuery('.product_archive_form').hasClass('sticky_active'))
				{
					jQuery('.product_archive_form').addClass('sticky_active');
					var elemento = jQuery('.products_wrapper.archive-product,.products_wrapper');
					var offset = elemento.offset();
					
					var left = offset.left;
					var right = left + elemento.outerWidth();
					jQuery('.product_archive_form').css('left',right);
				}
			}
			else
			{
				jQuery('.product_archive_form').removeClass('sticky_active');
				jQuery('.product_archive_form').css('left','100%');
			}
			var altura_form=jQuery('.product_archive_form').outerHeight()+50;
			if(jQuery('.product_archive_form').offset().top - jQuery('.titulo-texto-tienda').offset().top > -altura_form)
			{
				jQuery('.product_archive_form').removeClass('sticky_active');
				jQuery('.product_archive_form').css('left','100%');
			}
		});
	}
	/* STICKY FORM OTROS CURSOS */
	/* Submenú otros cursos */
	if(jQuery('.otros_cursos_subcategorias').length > 0)
	{
		jQuery('.products.grid li').each(function(index, element) {
			var indexx=index+1;
			if(indexx%2==0)
			{
				jQuery(this).next('li').addClass('clearboth');
			}
		});
	}
	if(jQuery('.otros_cursos_subcategorias.dynamic_change').length > 0)
	{
		jQuery('.otros_cursos_subcategorias li a').click(function(e) {
			e.preventDefault();
			var categoria=jQuery(this).attr('datacategory');
			var enlace=jQuery(this).attr('datalink');
			jQuery('.otros_cursos_subcategorias li a').removeClass('active');
			jQuery(this).addClass('active');
			changeSubCategory(categoria);
            setTimeout(function(){
				history.pushState(null,null, enlace);
			},401);
        });
		jQuery(window).on('popstate', function() {
			var url_actual=window.location.href;
			jQuery('.otros_cursos_subcategorias a').each(function(index, element) {
                if(jQuery(element).attr('datalink') == url_actual)
				{
					jQuery('.otros_cursos_subcategorias li a').removeClass('active');
					jQuery(element).addClass('active');
					changeSubCategory(jQuery(element).attr('datacategory'));
				}
            });
		});
		function changeSubCategory(cat_id)
		{
			jQuery('.products.grid li').fadeOut(400).removeClass('clearboth');
			if(cat_id == 'all')
			{
				jQuery('.products.grid li').delay(401).fadeIn(400);
				jQuery('.products.grid li').each(function(index, element) {
					var indexx=index+1;
					if(indexx%2==0)
					{
						jQuery(this).next().addClass('clearboth');
					}
				});
			}
			else
			{
				jQuery('.products.grid li.product_cat_'+cat_id).delay(401).fadeIn(400);
				jQuery('.products.grid li.product_cat_'+cat_id).each(function(index, element) {
					var indexx=index+1;
					jQuery(this).addClass('indexx-'+indexx);
					if(indexx%2==0)
					{
						jQuery('.products.grid li.product_cat_'+cat_id).eq(indexx).addClass('clearboth');
						/*jQuery('.indexx-'+indexx+1).addClass('clearboth');*/
					}
				});
			}
		}
	}
	/* Fin submenú otros cursos */
	/* Reubicación elementos para móvil en BKAT 2019 */
	if(jQuery('.bkat_search_results_2019').length > 0)
	{
		if(jQuery(window).width() < 1239)
		{
			jQuery('.bkat_container .zona_filtro').appendTo('.mobile_bkat_menu_container #content_element_filtrar');
			jQuery('.bkat_container .zona_resultados .sort_form').appendTo('.mobile_bkat_menu_container #content_element_ordenar');
			jQuery('.bkat_container .zona_resultados .zona_ubicacion .acf-map.listado').appendTo('.mobile_bkat_menu_container #content_element_mapa');
		}
		jQuery('.mobile_bkat_menu_container a.menu_element').click(function(e) {
			e.preventDefault();
			if(!jQuery(this).hasClass('active'))
			{
				jQuery('.mobile_bkat_menu_container a').removeClass('active');
				jQuery(this).addClass('active');
				jQuery('.mobile_bkat_menu_container .content_element').removeClass('active');
				jQuery('.mobile_bkat_menu_container #content_element_'+jQuery(this).attr('id')).addClass('active');
			}
			else
			{
				jQuery('.mobile_bkat_menu_container a').removeClass('active');
				jQuery('.mobile_bkat_menu_container .content_element').removeClass('active');
			}
		});
		if(jQuery(window).width() < 768)
		{
			jQuery('.bkat-item').each(function(index, element) {
                jQuery(element).find('.cta_button').appendTo(jQuery(element).find('.texto'));
            });
		}
	}
	/* Fin reubicación elementos para móvil en BKAT 2019 */
	
	if(jQuery('.page-template-template-archive-autoescuela').length > 0 || jQuery('.page-template-page-template-autoescuelas-ciudades').length > 0 || jQuery('.page-template-page-template-cursos-ciudades').length > 0)
	{
		jQuery('.zona_ubicacion .accordion').click(function(e) {
            jQuery('.zona_ubicacion .mapa.panel').toggleClass('active');
        });
	}
	
	/* Bloque autoescuelas destacadas home */
	if(jQuery('.contenedor_autoescuelas_destacadas').length > 0)
	{
		jQuery.post('/wp-content/themes/betheme-child/ajax-block-home.php','', function (response) {
			var respuesta=jQuery.parseJSON(response);
			var datos=respuesta.html_data;
			var html=jQuery.parseHTML(datos);
			jQuery('.contenedor_autoescuelas_destacadas .MainTitlesCAPSearch').text('Estos son los centros que recomendamos para ti');
			jQuery('.contenedor_autoescuelas_destacadas .waiting_gif').fadeOut(400,function(){
				jQuery('.contenedor_autoescuelas_destacadas').append(html).hide().fadeIn();
				jQuery('.contenedor_autoescuelas_destacadas .ItemMainCourse').each(function(index, element) {
					var espacio_peq=25;
					left=0;
					jQuery(element).find('.gdrts-rating-element .gdrts-stars-empty > svg').each(function(index, element) {
						/*console.log(index);*/
						jQuery(element).css('left',left+'px');
						left=left+espacio_peq;
					});
					left=0;
					jQuery(element).find('.gdrts-rating-element .gdrts-stars-current > svg').each(function(index, element) {
						jQuery(element).css('left',left+'px');
						left=left+espacio_peq;
					});
				});
			});
		});
	}
	/* Fin bloque autoescuelas destacadas home */
});


//************************* Scripts made by Diego  ************************//
// Remove cart button //
jQuery(document).ready( function(){
	/*jQuery('.cart').insertAfter(jQuery('.MinText'));
	jQuery('.cart').insertAfter(jQuery('.SideBarCourse'));*/
	/* No estaba añadida la especificación de que esto es solo para productos no-BKAT (:not(.bkat-product)), por lo que estaba afectando también a productos BKAT */
	/* Tampoco estaba añadida la comprobación de los tipos (si existe o no .SideBarCourse) */
	if(jQuery('.SideBarCourse').length > 0)
	{	
		jQuery('.single-product .product:not(.bkat-product) .cart').insertAfter(jQuery('.SideBarCourse'));
	}
	else
	{
		jQuery('.single-product .product:not(.bkat-product) .cart').insertAfter(jQuery('.MinText'));
	}
	jQuery('#breadcrumbs').insertAfter(jQuery('.BreadCrumbsOut'));
	
	/* Titulos steps */
	if(jQuery('.steps_container').length > 0)
	{
		console.log(jQuery('li.step:nth-of-type(1)').position().left);
		if(jQuery(window).width()>=768)
		{
			jQuery('#step_text_one').css('left',jQuery('li.step:nth-of-type(1)').position().left);
			jQuery('#step_text_two').css('left',jQuery('li.step:nth-of-type(2)').position().left);
			jQuery('#step_text_three').css('left',jQuery('li.step:nth-of-type(3)').position().left);
		}
		else
		{
			jQuery('#step_text_one').css('left',jQuery('li.step:nth-of-type(1)').position().left-15);
			jQuery('#step_text_two').css('left',jQuery('li.step:nth-of-type(2)').position().left-15);
			jQuery('#step_text_three').css('left',jQuery('li.step:nth-of-type(3)').position().left-15);
		}
	}
	/* Fin titulos steps */
	
});

// Remove elements in product page mobile //
jQuery(document).ready(function () {
		var viewportWidth = jQuery(window).width();
		if (viewportWidth < 960) {
			jQuery(".Kartt").appendTo(".AddtocartDest");
			// jQuery('.Kartt').insertAfter(jQuery('.TimeTable'));
		}
});

// Show and hide RGPD in contact form (contact-form-test) //

	jQuery(document).ready(function(){
		jQuery(".ShowRgpd").click(function(){
			jQuery('.Target').show("swing");
		 });
		jQuery(".HideRGPD").click(function(){
			jQuery('.Target').hide("linear");
		});
	});



	jQuery(document).ready(function(e) {
		jQuery(".FaqS .ChildFaqS").hide();

		jQuery(".FaqS .TogglE").click(function(){
			jQuery(this).next().slideToggle()
			.siblings(".ChildFaqS:visible").slideUp();
		});
	});
//************************* END Scripts made by Diego  ************************//

jQuery(document).ready(function () {
	/* Leer RGPD completa */
	if(jQuery('.leer-proteccion-completa').length > 0)
	jQuery('.leer-proteccion-completa').click(function(e) {
		e.preventDefault();
		jQuery('.proteccion-datos2').toggleClass('active');
	});
});

/* Cambios CRO */
if (jQuery(window).width() < 750)
{
	/* CAMBIOS SOLO EN MOVIL */
	jQuery('.wpcf7-submit.boton-ciudad').css('cssText','background:#353535 !important');
	var t=setInterval(removeZopim,500);
	function removeZopim()
	{
		if(jQuery('div.zopim').length > 0)
		{
			jQuery('div.zopim').remove();
			clearInterval(t);
		}
	}
}

/* Llamada al chat de zopim */
jQuery(window).load(function() {
	if (jQuery(window).width() >= 750)
	{
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="https://v2.zopim.com/?57z0ZKc4O8MbRUSkCKlBOxdmdwbx9aoM";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	}
});
/* Fin cambios CRO */

/* Cambios en Cursos obtención ADR */
if(jQuery('body.page-id-8666').length > 0)
{
	var titulo_primer_bloque=jQuery('.titulo-cursos-pedagogicas.primer_bloque').html();
	jQuery('.titulo-cursos-pedagogicas.primer_bloque').remove();
	jQuery('.bloque-cursos-pedagogicas.primer_bloque ul.products').first().prepend('<li class="titulo_bloque isotope-item product type-product status-publish has-post-thumbnail product_cat-presenciales product_cat-transporte product_tag-permisos product_tag-todos product_tag-transporte first instock taxable shipping-taxable product-type-simple">'+titulo_primer_bloque+'</li>');
	
	var titulo_segundo_bloque=jQuery('.titulo-cursos-pedagogicas.segundo_bloque').html();
	jQuery('.titulo-cursos-pedagogicas.segundo_bloque').remove();
	jQuery('.bloque-cursos-pedagogicas.segundo_bloque ul.products').first().prepend('<li class="titulo_bloque isotope-item product type-product status-publish has-post-thumbnail product_cat-presenciales product_cat-transporte product_tag-permisos product_tag-todos product_tag-transporte first instock taxable shipping-taxable product-type-simple">'+titulo_segundo_bloque+'</li>');
}
/* Fin cambios en Cursos obtención ADR */

/* Cambios en Cursos renovación ADR */
if(jQuery('body.page-id-8663').length > 0)
{
	var titulo_primer_bloque=jQuery('.titulo-cursos-pedagogicas.primer_bloque').html();
	jQuery('.titulo-cursos-pedagogicas.primer_bloque').remove();
	jQuery('.bloque-cursos-pedagogicas.primer_bloque ul.products').first().prepend('<li class="titulo_bloque isotope-item product type-product status-publish has-post-thumbnail product_cat-presenciales product_cat-transporte product_tag-permisos product_tag-todos product_tag-transporte first instock taxable shipping-taxable product-type-simple">'+titulo_primer_bloque+'</li>');
	
	var titulo_segundo_bloque=jQuery('.titulo-cursos-pedagogicas.segundo_bloque').html();
	jQuery('.titulo-cursos-pedagogicas.segundo_bloque').remove();
	jQuery('.bloque-cursos-pedagogicas.segundo_bloque ul.products').first().prepend('<li class="titulo_bloque isotope-item product type-product status-publish has-post-thumbnail product_cat-presenciales product_cat-transporte product_tag-permisos product_tag-todos product_tag-transporte first instock taxable shipping-taxable product-type-simple">'+titulo_segundo_bloque+'</li>');
}
/* Fin cambios en Cursos renovación ADR */
/* Para enviar el formulario de votaciones por ajax */
if(jQuery('.form_votaciones').length > 0)
{
	jQuery('.form_votaciones .send_button').click(function(e) {
		e.preventDefault();
		var usuario=jQuery('.form_votaciones input[name="current_user"]').val();
		var centro=jQuery('.form_votaciones input[name="current_center"]').val();
		var puntuacion=jQuery('.form_votaciones input[name="puntuacion"]:checked').val();
		var comentario=jQuery('.form_votaciones textarea[name="comentario"]').val();
		var fecha=jQuery('.form_votaciones input[name="current_date"]').val();
		
		jQuery('.result_message').css('display','block');
		
        jQuery.post('/wp-content/themes/betheme-child/registrar-votacion.php',{usuario:usuario,centro:centro,puntuacion:puntuacion,comentario:comentario,fecha:fecha}, function (response) {
			var respuesta=jQuery.parseJSON(response);
			jQuery('.result_message .spinner').remove();
			jQuery('.result_message').text(respuesta.message);
			setTimeout(function(){ location.reload(); }, 1000);
			/*console.log(respuesta);*/
		});
    });
	
	jQuery('.valoracion .me_gusta').click(function(e) {
		e.preventDefault();
		var usuario=jQuery(this).attr('id_usuario');
		var bloque_valoracion=jQuery(this).closest('.valoracion');
		var id_valoracion=jQuery(this).closest('.valoracion').attr('id_valoracion');
		
		jQuery.post('/wp-content/themes/betheme-child/registrar-votacion.php',{usuario:usuario,id_valoracion:id_valoracion}, function (response) {
			var respuesta=jQuery.parseJSON(response);
			console.log(jQuery(this));
			bloque_valoracion.find('a.me_gusta').replaceWith('<span href="#" class="me_gusta_disabled voted">'+respuesta.num_likes+'</span>');
			/*console.log(respuesta);*/
		});
	});
	
	/* Para mostrar valoración seleccionada y abrir el botón de enviar al seleccionar una valoración */
	jQuery('input[name=puntuacion]').change(function() {
		jQuery('.form_votaciones .send_button').removeAttr('disabled');
		
		var valor=jQuery(this).val();
		jQuery('.valoracion_seleccionada').css('opacity','1');
		jQuery('.valoracion_seleccionada .numero').text(valor);		
		switch(valor)
		{
			case '1':
				jQuery('.valoracion_seleccionada .texto').text('Mal');
				break;
			case '2':
				jQuery('.valoracion_seleccionada .texto').text('Regular');
				break;
			case '3':
				jQuery('.valoracion_seleccionada .texto').text('Bien');
				break;
			case '4':
				jQuery('.valoracion_seleccionada .texto').text('Sobresaliente');
				break;
			case '5':
				jQuery('.valoracion_seleccionada .texto').text('Excelente');
				break;
		}
	});
}
/* Fin para enviar el formulario de votaciones por ajax */


jQuery(document).ready(function () {
	if(jQuery('body.page-id-33609').length > 0)
	{
		/* Cambios CRO 23-9-2020 */
		jQuery('.wpcf7-form').each(function(index, element) {
			jQuery(element).find('.email').after(jQuery(element).find('.ciudad'));
        });
		/* Fin cambios CRO 23-9-2020 */
		/* Cambios CRO 21-10-2020 */
		jQuery('.wpcf7-submit').attr('value','Quiero más información');
		/* Fin cambios CRO 21-10-2020 */
	}
});

/* Slick slider */
jQuery(document).ready(function(){
	if(jQuery('.the_slider').length > 0)
	{
		jQuery('.the_slider').slick({
			slidesToShow: 5,
			slidesToScroll: 5,
			responsive: [
				{
				  breakpoint: 768,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				  }
				}
			]
		});
	}
});