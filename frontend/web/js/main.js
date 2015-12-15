$(document).ready(function() {
    $('.calendar-button').click(function() {
        $(this).closest('.input-group').find('input').trigger('focus');
    });

    $('.image-gallery').each(function() {
        $(this).magnificPopup({
            delegate: '.image-gallery-item',
            type:'image',
            gallery:{
                enabled:true
            }
        });
    });
});
