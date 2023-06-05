<?php

require_once "Utils.php";

/**
 * fungsi untuk menambahkan data pengajar
 * 
 * @param array $lecturers berisi data pengajar
 * @return array data pengajar yang telah di tambahkan
 * 
 */
function addStudentsData(array $students, $id): array
{
    while (true) {
        // meminta inputan NIK

        $nisn = askForNisn();
        // cek NIK ada atau tidak 
        if (isNisnExists(array: $students, nisn: $nisn, id: null) == true) {
            echo "sorry, NIK: \"$nisn\" already exists" . "\n";
        } else {
            // simpan data dalam array

            $students[] = askForStudentData($nisn, $id);
            echo "Data siswa telah disimpan!" . "\n";
            // return $lecturers;
            break;
        }
    }
    return $students;
}

// /**
//  * fungsi untuk menambahkan data pengajar
//  * 
//  * @param array $lecturers berisi data pengajar
//  * @return array data pengajar yang telah di tambahkan
//  * 
//  */
// function addLecturersData(array $lecturers, $id): array
// {
//     while (true) {
//         // meminta inputan NIK

//         $nik = askForNik();
//         // cek NIK ada atau tidak 
//         if (isNikExists($lecturers, $nik, null) == true) {
//             echo "sorry, NIK: \"$nik\" already exists" . "\n";
//         } else {
//             // simpan data dalam array

//             $lecturers[] = askForLectureData($nik, $id);
//             echo "Data pengajar telah disimpan" . "\n";
//             // return $lecturers;
//             break;
//         }
//     }
//     return $lecturers;
// }
