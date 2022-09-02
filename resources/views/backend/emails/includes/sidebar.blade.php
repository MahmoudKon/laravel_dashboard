<div class="sidebar-left">
    <div class="sidebar">
        <div class="sidebar-content email-app-sidebar d-flex">
            <div class="email-app-menu col-md-4 card d-none d-lg-block">
                <div class="form-group form-group-compose text-center">
                    <a href="{{ routeHelper('emails.create') }}" type="button" class="btn btn-danger show-modal-form btn-block my-1"><i class="ft-mail"></i> @lang('inputs.compose')</a>
                </div>

                <h6 class="text-muted text-bold-500 mb-1">@lang('inputs.messages')</h6>
                <div class="list-group list-group-messages">
                    <a href="#" class="list-group-item active border-0 group-message" data-group="inbox">
                        <i class="fa fa-inbox"></i> @lang('inputs.inbox')
                        <span class="badge badge-danger badge-pill float-right emails-unread-count">{{ $emails_not_seen_count }}</span>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action border-0 group-message" data-group="sent">
                        <i class="fa fa-share"></i> @lang('inputs.sent')
                    </a>
                </div>

                <h6 class="text-muted text-bold-500 my-1">@lang('inputs.seen')</h6>

                <div class="list-group list-group-messages">
                    <a href="#" class="list-group-item active border-0 group-seen-type" data-group="null">@lang('inputs.all')</a>

                    <a href="#" class="list-group-item border-0 group-seen-type" data-group="0"> @lang('inputs.unseen')
                        <span class="badge badge-danger badge-pill float-right emails-unread-count">{{ $emails_not_seen_count }}</span>
                    </a>

                    <a href="#" class="list-group-item border-0 group-seen-type" data-group="1">@lang('inputs.seen')</a>
                </div>
            </div>
            <div class="email-app-list-wraper col-md-8 card p-0">

                <div class="email-app-list">
                    <div class="card-body chat-fixed-search">
                        <fieldset class="form-group position-relative has-icon-left m-0 pb-1">
                            <input type="text" class="form-control" id="search-in-email" placeholder="@lang('inputs.search')">
                            <div class="form-control-position">
                                <i class="ft-search"></i>
                            </div>
                        </fieldset>
                    </div>
                    <div id="users-list" class="list-group">
                        <div class="users-list-padding media-list" id="list-user-emails"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
