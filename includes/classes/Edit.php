<?php

require_once __DIR__ . "/../../Utils.php";
require_once "ClassUtils.php";
require_once "Search.php";

function editClassData(array $classes, array $enrollments, array $lecturers, array $students): array
{
    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        // tampilkan menu pencarian, untuk mencari nama kelas yang akan diubah
        $searchClass = searchClasses($enrollments, $classes, $lecturers, $students);
        if (count($searchClass) > 0) {
            while (true) {
                // minta inputan data yang akan diubah dari user
                echo "\n" . "Data kelas yang akan diubah ? " . "\n";
                echo "Please type ordinal number above: ";
                $input = getNumeric();
                $indexToModify = $input - 1;

                // cek jika inputan dari user lebih dari jumlah data yang ada dan jika kurang dari atau sama dengan 0
                if ($input > count($searchClass) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchClass[$indexToModify]["id"];
                    // loop untuk menemukan data kelas yang akan diubah
                    for ($i = 0; $i < count($classes); $i++) {
                        // cek id jika "lectuerId" kelas sama dengan id yang akan diubah dari hasil pecarian
                        // maka lanjut minta inputan data yang baru dari user
                        if ($id == $classes[$i]["id"]) {
                            // tampilkan pesan nama kelas yang akan diubah
                            echo "Memperbarui data" . ' "' . $classes[$i]["name"] . '"' . "\n";
                            // tampung hasil di array ke $i
                            $updateClassData = askForNewClassData($id); // search untuk menemukan pengajar

                            // search untuk menemukan pengajar
                            $seachLecturers = searchLecturers($lecturers, $classes);
                            if (count($seachLecturers) > 0) {
                                while (true) {
                                    echo "Pilih pengajar yang akan mengajar di kelas ini" . "\n";
                                    echo "Please type ordinal number above: ";
                                    $input = getNumeric();
                                    $indexLecturers = $input - 1;
                                    // cek jika inputan dari user lebih dari jumlah data yang ada dan jika kurang dari atau sama dengan 0
                                    if ($input > count($seachLecturers) || $input <= 0) {
                                        echo "Ordinal number was not found!" . "\n";
                                        break;
                                    } else {
                                        $updateClassData["lecturerId"] = $seachLecturers[$indexLecturers]["id"];

                                        $classes[$i] = $updateClassData;

                                        echo "Pengajar " . '"' . $seachLecturers[$indexLecturers]["name"] . '"' . " di-set untuk kelas " .
                                            '"' . $classes[$i]["name"] . '".' . "\n";
                                        echo "Data kelas " . '"' . $classes[$i]["name"] . '"' . " telah disimpan." . "\n";
                                        break;
                                    }
                                    break;
                                    // return $classes;
                                }
                            }
                        }
                    }
                }
                break;
            }
            // }
        }
    }
    saveDataIntoJson($classes, JSON_CLASSES);
    return $classes;
}
