
$(function() {

    $('#push-email').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).attr('href'),
            success: function (response) {
                // toast(response.message, null, 'success');
            }
        });
    });
});
