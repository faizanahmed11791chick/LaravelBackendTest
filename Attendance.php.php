// AttendanceService.php

namespace App\HumanResources\Attendance\Application;

use App\HumanResources\Attendance\Domain\Attendance;

class AttendanceService
{
    public function uploadAttendance($employeeId, $checkin, $checkout)
    {
        return Attendance::create([
            'employee_id' => $employeeId,
            'checkin' => $checkin,
            'checkout' => $checkout,
        ]);
    }

    public function getEmployeeAttendance($employeeId)
    {
        return Attendance::where('employee_id', $employeeId)->get();
    }
}
