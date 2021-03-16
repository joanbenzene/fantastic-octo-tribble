@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Pay now!') }}</div>

                    <div class="card-body">
                        // This is the form. We submit it to /pay through a POST method as you just said. But we still got an error
                        <form method="POST" action="{{ route('payment') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Montant') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="place" autofocus>

                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-4">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Pay') }}
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

