@extends('layouts.app')

@section('title', 'Add Questions')

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
                    <div class="breadcrumb-item">Add Questions</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Input Questions</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Question</label>
                                <input type="text"
                                    class="form-control @error('question')
                                is-invalid
                            @enderror"
                                    name="question">
                                @error('question')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category Question</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="Signs" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Signs</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="Generic" class="selectgroup-input">
                                        <span class="selectgroup-button">Generic</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="category" value="Psychologist"
                                            class="selectgroup-input">
                                        <span class="selectgroup-button">Psychologist</span>
                                    </label>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Option A</label>
                                <input type="text"
                                    class="form-control @error('option_a')
                                is-invalid
                            @enderror"
                                    name="option_a">
                                @error('option_a')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Option B</label>
                                <input type="text"
                                    class="form-control @error('option_b')
                                is-invalid
                            @enderror"
                                    name="option_b">
                                @error('option_b')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Option C</label>
                                <input type="text"
                                    class="form-control @error('option_c')
                                is-invalid
                            @enderror"
                                    name="option_c">
                                @error('option_c')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Option D</label>
                                <input type="text"
                                    class="form-control @error('option_d')
                                is-invalid
                            @enderror"
                                    name="option_d">
                                @error('option_d')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Answer</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="answer" value="A" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">A</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="answer" value="B" class="selectgroup-input">
                                        <span class="selectgroup-button">B</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="answer" value="C" class="selectgroup-input">
                                        <span class="selectgroup-button">C</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="answer" value="D" class="selectgroup-input">
                                        <span class="selectgroup-button">D</span>
                                    </label>

                                </div>
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
