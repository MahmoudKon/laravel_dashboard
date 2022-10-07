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

    window.Echo.private(`new-email.${AUTH_USER_ID}`).listen('.new-email', (data) => {
        toast(data.message, null, 'success');
        let count = parseInt($('#emails-unread-count').text());
        $('.emails-unread-count').text(count + 1);
        list_notifications.prepend(EmailTemplate(data.email));
        $('#list-user-emails').prepend(EmailTemplate(data.email));
    });

    $('#get-emails-count').one('click', function(e) {
        e.preventDefault();
        list_notifications.empty();
        loadEmails(`${MAIN_ROUTE}/list`, list_notifications);
    });

    // Load Email When Make Scroll
    list_notifications.scroll(function () {
        if (current_element != 'notification') next_page = `${MAIN_ROUTE}/list`;
        current_element = "notification";
        if ( $(this).scrollTop() + $(this).innerHeight() + 1 >= $(this)[0].scrollHeight && next_page !== null )
            loadEmails(next_page, $(this));
    });

    function EmailTemplate (email) {
        return `<a href="${MAIN_ROUTE}?email=${email.id}" class="single-email" data-id="${email.id}">
                    <div class="media unseen-email">
                        <div class="media-left align-self-center">
                            <span class="avatar avatar-md">
                                    <img src="${main_path}/${email.notifier.image}" class="rounded-circle" width="55px">
                            </span>
                        </div>

                        <div class="media-body">
                            <h6 class="media-heading">${email.notifier.name}</h6>
                            <p class="notification-text font-small-3 text-muted">${email.subject}</p>

                            <small>
                                <time class="media-meta text-muted">${email.created_at}</time>
                            </small>
                        </div>
                    </div>
                </a>`;
    }
});

