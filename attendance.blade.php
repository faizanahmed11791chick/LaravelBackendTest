<!-- attendance.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Information</title>
</head>
<body>
    <h1>Employee Attendance Information</h1>

    <!-- Upload Attendance Form -->
    <form id="uploadForm">
        <label for="employeeId">Employee ID:</label>
        <input type="text" id="employeeId" name="employee_id" required>

        <label for="checkin">Check-in:</label>
        <input type="datetime-local" id="checkin" name="checkin" required>

        <label for="checkout">Check-out:</label>
        <input type="datetime-local" id="checkout" name="checkout" required>

        <button type="button" onclick="uploadAttendance()">Upload Attendance</button>
    </form>

    <hr>

    <!-- Display Employee Attendance -->
    <h2>Employee Attendance</h2>
    <ul id="attendanceList"></ul>

    <script>
        // JavaScript to interact with the API endpoints
        async function uploadAttendance() {
            const formData = new FormData(document.getElementById('uploadForm'));

            try {
                const response = await fetch('/upload-attendance', {
                    method: 'POST',
                    body: formData,
                });

                const data = await response.json();
                alert(data.message);
            } catch (error) {
                console.error('Error uploading attendance:', error);
            }
        }

        async function getEmployeeAttendance() {
            try {
                const employeeId = document.getElementById('employeeId').value;
                const response = await fetch(`/get-employee-attendance?employee_id=${employeeId}`);
                const data = await response.json();

                const attendanceList = document.getElementById('attendanceList');
                attendanceList.innerHTML = '';

                data.attendance.forEach(entry => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `Check-in: ${entry.checkin}, Check-out: ${entry.checkout}`;
                    attendanceList.appendChild(listItem);
                });
            } catch (error) {
                console.error('Error fetching employee attendance:', error);
            }
        }

        // Initial load of attendance
        getEmployeeAttendance();
    </script>
</body>
</html>
