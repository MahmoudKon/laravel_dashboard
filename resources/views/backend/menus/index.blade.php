@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/ui/dragula.min.css') }}">
@endsection

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    @include('backend.includes.cards.table-header')
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-1">
                @if(canUser('menus.create'))
                    <a href="{{ routeHelper('menus.create') }}" class="btn btn-primary btn-sm show-modal-form"> <i class="fa fa-plus"></i> @lang('menu.create-row', ['model' => trans('menu.menu')])</a>
                @endif

                @if(canUser('menus.syncMenus'))
                    <a href="{{ routeHelper('menus.sync') }}" class="btn btn-dark btn-sm"> <i class="fas fa-sync-alt"></i> @lang('buttons.sync menus')</a>
                @endif
            </div>

            <ul class="list-group drag-drop nested-sortable" id="list-group-tags" data-url="{{ routeHelper('menus.reorder') }}" data-parent-id='null'>
                @foreach ($menus as $menu)
                    @include('backend.menus.list-menus', ['menu' => $menu])
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/input-groups.js') }}"></script>
    {{-- https://github.com/SortableJS/Sortable --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>

        $(function() {

            var sortablelist = document.getElementById('list-group-tags');
            var nestedSortables = document.getElementsByClassName('nested-sortable');

            for (var i = 0; i < nestedSortables.length; i++) {
                new Sortable(nestedSortables[i], {
                    group: 'nested',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    onEnd: function (/**Event*/evt) {
                        let orders = createSortArray();
                        saveOrdring(orders);
                    },
                });
            }

            function createSortArray()
            {
                let orders = [];
                $('li.list-group-item').each(function (index) {
                    let id = $(this).data('id');
                    let parent_id = $(this).closest('.nested-sortable').data('parent-id');
                    if(typeof orders[id] !== 'undefined') return true;
                    orders[id] = {parent_id: parent_id, order: (index + 1)}
                });
                return orders;
            }

            function saveOrdring(orders)
            {
                $.ajax({
                    type: "post",
                    url: `${$('.drag-drop').data('url')}`,
                    data: {orders: orders},
                    success: function (response) {
                    let order = 1;
                    $('.order').each(function () {
                        $(this).text(order++);
                    });
                    }
                });
            }
        });

        $(function() {
            $('body').on('keyup', 'input[name="icon"]', function() {
                let icon = $(this).closest('.input-group').find('.input-group-text');
                icon.html(`<i class="${$(this).val()}"></i>`);
            });
        });
    </script>
@endsection
