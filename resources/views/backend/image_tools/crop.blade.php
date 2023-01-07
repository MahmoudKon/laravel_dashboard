@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/plugins/images/cropper/cropper.css') }}">
@endsection

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    <div class="card-header bg-info white">
        <h4 class="card-title white">
            {{ trans('menu.'.getModel()) }}
        </h4>

        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse" data-toggle="tooltip" title="@lang('title.minus-section')" ><i class="ft-minus"></i></a></li>
                <li><a data-action="expand" data-toggle="tooltip" title="@lang('title.full-page')" ><i class="ft-maximize"></i></a></li>
                <li><a data-action="close" data-toggle="tooltip" title="@lang('title.remove-section')" ><i class="ft-x"></i></a></li>
            </ul>
        </div>
    </div>
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="card-body">

            <fieldset class="mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn bg-gradient-x2-grey-blue text-white btn-sm download-cropped" type="button">
                            <i class="fa fa-download"></i> Download Cropped Image
                        </button>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input cursor-pointer upload-image" id="upload-image" accept="image/*">
                        <label class="custom-file-label" for="upload-image"><i class="fa fa-upload"></i> Choose file</label>
                    </div>
                </div>
            </fieldset>

            <div class="row mb-1">
                <div class="col-md-9">
                    <div class="img-container overflow-hidden">
                        <img class="main-demo-image img-fluid" src="" alt="Select Picture">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="docs-preview clearfix">
                            <div class="img-preview preview-lg img-fluid" dir="ltr"></div>
                            {{-- <div class="img-preview preview-md img-fluid"></div>
                            <div class="img-preview preview-sm img-fluid"></div>
                            <div class="img-preview preview-xs img-fluid"></div> --}}
                        </div>
                    </div>
                    <!-- <h3 class="page-header">Data:</h3> -->
                    <div class="docs-data">
                        <fieldset class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">X</span>
                                </div>
                                <input type="number" class="form-control main-demo-dataX" placeholder="x" data-method="x">
                                <div class="input-group-append">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Y</span>
                                </div>
                                <input type="number" class="form-control main-demo-dataY" placeholder="y" data-method="y">
                                <div class="input-group-append">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Width</span>
                                </div>
                                <input type="number" class="form-control main-demo-dataWidth" placeholder="width" data-method="width">
                                <div class="input-group-append">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Height</span>
                                </div>
                                <input type="number" class="form-control main-demo-dataHeight" placeholder="height" data-method="height">
                                <div class="input-group-append">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-blue rotate-m45-deg" type="button"><i class="fa fa-rotate-left"></i> Rotate -45&deg;</button>
                <button class="btn btn-outline-pink rotate-45-deg" type="button"><i class="fa fa-rotate-right"></i> Rotate 45&deg;</button>
                <button class="btn btn-outline-teal rotate-180-deg" type="button"><i class="fa fa-rotate"></i>  Rotate 180&deg;</button>
                <button class="btn btn-outline-blue flip-horizontal" type="button" data-option="1"><i class="fa-solid fa-arrows-left-right"></i> Flip
                <button class="btn btn-outline-pink flip-vertical" type="button" data-option="1"><i class="fa-solid fa-arrows-up-down"></i> Flip
                <button class="btn btn-outline-teal zoom-in" type="button"><i class="fa fa-search-plus"></i> Zoom In</button>
                <button class="btn btn-outline-teal zoom-out" type="button"><i class="fa fa-search-minus"></i> Zoom Out</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/extensions/cropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/extensions/image-cropper.js') }}"></script>
@endpush
