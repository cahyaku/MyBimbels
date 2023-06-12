<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function pendaftaranSiswa(array $enrollments, array $classes, array $lecturers, array $students)
{
    $classId = -1;
    $studentId = -1;
    echo "\n" . "PENDAFTARAN SISWA KELAS";

    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        $searchClass = searchClasses($enrollments, $classes, $lecturers, $students);
        if (count($searchClass) > 0) {
            while (true) {
                echo "\n" . "Pilih kelas: ";
                $input = getNumeric();
                $target = $input - 1;
                if ($input > count($searchClass) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                } else {
                    $classId = $searchClass[$target]["id"];
                    echo "Menambahkan siswa untuk kelas " . '"' . $searchClass[$target]["name"] . '".' . "\n";
                    break;
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
            // tampilkan nama siswa dan kelas yang dipilih 
            echo "Siswa " . '"' . $studentId . '"' . " telah ditambahkan pada kelas " .  '"' . $searchClass[$target]["name"] . '".' . "\n";
            echo "Data kelas " . '"' . $searchClass[$target]["name"] . '"' . " telah diperbarui!" . "\n";
            return $enrollments;
        }
    }
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
                // echo  $searchResult[$target]["name"];
            }
            // }
        }
    }
    return -1;
}
