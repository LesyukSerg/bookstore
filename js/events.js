function dellItem(btn, url) {
    btn.attr('disabled', 'disabled');
    btn.html('Deleting...');
    let row = btn.parent().parent();
    let urlAction = window.location.origin + url;

    $.ajax({
        type: 'DELETE',
        url: urlAction,
        dataType: "JSON",
        success: function (data, textStatus, xhr) {
            console.log('success');
            console.log(xhr.status);
            row.hide();
            row.remove();
        },
        error: function (data, textStatus, xhr) {
            console.log('error');
            console.log(xhr.status);
            btn.html("can't Delete");
        }
    });
}

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('.del-book').on('click', function () {
        if (window.confirm("Are you sure?")) {
            if ($(this).data('id')) {
                let path = '/api/del-book.php?id=';
                dellItem($(this), path + $(this).data('id'));
            }
        }
    });
});