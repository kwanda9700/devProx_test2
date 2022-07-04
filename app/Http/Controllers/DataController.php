<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Carbon\Carbon;
use File;
use Session;

class DataController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $member = new Data;
        ini_set('max_execution_time', 1800);

        $numOfRecords = $request->records;
        $format = 'Y/m/d';

        $nameArray = array(
            "Jesse", "Campbell",
            "Ernest", "Rogers",
            "Theresa", "Patterson",
            "Henry", "Simmons",
            "Michelle", "Perry",
            "Bruce", "Cook",
            "Frank", "Butler",
            "Shirley", "Carolyn",
            "Albert", "Walker",
            "Randy", "Reed"
        );

        $surnameArray = array(
            "Ralph", "Clark",
            "Jean", "Alexander",
            "Ruth", "Jackson",
            "Debra", "Allen",
            "Gerald", "Harris",
            "Stephen", "Roberts",
            "Eric", "Long",
            "Amanda", "Scott",
            "Teresa", "Diaz",
            "Wanda", "Thomas"
        );

        $startDate = "90 years ago";
        $endDate = "18 years ago";

        DataController::createCSVFile($nameArray, $surnameArray, $numOfRecords, $startDate, $endDate, $format);
        return view('upload');
    }

    public function createCSVFile($nameArray, $surnameArray, $numOfRecords, $startDate, $endDate, $format)
    {
        $id = 0;
        $fullNameArray = [['name' => 'Name', 'surname' => 'Surname', 'initial' => 'Initial', 'age' => 'Age', 'date_of_birth' => 'Date Of Birth']];

        for ($i = 0; $i < $numOfRecords; $i++) {
            $id++;
            $newName = $nameArray[rand(0, count($nameArray) - 1)];
            $newSurnameName = $surnameArray[rand(0, count($surnameArray) - 1)];
            $initial = DataController::getInitial($newName);
            $birth_date = DataController::randomDate($startDate, $endDate, $format);
            $age = DataController::getAge($birth_date);

            $name = $id . "," .  $newName . "," . $newSurnameName . "," . $initial . "," . $age . "," . $birth_date;

            if (!in_array($name, $fullNameArray)) {
                $fullNameArray[] = [
                    'name' => $newName,
                    'surname' => $newSurnameName,
                    'initial' => $initial,
                    'age' => $age,
                    'date_of_birth' => $birth_date
                    // 'created_at' => $currentTime,
                    // 'updated_at' => $currentTime
                ];
            } else {
                $id--;
            }
        }

        DataController::createFolder();

        if ($i == $numOfRecords) {
            $folderPath = public_path('output\output.csv');
            if (file_exists($folderPath)) {
                unlink($folderPath);
            }
            $folderPath = public_path('output\output.csv');
            $file = fopen($folderPath, 'a');

            foreach ($fullNameArray as $line) {
                fputcsv($file, $line);
            }

            fclose($file);
        }
    }

    public function getInitial($name)
    {
        $words = explode(" ", $name);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
            return $acronym;
        }
    }

    public function createFolder()

    {
        $path = public_path('output');



        if (!File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
        }
    }

    function randomDate($startDate, $endDate, $format)
    {
        $fMin = strtotime($startDate);
        $fMax = strtotime($endDate);

        $fVal = mt_rand($fMin, $fMax);

        return date($format, $fVal);
    }

    function getAge($birth_date)
    {
        $birth_date = explode("/", $birth_date);
        $age = (date("md", date("U", mktime(0, 0, 0, $birth_date[2], $birth_date[1], $birth_date[0]))) > date("md")
            ? ((date("Y") - $birth_date[0]) - 1)
            : (date("Y") - $birth_date[0]));
        return $age;
    }

    public function cancel()
    {
        return redirect('index');
    }

    public function upload(Request $request)
    {
        if ($request->input('submit') != null) {

            $file = $request->file('file');

            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            $valid_extension = array("csv");

            $maxFileSize = 73400320;

            if (in_array(strtolower($extension), $valid_extension)) {

                if ($fileSize <= $maxFileSize) {
                    $location = 'output';

                    $file->move($location, $filename);

                    $filepath = public_path($location . "/" . $filename);
                    $currentTime = Carbon::now();

                    $file = fopen($filepath, "r");
                    fgetcsv($file, 1000, ",");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    foreach ($importData_arr as $importData) {

                        $insertData = array(
                            "name" => $importData[0],
                            "surname" => $importData[1],
                            "initial" => $importData[2],
                            "age" => $importData[3],
                            "date_of_birth" => $importData[4],
                            'created_at' => $currentTime,
                            'updated_at' => $currentTime
                        );
                        Data::insertData($insertData);
                    }

                    // Session::flash('message', 'Import Successful.');
                    return view('success');
                } else {
                    Session::flash('message', 'File too large. File must be less than 70MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension.');
            }
        }

        return view('upload');
    }

    public function success()
    {
        return view('success');
    }
}
