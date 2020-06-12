$(function() {
	
	$('#userdata').submit(function(event) {
		event.preventDefault();
		let url =$(this).attr('action');
		let data=$(this).serialize();
		alert(url);
		alert(data);
		$.post(url, data, function(response) {
			alert(response);
			$('#result').text(response);
		});
	});

	$.get('dashboard/xhrGet', function(response) {
		
		let data=response;
		for(let i=0;i < data.length;i++){
			$('.sleepy').append('<div>'+data[i].text+'<a class="del" no="'+data[i].post_id+'"href="#">delete</a><a class="edit" no="'+data[i].post_id+'"  href="#">edit</a></div>');
			
		}
		
		
		
		
	},'json');

	$('#xhrinsert').submit(function(event) {
		event.preventDefault();
		let url =$(this).attr('action');
		let data=$(this).serialize();
	
		$.post(url,data, function(response) {

			//console.log(response.text);
			
			$('.sleepy').append('<div>'+response.text+'<a class="del" no="'+response.id+'"href="#">delete</a><a class="edit" no="'+response.id+'"  href="#">edit</a></div>');
			$('#xhrinsert')[0].reset();
			

			
		},'json');

	});


	$(document).on('click','.del',function(event) {
		
		let id=$(this).attr('no');
		let url='dashboard/xhrDelete';
		let data={'id':id};
		let child=$(this);

		$.post(url,data, function(response) {

			child.parent().remove();

			
		});
		
	});

	$(document).on('click','.edit',function(event) {
		
		let id=$(this).attr('no');
		alert(id);
		
	});


});

	
	
	
	

	
