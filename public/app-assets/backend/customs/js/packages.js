$(document).ready(function () {
    $('.repeater-slices').repeater({
        show: function () {
            $(this).slideDown();
        },
        hide: function (remove) {
            let ele    = $(this),
                delBtn = ele.find('span[data-repeater-delete]');
            if ($('div[data-repeater-item]').length > 1) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (ele.find('input[type="hidden"]').val() == '') {
                            Swal.fire({
                                'title': 'Removing',
                                'text': 'The Slice has been deleted!',
                                'icon': 'success'
                            });
                            ele.slideUp(remove);
                            return true;
                        } else {
                            $.ajax({
                                url: delBtn.data('href'),
                                type: "post",
                                success: function (data, textStatus, jqXHR) {
                                    ele.slideUp(remove);
                                    Swal.fire({
                                        'title': 'Removing',
                                        'text': data.message,
                                        'icon': 'success'
                                    });
                                },
                                error: function (jqXHR) {
                                    if (jqXHR.readyState == 0)
                                        return false;
                                    Swal.fire({
                                        'title': 'File: ' + jqXHR.responseJSON.file + ' (Line: ' + jqXHR.responseJSON.line + ')',
                                        'text': jqXHR.responseJSON.message,
                                        'icon': 'error'
                                    });
                                },
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    'title': 'Warning',
                    'text': 'Must have more than 1 slice!',
                    'icon': 'warning',
                });
            }


        }
    });

    $('.summernote').summernote();

    if ($('input[name=discount]').val() >= 1) {
        $('input[type=date]').closest('.col-md-4').slideDown(300);
        $('input[name=discount]').closest('.col-md-12').removeClass('col-md-12').addClass('col-md-4');
    } else {
        $('input[type=date]').closest('.col-md-4').slideUp(300);
        $('input[name=discount]').closest('.col-md-4').removeClass('col-md-4').addClass('col-md-12');
    }

    $('input[name=discount]').change(function () {
        if ($(this).val() >= 1) {
            $('input[type=date]').closest('.col-md-4').slideDown(300);
            $(this).closest('.col-md-12').removeClass('col-md-12').addClass('col-md-4');
        } else {
            $('input[type=date]').closest('.col-md-4').slideUp(300);
            $(this).closest('.col-md-4').removeClass('col-md-4').addClass('col-md-12');
        }
    });
});
