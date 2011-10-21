// JavaScript Document
$(document).ready(function(){
	$(".item").prepend("<span class='spantopnav'></span>"); //Throws an empty span tag right before the a tag
	$(".lisubnav").each(function() { //For each list item...
		var linkText = $(this).find("a").html(); //Find the text inside of the a tag
		$(this).find(".spantopnav").show().html(linkText); //Add the text in the span tag
	}); 
	
	$(".lisubnav").hover(function() {	//On hover...
		$(this).find(".spantopnav").stop().animate({ 
			marginTop: "-40" //Find the span tag and move it up 40 pixels
		}, 250);
		el = $(this).find(".subnav");
		el2 = el.parent();
		po = el2.position();
		h = po.top+ 40;
		el.css({'top': h +'px','left' : po.left});
		
		
		el.show(); //Show the subnav
		
	} , function() { //On hover out...
		$(this).find(".subnav").hide(); //Hide the subnav

		$(this).find(".spantopnav").stop().animate({
			marginTop: "0" //Move the span back to its original state (0px)
		}, 250);
	});
	
});