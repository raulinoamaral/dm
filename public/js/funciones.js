$(function(){

<<<<<<< HEAD
	$('#proyectos').mixItUp(
		callbacks: {
		onMixLoad: function(){
      		var hash = window.location.hash;
      		var noHash=hash.replace("#","");
 
	      if(hash){
    	      $('#proyectos').mixitup('filter', noHash);
      		}
    	}
=======
	
	var filterOnLoad = window.location.hash ? '.'+(window.location.hash).replace('#','') : 'all';


	$('#proyectos').mixItUp({
		load: {
			filter: filterOnLoad
		}
	});
>>>>>>> FETCH_HEAD

		
}

);
});