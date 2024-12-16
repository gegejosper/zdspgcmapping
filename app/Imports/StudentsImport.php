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
        // return new Student([
        //     'first_name'     => $row[0],
        //     'last_name'      => $row[1],
        //     'middle_name'    => $row[2] ?? null,
        //     'address'        => $row[3] ?? null,
        //     'municipality'   => $row[4],
        //     'province'       => $row[5],
        //     'region'         => $row[6] ?? null,
        //     'latitude'       => null,
        //     'longitude'      => null,
        //     'course_id'      => $row[7],
        //     'campus_id'      => $row[8],
        //     'scholarship_id' => $row[9],
        //     'year'           => '1st Year',
        //     'status'         => 'active',
        // ]);

        $existing_student = Student::where([
            ['first_name', $row[0]],
            ['last_name', $row[1]],
            ['middle_name', $row[2] ?? null],
            ['municipality', $row[3]],
            ['province', $row[4]],
            ['region', $row[5] ?? null],
            ['course_id', $row[6]],
            ['campus_id', $row[7]],
            ['scholarship_id', $row[8]],
        ])->first();
        
        if ($existing_student) {
            // Return a message or handle the duplicate record logic here
            return null; // or you can log, skip, or throw an exception
        }
        
        // If no existing student is found, create a new one
        return new Student([
            'first_name'     => $row[0],
            'last_name'      => $row[1],
            'middle_name'    => $row[2] ?? null,
            'address'        => null,
            'municipality'   => $row[3],
            'province'       => $row[4],
            'region'         => $row[5] ?? null,
            'latitude'       => null,
            'longitude'      => null,
            'course_id'      => $row[6],
            'campus_id'      => $row[7],
            'scholarship_id' => $row[8],
            'year'           => '1st Year',
            'status'         => 'active',
        ]);
    }
}
