$(document).ready(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 500){
            $('#scrollback').fadeIn();
        }else{
            $('#scrollback').fadeOut();
        }
    })
    $('#scrollback').click(function(){
        $('html,body').animate({ scrollTop: 0},600);
    });
});

