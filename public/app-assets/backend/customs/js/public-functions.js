$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
}); // TO SEND THE CSRF TOKEN WITH AJAX REQUEST

$(document).ajaxError(function(response, jqXHR) {
    if (jqXHR.status === 419) { location.reload(true); }
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
    let data = null;
    let url  = window.location.href;
    let type = "get";

    if (form) {
        data = form.serialize();
        url  = form.attr('action');
        type = form.attr('method');
    }

    $('#load-data').addClass('load');
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(data, textStatus, jqXHR) {
            $('#load-data').empty().append(data);
            if (form) form.parent().removeClass('load');
        },
        error: function(jqXHR) {
            handleErrors(jqXHR);
            // $('#load-data').removeClass('load');
            if (form) form.parent().removeClass('load');
        },
        complete: function () { $('#load-data').removeClass('loads'); initPluginElements();}
    });
} // AJAX CODE TO LOAD THE DATA TABLE

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
        templateResult: iconFormat,
        templateSelection: iconFormat,
    });

    $('[data-toggle="tooltip"]').tooltip();
}

// Format icon
function iconFormat(icon) {
    if (!icon.id) return icon.text;
    if (!$(icon.element).data('icon')) return icon.text;
    return `<i class='${$(icon.element).data('icon')}'></i> ${icon.text}`;
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

function swal (callback) {
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
