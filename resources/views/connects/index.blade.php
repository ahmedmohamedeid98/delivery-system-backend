@extends('layouts.app')
@section('title')Buy Connects @endsection

<!-- Styles -->
@section('style')
<style>
    /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
    /* html {
        line-height: 1.15;
        -webkit-text-size-adjust: 100%
    } */
    /* 
    body {
        margin: 0
    } */
    /* 
    a {
        background-color: transparent
    } */

    /* [hidden] {
        display: none
    } */

    /* html {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        line-height: 1.5
    } */

    /* *,
    :after,
    :before {
        box-sizing: border-box;
        border: 0 solid #e2e8f0
    } */

    .content {
        min-height: calc(100vh - 80px);
        padding-bottom: 40px;
        display: flex;
        flex-direction: column;
    }

    @media screen and (max-width: 770px) {
        .content {
            padding-bottom: 700px;
        }
    }

    @media screen and (max-width: 520px) {
        .content {
            padding-bottom: 1050px;
        }
    }

    .header-card {
        background-image: linear-gradient(to right, #14A800, #FFD700);
        color: white;
        padding: 20px 0 120px 0;
        position: relative;
    }

    .cards {
        position: absolute;
        top: 100px;

    }

    .ribbon {
        position: absolute;
        top: 0;
        right: 0;
        background-image: linear-gradient(to right, #14A800, #FFD700);
        color: white;
        padding: 2px 20px 2px 20px;
        border-end-start-radius: 12px;
    }

    .best-plan {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
    }

    .plan-card {
        border-radius: 12px;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        overflow: hidden;
    }


    .coins-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 1;
        font-size: 45px;
        color: #FFD700;
    }

    .price {
        text-align: center;
        color: #14A800;
        font-size: 22px;
    }

    .connects-count {
        margin-top: 10px;
        text-align: center;
        color: #14A800;
        font-size: 18px;
    }

    .buy-btn {
        background-color: #14A800;
        width: 100px;
        height: 40px;
        border-radius: 20px;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="content">
    <div class="header-card d-flex justify-content-center align-items-center">
        <h1>Buy Connects</h1>

        <div class="cards d-flex flex-wrap gap-3 justify-content-center">
            <!-- <app-plan-card [loading]="loading25" (amount)="buy($event)" coinsCount="1" connects="25"
                description="Get 20 connects and 5 as a gift" price="50">
            </app-plan-card> -->

            <div class="d-flex justify-content-center">
                <div class="plan-card card best-plan" style="width: 250px; height: 350px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="coins-container mb-2">
                            <i class="fal fa-coins me-1"></i>
                        </div>
                        <p class="connects-count">25 Connects
                        </p>
                        <p class="text-center text-muted">Get 20 connects and 5 as a gift</p>
                        <p class="price">50<i class="fal fa-pound-sign ms-1"></i></p>
                    </div>
                    <form method="POST" action="{{ route('connects.buy') }}">
                        @csrf
                        <input type="hidden" name="amount" value="50">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="trans_type" value="connects">
                        <button type="submit" class="btn buy-btn">
                            Buy
                        </button>
                    </form>
                </div>
            </div>


            <div class="d-flex justify-content-center">
                <div class="plan-card card best-plan" style="width: 250px; height: 350px;">
                    <p class="ribbon">Most Popular</p>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="coins-container mb-2">
                            @foreach ([1,2] as $post)
                            <i class="fal fa-coins me-1"></i>
                            @endforeach
                        </div>
                        <p class="connects-count">75 Connects
                        </p>
                        <p class="text-center text-muted">Get 70 connects and 5 as a gift</p>
                        <p class="price">120<i class="fal fa-pound-sign ms-1"></i></p>
                    </div>
                    <form method="POST" action="{{ route('connects.buy') }}">
                        @csrf
                        <input type="hidden" name="amount" value="120">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="trans_type" value="connects">
                        <button type="submit" class="btn buy-btn">
                            Buy
                        </button>
                    </form>
                </div>
            </div>



            <div class="d-flex justify-content-center">
                <div class="plan-card card best-plan" style="width: 250px; height: 350px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="coins-container mb-2">
                            @foreach ([1,2,3] as $post)
                            <i class="fal fa-coins me-1"></i>
                            @endforeach
                        </div>
                        <p class="connects-count">140 Connects
                        </p>
                        <p class="text-center text-muted">Get 135 connects and 5 as a gift</p>
                        <p class="price">200<i class="fal fa-pound-sign ms-1"></i></p>
                    </div>
                    <form method="POST" action="{{ route('connects.buy') }}">
                        @csrf
                        <input type="hidden" name="amount" value="200">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="trans_type" value="connects">
                        <button type="submit" class="btn buy-btn">
                            Buy
                        </button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection