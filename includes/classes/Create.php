<?php

require_once __DIR__ . "/../../Utils.php";
require_once "ClassUtils.php";
require_once "Search.php";

function addClassesData(array $classes, array $lecturers): array
{
    echo "\n" . "PENAMBAHAN DATA KELAS BARU" . "\n";
    $newClass = askForNewClassData(generateId($classes));
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
                echo "Nomor yang dipilih tidak ditemukan!" . "\n";
                break;
            } else {
                $newClass["lecturerId"] = $searchResult[$indexLecturers]["id"];
                $classes[] = $newClass;
                echo "Pengajar " . '"' . $searchResult[$indexLecturers]["name"] . '"' . " di-set untuk kelas " .
                    '"' . $newClass["name"] . '".' . "\n";
                echo "Data kelas " . '"' . $newClass["name"] . '"' . " telah disimpan." . "\n";
                break;
            }
            break;
        }
    }
    saveDataIntoJson($classes, JSON_CLASSES);
    return $classes;
}
