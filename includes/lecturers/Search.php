<?php

require_once "Utils.php";

// /**
//  * function untuk search lecturers
//  * 
//  * @param array $persons data dari pengajar yang akan diproses
//  * @param array $classes data kelas yang dimiliki oleh pengajar
//  */
// function searchLecturers(array $persons, $classes): bool
// {
//     if (count($persons) == 0) {
//         echo "empty data" . "\n";
//     } else {
//         // while (true) {
//         // meminta inputan nama pengajar dari user
//         echo "\n" . "Nama pengajar: ";
//         $inputDataPerson = preg_quote(getString());

//         echo "Hasil pencarian: " . "\n";
//         $searchResult = [];
//         // loop untuk mendapatkan pengajar
//         for ($i = 0; $i < count($persons); $i++) {
//             if (preg_match("/$inputDataPerson/i", $persons[$i]["name"])) {
//                 if (in_array($persons[$i]["nik"], $searchResult) == false) {
//                     $searchResult[] = $persons[$i];
//                 }
//             }
//         }

//         if (count($searchResult) == 0) {
//             echo "Data pengajar tidak ditemukan" . "\n";
//         } else {
//             // loop untuk menampilkan data
//             for ($i = 0; $i < count($searchResult); $i++) :
//                 showTeacher($searchResult, $classes);
//                 // showTeacher($persons, $classes);
//                 break;
//             endfor;
//             return true;
//         }
//     }
//     // }
//     return false;
// }

function searchPengajar(array $persons, $classes): array
{
    if (count($persons) == 0) {
        echo "empty data" . "\n";
    } else {
        // while (true) {
        // meminta inputan nama pengajar dari user
        echo "\n" . "Nama pengajar: ";
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
            // loop untuk menampilkan data
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
