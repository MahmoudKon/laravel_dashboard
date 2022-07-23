<div class="card-header bg-primary"> <h4 class="card-title white"> Make Short Link </h4> </div>

<div class="card-content collpase show">
    <div class="card-body">
        <form action="{{ routeHelper('posts.short.url', $post->id) }}" method="post" class="make-short-url">
            @csrf
            <input type="hidden" name="URL" value="{{ $post->url }}">

            {{-- START URL --}}
            <div class="form-group">
                <label>@lang('inputs.url')</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ url($post->url) }}" required readonly>
                </div>
            </div>
            {{-- START URL --}}

            {{-- START LOCATION --}}
            <div class="form-group">
                <label class="required">@lang('inputs.select-your-location'):</label>
                <select class="select2 form-control" name="type" data-placeholder="--- @lang('inputs.select-your-location') ---" required>
                    <option value="out">In Egypt</option>
                    <option value="in">Out Egypt</option>
                </select>
            </div>
            {{-- END LOCATION --}}

            {{-- START URL --}}
            <div class="form-group hidden" id="short-url-parent">
                <label>@lang('inputs.result')</label>
                <p class="form-control copy primary" id="display-short-url" disabled data-toggle="tooltip" title="@lang('buttons.copy')"></p>
            </div>
            {{-- START URL --}}

            <div class="form-actions d-flex m-0" style="justify-content: space-evenly;">
                <button type="reset" class="btn btn-warning" data-dismiss="modal" data-toggle="tooltip" title="@lang('buttons.reset-form')">
                    <i class="ft-repeat"></i> @lang('buttons.reset')
                </button>

                <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="@lang('buttons.submit-form')">
                    <i class="fa fa-link"></i> @lang('buttons.short')
                </button>
            </div>

        </form>
    </div>
</div>
