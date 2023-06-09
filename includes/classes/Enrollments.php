<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function pendaftaranSiswa($enrollments, $classes, $lecturers, $students)
{
    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        echo "\n" . "PENDAFTARAN SISWA KELAS";
        $searchResult = searchClasses($enrollments, $classes, $lecturers, $students);
        if (count($searchResult) > 0) {
            while (true) {
                echo "\n" . "Pilih kelas: " . "\n";
                $input = getNumeric();
                $target = $input - 1;

                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$target]["id"];
                    for ($i = 0; $i < count($enrollments); $i++) {
                        if ($id == $enrollments[$i]["id"]) {

                            echo "Menambahkan siswa untuk kelas";
                        }
                    }
                }
            }
        }
    }
}
