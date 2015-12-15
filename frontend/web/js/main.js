$(document).ready(function() {
    $('.calendar-button').click(function() {
        $(this).closest('.input-group').find('input').trigger('focus');
    });
});
