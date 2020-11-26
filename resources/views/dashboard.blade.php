@extends('layouts.app')
<title>@lang('Dashboard')</title>

@section('content')
{{-- <center>
    <div style="width: 35%;">
        <form action="{{ route('person.info.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="firstname">@lang('First Name')</label>
                <input value="@isset($person->first_name) {{$person->first_name}} @endisset" type="text" class="form-control" id="firstname" name="firstname" placeholder='First Name'>
            </div>
            <div class="form-group">
                <label for="lastname">@lang('Last Name')</label>
                <input value="{{ $person->last_name }}" type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="address">@lang('Address')</label>
                <input value="{{ $person->Address }}" class="form-control" id="address" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="passport">@lang('Passport ID')</label>
                <input value="{{ $person->passport }}" type="text" class="form-control" id="passport" name="passport" placeholder="Passport">
            </div>
            <div class="form-group">
                <label for="city">@lang('City')</label>
                <input value="{{ $person->city }}" type="text" class="form-control" id="city" name="city" placeholder="City">
            </div>
            <div class="form-group">
                <label for="number">@lang('Number')</label>
                <input value="{{ $person->number }}" type="text" class="form-control" id="number" name="number" placeholder="Number">
            </div>
            
            <button type='submit' class='btn btn-primary'>@lang('Update')</button>
        </form>
    </div>
</center> --}}

<main class="main pt-2">

    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>My Account</h1>
        </div>
    </section>

    <div class="container-fluid animated fadeIn">
        <div class="row">
            {{-- Update Personal Info --}}
            <div class="col-lg-8">
                <form class="form" action="{{ route('change.person') }}" method="post" enctype="multipart/form-data">       
                    @csrf

                    <div class="card padding-10">
                        <div class="card-header">
                            Update Personal Info
                        </div>

                        <div class="card-body backpack-profile-form bold-labels">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="required">First Name</label>
                                    <input value="@isset($person->first_name){{ $person->first_name }}@endisset" class="form-control" type="text" name="firstname">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="required">Last Name</label>
                                    <input value="@isset($person->last_name){{ $person->last_name }}@endisset" class="form-control" type="text" name="lastname">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="required">Address</label>
                                    <input value="@isset($person->Address){{ $person->Address }}@endisset" class="form-control" type="text" name="address">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="required">Passport ID</label>
                                    <input value="@isset($person->passport){{ $person->passport }}@endisset" class="form-control" type="text" name="passport">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="required">City</label>
                                    <input value="@isset($person->city){{ $person->city }}@endisset" class="form-control" type="text" name="city">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="required">Number</label>
                                    <input value="@isset($person->number){{ $person->number }}@endisset" class="form-control" type="text" name="number">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="la la-save"></i> Save</button>
                            <a href="{{ route('store') }}" class="btn">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
            {{-- Update Account Info --}}
            <div class="col-lg-8">
                <form class="form" action="{{ route('change.account') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card padding-10">
                        <div class="card-header">
                            Update Account Info
                        </div>

                        <div class="card-body backpack-profile-form bold-labels">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="required">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="required">Email</label>
                                    <input class="form-control" type="text" name="email" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="la la-save"></i> Save</button>
                            <a href="{{ route('store') }}" class="btn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Change Password --}}
            <div class="col-lg-8">
                <form class="form" action="{{ route('change.password') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card padding-10">

                        <div class="card-header">
                            Change Password
                        </div>

                        <div class="card-body backpack-profile-form bold-labels">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="required">Old password</label>
                                    <input autocomplete="new-password" class="form-control" type="password" name="old_password" id="old_password">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="required">New password</label>
                                    <input autocomplete="new-password" class="form-control" type="password" name="password" id="password">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label class="required">Confirm password</label>
                                    <input autocomplete="new-password" class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="la la-save"></i> Change Password</button>
                                <a href="{{ route('store') }}" class="btn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>


@endsection