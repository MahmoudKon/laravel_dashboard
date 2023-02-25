@if (Route::has('messenger'))
    <script>
        $(function() {
            let new_message_remove_time = null;
            let new_message_element = $('#all-unread-messages');

            window.Echo.private(`new-message.{{ auth()->id() }}`)
                .listen('{{ config("messenger.event-name") }}', (data) => {
                    let counter = Number.parseInt(new_message_element.text());

                    new_message_element.text(counter+1).attr('data-original-title', data.message.user.name).attr('data-content', data.message.message).click();
                    if (new_message_remove_time) clearTimeout(new_message_remove_time);

                    new_message_remove_time = setTimeout(() => {
                        $('body').find(`#${new_message_element.attr('aria-describedby')}`).remove();
                        new_message_element.click().removeAttr('data-original-title').removeAttr('data-content').removeAttr('aria-describedby');
                    }, 3000);

                    sound = true;
                    playAudio();
                });

            window.Echo.join(`chat`).listenForWhisper('unread-count', (e) => {
                        if ({{ auth()->id() }} != e.auth_id) return;
                            $('#all-unread-messages').text(e.count)
                    });
        });
    </script>
@endif