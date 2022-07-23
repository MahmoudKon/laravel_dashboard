var new_navigator_status = 'online';
var current_navigator_status = 'online';

function check_internet_connection()
{
    new_navigator_status = navigator.onLine ? "online" : "offline";

    if (new_navigator_status == current_navigator_status) return true;

    new_navigator_status == 'online'
        ? toast("Internet is connected.", "Connection", "success", 6000)
        : toast("Opps! Internet Is Disconnected.", "Connection Failed", "error", 6000);

    current_navigator_status = new_navigator_status;
}

check_internet_connection();
setInterval(function(){ check_internet_connection(); }, 3000);
