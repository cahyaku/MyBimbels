<?php

require_once __DIR__ . "/../../Utils.php";

/**
 * function untuk search kelas siswa 
 * 
 * @param array $persons data dari siswa yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh siswa
 */
function searchClasses($enrollments, $classes, $lecturers, $students): array
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
                showClassesInfo($enrollments, $searchResult, $lecturers, $students);
                break;
            endfor;
            // break;
        }
    }
    // }
    return $searchResult;
}

function searchLecturers(array $persons, $classes): array
{
    if (count($persons) == 0) {
        echo "empty data" . "\n";
    } else {
        // while (true) {
        // meminta inputan nama pengajar dari user
        echo "\n" . "Pilih Pengajar" . "\n";
        echo "Nama pengajar: ";
        $inputDataPerson = preg_quote(getString());

        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan pengajar
        for ($i = 0; $i < count($persons); $i++) {
            if (preg_match("/$inputDataPerson/i", $persons[$i]["name"])) {
                if (in_array($persons[$i]["nik"], $searchResult) == false) {
                    $searchResult[] = $persons[$i];
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
