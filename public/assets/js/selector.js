$( "#color-panel .panel-button" ).click(function(){
    $( "#color-panel" ).toggleClass( "close-color-panel", "open-color-panel", 1000 );
    $( "#color-panel" ).toggleClass( "open-color-panel", "close-color-panel", 1000 );
    return false;
});
// Color Skins
$('.switcher').click(function(){
    var title = jQuery(this).attr('title');
    jQuery('#changeable-colors').attr('href', 'css/colors/' + title + '.css');
    return false;
});

jQuery(".noel-orange-bg").on('click',function(){
    jQuery(".logo-header img").attr("src", "images/logo.png");
    jQuery(".footer-logo .text-center img").attr("src", "images/logo.png");
    return false;
});

jQuery(".eather-blue-bg").on('click',function(){
    jQuery(".logo-header img").attr("src", "images/logo2.png");
    jQuery(".footer-logo .text-center img").attr("src", "images/logo2.png");
    return false;
});

jQuery(".summer-green-bg").on('click',function(){
    jQuery(".logo-header img").attr("src", "images/logo3.png");
    jQuery(".footer-logo .text-center img").attr("src", "images/logo3.png");
    return false;
});

jQuery(".default-yellow-bg").on('click',function(){
    jQuery(".logo-header img").attr("src", "images/logo4.png");
    jQuery(".footer-logo .text-center img").attr("src", "images/logo4.png");
    return false;
});