@extends('admin.layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="main-card mb-12 card">
            <div class="card-header">
                <div class="col-md-10">
                    <h5><strong>
                        <i class="pe-7s-scissors icon-gradient bg-mean-fruit"></i>
                        @lang('labels.salons')
                    </strong></h5>
                </div>
                <div class="col-md-2 float-right">
                    <a class="btn btn-primary" href="{{ route('admin.salons.create') }}">@lang('labels.add_salon')</a>
                    {{-- <button class="btn btn-primary"></button> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    @if (session('success'))
                       <div class="alert alert-success alert-dismissible">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{ session('success') }}</strong>
                       </div>
                    @endif
                    @if (session('error'))
                       <div class="alert alert-danger alert-dismissible">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong>{{ session('error') }}</strong>
                       </div>
                    @endif
                    <input type="hidden" id="get-salons-url" value="{{route('admin.salons.index')}}">
                    <h3 class="card-title">Salons Index Page</h3>
                    <br><br>
                    {{-- <button class="btn btn-warning">Go somewhere</button> --}}
                    <table class="table table-hover display" id="salons-table" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Opens At</th>
                                <th>Close At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card-footer">Footer</div> --}}
        </div>

    </div>
@endsection
@push('page_js')
    <script src="{{ asset('assets/admin/js/datatables/datatables.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/admin/salons/salons.js') }}" charset="utf-8"></script>
@endpush

@section('model')
    <div class="modal fade" id="owner_details" tabindex="-1" role="dialog" aria-labelledby="owner_details_label" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="owner_details_title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
