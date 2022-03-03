@extends('layouts.app')
@section('title')Payment Status @endsection

@section('style')
<style>
    .btn {
        background-color: #14A800;
        color: white;
        width: 60%;
        height: 40px;
        border-radius: 20px;

    }

    .success-card {
        height: calc(100vh - 80px);
    }


    .card-header {
        background-color: var(--on-primary);
        color: var(--primary);
        font-size: 50px;
    }

    .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }
</style>
@endsection

@section('content')

<div class="success-card row d-flex justify-content-center align-items-center">
    @if($status == 'A')
    <div class="col-8 col-md-3 card p-0">
        <div class="card-header d-flex  justify-content-center py-3"><i class="fal fa-badge-check"></i></div>
        <div class="card-body d-flex flex-column align-items-center">
            <p class="h2 ">Payment Success.</p>
            <p class="text-muted text-center my-3">Your payment done you will see your transaction details soon in your profile
            </p>
            <a href="https://edelivery-marketplace.herokuapp.com" class="btn">Back to Home</a>
        </div>

    </div>
    @endif

    @if($status == 'C')
    <div class="col-8 col-md-3 card p-0">
        <div class="card-header d-flex  justify-content-center py-3"><i class="fal fa-exclamation-triangle text-warning"></i>
        </div>
        <div class="card-body d-flex flex-column align-items-center">
            <p class="h2 ">Payment Canceled.</p>
            <p class="text-muted text-center my-3">You are canceled payment if there is a mistack please call us.</p>
            <a href="https://edelivery-marketplace.herokuapp.com" class="btn bg-warning">Back to Home</a>
        </div>
    </div>
    @endif
    @if($status != 'C' && $status != 'A')
    <div class="col-8 col-md-3 card p-0">
        <div class="card-header d-flex  justify-content-center py-3"><i class="fal fa-exclamation-triangle text-danger"></i>
        </div>
        <div class="card-body d-flex flex-column align-items-center">
            <p class="h2 ">Payment Failure.</p>
            <p class="text-muted text-center my-3">Something want wrong please ensure from your card info and try again</p>
            <a href="https://edelivery-marketplace.herokuapp.com" class="btn bg-danger">Back to Home</a>
        </div>
    </div>
    @endif
</div>

@endsection