$(function() {  
	$('.navigatie a.pop').live('click', function(event) {
			event.preventDefault();
			jQuery.fx.off = true;
			
			$.each($('.navigatie a.pop'), function(index, value) { 
			var allthings = String(value.href).substr(String(value.href).indexOf('#'));
															$(allthings).toggle(false);
			});
	
		
			
			var targetSelector = String(this.href).substr(String(this.href).indexOf('#'));
			$(targetSelector).toggle(true);
			
			var currentClass = $(this).hasClass('active') ? 'active' : '';
			$('.navigatie a.pop').removeClass('active');
			$(this).addClass(currentClass);
			$(this).toggleClass('active');
	
			if(!$(this).hasClass('active'))
				$(targetSelector).toggle(false);
	
	  });
	
	// Ipad orientatie
	function ipadOrientation()
	{
		if($("#container").width()==1024)
		{
			return "landscape";
		}
		else
		{
			return "portrait";
		}
	}
	
	$(document).bind('touchmove',function(e){                   
		e.preventDefault();                 
	});  
	
	menu_active = 0;
	
	$(document).addSwipeEvents(function(evt, touch) {
		
		// start Y van event
		var tstarty = touch.startY;
		var tendy = touch.currentY;
		
		// menu
		if(touch.eventType=="doubletap")
		{
			openMenu();
		}
	});	
	
	function openMenu()
	{
		if(menu_active == 0)
		{
			$("#menu").stop().toggle( "blind", { direction: "vertical" }, 200,function(){menu_active = 0;})
			menu_active = 1;
		}
	}
});

request_pending = 0;

/* AJAX NAV */  
function init_ajax_links()
{
	$("a:not(.pop)").each(function()
	{		
		$(this).bind('click',function()
		{
			init_ajax_load($(this).attr("href"));
			return false;
		});
	});
}

function init_ajax_load(url)
{
	$('#container_right').load(url,function()
	{
		if(request_pending==0)
		{
			request_pending = 1;
			
			leftval = "-" + $(window).width();
			
			$("#container").animate({left: + leftval},600);
			$("#container_right").animate({left:"0"},600,function()
			{
				$("#container").empty();
				$("#container_right").attr("id", "container");
				$("#container").attr("id", "container_right");
				$('#container').after($('#container_right'));
				$("#container_right").attr('style','');
				
				init_ajax_links()
				setTimeout("init_iscroll()",2000);
				
				request_pending = 0;
			});
		}
	});
}

function init_iscroll()
{
	$('.iscroll').each(function ()
	{
		thisid = $(this).attr('id');
		var scroller = new iScroll(thisid);
		$(this).data('scroller', scroller);
	});
}

$(window).load(function() 
{
	init_iscroll();
	init_ajax_links();
});
