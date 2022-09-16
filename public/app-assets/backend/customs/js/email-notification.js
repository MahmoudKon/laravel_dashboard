const MAIN_ROUTE = `${ENDPOINT}/emails`;
let load_new_email = true; // Check If The Value Is True Then Rerun The Ajax Function To Relisting The Emails
let limit = 0;
let jqxhr = {abort: function () {}}; // to cancel previous ajax request if still running
let next_page = null;
let page_is_loading = true;
let current_element = "notification";

/***************************************** Load New Emails In Notification Section *************************************************/
function loadEmails(page, ele, append = true, data = {}, empty = true) {
    if (typeof ele === 'string') ele = $(ele);
    $(ele).parent().addClass('load');
    load_new_email = false;
    jqxhr.abort();
    jqxhr = $.ajax({
        url: page,
        method: 'POST',
        data: data,
        success: function (response) {
            next_page = response.next_page ?? null;

            if(empty && !$.isEmptyObject(data)) $(ele).empty();
            if (append) $(ele).append(response.emails);
            else $(ele).prepend(response.emails);

            activeEmailFromRequest();
        },
        complete: function() { ele.parent().removeClass('load'); }
    });
} // END

function activeEmailFromRequest() {
    if ($('#list-user-emails').length == 0) return;
    let email = window.location.search.split('=')[1];
    if (email) {
        window.history.pushState({}, "", document.location.href.split("?")[0]);
        $('body').find(`#list-user-emails .single-email[data-id="${email}"]`).click();
    }
} // END CHECK

/*****************************************************************************************************
 *****************************************************************************************************
 ****************************** For Email Notification Icon ******************************************
 *****************************************************************************************************
 *****************************************************************************************************/

$(function () {
    let list_notifications  = $('#list-emails');

    let emails_not_seen_count = parseInt($('#emails-unread-count').text());
    function changeCount(type = '-') {
        if (type == '-') emails_not_seen_count --;
        else emails_not_seen_count ++;

        $('.emails-unread-count').text(emails_not_seen_count);
    }

    // NOTIFICATION
    window.Echo.private(`new-email.${AUTH_USER_ID}`).listen('NewEmail', (data) => {
        toast(data.message, null, 'success');
        changeCount('+');
    });

    // getEmailsCount();
    // window.Echo.channel('new-email').listen('NewEmail', (data) => {
    //     if (data.recipient_ids.includes(AUTH_USER_ID)) {
    //         toast(data.email.subject, 'Have a New Mail', 'success');
    //         $('.emails-unread-count').text(parseInt($('#emails-unread-count').text()) + 1);
    //     }
    // });


    $('#get-emails-count').click(function(e) {
        e.preventDefault();
        if (! $(this).closest('li').hasClass('show')) {
            list_notifications.empty();
            load_new_email = false;
            loadEmails(`${MAIN_ROUTE}/list`, list_notifications);
        }
    });

    // Load Email When Make Scroll
    list_notifications.scroll(function () {
        if (current_element != 'notification') next_page = `${MAIN_ROUTE}/list`;
        current_element = "notification";
        if ( $(this).scrollTop() + $(this).innerHeight() + 1 >= $(this)[0].scrollHeight && next_page !== null )
            loadEmails(next_page, $(this));
    });

    /********************************************* To Get The Email UnReaded Count *****************************************************/
    // getEmailsCount();
    // setInterval(() => { getEmailsCount(true); page_is_loading = false }, 15000);
    function getEmailsCount(force_lood = false) {
        $.ajax({
            url: `${MAIN_ROUTE}/count`,
            type: 'POST',
            success: function(result) {
                limit = result - parseInt($('#emails-unread-count').text());
                $('.emails-unread-count').text(result);
                if (limit > 0) {
                    if (!page_is_loading) {
                        RUN_SOUND = true;
                        toast("Have New Email", null, 'success');
                    }
                    let ele = '';
                    if ($('#list-emails').closest('ul').hasClass('show'))
                        ele = "#list-email,";

                    if (force_lood && $('#list-user-emails').length)
                        ele += "#list-user-emails";

                    if (ele !== '') {
                        loadEmails(`${MAIN_ROUTE}/new/${limit}`, ele, false);
                    }
                }
            }
        });
    } // END GET EMAILS COUNT
});

