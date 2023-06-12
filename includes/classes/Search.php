<?php

require_once __DIR__ . "/../../Utils.php";

/**
 * function untuk search kelas siswa 
 * @param array $persons data dari siswa yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh siswa
 */
function searchClasses(array $enrollments, array $classes, array  $lecturers, array $students): array
{
    if (count($classes) == 0) {
        echo "empty data" . "\n";
    } else {
        // while (true) {
        // meminta inputan nama nama kelas dari user
        echo "\n" . "Nama kelas: ";
        $inputDataClasses = preg_quote(getString());
        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan kelas
        for ($i = 0; $i < count($classes); $i++) {
            if (preg_match("/$inputDataClasses/i", $classes[$i]["name"])) {
                if (in_array($classes[$i]["id"], $searchResult) == false) {
                    $searchResult[] = $classes[$i];
                }
            }
        }
        if (count($searchResult) == 0) {
            echo "Data kelas tidak ditemukan!" . "\n";
        } else {
            // loop untuk menampilkan data kelas
            for ($i = 0; $i < count($searchResult); $i++) :
                showClassesInfo($enrollments, $searchResult, $lecturers, $students);
                break;
            endfor;
            // break;
        }
    }
    // }
    return $searchResult;
}

// function untuk mencari kelas dan cek hanya kelas yang berjalan yang akan di tampilkan
function searchKelas(array $enrollments, array $classes, array $lecturers, array $students): array
{
    if (count($classes) == 0) {
        echo "empty data" . "\n";
    } else {
        // meminta inputan nama nama kelas dari user
        echo "\n" . "Nama kelas: ";
        $inputDataClasses = preg_quote(getString());
        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan kelas
        for ($i = 0; $i < count($classes); $i++) {
            if (preg_match("/$inputDataClasses/i", $classes[$i]["name"])) {

                // cek kelas berjalan atau tidak, jika kelas berjalan maka lanjutkan pencarian dan dan tampilkan hasinya
                // jika onging == true maka tampilkan lanjutkan pencarian
                if ($classes[$i]["ongoing"] == true) {
                    if (in_array($classes[$i]["id"], $searchResult) == false) {
                        $searchResult[] = $classes[$i];
                    }
                } else {
                    echo "data kelas tidak ditemukan" . "\n";
                }
            }
        }

        if (count($searchResult) == 0) {
            echo "Data kelas tidak ditemukan!" . "\n";
        } else {
            // loop untuk menampilkan data kelas
            for ($i = 0; $i < count($searchResult); $i++) :
                showClassesInfo($enrollments, $searchResult, $lecturers, $students);
                break;
            endfor;
        }
    }
    return $searchResult;
}

function searchLecturers(array $persons, $classes): array
{
    if (count($persons) == 0) {
        echo "empty data" . "\n";
    } else {
        echo "\n" . "Pilih Pengajar" . "\n";
        echo "Nama pengajar: ";
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
            // loop untuk menampilkan data pengajar
            for ($i = 0; $i < count($searchResult); $i++) :
                showTeacher($searchResult, $classes);
                break;
            endfor;
        }
    }
    return $searchResult;
}

/**
 * function untuk search siswa
 * 
 * @param array $persons data dari siswa yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh siswa
 */
function searchStudents(array $students, $classes, $enrollments, $lecturers): array
{
    if (count($students) == 0) {
        echo "empty data" . "\n";
    } else {
        echo "\n" . "Nama siswa: ";
        $inputDataStudents = preg_quote(getString());
        echo "Hasil pencarian: " . "\n";
        $searchResult = [];
        // loop untuk mendapatkan siswa
        for ($i = 0; $i < count($students); $i++) {
            if (preg_match("/$inputDataStudents/i", $students[$i]["name"])) {
                if (in_array($students[$i]["nisn"], $searchResult) == false) {
                    $searchResult[] = $students[$i];
                }
            }
        }
        if (count($searchResult) == 0) {
            echo "Data siswa tidak ditemukan!" . "\n";
        } else {
            showStudentsInfo($searchResult, $classes, $enrollments, $lecturers);
        }
    }
    return $searchResult;
}
