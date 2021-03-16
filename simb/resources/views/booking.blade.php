@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Book now!') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                                <div class="col-md-6 custom-preview">
                                    <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                    @error('place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Image Preview -->
                            <div class="form-group row my-4 custom-preview" style="width: 300px">
                                <label class="custom-preview-label" for="">Image Preview</label>
                                <input id="carte" class="custom-preview-input" type="file" accept="image/*" preview="image-preview" name="carte" value="{{ old('carte') }}" required>
                                @error('carte')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="preview" id="image-preview" style="width: 150px; height: 150px"></div>

                            <!-- Image Preview 2 -->
                            <div class="custom-preview" style="width: 300px">
                                <label class="custom-preview-label" for="">Image Preview 2</label>
                                <input class="custom-preview-input" accept="image/*" type="file" id="passport" preview="image-preview2" name="passport" value="{{ old('passport') }}" required>
                                @error('passport')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="preview" id="image-preview2"></div>

                            <div class="form-group row my-4">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Book') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

