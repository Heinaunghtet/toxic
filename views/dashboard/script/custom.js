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
			$('.sleepy').append('<div>'+data[i].text+'<a class="del" no="'+data[i].post_id+'"href="#">[Delete]</a><a class="edit" no="'+data[i].post_id+'"href="#">[Edit]</a></div>');
			
		}
		
		
		
		
	},'json');

	$('#xhrinsert').submit(function(event) {
		event.preventDefault();
		let url =$(this).attr('action');
		let data=$(this).serialize();
	
		$.post(url,data, function(response) {

			//console.log(response.text);
			
			$('.sleepy').append('<div>'+response.text+'<a class="del" no="'+response.id+'"href="#">[delete]</a><a class="edit" no="'+response.id+'"href="#">[Edit]</a></div>');
			$('#xhrinsert')[0].reset();
			

			
		},'json');

	});


	$(document).on('click','.del',function(event) {
		event.preventDefault();
		let id=$(this).attr('no');
		let url='dashboard/xhrDelete';
		let data={'id':id};
		let child=$(this);

		$.post(url,data, function(response) {

			child.parent().remove();
			console.log(response);

			
		});
		
	});

	$(document).on('click','.edit',function(event) {

		
		event.preventDefault();
		let id=$(this).attr('no');
		let url='dashboard/xhrUpdate';
		let data={'id':id};
		let child=$(this);
		let text =child.parent().clone() //clone the element
           .children() //select all the children
           .remove() //remove all the children
           .end()  //again go back to selected element
           .text();  //get the text of element
    
        let updatedata= window.prompt("Edit Data", text);
        if(updatedata){
        	$.post(url,{id,updatedata}, function(response) {

			     console.log(response);
			     if(response==1){
       				child.parent().contents().filter(function(){ 
         			return this.nodeType == 3; 
      				})[0].nodeValue = updatedata;

      			}else{
       				alert('error');
     			}


			
		    });

        }

		
		
		
	});


});