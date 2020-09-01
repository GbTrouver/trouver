@extends('admin.layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="main-card mb-12 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title">
                    <h5><strong>
                        <i class="fa {{ !empty($salon) ? 'fa-edit' : 'fa-plus' }} icon-gradient bg-mean-fruit"></i>
                        {{ !empty($salon) ? trans('labels.edit_salon') : trans('labels.add_salon') }}
                    </strong></h5>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="#salon_details" data-toggle="tab" class="nav-link {{ $active_tab == '' || $active_tab=='salon_details' ? 'active': '' }}">Salon Details</a>
                    </li>
                    @if (!empty($salon))
                        {{-- <li class="nav-item">
                            <a href="#salon_pictures" data-toggle="tab" class="nav-link">Salon Pictures</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#owner_details" data-toggle="tab" class="nav-link {{ $active_tab=='owner_details' ? 'active': '' }}">Owner Details</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    {{-- salons Details Tab --}}
                    <div class="tab-pane {{ $active_tab == '' || $active_tab=='salon_details' ? 'active': '' }}" id="salon_details" role="tabpanel">
                        <div class="col-md-12">
                            @if (session('success_salon_details'))
                               <div class="alert alert-success alert-dismissible">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   <strong>{{ session('success_salon_details') }}</strong>
                               </div>
                            @endif
                            @if (session('error_salon_details'))
                               <div class="alert alert-danger alert-dismissible">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   <strong>{{ session('error_salon_details') }}</strong>
                               </div>
                            @endif
                            @if (!empty($salon))
                                <form class="" id="salons_form" method="post" action="{{ route('admin.salons.update', $salon->id) }}" enctype="multipart/form-data">
                            @else
                                <form class="" id="salons_form" method="post" action="{{ route('admin.salons.store') }}" enctype="multipart/form-data">
                            @endif
                                {{ csrf_field() }}
                                <input type="hidden" name="active_tab" value="salon_details">
                                <input type="hidden" name="next_tab" value="owner_details">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="name" class="control-label">@lang('labels.name')<span class="required" aria-required="true">*</span></label>
                                            <input name="name" id="name" placeholder="@lang('placeholders.name')" type="text" class="form-control" value="{{ !empty($salon->name) ? $salon->name : '' }}">
                                            <span id="name_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('name') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="email" class="control-label">@lang('labels.email')<span class="required" aria-required="true">*</span></label>
                                            <input name="email" id="email" placeholder="@lang('placeholders.email')" type="email" class="form-control" value="{{ !empty($salon->email) ? $salon->email : '' }}">
                                            <span id="email_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('email') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="address" class="control-label">@lang('labels.address')<span class="required" aria-required="true">*</span></label>
                                    <input name="address" id="address" placeholder="@lang('placeholders.address')" type="text" class="form-control" value="{{ !empty($salon->address) ? $salon->address : '' }}">
                                    <span id="address_err" style="color: red; font-weight:700;">
                                        <small class="text-danger"><strong>{{ $errors->first('address') }}</strong></small>
                                    </span>
                                </div>
                                {{-- <div class="position-relative form-group">
                                    <label for="exampleAddress2" class="">Address 2</label>
                                    <input name="address2" id="exampleAddress2" placeholder="Apartment, studio, or floor" type="text" class="form-control">
                                </div> --}}
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="city" class="control-label">@lang('labels.city')<span class="required" aria-required="true">*</span></label>
                                            <input name="city" id="city" type="text" placeholder="@lang('placeholders.city')" class="form-control" value="{{ !empty($salon->city) ? $salon->city : '' }}">
                                            <span id="city_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('city') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="state" class="control-label">@lang('labels.state')<span class="required" aria-required="true">*</span></label>
                                            <input name="state" id="state" type="text" class="form-control" placeholder="@lang('placeholders.state')" value="{{ !empty($salon->state) ? $salon->state : '' }}">
                                            <span id="state_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('state') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="country" class="control-label">@lang('labels.country')<span class="required" aria-required="true">*</span></label>
                                            <input name="country" id="country" type="text" class="form-control" placeholder="@lang('placeholders.country')" value="{{ !empty($salon->country) ? $salon->country : '' }}">
                                            <span id="country_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('country') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="postal_code" class="control-label">@lang('labels.postal_code')<span class="required" aria-required="true">*</span></label>
                                            <input name="postal_code" id="postal_code" type="text" class="form-control" maxlength="6" placeholder="@lang('placeholders.postal_code')" value="{{ !empty($salon->postal_code) ? $salon->postal_code : '' }}">
                                            <span id="postal_code_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('postal_code') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <label for="lat" class="control-label">@lang('labels.lat')<span class="required" aria-required="true">*</span></label>
                                        <input type="text" name="lat" id="lat" placeholder="@lang('placeholders.lat')" class="form-control" maxlength="10" value="{{ !empty($salon->lat) ? $salon->lat : '' }}">
                                        <span id="lat_err" style="color: red; font-weight:700;">
                                            <small class="text-danger"><strong>{{ $errors->first('lat') }}</strong></small>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="lng" class="control-label">@lang('labels.lng')<span class="required" aria-required="true">*</span></label>
                                        <input type="text" name="lng" id="lng" placeholder="@lang('placeholders.lng')" class="form-control" maxlength="10" value="{{ !empty($salon->lng) ? $salon->lng : '' }}">
                                        <span id="lng_err" style="color: red; font-weight:700;">
                                            <small class="text-danger"><strong>{{ $errors->first('lng') }}</strong></small>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="opens_at" class="control-label">@lang('labels.opens_at')<span class="required" aria-required="true">*</span></label>
                                        <input type="time" name="open_at" id="open_at" placeholder="@lang('placeholders.opens_at')" class="form-control" value="{{ !empty($salon->open_at) ? $salon->open_at : '' }}">
                                        <span id="opens_at_err" style="color: red; font-weight:700;">
                                            <small class="text-danger"><strong>{{ $errors->first('opens_at') }}</strong></small>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="close_at" class="control-label">@lang('labels.close_at')<span class="required" aria-required="true">*</span></label>
                                        <input type="time" name="close_at" id="close_at" placeholder="@lang('placeholders.close_at')" class="form-control" value="{{ !empty($salon->close_at) ? $salon->close_at : '' }}">
                                        <span id="close_at_err" style="color: red; font-weight:700;">
                                            <small class="text-danger"><strong>{{ $errors->first('close_at') }}</strong></small>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="lunch_from" class="control-label">@lang('labels.lunch_from')<span class="required" aria-required="true">*</span></label>
                                        <input type="time" name="lunch_from" id="lunch_from" placeholder="@lang('placeholders.lunch_from')" class="form-control" value="{{ !empty($salon->lunch_from) ? $salon->lunch_from : '' }}">
                                        <span id="lunch_from_err" style="color: red; font-weight:700;">
                                            <small class="text-danger"><strong>{{ $errors->first('lunch_from') }}</strong></small>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="lunch_to" class="control-label">@lang('labels.lunch_to')<span class="required" aria-required="true">*</span></label>
                                        <input type="time" name="lunch_to" id="lunch_to" placeholder="@lang('placeholders.lunch_to')" class="form-control" value="{{ !empty($salon->lunch_to) ? $salon->lunch_to : '' }}">
                                        <span id="lunch_to_err" style="color: red; font-weight:700;">
                                            <small class="text-danger"><strong>{{ $errors->first('lunch_to') }}</strong></small>
                                        </span>
                                    </div>
                                </div> <br>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="logo" class="control-label">Salon Logo</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="logo" id="logo" accept="image/*">
                                                <label class="custom-file-label" for="logo">{{ !empty($salon->logo) ? $salon->logo : 'Upload Salon Logo' }}</label>
                                            </div>
                                            <span id="logo_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('logo') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="banner" class="control-label">Salon Banner</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="banner" id="banner" accept="image/*">
                                                <label class="custom-file-label" for="banner">{{ !empty($salon->banner) ? $salon->banner : 'Upload Salon Banner' }}</label>
                                            </div>
                                            <span id="banner_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('banner') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-group">
                                    <button class="mt-2 btn btn-primary" type="submit">@lang('labels.submit')</button>
                                    <a href="{{ route('admin.salons.index') }}" class="mt-2 btn btn-danger">@lang('labels.cancel')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- salons Details Tab --}}

                    @if (!empty($salon))
                        {{-- Salons Pictures Tab --}}
                        {{-- <div class="tab-pane" id="salon_pictures" role="tabpanel">
                            <h3>Coming Soon...</h3>
                        </div> --}}
                        {{-- Salons Pictures Tab --}}

                        {{-- Onwer Details Tab --}}
                        <div class="tab-pane {{ $active_tab=='owner_details' ? 'active': '' }}" id="owner_details" role="tabpanel">
                            {{-- <h3>Coming Soon...</h3> --}}
                            @include('admin.salons.create.owner_details')
                        </div>
                        {{-- Onwer Details Tab --}}
                    @endif
                </div>
            </div>
            {{-- <div class="card-footer">Footer</div> --}}
        </div>
    </div>
@endsection

@push('page_js')
    <script src="{{ asset('assets/admin/salons/salons_validate.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/admin/salons/salons.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/admin/salons/salons_tabs.js') }}" charset="utf-8"></script>
@endpush
