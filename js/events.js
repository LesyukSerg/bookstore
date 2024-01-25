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

function likeItem(btn, url) {
    btn.attr('disabled', 'disabled');
    btn.html(btn.html() + '...');
    let urlAction = window.location.origin + url;

    $.ajax({
        type: 'GET',
        url: urlAction,
        dataType: "JSON",
        success: function (data, textStatus, xhr) {
            console.log('success');
            console.log(xhr.status);
            if (btn.hasClass('btn-secondary')) {
                btn.addClass('btn-success').removeClass('btn-secondary')
                btn.html('Liked');
            } else {
                btn.addClass('btn-secondary').removeClass('btn-success')
                btn.html('Unliked');
            }
            btn.removeAttr('disabled');
        },
        error: function (data, textStatus, xhr) {
            console.log('error');
            console.log(xhr.status);
            btn.html("can't Like");
        }
    });
}

$(document).ready(function () {
    $('.selectpicker').selectpicker();

    $('.del-book').on('click', function () {
        if (window.confirm("Are you sure?")) {
            if ($(this).data('id')) {
                let path = '/api/del-book.php?id=';
                dellItem($(this), path + $(this).data('id'));
            }
        }
    });

    $('.like-book').on('click', function () {
        if ($(this).data('id')) {
            let path = '/api/like-book.php?id=';
            likeItem($(this), path + $(this).data('id'));
        }
    });
});