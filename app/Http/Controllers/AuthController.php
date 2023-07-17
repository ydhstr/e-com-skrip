<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Store;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (auth()->attempt($credentials)) {
            $token = Auth::guard('api')->attempt($credentials);
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'token' => $token
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'email atau password salah'
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'detail_alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $Member = Member::create($input);

        return response()->json([
            'data' => $Member
        ]);
    }

    public function login_member()
    {
        return view('auth.login_member');
    }

    public function login_member_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/login_member');
        }

        $credentials = $request->only('email', 'password');
        $member = Member::where('email', $request->email)->first();

        if ($member) {
            if (Auth::guard('webmember')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/');
            } else {
                Session::flash('failed', "Email atau password salah");
                return redirect('/login_member');
            }
        } else {
            Session::flash('failed', "Email atau password salah");
            return redirect('/login_member');
        }
    }

    public function register_member()
    {
        return view('auth.register_member');
    }

    public function register_member_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/register_member');
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        unset($input['konfirmasi_password']);
        Member::create($input);

        Session::flash('success', 'Account successfully created!');
        return redirect('/login_member');
    }

    public function logout()
    {
            Auth::guard('web')->logout();
            Session::flush();
            return redirect('/login');
    }

    public function logout_member()
    {
        Auth::guard('webmember')->logout();
        Session::flush();
        return redirect('/');
    }

    public function login_store()
    {
        return view('auth.login_store');
    }
    public function registers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_store' => 'required',
            'alamat' => 'required',
            'social_media' => 'required',
            'online_store' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $Store = Store::create($input);

        return response()->json([
            'data' => $Store
        ]);
    }
    public function login_store_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/login_store');
        }

        $credentials = $request->only('email', 'password');
        $store = Store::where('email', $request->email)->first();

        if ($store) {
            if (Auth::guard('webstore')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/dashboard');
            } else {
                Session::flash('failed', "Email atau password salah");
                return redirect('/login_store');
            }
        } else {
            Session::flash('failed', "Email atau password salah");
            return redirect('/login_store');
        }
    }

    public function register_store()
    {
        return view('auth.register_store');
    }
    
    public function register_store_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_store' => 'required',
            'alamat' => 'required',
            'social_media' => 'required',
            'online_store' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors()->toArray());
            return redirect('/register_store');
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        unset($input['konfirmasi_password']);
        Store::create($input);

        Session::flash('success', 'Account successfully created!');
        return redirect('/login_store');
    }

    public function logout_store()
    {
        Auth::guard('webstore')->logout();
        Session::flush();
        return redirect('/');
    }
}
