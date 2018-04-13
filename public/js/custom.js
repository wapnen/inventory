$(document).ready(function(){

	//get all the lgas for the selected state

	$("#state").change(function(){
		
		var state = $(this).val();
		 $.ajax({
		 	'url' : '/lgas/'+ state,
		 	'type' : 'get',
		 	'dataType' : 'json',
		 	success : function(data){
		 		console.log(data);
		 		$('#city').empty();
		 		var state = document.getElementById('city');
		 		for( var key in data){
		 			var option = document.createElement('option');
		 			option.text = data[key].name;
		 			option.value = data[key].name;
		 			state.appendChild(option);
		 		}
		 	}
		 });
	});
 
});