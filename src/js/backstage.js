$(document).ready(function () {

    $('.btn-filter').on('click', function () {
    var $target = $(this).data('target');
    if ($target != 'all') {
        $('.table-choose tbody tr').css('display', 'none');
        $('.table-choose tbody tr[data-status="' + $target + '"]').fadeIn('slow');
    } else {
        $('.table-choose tbody tr').css('display', 'none').fadeIn('slow');
    }
    });

});

