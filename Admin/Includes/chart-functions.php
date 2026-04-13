<?php
/**
 * Logic to build a calendar array with attendance status
 */
function getCalendarData($conn, $admissionNo, $month, $year) {
    // Determine the number of days in the chosen month/year
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $calendar = [];

    for ($day = 1; $day <= $daysInMonth; $day++) {
        // Format date to match the 'dateTimeTaken' column (YYYY-MM-DD)
        $date = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT);
        
        // Query the status for the specific student and date
        $sql = "SELECT status FROM tblattendance WHERE admissionNo = '$admissionNo' AND dateTimeTaken = '$date' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $calendar[$day] = [
            'status' => ($row) ? $row['status'] : 'no_record' // 1: Present, 0: Absent, no_record: Holiday/N/A
        ];
    }
    return $calendar;
}
?>