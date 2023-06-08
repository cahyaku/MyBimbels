<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function addClassesData(array $classes, array $lecturers): array
{
    echo "\n" . "PENAMBHAN DATA KELAS BARU" . "\n";
    $classes[] = askForClassData(generateId($classes));
    // echo "Data kelas telah disimpan!" . "\n"
    $searchResult = searchLecturers($lecturers, $classes);

    if (count($searchResult) > 0) {
        while (true) {
            echo "Pilih pengajar yang akan mengajar di kelas ini" . "\n";
            echo "Please type ordinal number above: ";
            $input = getNumeric();
            $indexLecturers = $input - 1;

            // cek jika inputan dari user lebih dari jumlah data yang ada dan jika kurang dari atau sama dengan 0
            if ($input > count($searchResult) || $input <= 0) {
                echo "Ordinal number was not found!" . "\n";
                break;
            } else {
                $id = $searchResult[$indexLecturers]["id"];
                // loop untuk menemukan data pengajar yang dipilih
                for ($i = 0; $i < count($lecturers); $i++) {
                    if ($id == $lecturers[$i]["id"]) {
                        echo "Data pengajar " . '"' . $lecturers[$i]["name"] . '"' . " di-set untuk kelas ini!" . "\n";
                    }
                    // break;
                }
            }
            break;
        }
    }
    return $classes;
}
