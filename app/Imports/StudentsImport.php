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

    public function startRow(): int
    {
        return 2; // Start processing from the 2nd row
    }
    public function model(array $row)
    {
        // $existing_student = Student::where([
        //     ['first_name', $row[0]],
        //     ['last_name', $row[1]],
        //     ['middle_name', $row[2] ?? null],
        //     ['municipality', $row[3]],
        //     ['province', $row[4]],
        //     ['region', $row[5] ?? null],
        //     ['course_id', $row[6]],
        //     ['campus_id', $row[7]],
        //     ['scholarship_id', $row[8]],
        // ])->first();
        
        // if ($existing_student) {
        //     // Return a message or handle the duplicate record logic here
        //     return null; // or you can log, skip, or throw an exception
        // }
        
        // // If no existing student is found, create a new one
        // return new Student([
        //     'first_name'     => $row[0],
        //     'last_name'      => $row[1],
        //     'middle_name'    => $row[2] ?? null,
        //     'address'        => null,
        //     'municipality'   => $row[3],
        //     'province'       => $row[4],
        //     'region'         => $row[5] ?? null,
        //     'latitude'       => null,
        //     'longitude'      => null,
        //     'course_id'      => $row[6],
        //     'campus_id'      => $row[7],
        //     'scholarship_id' => $row[8],
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
            return null; // Skip duplicate records
        }

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
