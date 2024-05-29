<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class AuthController extends Controller
{
    //

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }
    public function loginProcess()
    {
        $validate = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => 'Perlu diisi!!!',
        ]);

        if (Auth::attempt($validate)) {
            request()->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['msg' => 'Kombinasi Salah']);
    }
    public function registerProcess()
    {
        $validate = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:5', 'confirmed'],

        ], [
            'required' => 'Perlu diisi !!!',
            'unique' => 'Username Sudah Ada !!!',
            'numeric' => 'Harus angka !!!',
            'email' => 'harus berupa emamil !!!',
            'password.min' => 'Minimal 5 Karakter !!!',
            'username.min' => 'Minimal 5 Karakter !!!'
        ]);
        $validate['roles'] = 2;
        $validate['password'] = bcrypt(request()->password);

        $data = User::create($validate);
        $data->save();
        return redirect()->route('login')->with('status', 'Register Berhasil');
    }
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('welcome');
    }
    public function deleteuser()
    {
        $user = User::find(request()->id);
        if ($user->image) {
            unlink($user->image);
        }
        $user->delete();
        return redirect()->back()->with('status', 'Berhasil Delete');
    }
    public function updateUser()
    {
        $validated = request()->validate([
            'name' => 'required',
            'password' => ['required', 'min:5',],
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        // dd($validated);
        $user = User::find(Auth::user()->id);
        if ($user->image) {
            unlink($user->image);
        }
        $manager = new ImageManager(new Driver());
        $manager->read(request()->file('file'))->encode(new WebpEncoder(90))->save('storage/images/' . request()->file('file')->hashName() . '.webp');
        // $webp_image = Image::read(request()->file('file'), new FilePathImageDecoder())->encode('webp', 90)->save('storage/images/' . request()->file('file')->hashName() . '.webp');

        $hasil = $user->update([
            'name' => $validated['name'],
            'email' => request()['email'],
            'password' => bcrypt($validated['password']),
            'profile_photo_path' => 'storage/images/' . request()->file('file')->hashName() . '.webp',
        ]);

        if (!$hasil) {
            return redirect()->back()->withErrors(['msg' => 'Gagal Update']);
        } else
            return redirect()->back()->with('status', 'Berhasil Update');
    }
}
