@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser(getModel()."-show"))
        <a href="{{ routeHelper(getModel().'.show', $id) }}" class="btn btn-outline-info dropdown-item">
            <i class="ft-eye"></i> @lang('buttons.cover')
        </a>
    @endif

    @if (canUser("posts-index") && $posts_count)
        <a href="{{ routeHelper('contents.posts.index', $id) }}" class="btn btn-outline-primary dropdown-item">
            <i class="fa fa-list"></i> @lang('buttons.list-posts') Post
        </a>
    @endif

    @if (canUser("posts-create"))
        <a href="{{ routeHelper('contents.posts.create', $id) }}" class="btn btn-outline-purple dropdown-item">
            <i class="fa fa-plus"></i> @lang('menu.create-row', ['model' => trans('menu.post')])
        </a>
    @endif
@endsection
