<div class="card px-2 pt-2 mb-0">
    <div class="card-header bg-blue-grey py-1">
        <h4 class="card-title white">
            <i class="fas fa-search fa-sm"></i><span class="mx-1">{{ $title }}</span>
        </h4>
    </div>

    <div class="card-body pb-0">
            <form action="{{ routeHelper(getModel().".index") }}" method="get" id="search-form">
                <input type="hidden" name="search" value="1">
            {{-- END FORM INPUTS --}}
            @include('backend.' . getModel(view:true) . '.search')
            {{-- END FORM INPUTS --}}

            {{-- END FORM BUTTONS --}}
            <x-form-buttons submit='search' />
            {{-- END FORM BUTTONS --}}
        </form>
    </div>
</div>
<hr>
