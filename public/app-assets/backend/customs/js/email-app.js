// let next_page = null; // The Next Page For Email [ Using On Paginate And The Value Come From Response ] And Using On The Notification Icon
$(function () {
    let list_emails  = $('#list-user-emails');
    let data_filter = {search: null, type: "inbox", seen: null};

    $('body').on('click', '.group-message', function(e) {
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
        data_filter.type = $(this).data('group');
        if (data_filter.type == 'sent') {
            data_filter.seen = null;
            $('.group-seen-type[data-group="null"]').addClass('active').siblings().removeClass('active');
        }
        loadEmails(`${MAIN_ROUTE}/list`, list_emails, true, data_filter);
    });

    $('body').on('click', '.group-seen-type', function(e) {
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
        data_filter.seen = $(this).data('group');
        data_filter.type = 'index';
        $('.group-message[data-group="inbox"]').addClass('active').siblings().removeClass('active');
        loadEmails(`${MAIN_ROUTE}/list`, list_emails, true, data_filter);
    });

    // Load Email When Make Scroll
    $('#users-list').scroll(function () {
        if (current_element != 'app') next_page = `${MAIN_ROUTE}/list`;
        current_element = "app";
        if ( $(this).scrollTop() + $(this).innerHeight() == $(this)[0].scrollHeight && next_page !== null )
            loadEmails(next_page, list_emails, true, data_filter, false);
    });

    $('body').on('keyup', '#search-in-email', function() {
        data_filter.search = $(this).val();
        loadEmails(`${MAIN_ROUTE}/list`, list_emails, true, data_filter);
    });

    if ($('#list-user-emails').length > 0)
        loadEmails(`${MAIN_ROUTE}/list`, $('#list-user-emails'));

    $('body').on('click', '#list-user-emails .single-email', function (e) {
        e.preventDefault();

        AddActiveClass($(this).find('div.media'));
        $('#preview-email-body').parent().addClass('load');

        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            success: function (response) {
                $('#preview-email-body').html(response);
            },
            complete: function() { $('#preview-email-body').parent().removeClass('load'); }
        });
    });

    $('body').on('change', '#cc_select, #to_select', function() {
        let send_to_emails = $(this).val();
        let another_select = $(`#to_select`);
        if($(this).attr('id') == 'to_select')
            another_select = $(`#cc_select`);

        another_select.select2('destroy').find('option').attr('disabled', false);
        $(this).find('option').attr('disabled', false);
        if (send_to_emails)
            send_to_emails.forEach(element => { another_select.find(`option[value="${element}"]`).attr('disabled', true);});

        another_select.select2();
    });

    function AddActiveClass(email)
    {
        $('body').find('.open-email').removeClass('open-email');
        email.addClass('open-email');

        if(email.hasClass('unseen-email')) {
            email.removeClass('unseen-email');
            $('.emails-unread-count').text( parseInt($('#emails-unread-count').text()) - 1);
        }
    }

    $('body').on('submit', 'form#delete-email', function (e) {
        e.preventDefault();
        let href = $(this).attr('action'), data = $(this).serialize();
        if( ! confirm('Are you sure to delete email?')) {
            $('.load').removeClass('load');
            return;
        }

        $.ajax({
            url: href,
            type: "post",
            data: data,
            success: function (response, textStatus, jqXHR) {
                $('.load').removeClass('load');
                $(`.single-email[data-id="${response.email_id}"]`).remove();
                $('#preview-email-body').empty();
                loadEmails(`${MAIN_ROUTE}/list`, list_emails, true, data_filter);
                if (window.toast)
                        toast(response.message, null, 'success');
            },
        });
    });

    $('body').on('submit', 'form#delete-email', function (e) {
        e.preventDefault();
        let href = $(this).attr('action'), data = $(this).serialize();
        swal(
            $.ajax({
                url: href,
                type: "post",
                data: data,
                success: function (data, textStatus, jqXHR) {
                    $('.load').removeClass('load');
                    $('#preview-email-body').empty();
                    loadEmails(`${MAIN_ROUTE}/list`, list_emails, true, data_filter);
                    if (window.toast)
                            toast(response.message, null, 'success');
                },
                error: function (jqXHR) {
                    handleErrors(jqXHR);
                },
            })
        );
    }); // WHEN SUBMIT THE FORM TO DELETE THE ROW
});

