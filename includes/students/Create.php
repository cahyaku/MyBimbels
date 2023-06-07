<?php

require_once __DIR__ . "/../../Utils.php";

/**
 * fungsi untuk menambahkan data pengajar
 * 
 * @param array $siswa berisi data siswa
 * @return array data siswa yang telah ditambahkan
 * 
 */
function addStudentsData(array $students, $id): array
{
    while (true) {
        // meminta inputan NISN

        $nisn = askForNisn();
        // cek NISN ada atau tidak 
        if (isNisnExists(array: $students, nisn: $nisn, id: null) == true) {
            echo "sorry, NIK: \"$nisn\" already exists" . "\n";
        } else {
            // simpan data dalam array
            $students[] = askForStudentData($nisn, $id);
            echo "Data siswa telah disimpan!" . "\n";

            break;
        }
    }
    return $students;
}
