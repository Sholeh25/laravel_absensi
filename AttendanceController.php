<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use App\Employee;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Convert lat/lng -> readable address using LocationIQ (if API key set).
     * If no key or request fails, return "Lat:..., Lng:..." fallback.
     */
    private function getAddressFromCoordinates($lat, $lng)
    {
        $key = env('LOCATIONIQ_API_KEY');
        if (empty($key)) {
            return "Lat: {$lat}, Lng: {$lng}";
        }

        try {
            $url = "https://us1.locationiq.com/v1/reverse.php?key={$key}&lat={$lat}&lon={$lng}&format=json";
            $resp = @file_get_contents($url);

            if ($resp === false) {
                return "Lat: {$lat}, Lng: {$lng}";
            }

            $json = json_decode($resp);
            if (isset($json->display_name) && $json->display_name) {
                return $json->display_name;
            }
        } catch (\Exception $e) {
            // ignore fallback
        }

        return "Lat: {$lat}, Lng: {$lng}";
    }

    /**
     * AJAX endpoint: return address string for given lat/lng (POST).
     * Route should point to AttendanceController@getLocation
     */
    public function getLocation(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $address = $this->getAddressFromCoordinates(
            $request->input('lat'),
            $request->input('lng')
        );

        return response()->json($address);
    }

    /**
     * List attendances for authenticated employee.
     */
    public function index(Request $request)
    {
        $employee = optional(Auth::user())->employee;

        if (!$employee) {
            return redirect()->route('employee.index')
                ->with('error', 'Data karyawan tidak ditemukan.');
        }

        $filter = $request->input('filter') ?? $request->input('date_range') ?? null;

        $query = Attendance::where('employee_id', $employee->id)
                  ->orderBy('created_at', 'desc');

        if ($filter) {
            if (preg_match('/^\d{4}-\d{1,2}$/', $filter)) {
                [$y, $m] = explode('-', $filter);
                $query->whereYear('created_at', (int)$y)
                      ->whereMonth('created_at', (int)$m);
            } else {
                if (strpos($filter, '-') !== false) {
                    $parts = preg_split('/\s*-\s*/', $filter);

                    if (!empty($parts[0])) {
                        try {
                            $dt = Carbon::createFromFormat('d-m-Y', trim($parts[0]));
                            $query->whereYear('created_at', $dt->year)
                                  ->whereMonth('created_at', $dt->month);
                        } catch (\Exception $e) {
                            // ignore parse error
                        }
                    }
                }
            }
        }

        $attendances = $query->get();

        return view('employee.attendance.index', compact('attendances', 'filter'));
    }

    /**
     * Show register (camera) view.
     */
    public function create()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->firstOrFail();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        return view('employee.attendance.create', compact('employee', 'attendance'));
    }

    /**
     * Store "entry" attendance.
     * Expects: photo_base64, lat, lng, optionally ip_address
     */
    public function store(Request $request, $employee_id = null)
    {
        $employee = Auth::user()->employee;
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee tidak ditemukan.');
        }

        $request->validate([
            'photo_base64' => 'required|string',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $ip = $request->input('ip_address') ?: $request->ip();
        $time = Carbon::now('Asia/Jakarta')->format('H:i:s');

        // decode base64 image
        $data = $request->input('photo_base64');
        if (preg_match('/^data:(image\/\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $decoded = base64_decode($data);
            $mime = $type[1]; // image/jpeg
            $ext = explode('/', $mime)[1];
        } else {
            $decoded = base64_decode($data);
            $ext = 'jpg';
        }

        if ($decoded === false) {
            return redirect()->back()->with('error', 'Gagal decode foto.');
        }

        // generate filename + save to public disk (storage/app/public/attendance_photos)
        $filename = 'entry_' . time() . '_' . $employee->id . '_' . Str::random(6) . '.' . $ext;
        $relativePath = 'attendance_photos/' . $filename;

        try {
            Storage::disk('public')->put($relativePath, $decoded);
        } catch (\Exception $e) {
            $fallback = storage_path('app/public/attendance_photos');
            if (!file_exists($fallback)) mkdir($fallback, 0755, true);
            file_put_contents($fallback . DIRECTORY_SEPARATOR . $filename, $decoded);
        }

        $location = $this->getAddressFromCoordinates($lat, $lng);

        $attendance = new Attendance();
        $attendance->employee_id = $employee->id;
        $attendance->entry_ip = $ip;
        $attendance->entry_location = $location;
        $attendance->entry_latitude = $lat;
        $attendance->entry_longitude = $lng;
        $attendance->entry_photo = $filename;
        $attendance->registered = 'ya';
        $attendance->time = $time;
        $attendance->save();

        return redirect()->route('employee.attendance.index')
            ->with('success', 'Absensi masuk berhasil dicatat.');
    }

    /**
     * Update attendance -> record exit.
     */
    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'photo_base64' => 'required|string',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $ip = $request->input('ip_address') ?: $request->ip();
        $time = Carbon::now('Asia/Jakarta')->format('H:i:s');

        $data = $request->input('photo_base64');
        if (preg_match('/^data:(image\/\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $decoded = base64_decode($data);
            $mime = $type[1];
            $ext = explode('/', $mime)[1];
        } else {
            $decoded = base64_decode($data);
            $ext = 'jpg';
        }

        if ($decoded === false) {
            return redirect()->back()->with('error', 'Gagal decode foto exit.');
        }

        $filename = 'exit_' . time() . '_' . $attendance->employee_id . '_' . Str::random(6) . '.' . $ext;
        $relativePath = 'attendance_photos/' . $filename;

        try {
            Storage::disk('public')->put($relativePath, $decoded);
        } catch (\Exception $e) {
            $fallback = storage_path('app/public/attendance_photos');
            if (!file_exists($fallback)) mkdir($fallback, 0755, true);
            file_put_contents($fallback . DIRECTORY_SEPARATOR . $filename, $decoded);
        }

        $location = $this->getAddressFromCoordinates($lat, $lng);

        $attendance->exit_ip = $ip;
        $attendance->exit_location = $location;
        $attendance->exit_latitude = $lat;
        $attendance->exit_longitude = $lng;
        $attendance->exit_photo = $filename;
        $attendance->save();

        return redirect()->route('employee.attendance.index')
            ->with('success', 'Absensi keluar berhasil dicatat.');
    }
}
