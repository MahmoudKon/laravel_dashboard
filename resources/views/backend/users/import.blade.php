<div class="card">
    {{-- START INCLUDE THE FORM PAGE --}}
    <div class="card-header bg-primary">
        <h4 class="card-title white">
            <i class="fa fa-plus fa-sm"></i><span class="mx-1">Import {{ ucfirst(getModel()) }} Excel File</span>
        </h4>

        @yield('back')
    </div>

    <div class="card-content collpase show">
        <div class="card-body">
            <form action="{{ routeHelper(getModel().'.excel.import') }}" method="post" class="submit-form" enctype="multipart/form-data">
                @csrf

                {{-- END FORM INPUTS --}}
                <div class="form-group">
                    <label for="file" class="required block-tag">Select Excel File</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-file-excel"></i> </span>
                        </div>
                        <input type="file" class="form-control" name="file" id="file" required>
                    </div>
                    <p class="badge-default badge-info block-tag text-center">
                        Please Upload Only Excel File
                    </p>
                </div>
                {{-- END FORM INPUTS --}}

                {{-- END FORM BUTTONS --}}
                <x-form-buttons submit='save' />
                {{-- END FORM BUTTONS --}}
            </form>
        </div>
    </div>

    {{-- END INCLUDE THE FORM PAGE --}}
</div>
