@extends('admin.layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="main-card mb-12 card">
            <div class="card-header">
                <div class="col-md-10">
                    <h5><strong>
                        <i class="fa fa-plus icon-gradient bg-mean-fruit"></i>
                        Add Salons
                    </strong></h5>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form class="">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="name" class="">Name</label>
                                    <input name="name" id="name" placeholder="Salon Name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="email" class="">Email</label>
                                    <input name="email" id="email" placeholder="Salon Email" type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <label for="address" class="">Address</label>
                            <input name="address" id="address" placeholder="Salon Address" type="text" class="form-control">
                        </div>
                        {{-- <div class="position-relative form-group">
                            <label for="exampleAddress2" class="">Address 2</label>
                            <input name="address2" id="exampleAddress2" placeholder="Apartment, studio, or floor" type="text" class="form-control">
                        </div> --}}
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="city" class="">City</label>
                                    <input name="city" id="city" type="text" placeholder="City" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="state" class="">State</label>
                                    <input name="state" id="state" type="text" class="form-control" placeholder="State">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="country" class="">Country</label>
                                    <input name="country" id="country" type="text" class="form-control" placeholder="Country">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="postal_code" class="">Postal Code</label>
                                    <input name="postal_code" id="postal_code" type="text" class="form-control" maxlength="6" placeholder="Postal Code">
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group">
                            <button class="mt-2 btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('admin.salons.index') }}" class="mt-2 btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="card-footer">Footer</div> --}}
        </div>
    </div>
@endsection
