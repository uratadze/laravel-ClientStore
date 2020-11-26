@extends('layouts.app')
<title>@lang('Person Info Fill')</title>

@section('content')
<center>
<div style="width: 35%;">
    <form action="{{ route('person.info.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname">@lang('First Name')</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old("firstname") }}" placeholder='First Name'>
        </div>
        <div class="form-group">
            <label for="lastname">@lang('Last Name')</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old("lastname") }}" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="address">@lang('Address')</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old("address") }}" placeholder="Address">
        </div>
        <div class="form-group">
            <label for="passport">@lang('Passport ID')</label>
            <input type="text" class="form-control" id="passport" name="passport" value="{{ old("passport") }}" placeholder="Passport">
        </div>
        <div class="form-group">
            <label for="city">@lang('City')</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old("city") }}" placeholder="City">
        </div>
        <div class="form-group">
            <label for="number">@lang('Number')</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ old("number") }}" placeholder="Number">
        </div>
        
        <button type='submit' class='btn btn-primary'>@lang('Checkout')</button>
    </form>
</div>
</center>
@endsection