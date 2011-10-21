// JavaScript Document
$(document).ready(function() {
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    
	for(i=0;i<$('#menu_contenu').children().length;i++)
	{	
		$('#menu_contenu_'+i).append('<a href="#" id="_'+i+'" class="remove_tag" >Delete</a>');
		$('#menu_contenu_'+i).addClass('blockembed');
	}
	
	
	
	
	function add() {
		var collectionHolder = $('#menu_contenu');
		index = collectionHolder.children().length;
		var prototype = collectionHolder.attr('data-prototype');
		form = prototype.replace(/\$\$name\$\$/g, index);
		collectionHolder.append(form);
		$('#menu_contenu_'+index).append('<a href="#" id="_'+index+'" class="remove_tag" >Delete</a>');
		$('#menu_contenu_'+index).addClass('blockembed');
		//CKEDITOR.replace( 'menu_contenu_'+index+'_text',{width:'600px',height:'200px'});
		
		
	}

	$('#add_tag').live('click', function(event){
		event.preventDefault();
		add();
	});
	
	$('.remove_tag').live('click', function(event){
		event.preventDefault();
		/*
		if (CKEDITOR.instances['menu_contenu'+this.id+'_text']) {
			CKEDITOR.instances['menu_contenu'+this.id+'_text'].destroy();
		}
		*/
		$('#menu_contenu'+this.id).parent().remove();
	});

});