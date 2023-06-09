<?php

require_once __DIR__ . "/../../Utils.php";
require_once "LecturerUtils.php";

/**
 * fungsi untuk menambahkan data pengajar
 * 
 * @param array $lecturers berisi data pengajar
 * @return array data pengajar yang telah ditambahkan
 * 
 */
function addLecturersData(array $lecturers): array
{
    while (true) {
        // meminta inputan NIK
        echo "\n" . "PENAMBAHAN DATA PENGJAR BARU" . "\n";
        $sentence1 = "NIK: ";
        $sentence2 = "Silahkan masukan data NIK dengan benar!";
        $nik = askForNumber($sentence1, $sentence2);
        // cek NIK ada atau tidak 
        if (isNikExists(array: $lecturers, nik: $nik, id: null) == true) {
            echo "sorry, NIK: \"$nik\" already exists" . "\n";
        } else {
            // simpan data dalam array
            $lecturers[] = askForLectureData($nik, generateId($lecturers));

            // echo "Data pengajar " . '"' . $lecturers[count($lecturers) - 1]["name"] . '"' . " telah disimpan!" . "\n";
            echo "Data pengajar " . '"' . end($lecturers)["name"] . '"' . " telah disimpan!" . "\n";
            break;
        }
    }
    saveDataIntoJson($lecturers, JSON_LECTURERS);
    return $lecturers;
}
