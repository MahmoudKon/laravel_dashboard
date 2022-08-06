Pusher.logToConsole = true;
// var pusher = new Pusher('8a54692d8cd3a078d328', {
//     cluster: 'eu',
//     encrypted: true
// });


// var channel = pusher.subscribe(`private-new-email`);
// channel.bind('App\\Events\\NewEmail', function(data) {
//     console.log(data);
//     // $('.emails-unread-count').text(Number($('#emails-unread-count').text()) + 1);
//     // toast("Have New Email", null, 'success');
// });


Echo.channel('private-new-email')
    .listen('App\\Events\\NewEmail', (e) => {
        console.log(e);
    });
