$(function(){

	$('#proyectos').mixItUp(
		callbacks: {
		onMixLoad: function(){
      		var hash = window.location.hash;
      		var noHash=hash.replace("#","");
 
	      if(hash){
    	      $('#proyectos').mixitup('filter', noHash);
      		}
    	}

		
}

);
});