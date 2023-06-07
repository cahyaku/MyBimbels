<?php

require_once __DIR__ . "/../../Utils.php";

/**
 * function untuk search kelas siswa 
 * 
 * @param array $persons data dari siswa yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh siswa
 */
function searchClasses($classes, $lecturers, $students): array
{
    if (count($classes) == 0) {
        echo "empty data" . "\n";
    } else {
        // while (true) {
        // meminta inputan nama nama kelas dari user
        echo "\n" . "Nama kelas: ";
        $inputDataClasses = preg_quote(getString());
        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan kelas
        for ($i = 0; $i < count($classes); $i++) {
            if (preg_match("/$inputDataClasses/i", $classes[$i]["name"])) {
                if (in_array($classes[$i]["id"], $searchResult) == false) {
                    $searchResult[] = $classes[$i];
                }
            }
        }

        if (count($searchResult) == 0) {
            echo "Data kelas tidak ditemukan!" . "\n";
        } else {
            // loop untuk menampilkan data kelas
            for ($i = 0; $i < count($searchResult); $i++) :
                showClassesInfo($searchResult, $lecturers, $students);
                break;
            endfor;
            // break;
        }
    }
    // }
    return $searchResult;
}
