
$(function() {
    window.Echo.channel('email').listen('NewEmail', (email) => {
                    console.log(email);
                });

    $('#push-email').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).attr('href'),
            success: function (response) {
                toast(response.message, null, 'success');
            }
        });
    });
});
