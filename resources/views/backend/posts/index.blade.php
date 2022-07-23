@extends('backend.includes.pages.index-page')

@push('script')
    <script>
        $(function() {
            $('body').on('change', '.active-toggle', function() {
                let _this = $(this);
                let url = '{{ routeHelper("posts.active.toggle") }}';
                let post_id = $(this).data('post-id');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {post_id: post_id},
                    success: function(response, textStatus, jqXHR) {
                        toast(response.message, null, 'success');
                    },
                    error: function(jqXHR) {
                        handleErrors(jqXHR);
                    },
                });
            });

            $('body').on('change', '[name="type"]', function() {
                $(this).closest('form').submit();
            });

            $('body').on('submit', '.make-short-url', function(e) {
                e.preventDefault();
                let form = $(this);
                let display_short_url = $('body').find('#display-short-url');
                let parent_short_url  = display_short_url.closest('.form-group');
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function (response, textStatus, jqXHR) {
                        $('#short-url-parent').slideDown(200);
                        display_short_url.text(response);
                        parent_short_url.find('.copy-url').attr('data-url', response);
                        parent_short_url.removeClass('hidden').slideDown(300);
                    },
                    error: function (jqXHR) {
                        handleErrors(jqXHR);
                    },
                });
            });
        });
    </script>
@endpush
