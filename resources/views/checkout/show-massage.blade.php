@extends('layouts.app')

<title>@lang('Checkout')</title>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Message')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        ეს გახლავთ სატესტო ვერსია, ამიტომ შეკვეთა ავტომატურად დადასტურდა გადახდის გარეშე !
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
