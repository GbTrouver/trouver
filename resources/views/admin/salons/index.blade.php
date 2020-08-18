@extends('admin.layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="main-card mb-12 card">
            <div class="card-header">
                <div class="col-md-10">
                    <h5><strong>
                        <i class="pe-7s-scissors icon-gradient bg-mean-fruit"></i>
                        Salons
                    </strong></h5>
                </div>
                <div class="col-md-2 float-right">
                    <a class="btn btn-primary" href="{{ route('admin.salons.create') }}">Add Salon</a>
                    {{-- <button class="btn btn-primary"></button> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <h5 class="card-title">Salons Index Page</h5>will display here with appropriate actions.
                    <br><br>
                    <button class="btn btn-warning">Go somewhere</button>
                </div>
            </div>
            {{-- <div class="card-footer">Footer</div> --}}
        </div>
    </div>
@endsection
