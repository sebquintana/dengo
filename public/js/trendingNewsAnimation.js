$(document).ready(function(){
    $('.newsContainer').mouseenter(function(){
        $(this).fadeTo('fast', 0.7);
    });
    $('.newsContainer').mouseleave(function(){
        $(this).fadeTo('fast', 1);
    })
});