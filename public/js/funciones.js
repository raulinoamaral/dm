$(function(){

	
	var filterOnLoad = window.location.hash ? '.'+(window.location.hash).replace('#','') : 'all';


	$('#proyectos').mixItUp({
		load: {
			filter: filterOnLoad
		}
	});

});