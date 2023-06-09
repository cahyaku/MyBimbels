<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function pendaftaranSiswa($enrollments, $classes, $lecturers, $students)
{
    $classId = -1;
    $studentId = -1;

    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        echo "\n" . "PENDAFTARAN SISWA KELAS";

        $searchResult = searchClasses($enrollments, $classes, $lecturers, $students);
        if (count($searchResult) > 0) {
            while (true) {
                echo "\n" . "Pilih kelas: ";
                $input = getNumeric();
                $target = $input - 1;

                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                } else {
                    $classId = $searchResult[$target]["id"];
                    break;

                    // for ($i = 0; $i < count($classes); $i++) {
                    //     if ($id == $enrollments[$i]["id"]) {
                    //         // $Classes = $enrollments[$i];
                    //         echo "Menambahkan siswa untuk kelas " . '"' . $searchResult[$target]["name"] . '".' . "\n";
                    //         $newEnrollments = getSiswa($students, $classes, $enrollments, $lecturers);

                    //         echo "Siswa " . '"' . $newEnrollments[$target]["name"] . '"' . " telah ditambahkan pada kelas " .  '"' . $searchResult[$target]["name"] . '".' . "\n";
                    //         // echo "Siswa " . '"' . '"' . " telah ditambahkan pada kelas " .  '"' . $searchResult[$target]["name"] . '".' . "\n";
                    //     }
                    //     // break;
                    // }
                }
            }
        }
    }
    // pencarian siswa 
    if (count($students) == 0) {
        echo "Empty Data" . "\n";
    } else {
        while (true) {
            $studentId = askForStudent($students, $classes, $enrollments, $lecturers);

            if ($classId != -1 && $studentId != -1) {
                $enrollments[] = [
                    "id" => generateId($enrollments),
                    "classId" => $classId,
                    "studentId" => $studentId,
                ];
            }
            return $enrollments;
        }
    }
    return -1;
}

/**
 * function untuk mendapatkan data siswa yang akan didaftarkan ke bimbels
 */
function askForStudent(array $students, array $classes, array  $enrollments, array $lecturers): int
{
    if (count($students) == 0) {
        echo "Empty Data" . "\n";
    } else {
        $searchResult = searchStudents($students, $classes, $enrollments, $lecturers);
        if (count($searchResult) > 0) {
            // while (true) {
            echo "\n" . "Pilih siswa yang akan ditambahakan di kelas ini: ";
            $input = getNumeric();
            $target = $input - 1;

            if ($input > count($searchResult) || $input <= 0) {
                echo "Ordinal number was not found!" . "\n";
                // break;
            } else {
                return $searchResult[$target]["id"];
            }
            // }
        }
    }
    return -1;
}
