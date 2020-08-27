<div class="col-md-12">
    @if (session('success_owner_details'))
       <div class="alert alert-success alert-dismissible">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>{{ session('success_success_owner_details') }}</strong>
       </div>
    @endif
    @if (session('error_owner_details'))
       <div class="alert alert-danger alert-dismissible">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>{{ session('error_owner_details') }}</strong>
       </div>
    @endif

    <form class="" id="owner_details_form" action="{{ route('admin.salons.update_owner_details', $salon->id) }}" method="post">
        {{ csrf_field() }}

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="first_name" class="control-label">@lang('labels.first_name')<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="@lang('placeholders.first_name')">
                    <span id="first_name_err" style="color: red; font-weight:700;">
                        <small class="text-danger"><strong>{{ $errors->first('first_name') }}</strong></small>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="last_name" class="control-label">@lang('labels.last_name')<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="@lang('placeholders.last_name')">
                    <span id="last_name_err" style="color: red; font-weight:700;">
                        <small class="text-danger"><strong>{{ $errors->first('last_name') }}</strong></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="owner_email" class="control-label">@lang('labels.email')<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="owner_email" id="owner_email" class="form-control" placeholder="@lang('placeholders.email')">
                    <span id="owner_email_err" style="color: red; font-weight:700;">
                        <small class="text-danger"><strong>{{ $errors->first('owner_email') }}</strong></small>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="owner_image" class="control-label">@lang('labels.owner_image')<span class="required" aria-required="true">*</span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="owner_image" id="owner_image" accept=".jpg,.jpeg,.png">
                        <label class="custom-file-label" for="owner_image">@lang('placeholders.owner_image')</label>
                    </div>
                    <span id="owner_image_err" style="color: red; font-weight:700;">
                        <small class="text-danger"><strong>{{ $errors->first('owner_image') }}</strong></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="mobile" class="control-label">@lang('labels.mobile')<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="@lang('placeholders.mobile')" maxlength="10">
                    <span id="mobile_err" style="color: red; font-weight:700;">
                        <small class="text-danger"><strong>{{ $errors->first('mobile') }}</strong></small>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="alt_mobile" class="control-label">@lang('labels.alt_mobile')<span class="required" aria-required="true">*</span></label>
                    <input type="text" name="alt_mobile" id="alt_mobile" class="form-control" placeholder="@lang('placeholders.alt_mobile')" maxlength="10">
                    <span id="alt_mobile_err" style="color: red; font-weight:700;">
                        <small class="text-danger"><strong>{{ $errors->first('alt_mobile') }}</strong></small>
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
