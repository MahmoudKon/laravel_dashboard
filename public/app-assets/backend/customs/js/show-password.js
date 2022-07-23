$(function() {
    $('.show-password').css('cursor', 'pointer');
    $('.show-password').click(function () {
        let input = $(this).closest('.form-group').find('input');
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
            $(this).attr('data-original-title', 'Hidden Password').empty().append('<i class="fas fa-eye"></i>');
        } else {
            input.attr('type', 'password');
            $(this).attr('data-original-title', 'Show Password').empty().append('<i class="fas fa-eye-slash"></i>');
        }
    });
});
