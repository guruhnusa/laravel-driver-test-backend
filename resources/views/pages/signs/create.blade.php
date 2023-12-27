@extends('layouts.app')

@section('title', 'Add Signs')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add Questions</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Add Signs</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('signs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Input Signs</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text"
                                    class="form-control @error('title')
                                is-invalid
                            @enderror"
                                    name="title">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text"
                                    class="form-control @error('description')
                                is-invalid
                            @enderror"
                                    name="description">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category Question</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="Forbidden" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Forbidden</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="Priority" class="selectgroup-input">
                                        <span class="selectgroup-button">Priority</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="Warning" class="selectgroup-input">
                                        <span class="selectgroup-button">Warning</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sign Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image"
                                        @error('image') is-invalid @enderror accept="image/*">
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
