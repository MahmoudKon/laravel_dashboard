@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
@endsection

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    @include('backend.includes.cards.table-header', ['title' => trans('menu.profile')])
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="content-body">
            <div class="card p-2">
                @include('backend.profile.form', ['form_type' => 'info', 'bg' => 'bg-gradient-directional-teal'])

                @include('backend.profile.form', ['form_type' => 'avatar', 'bg' => 'bg-gradient-directional-cyan'])

                @include('backend.profile.form', ['form_type' => 'password', 'bg' => 'bg-gradient-directional-grey-blue'])

                @hasanyrole(SUPERADMIN_ROLES)
                    @include('backend.profile.form', ['form_type' => 'roles', 'bg' => 'bg-gradient-directional-blue-grey'])

                    @include('backend.profile.form', ['form_type' => 'permissions', 'bg' => 'bg-gradient-directional-blue-grey'])
                @endhasanyrole
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>
@endsection
