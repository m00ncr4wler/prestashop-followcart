$(document).ready(function() {
    $('#buy_block').affix({
        offset: {
            top: function () {
                return $('#image-block').offset().top - 38;
            },
            bottom: function () {
                return $('.footer-container').outerHeight(true) + 38
            }
        },
        target: $('#center_column')
    });
});