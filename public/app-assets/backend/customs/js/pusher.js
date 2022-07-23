var pusher = new Pusher('8a54692d8cd3a078d328', {
    cluster: 'eu',
    encrypted: true,
});

var channel = pusher.subscribe('count-unread-emails');
channel.bind('App\\Events\\CountUnreadEmails', function(data) {
    console.log(data);
    $('.emails-unread-count').text(Number($('#emails-unread-count').text()) + 1);
    toast("Have New Email", null, 'success');
});
