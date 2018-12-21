$( "#color-panel .panel-button" ).click(function(){
    $( "#color-panel" ).toggleClass( "close-color-panel", "open-color-panel", 1000 );
    $( "#color-panel" ).toggleClass( "open-color-panel", "close-color-panel", 1000 );
    return false;
});
// Color Skins
$('#snow').click(function(){
    var title = jQuery(this).attr('title');
    jQuery('#changeable-colors').attr('href', '/assets/css/' + title + '.css');
    jQuery("#changeable-theme").attr("src", "/assets/js/" + title + ".js");
    return false;
});

$('#summer').click(function(){
    var title = jQuery(this).attr('title');
    jQuery('#changeable-colors').attr('href', '/assets/css/' + title + '.css');
    jQuery("#changeable-theme").attr("src", "/assets/js/" + title + ".js");
    return false;
});

$('#default').click(function(){
    var title = jQuery(this).attr('title');
    jQuery('#changeable-colors').attr('href', '/assets/css/' + title + '.css');
    jQuery("#changeable-theme").attr("src", "/assets/js/" + title + ".js");
    return false;
});

$('#earthe').click(function(){
    var title = jQuery(this).attr('title');
    jQuery('#changeable-colors').attr('href', '/assets/css/' + title + '.css');
    jQuery("#changeable-theme").attr("src", "/assets/js/" + title + ".js");
    return false;
});

// jQuery(".noel-bg").on('click',function(){
//     jQuery("#changeable-theme").attr("src", "js/snow.js");
//     return false;
// });
//
// jQuery(".eather-bg").on('click',function(){
//     jQuery("#changeable-theme").attr("src", "js/eather.js");
//     return false;
// });
//
// jQuery(".summer-bg").on('click',function(){
//     jQuery("#changeable-theme").attr("src", "js/summer.js");
//     return false;
// });
//
// jQuery(".default-bg").on('click',function(){
//     jQuery("#changeable-theme").attr("src", "js/default.js");
//     return false;
// });