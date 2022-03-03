@extends('layouts.app')
@section('title')Payment task @endsection

@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    label {
        width: 100%;
        font-size: 1rem;
    }

    .card-input-element+.card {
        /* height: calc(36px + 2*1rem); */
        height: 45px;

        color: #14A800;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 2px solid transparent;
        border-radius: 4px;
    }

    .card-input-element+.card:hover {
        cursor: pointer;
    }

    .card-height {
        min-height: 420px;
    }

    .card-input-element:checked+.card {
        border: 2px solid #14A800;
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }

    .body-container {
        min-height: calc(100vh - 80px);
        padding: 40px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
    }
</style>
@endsection

@section('content')


<div class="body-container">
    <div class="row justify-content-center">
        <div class=" col-10 col-md-4 mb-5">
            <div class="card card-height">
                <div class="card-body">
                    <p class="p-0 m-0 h5">
                        Payment Details
                    </p>
                    <span class="text-secondary">
                        <span>{{ $from_user }}</span>, you will pay forrr
                    </span>
                    <hr>
                    <div>
                        <p class="lead p-0 m-0">
                            Task #{{ $id }}
                        </p>
                        <p class="text-secondary">{{ $title }}</p>
                        <strong>budget</strong>
                        <p>{{ $budget }} EGB</p>
                        <hr>
                        <p class="m-0">After task completed paid amount will transfer to:</p>
                        <p class="m-0 text-secondary"><strong>{{ $to_user }}</strong></p>
                        <p class="m-0 text-secondary">{{ $to_email }}</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-10 col-md-4">
            <form method="POST" action="{{ route('pay.task') }}">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ $from_user_id }}">
                <input type="hidden" name="task_id" value="{{ $id }}">
                <div class="card card-height">

                    <div class="card-body d-flex flex-column justify-content-between">

                        <div>
                            <p class="lead">
                                Choose your payment way: <span class="text-danger"> *</span>
                            </p>
                            @if(count($errors))
                            <div class="form-group">
                                <p>mkmkmkm</p>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            <div class="row">

                                <div class="col-md-4 h-75">
                                    <label>
                                        <input name="trans_type" type="radio" class="card-input-element d-none" id="order" value="order">
                                        <div class="card card-body bg-light d-flex flex-row justify-content-center align-items-center">Order
                                        </div>
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <label class="">
                                        <input name="trans_type" type="radio" class="card-input-element d-none" value="service" required>
                                        <div class="card card-body bg-light d-flex flex-row justify-content-center align-items-center">
                                            Service
                                        </div>
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <label class="">
                                        <input name="trans_type" type="radio" class="card-input-element d-none" value="both">
                                        <div class="card card-body bg-light d-flex flex-row justify-content-center align-items-center">
                                            Both
                                        </div>
                                    </label>

                                    @error('trans_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label>Cost Value By EGP <span class="text-danger"> * </span></label>
                                    <input type="text" name="amount" id="amount" class="form-control" aria-label="Text input with dropdown button" value="{{ old('amount') }}">
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group mt-3">
                                    <label>Description <span class="text-danger"> * </span></label>
                                    <input name="description" type="text" id="description" class="form-control" aria-label="Text input with dropdown button" value="{{ old('description') }}">
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Descir</strong>
                                    </span>
                                    @enderror

                                </div>

                            </div>
                        </div>
                        <input class="btn btn-outline-success w-100 mt-2" type="submit" name="pay" id="pay" value="Pay" required>
                    </div>

                </div>
            </form>
        </div>
    </div>


</div>


@endsection