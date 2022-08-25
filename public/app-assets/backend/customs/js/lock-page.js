$(function () {
    var last_active_time = Date.now();

    $(window).on('mouseover click keydown scroll', function () { last_active_time = Date.now(); });

    setInterval(() => { lockscreen(); }, 10000);

    function lockscreen() {
        if (Date.now() - last_active_time >= 3600000)
            window.location.href = `${main_path}/lockscreen`;
    }
});
