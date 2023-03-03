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

    $('body').on('click', '#regenerat-password', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('href'),
            type: "POST",
            success: function(response) {
                $('body').find('#show-generated-password').val(response.password);
            }
        })
    });

    $("body").on('click', '[data-copy-target]', function(e) {
        e.preventDefault();
        let target = $("body").find($(this).data('copy-target'));
        let modal = $(this).closest('.modal');

        if (target.length == 0 || target.val().length == 0) {
            toast("No text to copy!", null, 'error');
            return true;
        }
        
        target.select();
        document.execCommand('copy');
        modal.modal('hide').find('.card-content').empty();
        toast("Copied", null, 'success');
    });
});
