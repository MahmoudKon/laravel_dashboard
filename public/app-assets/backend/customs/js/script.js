$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    }); // TO SEND THE CSRF TOKEN WITH AJAX REQUEST

    $(document).ajaxError(function(data, textStatus, jqXHR) {
        if (typeof textStatus.responseJSON !== 'undefined' && textStatus.responseJSON.message == 'Unauthenticated.') { location.reload(true); }
    }); // WHEN MAKE REQUEST AND THE RESPONSE IS ERROR THEN MAKE REFRESH THE PAGE

    // $(document).ajaxComplete(function() { $('.load').removeClass('load'); }); // WHEN THE REQUEST IS COMPLETED WILL BE REMOVE THE CLASS LOAD

    document.addEventListener('wheel', (e) => (e.ctrlKey || e.metaKey) && e.preventDefault(), { passive: false });

    $('body').on('contextmenu', 'img', function (e) { e.preventDefault(); });

    $('.page-reload').click(function (e) {
        e.preventDefault();
        $('body').addClass('load');
        location.reload();
    });

    $('a[data-action="reload"]').click(function () {rows();});

    // THIS FOR CHECK IF THE PAGE HAVE TABLE OR NOT, IF HAVE THEN RUN THE AJAX CODE TO GET THE TABLE DATA
    if ($('#load-data').length) rows();

    $('body').on('click', '.show-modal-form', function (e) {
        e.preventDefault();
        let btn       = $(this),
            modal     = $('body').find('#load-form');
        if (! btn.attr('href')) {
            toast('the button must have href attribute!', title = null, icon = 'warning');
            return false;
        }

        let url = btn.find('[data-yajra-href]').length ? btn.find(`[data-yajra-href]`).data('yajra-href') : btn.attr('href');

        modal.addClass('load');
        $.ajax({
            url: url,
            type: "GET",
            success: function (data, textStatus, jqXHR) {
                modal.find('.form-body').empty().append(data);
                modal.removeClass('load').modal('show');
                initPluginElements();
            },
            error: function(jqXHR) {
                handleErrors(jqXHR);
            },
        });
    }); // PUSH FORM TO THE BOOTSTRAP MODAL

    $('body').on('submit', 'form.submit-form', function(e) {
        e.preventDefault();
        let form = $(this);
        form.find('span.error').fadeOut(100);

        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: new FormData($(this)[0]),
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response, textStatus, jqXHR) {
                if (response.redirect) return window.location = response.redirect;

                if (response.reload) return location.reload(true);

                $('.modal').modal("hide");
                toast(response.message, null, response.icon);
                form.trigger("reset");
                $("select").val('').trigger('change');
                rows();
                $('#recourds-count').text(response.count);
            },
            error: function (jqXHR, textStatus, errorMessage) {
                handleErrors(jqXHR, form);
                form.parent().removeClass('load');
            },
            complete: function() { form.parent().removeClass('load'); }
        });
    }); // WHEN SUBMIT THE FORM SEND DATA TO CONTROLLER

    $('body').on('submit', 'form.form-destroy', function (e) {
        e.preventDefault();
        let href = $(this).attr('action'), data = $(this).serialize();
        swal(function (){
                $.ajax({
                    url: href,
                    type: "post",
                    data: data,
                    success: function (data, textStatus, jqXHR) {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                            return true;
                        }
                        toast(data.message, null, data.icon)
                        rows();
                        $('#recourds-count').text(data.count);
                    },
                    error: function (jqXHR) {
                        handleErrors(jqXHR);
                    },
                });
            });
    }); // WHEN SUBMIT THE FORM TO DELETE THE ROW

    $("body").on("click", "input[type=checkbox]#check-all", function() {
        let bool = $(this);
        $('input[type=checkbox].check-box-id').each(function () {
            if(bool.prop('checked')) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    }); // WHEN CLICK ON TR MAKE THE CHILD CHECK-BOX IS TRUE OR FALSE

    $('body').on("click", "button[type='reset']", function(e) {
        let form = $(this).closest('form');
        form.find('input:not([type=hidden])').val('');
        form.find('.chosen').val('').trigger('chosen:updated');
        form.find('.select2').val('').trigger('change');
        if ($('.email-body, #email-body').length > 0) CKEDITOR.instances['email-body'].setData('');
    });

    $('body').on('click', '.multi-delete', function (e) {
        e.preventDefault();
        playAudio('warning');

        let ids = [], href = window.location.href + '/multidelete';
        $('input[type=checkbox].check-box-id:checked').each(function() { ids.push($(this).val()); });

        if (ids.length == 0) {
            Swal.fire({ title: SWAL_FAILED_TITLE, icon: 'warning' });
        } else {
            swal( function () {
                $.ajax({
                    url: href,
                    type: "post",
                    data: {id : ids},
                    success: function (data, textStatus, jqXHR) {
                        toast(data.message, null, data.icon)
                        rows();
                        $('#recourds-count').text(data.count);
                    },
                    error: function (jqXHR) {
                        handleErrors(jqXHR);
                    },
                });
            });
        }

    }); // MULTI DELETE ROWS

    $('body').on('click', '.select-all-options', function(e) {
        e.preventDefault();
        let select = $(this).closest('.form-group').find('select');
        let selected = select.find('option:selected').length == select.find('option').length
                        ? false
                        : true;
        select.select2('destroy').find('option').prop('selected', selected).end().select2();
    });

    $("body").on('click', '.copy, .copy-url', function(e) {
        e.preventDefault();
        let text = $(this).data('url') !== undefined ? $(this).data('url') : $(this).text();
        if (text == '') {
            toast("No text to copy!", null, 'error');
            return true;
        }
        $('body').append(`<input id="copy-this-path-input" value="${text}">`);
        let input = $('#copy-this-path-input');
        input.select();
        document.execCommand('copy');
        input.remove();
        toast("Copied", null, 'success');
    });

    $('body').on('click', '.toggle-checked', function(e) {
        e.preventDefault();
        let parent = $(this).parent();
        let checked = parent.find('input[type="checkbox"]:checked').length == parent.find('input[type="checkbox"]').length
                        ? false
                        : true;
        parent.find('input[type="checkbox"]').each(function () { $(this).attr('checked', checked) });
    });
});
