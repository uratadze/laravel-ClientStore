<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PersonInfoRequest;
use App\Http\Requests\AccountInfoRequest;
use App\Http\Requests\PasswordChangeRequest;



class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(Auth::user());
        return view('dashboard')
            ->with('person', (new Person)->currentPerson());
    }

    /**
     * Change person identify informations.
     * 
     * @param App\Http\Requests\PersonInfoRequest
     * @param App\Models\Person
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePersonInfo(PersonInfoRequest $request, person $person)
    {
        $person = $person->currentPerson();
        $person->first_name = $request->firstname;
        $person->last_name  = $request->lastname;
        $person->Address    = $request->address;
        $person->passport   = $request->passport;
        $person->city       = $request->city;
        $person->number     = $request->number;
        $person->client     = Auth::id();
        $person->save();
        return back()->with('success', __('Personal ინფორმაცია წარმატებით შეიცვალა'));
    }

    /**
     * Change person account informations.
     * 
     * @param App\Http\Requests\AccountInfoRequest
     * @return Illuminate\Support\Facades\Response
     */
    public function changeAccountInfo(AccountInfoRequest $request)
    {
        $client = Auth::user();
        $client->name  = $request->name;
        $client->email = $request->email;
        $client->save(); 
        return back()->with('success', __('Account ინფორმაცია წარმატებით შეიცვალა'));
    }

    /**
     * Change person account password.
     * 
     * @param App\Http\Requests\PasswordChangeRequest
     * @return Illuminate\Support\Facades\Response
     */
    public function changePassword(PasswordChangeRequest $request)
    {
        $client = Auth::user();
        if(! Hash::check($request->old_password, $client->password))
        {
            return back()->with('error', __('პაროლი არასწორია')); //with error code (password is wrong)
        }
        $client->password = Hash::make($request->password);
        $client->save();
        return back()->with('success', __('პაროლი წარმატებით შეიცვალა'));
    }
}
