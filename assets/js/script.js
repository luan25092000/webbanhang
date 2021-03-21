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
    $('#country').change(function(e){
        $countryId = $(this).val();
        $.post("../../ajax/District.php",{"countryId":$countryId},function(data){
            $('#district').html(data);
        });
    });
    $('#district').change(function(e){
        $districtId = $(this).val();
        $.post("../../ajax/Commune.php",{"districtId":$districtId},function(data){
            $('#commune').html(data);
        });
    });
});
