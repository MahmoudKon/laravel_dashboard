Pusher.logToConsole = true;

// var pusher = new Pusher('0db1a0b7492cd1f7d233', {
//     cluster: 'eu'
// });

// var channel = pusher.subscribe('my-channel');
// channel.bind('my-event', function(data) {
//     alert(JSON.stringify(data));
// });



// const private_channel = Echo.channel('private.emails.1');

// private_channel.subscribed(function() {
//     console.log('subscribed');
// }).listen

Echo.private('email.30')
    .listen('NewEmail', (email) => {
        console.log(email);
    })


$(function() {
    $('#push-email').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).attr('href'),
            success: function (response) {
                toast(response.message, null, 'success');
            }
        });
    });
});