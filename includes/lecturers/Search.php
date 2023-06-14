<?php

require_once "Utils.php";
require_once "LecturerUtils.php";


/**
 * function untuk search lecturers
 * 
 * @param array $lecturers data dari pengajar yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh pengajar
 */
function searchPengajar(array $lecturers, $classes): array
{
    if (count($lecturers) == 0) {
        echo "empty data" . "\n";
    } else {
        // while (true) {
        // meminta inputan nama pengajar dari user
        echo "\n" . "Nama pengajar: ";
        $inputDataPerson = preg_quote(getString());

        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan pengajar
        for ($i = 0; $i < count($lecturers); $i++) {
            if (preg_match("/$inputDataPerson/i", $lecturers[$i]["name"])) {
                if (in_array($lecturers[$i]["nik"], $searchResult) == false) {
                    $searchResult[] = $lecturers[$i];
                }
            }
        }

        if (count($searchResult) == 0) {
            echo "Data pengajar tidak ditemukan!" . "\n";
        } else {
            // loop untuk menampilkan data pengajar
            for ($i = 0; $i < count($searchResult); $i++) :
                showTeacher($searchResult, $classes);
                // showTeacher($persons, $classes);
                break;
            endfor;
            // break;
        }
    }
    // }
    return $searchResult;
}
