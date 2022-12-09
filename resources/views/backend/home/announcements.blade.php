@if( isset( $active_announcements ) && count( $active_announcements ) )
    <div class="card">
        <div class="card-header bg-dark">
            <h3 class="card-title text-white"> <i class="fa-solid fa-bullhorn"></i> @lang('menu.list-rows', ['model' => trans('menu.announcements')]) </h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th> <b> @lang('inputs.title') </b> </th>
                            <th> <b> @lang('inputs.start_date') </b> </th>
                            <th> <b> @lang('inputs.end_date') </b> </th>
                            <th> <b> @lang('inputs.url') </b> </th>
                            <th> <b> @lang('inputs.image') </b> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($active_announcements as $index => $active_announcement)
                            <tr class="{{ $index % 2 ? '' : 'bg-blue-grey bg-lighten-5' }}">
                                <td> <a href='{{ routeHelper('announcements.show', $active_announcement) }}' class="btn btn-sm btn-link"> {{ $active_announcement->title }} </a> </td>
                                <td> {{ $active_announcement->formatDate('start_date') }} </td>
                                <td> {{ $active_announcement->formatDate('end_date') }} </td>
                                <td> <a href='{{ $active_announcement->url }}' class='btn btn-sm btn-primary' target='_blank'> <i class='fa fa-link'></i> @lang('inputs.url')</a> </td>
                                <td> <x-preview-image :image="$active_announcement->image" :title="$active_announcement->name" /> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
