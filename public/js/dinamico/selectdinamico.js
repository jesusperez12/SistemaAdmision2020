$(function()
{
	$('#sede').on('change', onSelectAdmision);
});

function onSelectAdmision() {
	var sede_id = $(this).val();
	

	//ajax

	$.get('/api/Admision/1/niveles',function(data){
		var html_select = '<option value="">Selecione nivel</option>'; 
		for(var i=0; i<data.length; ++i)
			html_select +='<option value="'+data[i].id+'">'+data[i].name+'</option>'
		$('#subprograma').html(html_select);
	});
}