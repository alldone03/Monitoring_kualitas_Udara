<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\devicehave;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles == 1) {
            $device = Device::all();
            return view('pages.dashboard.admin', compact('device'));
        } else {
            $device = devicehave::where('users', '=', Auth::user()->id)->get();
            // dd($device);
            return view('pages.dashboard.user', compact('device'));
        }
    }
    public function gethistoryfend()
    {
        $data20 = History::where('device_id', '=', request()->id)->orderBy('created_at', 'desc')->take(20)->get();
        $suhu = [];
        $kelembaban = [];
        $kualitasudara = [];
        $created_at = [];
        foreach ($data20 as $key => $value) {
            $suhu[$key] = $value->suhu;
            $kelembaban[$key] = $value->kelembaban;
            $kualitasudara[$key] = $value->kualitas_udara;
            $created_at[$key] = $value->created_at;
        }
        return response()->json(['suhu' => $suhu, 'kelembaban' => $kelembaban, 'kualitasudara' => $kualitasudara, 'created_at' => $created_at]);
    }
}
