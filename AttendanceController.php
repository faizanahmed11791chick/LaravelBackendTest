// AttendanceController.php

namespace App\Http\Controllers;

use App\HumanResources\Attendance\Application\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function uploadAttendance(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        $this->attendanceService->uploadAttendance($employeeId, $checkin, $checkout);

        return response()->json(['message' => 'Attendance uploaded successfully']);
    }

    public function getEmployeeAttendance(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $attendance = $this->attendanceService->getEmployeeAttendance($employeeId);

        return response()->json(['attendance' => $attendance]);
    }
}
