<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ojt;
use App\Models\Attendance;
use Illuminate\Support\Facades\Log;

class QrController extends Controller
{

    public function index()
    {
        $ojts = Ojt::all();
        return view('admin.qr', compact('ojts'));
    }


    public function registerQr(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'school' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'program' => 'required|string|max:255',
        ]);

        $ojt = Ojt::create($request->all());

        $qrData = json_encode([
            'id' => $ojt->id,
            'name' => $ojt->name,
            'age' => $ojt->age,
            'school' => $ojt->school,
            'course' => $ojt->course,
            'program' => $ojt->program,
        ]);

        $ojt->update(['qr_code' => base64_encode($qrData)]);

        return redirect()->back()->with('success', 'QR Code generated successfully.');
    }

  
    public function scanQr(Request $request)
    {
        try {
            Log::info('Scanned QR Data (Raw): ' . $request->qr_data);
    
            $qrData = $request->qr_data;
    
            $decodedData = json_decode(base64_decode($qrData), true);
    
            if (!$decodedData || !isset($decodedData['id'])) {
                $decodedData = json_decode($qrData, true);
    
                if (!$decodedData || !isset($decodedData['id'])) {
                    Log::error('Invalid QR Code scanned: ' . json_encode($qrData));
                    return response()->json(['error' => 'Invalid QR Code'], 400);
                }
            }
    
            Log::info('Decoded QR Data: ' . json_encode($decodedData));
    
            $ojt = Ojt::find($decodedData['id']);
            if (!$ojt) {
                Log::warning('Student not found with ID: ' . $decodedData['id']);
                return response()->json(['error' => 'Student not found'], 404);
            }
    
            $lastAttendance = Attendance::where('ojt_id', $ojt->id)
                ->where('attendance_time', '>=', now()->subHour())
                ->first();
    
            if ($lastAttendance) {
                Log::info("Attendance already recorded for {$ojt->name} within the last hour.");
                return response()->json(['error' => 'Attendance already recorded recently'], 400);
            }
    
            
            $attendance = Attendance::create([
                'ojt_id' => $ojt->id,
                'attendance_time' => now(),
            ]);
    
            Log::info("Attendance recorded for {$ojt->name} at " . $attendance->attendance_time);
    
            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $ojt->name,
                    'age' => $ojt->age,
                    'school' => $ojt->school,
                    'course' => $ojt->course,
                    'program' => $ojt->program,
                    'attendance_time' => $attendance->attendance_time->format('Y-m-d H:i:s'),
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error scanning QR Code: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the QR Code'], 500);
        }
    }
}
