<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\devicehave;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    //

    public function index()
    {
        $device = Device::all();

        if (Auth::user()->roles == 1) {
            return view('pages.history.index2', compact('device'));
        } else {
            $device = [];
            $devicedata = devicehave::where('users', '=', Auth::user()->id)->get();
            foreach ($devicedata as $key => $value) {
                array_push($device, ['id' => $value->device['id'], 'nama_device' => $value->device['nama_device']]);
            }

            return view('pages.history.index2', compact('device'));
        }
    }
    public function logdevice()

    {
        // dd(request()->all());
        $device = Device::where('nama_device', '=', request()->nama_device)->first();
        if ($device != null) {
            if (strtotime(Carbon::now()) - strtotime(History::where('device_id', '=', $device->id)->latest()->first()->created_at) >= 4) {
                History::create([
                    'device_id' => $device->id,
                    'suhu' => request()->suhu,
                    'kelembaban' => request()->kelembaban,
                    'kualitas_udara' => request()->kualitas_udara,
                ]);
            }

            return response()->json(
                [
                    'message' => "Success",
                    'device_id' => $device->id,
                    'suhu' => request()->suhu,
                    'kelembaban' => request()->kelembaban,
                    'kualitas_udara' => request()->kualitas_udara,
                ]
            );
        } else {
            return response()->json([
                'message' => "ERROR",
            ]);
        }
    }
    public function history2()
    {
        // dd(History::all());
        $data = History::where('device_id', '=', request()->device)->where('created_at', '>', request()->startdate)->where('created_at', '<', request()->enddate)->latest()->paginate(10);
        // dd($data);
        foreach ($data as $key => $value) {
            $data[$key] = $value;
            $data[$key]['device'] = $value->device;
        }
        // dd(json_encode($data));
        return json_encode($data);
    }
}
