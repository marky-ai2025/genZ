<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // ✅ Skip rows if the required fields are missing
        if (!isset($row['lastname']) || empty($row['lastname'])) {
            return null;
        }

        return new Student([
            'lastname'    => $row['lastname'],
            'firstname'   => $row['firstname'],
            'middlename'  => $row['middlename'],
            'gender'      => $row['gender'],
            'birthday'    => $this->formatDate($row['birthday']), // ✅ Convert birthday format
            'address'     => $row['address'],
            'school'      => $row['school'],
            'course'      => $row['course'],
            'program'     => $row['program'],
            'civilstatus' => $row['civilstatus'],
            'religion'    => $row['religion'],
        ]);
    }

    // ✅ Function to format Excel date correctly
    private function formatDate($date)
    {
        if (is_numeric($date)) {
            return Date::excelToDateTimeObject($date)->format('Y-m-d'); // Convert Excel serial date
        } else {
            return date('Y-m-d', strtotime($date)); // Convert 'mm/dd/yyyy' to 'YYYY-MM-DD'
        }
    }
}
