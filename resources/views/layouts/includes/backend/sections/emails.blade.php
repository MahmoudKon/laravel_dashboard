<li class="dropdown dropdown-notification nav-item">
    <a class="nav-link nav-link-label" href="#" id="get-emails-count" data-toggle="dropdown"><i class="ficon ft-bell"></i>
        <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow unread-notifications-count"> <b class="emails-unread-count" id="emails-unread-count">0</b> </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
        <li class="dropdown-menu-header">
            <h6 class="dropdown-header m-0">
                <a href="{{ routeHelper('emails.index') }}" class="grey darken-2">@lang('menu.notifications')</a>
            </h6>
            <span class="notification-tag badge badge-default badge-danger float-right m-0 unread-notifications-count">
                <b class="emails-unread-count">0</b> @lang('menu.news')
            </span>
        </li>

        <li class="scrollable-container media-list w-100" style="max-height: 300px" id="list-emails" data-route="{{ routeHelper('emails.list') }}"></li>

        <li class="dropdown-menu-footer">
            <a class="dropdown-item text-muted text-center read-unread-notifications" href="{{ routeHelper('emails.read') }}">@lang('menu.read all notifications')</a>
        </li>
    </ul>
</li>
