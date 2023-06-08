<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function editClassData(array $classes, array $enrollments, array $lecturers, array $students): array
{
    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        // tampilkan menu pencarian, untuk mencari nama kelas yang akan diubah
        $searchResult = searchClasses($enrollments, $classes, $lecturers, $students);
        if (count($searchResult) > 0) {
            while (true) {
                // minta inputan data yang akan diubah dari user
                echo "\n" . "Data kelas yang akan diubah ? " . "\n";
                echo "Please type ordinal number above: ";
                $input = getNumeric();
                $indexToModify = $input - 1;

                // cek jika inputan dari user lebih dari jumlah data yang ada dan jika kurang dari atau sama dengan 0
                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$indexToModify]["id"];

                    // loop untuk menemukan data kelas yang akan diubah
                    for ($i = 0; $i < count($students); $i++) {

                        // cek id jika "id" kelas sama dengan id yang akan diubah dari hasil pecarian
                        // maka lanjut minta inputan data yang baru dari user
                        if ($id == $classes[$i]["id"]) {
                            // tampilkan pesan nama kelas yang akan diubah
                            echo "Memperbarui data" . ' "' . $classes[$i]["name"] . '"' . "\n";
                            // tampung hasil di array ke $i
                            $classes[$i] = askForClassData($id);
                            break;
                        }
                    }
                }
                break;
            }
        }
    }
    return $classes;
}
