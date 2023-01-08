$(function () {
    let ajax_request = {abort: function() {}};
    $('body').on('click', '.show-search-form', function (e) {
        e.preventDefault();
        let btn   = $(this);
        if (! btn.attr('href')) {
            toast('the button must have href attribute!', title = null, icon = 'warning');
            return false;
        }

        ajax_request.abort();
        let url = btn.find('[data-yajra-href]').length ? btn.find(`[data-yajra-href]`).data('yajra-href') : btn.attr('href');

        ajax_request = $.ajax({
            url: url,
            type: "GET",
            success: function (data, textStatus, jqXHR) {
                let element = $('body').find('#search-form-body');
                element.empty().append(data).slideDown(300);
                btn.addClass('hidden');
                $('.close-search-button').removeClass('hidden');
                initPluginElements();
            },
            error: function(jqXHR) {
                handleErrors(jqXHR);
            },
        });
    })

    $('body').on('click', '.close-search-button', function(e) {
        e.preventDefault();
        $(this).addClass('hidden');
        $('.show-search-form').removeClass('hidden');
        $('#search-form-body').slideUp(300, function () { $('#search-form-body').empty() });
    });

    $('body').on('submit', 'form#search-form', function(e) {
        e.preventDefault();
        $(this).parent().addClass('load');
        rows($(this));
    });
});
