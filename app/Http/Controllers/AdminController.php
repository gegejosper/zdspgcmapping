<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Student;
use App\Models\Course;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    //
    public function index() {
        $courses = Course::all();
        $campuses = Campus::all(['campus_name', 'map_color', 'address', 'id']);
        $students = Student::with('course_details', 'campus_details', 'scholarship_details')
            ->where('status', 'active')
            ->get(['municipality', 'province', 'campus_id', 'course_id', 'scholarship_id'])
            ->groupBy(function($item) {
                return $item->municipality . ', ' . $item->province;
            });
        $distance = 0;
        $campus_address = 'Aurora, Zamboanga del Sur';
        $origin_coordinates = $this->getCoordinates($campus_address);
        $locations_list = array();
        foreach($students as $location => $student_group){
            $destination_coordinates = $this->getCoordinates($location);
    
            if (!$origin_coordinates || !$destination_coordinates) {
                //return response()->json(['error' => 'Unable to find coordinates for one or both locations'], 400);
                $distance_km = 'n/a';
            }
    
            // Get the distance between the coordinates using Mapbox Directions API
            $distance_km = $this->calculateDistance($origin_coordinates, $destination_coordinates);

            $location_data = [
                'address' => $location,
                'address_count' => $student_group->count(),
                'distance' => $distance_km,
                'campuses' => []
            ];

            // if($distance >= $distance_km){
                $locations_list[] = $location_data;
            // }
            

        }
        $filter_data = null;
        $main_address = $campus_address;
        return view('dashboard', compact('courses', 'campuses', 'students', 'distance', 'locations_list', 'filter_data', 'main_address'));
    }
    public function filter_campus(Request $req){
        $courses = Course::all();
        $campuses = Campus::all(['campus_name', 'map_color', 'address', 'id']);
        //$students = Student::with('course_details', 'campus_details', 'scholarship_details')->where('status', 'active')->get(['municipality', 'province', 'campus_id', 'course_id', 'scholarship_id']);
        $students = Student::with('course_details', 'campus_details', 'scholarship_details')
            ->where('status', 'active')
            ->where('campus_id', $req->campus)
            ->get(['municipality', 'province', 'campus_id', 'course_id', 'scholarship_id'])
            ->groupBy(function($item) {
                return $item->municipality . ', ' . $item->province;
            });
        //dd($students);
        $distance = $req->radius;
        $campus_data = Campus::find($req->campus);
        $campus_address = $campus_data->address;
        $origin_coordinates = $this->getCoordinates($campus_address);
        $locations_list = array();

        $scholarships = Scholarship::get(); // List of all scholarships
        $scholarship_counts = [];
        foreach ($scholarships as $scholarship) {
            $scholarship_counts[$scholarship->id] = [
                'name' => $scholarship->scholarship_name,
                'count' => 0,
            ];
        }

        $courses = Course::where('status', 'active')->get();
        $course_counts = [];
        foreach ($courses as $course) {
            $course_counts[$course->id] = [
                'name' => $course->course_name,
                'count' => 0,
            ];
        }
        foreach($students as $location => $student_group){
            $destination_coordinates = $this->getCoordinates($location);
    
            if (!$origin_coordinates || !$destination_coordinates) {
                //return response()->json(['error' => 'Unable to find coordinates for one or both locations'], 400);
                $distance_km = 'n/a';
            }
    
            // Get the distance between the coordinates using Mapbox Directions API
            $distance_km = $this->calculateDistance($origin_coordinates, $destination_coordinates);

            $location_data = [
                'address' => $location,
                'address_count' => $student_group->count(),
                'distance' => $distance_km,
                'campuses' => []
            ];

            if($distance >= $distance_km){
                $locations_list[] = $location_data;
                foreach ($student_group as $student) {
                    if (isset($scholarship_counts[$student->scholarship_id])) {
                        $scholarship_counts[$student->scholarship_id]['count'] += 1;
                    }
                    if (isset($course_counts[$student->course_id])) {
                        $course_counts[$student->course_id]['count'] += 1;
                    }
                }  
            }
        }
        $filter_data = [
            'campus' => $campus_data->campus_name,
            'campus_address' => $campus_data->address,
            'radius' => $distance
        ];
        $main_address = $campus_data->address;
        return view('dashboard', compact('courses','campuses', 'students', 'distance', 'locations_list', 'filter_data', 'main_address', 'scholarship_counts', 'course_counts'));
    }
    private function getCoordinates($address){
        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" . urlencode($address) . ".json";

        $response = Http::get($url, [
            'access_token' => 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A',
            'limit' => 1,
        ]);

        $data = $response->json();

        if (isset($data['features'][0]['geometry']['coordinates'])) {
            // Coordinates are in the format [longitude, latitude]
            return implode(',', $data['features'][0]['geometry']['coordinates']);
        }

        return null;
    }
    private function calculateDistance($origin_coordinates, $destination_coordinates, $use_straight_line = true){
        if ($use_straight_line) {
            // Parse the coordinates
            list($lon1, $lat1) = explode(',', $origin_coordinates);
            list($lon2, $lat2) = explode(',', $destination_coordinates);
    
            // Radius of Earth in kilometers
            $earth_radius_km = 6371;
    
            // Convert latitude and longitude from degrees to radians
            $d_lat = deg2rad($lat2 - $lat1);
            $d_lon = deg2rad($lon2 - $lon1);
    
            $a = sin($d_lat / 2) * sin($d_lat / 2) +
                 cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                 sin($d_lon / 2) * sin($d_lon / 2);
    
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
            $distance = $earth_radius_km * $c;
    
            return $distance; // Distance in kilometers (straight line)
        } else {
            // Use Mapbox API to get the road distance
            $url = "https://api.mapbox.com/directions/v5/mapbox/driving/{$origin_coordinates};{$destination_coordinates}";
    
            $response = Http::get($url, [
                'access_token' => 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A',
                'geometries' => 'geojson',
                'overview' => 'full',
            ]);
    
            $data = $response->json();
    
            if (isset($data['routes'][0]['distance'])) {
                return $data['routes'][0]['distance'] / 1000; // Convert meters to kilometers
            }
        }
    
        return null;
    
    }
    public function search_students(Request $req){
        $searchTerm = '%'.$req->search_query.'%';
        $keyword = $req->search_query;
        $students = Student::where(function($query) use ($searchTerm){
                            $query->where('first_name','LIKE', $searchTerm)
                            ->orWhere('last_name','LIKE', $searchTerm);
                        })->orderBy('last_name', 'asc')
                        ->orderBy('first_name', 'asc')
                        ->with('course_details')->paginate(200);
       //dd($students);
        return view('students.students', compact('students', 'keyword'));
    }
}
