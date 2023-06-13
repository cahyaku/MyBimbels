<?php

require_once __DIR__ . "/../../Utils.php";
require_once "StudentUtils.php";

/**
 * fungsi untuk menambahkan data pengajar
 * 
 * @param array $siswa berisi data siswa
 * @return array data siswa yang telah ditambahkan
 * 
 */
function addStudentsData(array $students): array
{
    while (true) {
        // meminta inputan NISN
        echo "\n" . "PENAMBAHAN DATA SISWA BARU" . "\n";
        $sentence1 = "NISN: ";
        $sentence2 = "Silahkan masukan data NISN dengan benar!";
        $nisn = askForNumber($sentence1, $sentence2);
        // cek NISN ada atau tidak 
        if (isNisnExists(array: $students, nisn: $nisn, id: null) == true) {
            echo "sorry, NISN: \"$nisn\" already exists" . "\n";
        } else {
            // simpan data dalam array
            $students[] = askForStudentData(
                $nisn,
                generateId($students)
            );
            echo "Data siswa telah disimpan!" . "\n";
            break;
        }
    }
    saveDataIntoJson($students, JSON_STUDENTS);

    return $students;
}
