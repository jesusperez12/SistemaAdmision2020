$("#static").change(event => {
	$.get("towns/"+event.target.value+"", function(response, static){
		
		for(i=0; i<response.length; i++){
			$("#towns").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
		}
		/*$("#town").empty();
		res.forEach(element => {
			$("#town").append(`<option value=${element.id}> ${element.name} </option>`);
		});*/
	});
});