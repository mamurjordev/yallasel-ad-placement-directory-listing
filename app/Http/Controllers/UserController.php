<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    use ApiResponser;

    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('User/List', [
            'users' => DB::table('users')->orderBy('name')->paginate(20)
        ]);
    }

    public function emailCheck(Request $request)
    {
        $email = $request->email;
        $db = DB::table('users')->where('email', $email)->first();
        if ($db) {
            return true;
        } else {
            return false;
        }
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) :
            $request->session()->regenerate();

            $checkEmailVarification = DB::table('users')->where('email', $request->email)->get();
            // dd($checkEmailVarification[0]->email);
            if ($checkEmailVarification[0]->email_verified_at == null) {
                // $request->session()->regenerate();
                // dd($request->session()->all());
                // return back()->withErrors([
                //     'email' => 'Varify your email to Login.',
                // ]);
                return redirect('/email/verify');
            } else {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }
        else :
            $msg = "Incorrect Email or Password.";
            return Redirect::back()->withErrors(['msg' => $msg]);
        endif;

        // return Redirect::route('home');
    }

    public function reRegister()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $checkEmailVarification = DB::table('users')->where('email', $request->email)->get();
        // dd($checkEmailVarification[0]->email);
        if ($checkEmailVarification[0]->email_verified_at == null) :
            return back()->withErrors([
                'email' => 'Varify your email to Login.',
            ]);
        else :
            if (Auth::attempt($credentials)) :
                $request->session()->regenerate();
                return redirect('/panel');
            else :
                $msg = "Incorrect Email or Password.";
                return Redirect::back()->withErrors([$msg]);
            endif;

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        endif;
    }

    // public function mailVerification()
    // {
    //     $user = DB::table('users')->where('id', Auth::user()->id)->first();
    //     $user->sendEmailVerificationNotification();
    // }

    public function Register(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'username' => trim($request->input('name')) . rand(1, 100),
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        Payment::create([
            'user_id' => $user->id
        ]);

        \App\Models\AccountSetting::create([
            'user_id' => $user->id,
        ]);

        // $user->sendEmailVerificationNotification();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $lang = session()->has('lang') ? session()->get('lang') : 'ar';
            $request->session()->regenerate();
            $request->session()->put('lang', $lang);
        };

        return redirect('/email/verify')->with('email', $request->email);
    }

    public function role(User $user)
    {
        if ($user->id == Auth::user()->id) return back();

        $role = $user->role == 'user' ? 'admin' : 'user';

        $user->role = $role;
        $user->save();

        return back();
    }

    public function userPosts($user_id)
    {
        $posts = DB::table('posts')
            ->where('posts.user_id', $user_id)
            ->join('regions', 'posts.region_id', '=', 'regions.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('post_attributes', 'post_attributes.id', '=', 'posts.id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('posts.id', 'posts.title', 'posts.created_at', 'posts.expected_price', 'regions.region_name', 'post_images.image', 'categories.category_name', 'post_attributes.post_attribute')
            ->paginate(10);
        return Inertia::render('userPosts', [
            'posts' => $posts
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id) return back();
        $user->delete();
        return back();
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect('/panel/login');
    }
}
