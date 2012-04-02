$('a').tooltip();
	
// Modal Box
$("a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed:'fast',
    theme:'light_rounded',
    slideshow: false, 
    autoplay_slideshow: false,
    social_tools: ' ' 
});

$(function() {
    $('a.showPopup').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        var horizontalPadding = 15;
        var verticalPadding = 15;
        $('<iframe id="site" src="' + this.href + '" />').dialog({
            title: ($this.attr('title')) ? $this.attr('title') : 'SimpleCatalog',
            autoOpen: true,
            width: 800,
            height: 400,
            modal: true,
            resizable: true,
            autoResize: true,
            close: function(event, ui) {
                location.reload();
            },
            overlay: {
                opacity: 1,
                background: "black"
            }
        }).width(800 - horizontalPadding).height(400 - verticalPadding);
    });    
}); 