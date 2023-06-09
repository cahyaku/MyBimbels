<?php

require_once __DIR__ . "/../../Utils.php";
require_once "StudentUtils.php";
require_once "Search.php";

function editStudent(array $students, array $classes, $enrollments, $lecturers): array
{
    // while (true) {
    if (count($students) == 0) {
        echo "Empty Data" . "\n";
        return $students;
    } else {
        // tampilkan menu pencarian, untuk mencari nama siswa yang akan diubah 
        $searchResult = searchStudent($students, $classes, $enrollments, $lecturers);
        if (count($searchResult) > 0) {
            while (true) {
                // minta inputan data yang akan diubah dari user
                echo "\n" . "Data siswa yang akan diperbarui: ";
                $input = getNumeric();
                $indexToModify = $input - 1;

                // cek jika inputan dari user lebih dari jumlah data yang ada dan jika kurang dari atau sama dengan 0
                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$indexToModify]["id"];

                    // loop untuk menemukan data siswa yang akan diubah
                    for ($i = 0; $i < count($students); $i++) {

                        // cek id jika "id" siswa sama dengan id yang akan diubah dari hasil pecarian
                        // maka lanjut minta inputan data yang baru dari user
                        if ($id == $students[$i]["id"]) {
                            // tampilkan pesan nama siswa yang akan diubah
                            echo "Mengubah data" . ' "' . $students[$i]["name"] . '"' . "\n";
                            // minta inputan nisn dari user
                            $sentence1 = "NISN: ";
                            $sentence2 = "Silahkan masukan data NISN dengan benar!";
                            $nisn = askForNumber($sentence1, $sentence2);
                            if (isNisnExists($students, $nisn, $id) == false) {
                                $students[$i] = askForStudentData($nisn, $id);
                                echo "Data siswa " . '"' . $students[$i]["name"] . '"' .  " telah diperbarui!" . "\n";
                            } else {
                                echo "maaf NISN tersebut sudah ada di database" . "\n";
                            }
                            break;
                        }
                    }
                }
                break;
            }
        }
        // }
    }
    saveDataIntoJson($students, JSON_STUDENTS);
    return $students;
}
