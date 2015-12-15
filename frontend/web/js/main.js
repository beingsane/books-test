$(document).ready(function() {

    $('.calendar-button').click(function() {
        $(this).closest('.input-group').find('input').trigger('focus');
    });

    function initMagnificPopup(container)
    {
        $('.image-gallery', container).each(function() {
            $(this).magnificPopup({
                delegate: '.image-gallery-item',
                type:'image',
                gallery:{
                    enabled:true
                }
            });
        });
    }

    initMagnificPopup($('body'));


    $('.btn-view-book').click(function() {
        var url = $(this).data('url');
        var modalDialog = $('#book-view-dialog');
        modalDialog.modal('show');

        var container = modalDialog.find('.modal-body');
        container.load(url, function(data) {
            initMagnificPopup(container);
        });
    });

});
