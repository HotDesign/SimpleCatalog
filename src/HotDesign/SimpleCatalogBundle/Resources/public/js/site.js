$('a').tooltip();
	
// Lighbox        
$("a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed:'fast',
    theme:'light_rounded',
    slideshow: false, 
    autoplay_slideshow: false,
    social_tools: ' ' 
});

$(".scactions a[rel^='prettyPhoto'], .scright a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed:'fast',
    theme:'light_rounded',
    slideshow: false, 
    autoplay_slideshow: false,
    modal: true,
    social_tools: ' ',    
    callback: function(){
          location.reload();
    }
});
	