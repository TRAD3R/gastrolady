'use strict';

$('#thumbs').delegate('img','click', function(){
    $('#largeImage').attr('src',$(this).attr('src'));
});