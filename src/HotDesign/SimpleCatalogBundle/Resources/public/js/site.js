$('a').tooltip();
 
 
$("a[rel^='prettyPhoto']").prettyPhoto();
				
$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed:'normal',
    theme:'light_square',
    slideshow:3000, 
    autoplay_slideshow: true
});
$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed:'fast',
    slideshow:10000, 
    hideflash: true
});