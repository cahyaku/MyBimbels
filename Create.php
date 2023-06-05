<?php

require_once "Utils.php";

/**
 * fungsi untuk menambahkan data pengajar
 * 
 * @param array $lecturers berisi data pengajar
 * @return array data pengajar yang telah di tambahkan
 * 
 */
function addLecturersData(array $lecturers, $id): array
{
    while (true) {
        // meminta inputan NIK

        $nik = askForNik();
        // cek NIK ada atau tidak 
        if (isNikExists(array: $lecturers, nik: $nik, id: null) == true) {
            echo "sorry, NIK: \"$nik\" already exists" . "\n";
        } else {
            // simpan data dalam array

            $lecturers[] = askForLectureData($nik, $id);
            echo "Data pengajar telah disimpan!" . "\n";
            // echo "Data pengajar " . $lecturers["name"] .  "telah disimpan!" . "\n";

            // return $lecturers;
            break;
        }
    }
    return $lecturers;
}
