<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function deleteStudents(array $students, array $classes, array $enrollments, array $lecturers): array
{
    if (count($students) == 0) {
        echo "Empty Data" . "\n";
        return $students;
    } else {
        // tampilkan menu pencarian
        $searchResult = searchSiswa($students, $classes, $enrollments, $lecturers);
        if (count($searchResult) > 0) {
            while (true) {
                echo "\n" . "Pilih data siswa yang akan dihapus? " . "\n";
                echo "Please type ordinal number above: ";
                $input = getNumeric();
                $indexToDelete = $input - 1;

                // cek jika yang diinputan oleh user lebih dari jumlah data yang ada dan lebih besar dari 0
                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$indexToDelete]["id"];
                    for ($i = 0; $i < count($students); $i++) {

                        // cek apakah id siswa sama dengan id yang akan dihapus
                        if ($id == $students[$i]["id"]) {

                            // cek data siswa yang akan dihapus
                            // hanya siswa yang tidak memiliki kelas yang bisa dihapus
                            if (countClasses($classes, $students[$i]["id"], true) > 0) {
                                // echo "Data siswa" . ' "' . $students[$indexToDelete]["name"] . '" ';
                                echo "Maaf data siswa " . $students[$indexToDelete]["name"] . " tidak dapat dihapus karena sudah memiliki data kelas" . "\n";
                            } else {
                                $sentence = "Yakin untuk menghapus data siswa " . ' "' . $students[$indexToDelete]["name"] . '" ' . "(y/n)?";
                                if (isContinue($sentence) == true) {
                                    echo "Data siswa " . '"' . $students[$indexToDelete]["name"] . '"' .  " telah dihapus!" . "\n";
                                    unset($students[$i]);
                                }
                                break;
                            }
                        }
                    }
                    $students = array_values($students);
                    break;
                }
            }
        }
    }
    saveDataIntoJson($students, JSON_STUDENTS);
    return $students;
}
