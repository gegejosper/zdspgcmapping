<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'first_name'     => $row[0],
            'last_name'      => $row[1],
            'middle_name'    => $row[2] ?? null,
            'address'        => $row[3] ?? null,
            'municipality'   => $row[4],
            'province'       => $row[5],
            'region'         => $row[6] ?? null,
            'latitude'       => $row[7] ?? null,
            'longitude'      => $row[8] ?? null,
            'course_id'      => $row[9],
            'campus_id'      => $row[10],
            'scholarship_id' => $row[11],
            'year'           => '1st Year',
            'status'         => 'active',
        ]);
    }
}
