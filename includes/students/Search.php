<?php

require_once "Utils.php";


/**
 * function untuk search siswa
 * 
 * @param array $persons data dari siswa yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh siswa
 */
function searchStudent(array $students, array $classes, array  $enrollments, array $lecturers): array
{
    if (count($students) == 0) {
        echo "empty data" . "\n";
    } else {
        // while (true) {
        // meminta inputan nama siswa dari user
        echo "\n" . "Nama siswa: ";
        $inputDataStudents = preg_quote(getString());
        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan siswa
        for ($i = 0; $i < count($students); $i++) {
            if (preg_match("/$inputDataStudents/i", $students[$i]["name"])) {
                if (in_array($students[$i]["nisn"], $searchResult) == false) {
                    $searchResult[] = $students[$i];
                }
            }
        }

        if (count($searchResult) == 0) {
            echo "Data siswa tidak ditemukan!" . "\n";
        } else {
            showStudentsInfo($searchResult, $classes, $enrollments, $lecturers);
        }
    }
    return $searchResult;
}
