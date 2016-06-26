<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Gate;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('is-admin')) {
            abort(500, "Must have admin privilige for this action.");
        }

        $users = User::sortable(['created_at' => 'desc'])->paginate(15);
        return view('user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {
        $newUser = new User($request->getValidInputs());
        $newUser->ip_when_created = \Request::ip();
        $newUser->password = \Hash::make($request->get('password'));
        $newUser->save();

        Email::sendAccountCreated($newUser);

        \Notifications::add('OK! Further instructions were sent to provided email.', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // =========================================================================
    
    /**
     * Settings screen where user can change password.
     */
    public function settings(Request $request) {
        $user = \Auth::user();
        return view('user.settings')->with(compact('user', 'request'));
    }

    /**
     * Endpoint for changing the password.
     */
    public function changePassword(UserRequest $request) {

        // Get authenticated user
        $user = \Auth::user();

        // Get subset of actual input fields to consider
        $input = $request->getValidInputs();

        // Hash password
        $input['password'] = \Hash::make($input['password']);

        // Update user object
        $user->update($input);

        \Notifications::add('Your password has been changed.', 'success');

        if ($request->has('_redirect_url')) {
            return redirect($request->get('_redirect_url'));
        } else {
            return redirect()->route('user.settings');
        }
    }

}
