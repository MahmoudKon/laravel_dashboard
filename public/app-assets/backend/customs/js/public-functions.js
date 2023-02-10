$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
}); // TO SEND THE CSRF TOKEN WITH AJAX REQUEST

$(document).ajaxError(function(response, jqXHR) {
    if (jqXHR.status === 419 || jqXHR.status === 401) { location.reload(true); }
}); // WHEN MAKE REQUEST AND THE RESPONSE IS ERROR THEN MAKE REFRESH THE PAGE

function playAudio(type = 'success') {
    let audio;
    switch (type) {
        case "notification":
            audio = new Audio(notificationAudio);
            break;
        case "success":
            audio = new Audio(successAudio);
            break;
        case "error":
        case "warning":
            audio = new Audio(warrningAudio);
            break;
        default:
            audio = new Audio(successAudio);
            break;
    }
    audio.play();
}

// Initialize query to datatable in page
function rows(form = null) {
    let ele  = $('#load-data');
    let data = null;
    let url  = ele.data('route') || window.location.href;
    let type = "get";

    if (form) {
        data = form.serialize();
        url  = form.attr('action');
        type = form.attr('method');
    }

    ele.addClass('load');
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(data, textStatus, jqXHR) {
            ele.empty().append(data);
        },
        error: function(jqXHR) {
            handleErrors(jqXHR);
        },
        complete: function () {
            if (form) form.parent().removeClass('load');
            ele.removeClass('load');
            initPluginElements();
        }
    });
} // AJAX CODE TO LOAD THE DATA TABLE

function beforeSendRequest(form)
{
    form.find('button').prop('disabled', true);
    form.find('span.error').fadeOut(100);
    form.find('.progress').fadeIn(300).removeClass('hidden');
    progressBar(form.find(".progress"), 0);
}

function completeRequest(form)
{
    form.parent().removeClass('load').find('button').prop('disabled', false);
    progressBar(form.find(".progress"), 100);
}

function progressBar(ele, percentage = 0)
{
    ele.find('.progress-bar').css({"width": `${percentage}%`}).text(`${percentage}%`);
    if ( percentage >= 100 ) {
        ele.find('.progress-bar').css({"width": '100%'}).text('100%');
        ele.fadeOut(3000, function() {
            ele.find('.progress-bar').css({"width": '0%'}).text('0%');
        });
    }
}

function handleErrors(jqXHR, form = null)
{
    if (jqXHR.readyState == 0) return true;

    if ([401,401,402,403,404].includes(jqXHR.status))
        toast(jqXHR.responseJSON.message, jqXHR.responseJSON.title || null, 'error');

    else if (jqXHR.status == 422) { // List Validation Error
        $.each(jqXHR.responseJSON.errors, function (key, val) {
            val = Array.isArray(val) ? val[0] : val;
            form.find(`#${key.replaceAll('.', '-')}_error`).text(val).fadeIn(300);
        });
    } else if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.line !== 'undefined') {
            toast('File: ' + jqXHR.responseJSON.file + ' (Line: ' + jqXHR.responseJSON.line + ')', jqXHR.responseJSON.message, 'error', 6000)
    } else {
        toast(jqXHR.responseJSON || jqXHR.statusText, null, 'error', 6000);
    }
}

function initPluginElements() {
    $(".select2").select2({
        dropdownParent: $("#load-form"),
    });

    $('[data-toggle="tooltip"]').tooltip();
}

function toast(message, title = null, icon = 'error', timer = 5000)
{
    playAudio(icon);
    const Toast = Swal.mixin({
        toast: true,
        position: $('html').attr('lang') == 'ar' ? 'top-start' : 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: icon,
        title: title,
        text: message,
    });
}

function FireSwal (callback) {
    playAudio('warning');
    Swal.fire({
        title: SWAL_TITLE,
        text: SWAL_MESSAGE,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: SWAL_CANCEL_BUTTON,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: SWAL_DELETE_BUTTON
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        } else {
            $('.load').removeClass('load');
        }
    });
}

$('body').on('click', '.page-reload', function (e) {
    e.preventDefault();
    $('body').addClass('load');
    location.reload();
});

$('.badge-text-maxlength').maxlength({
    alwaysShow: true,
    separator: ' of ',
    preText: 'You have ',
    postText: ' chars remaining.',
    validate: true,
    warningClass: "badge badge-success",
    limitReachedClass: "badge badge-danger",
});

$('body').on('submit', 'form', function() {
    $(this).parent().addClass('load');
});


function submitForm(form, callback) {
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (response) {
            callback(response);
        },
        complete: function () { form.parent().removeClass('load'); }
    });
}

$('body').on('click', '[data-toggle="tooltip"]', function() {
    $('body').find(`#${$(this).attr('aria-describedby')}`).remove();
    $(this).removeAttr('aria-describedby');
});
