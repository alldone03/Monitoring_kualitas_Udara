<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\devicehave;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $hasilambil = [];
        $device = Device::all();
        $binddevice = devicehave::all();
        foreach ($binddevice as $bind) {
            if ($bind->user['role']->id != 1) {
                array_push($hasilambil, [
                    'id' => $bind->id,
                    'namadevice' => $bind->device['nama_device'], 'iddevice' => $bind->device['id'],
                    'iduser' => $bind->user['id'], 'namauser' => $bind->user['name']
                ]);
            }
        }
        return view('pages.managedevice.index', compact('device', 'hasilambil'));
    }
    public function store()
    {

        $validate = request()->validate([
            'nama_device' => 'required|min:5|unique:devices',

        ], [
            'required' => 'Perlu diisi!!!',
        ]);
        Device::create($validate);
        History::create([
            'device_id' => Device::latest()->first()->id,
            'suhu' => 0.0,
            'kelembaban' => 0.0,
            'kualitas_udara' => 0,
        ]);
        return response()->json([
            'message' => "Success",
        ]);
    }
    public function deletedevice()
    {
        $device = Device::find(request()->id);
        $device->delete();
        return redirect()->back()->with('status', 'Berhasil Delete');
    }
    public function bindusertodeviceshow()
    {

        $user = User::where('roles', '<>', 1)->get();
        $device = Device::all();
        return response()->json(['user' => $user, 'device' => $device]);
    }
    public function bindusertodevice()
    {
        $validate = request()->validate([
            'selectuser' => 'required',
            'selectdevice' => 'required',
        ], [
            'required' => 'Perlu diisi!!!',
        ]);
        if (devicehave::where('users', '=', $validate['selectuser'])->where('devices', '=', $validate['selectdevice'])->count() <= 0) {
            devicehave::create(['devices' => $validate['selectdevice'], 'users' => $validate["selectuser"]]);
        } else {
            return response()->json(['gagal' => 'Device dan user telah di Bind']);
        }
        return response()->json(['success' => 'Device successfully Bind']);
    }
    public function bindusertodevicedelete()
    {
        $device = devicehave::find(request()->id);
        $device->delete();
        return redirect()->back()->with('status', 'Berhasil Delete');
    }
    public function edit(Device $device)
    {
        return response()->json($device);
    }
    public function update(Device $device)
    {
        $validate = request()->validate([
            'nama_device' => 'required|min:5|unique:devices,nama_device,' . $device->id,

        ], [
            'required' => 'Perlu diisi!!!',
        ]);
        $device->update($validate);
        return response()->json(['success' => 'Device successfully update']);
    }
    
}