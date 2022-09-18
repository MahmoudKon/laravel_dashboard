$(function () {
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
            success: function (response, textStatus, jqXHR) {
            if (response.redirect) return window.location = response.redirect;
                modal.find('.form-body').empty().append(response);
                modal.removeClass('load').modal('show');
                initPluginElements();
            },
            error: function(jqXHR) {
                handleErrors(jqXHR);
            },
        });
    }); // PUSH FORM TO THE BOOTSTRAP MODAL

    $('body').on('change', '.checkbox-change-status', function() {
        $(this).closest('form').submit();
    });

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
                    success: function (response, textStatus, jqXHR) {
                        if (response.redirect) return window.location.href = response.redirect;

                        if (response.reload) return location.reload(true);

                        toast(response.message, null, response.icon)
                        rows();
                        $('#recourds-count').text(response.count);
                    },
                    error: function (jqXHR) {
                        handleErrors(jqXHR);
                    },
                });
            });
    }); // WHEN SUBMIT THE FORM TO DELETE THE ROW


    $('body').on("click", "button[type='reset']", function(e) {
        let form = $(this).closest('form');
        form.find('input:not([type=hidden])').val('');
        form.find('.chosen').val('').trigger('chosen:updated');
        form.find('.select2').val('').trigger('change');
        if ($('.email-body, #email-body').length > 0) CKEDITOR.instances['email-body'].setData('');
    });


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




// ************************************************************************************************************
// ***************************************** MULTI DELETE FUNCTIONS *******************************************
// ************************************************************************************************************
$(function() {
    let multi_delete_rows_id = []; // array of ids
    let multi_delete_href    = window.location.href + '/multidelete'; // the multi delete end point

    // CHECK OR UNCHECK ALL INPUTS [MAKE ARRAY EMPTY OR MAKE PUSH IDS]
    $("body").on("click", "input[type=checkbox]#check-all", function() {
        let bool = $(this);
        $('input[type=checkbox].check-box-id').each(function () {
            $(this).prop('checked', bool.is(":checked"));
            if (bool.is(":checked")) updateMultiDeleteArray($(this));
            else multi_delete_rows_id = [];
        });
    });

    // WHEN MAKE CHECK OR UNCHECK FOR SINGLE ID [MAKE PUSH OR REMOVE ID]
    $("body").on("change", "input[type=checkbox].check-box-id", function() {
        updateMultiDeleteArray($(this));
    });

    // TO MAKE CHECK FOR OLD
    $("body").on('DOMSubtreeModified', '#load-data tbody', function() {
        multi_delete_rows_id.forEach(row_id => {
            $(`input[type=checkbox].check-box-id[value=${row_id}]`).prop('checked', true);
        });
    });

    // HELPER FUNCTION TO CHECK THIS ACTION WILL PUSH ID OR REMOVE IT FROM ARRAY
    function updateMultiDeleteArray(ele)
    {
        if (ele.is(":checked"))
            multi_delete_rows_id.push(ele.val());
        else {
            const index = multi_delete_rows_id.indexOf(ele.val());
            multi_delete_rows_id.splice(index, 1);
        }
    }

    // THE MAIN EVENT TO MAKE SEND IDS FOR BACKEND TO MAKE DESTROY
    $('body').on('click', '.multi-delete', function (e) {
        e.preventDefault();
        playAudio('warning');

        if (multi_delete_rows_id.length == 0) {
            Swal.fire({ title: SWAL_FAILED_TITLE, icon: 'warning' });
        } else {
            swal( function () {
                $.ajax({
                    url: multi_delete_href,
                    type: "post",
                    data: {id : multi_delete_rows_id},
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
    });
});
