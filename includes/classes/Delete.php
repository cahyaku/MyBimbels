<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function deleteClasses(array $classes, array $enrollments, array $lecturers, array $students): array
{
    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        // tampilkan menu pencarian
        $searchResult = searchClasses($enrollments, $classes, $lecturers, $students);

        if (count($searchResult) > 0) {
            while (true) {
                echo "\n" . "Pilih data kelas yang akan dihapus? " . "\n";
                echo "Please type ordinal number above: ";
                $input = getNumeric();
                $indexToDelete = $input - 1;

                // cek jika yang diinputan oleh user lebih dari jumlah data yang ada dan lebih besar dari 0
                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$indexToDelete]["id"];
                    for ($i = 0; $i < count($classes); $i++) {

                        // cek apakah id kelas sama dengan id yang akan dihapus
                        if ($id == $classes[$i]["id"]) {

                            // cek data kelas yang akan dihapus
                            // hanya kelas yang tidak memiliki siswa yang bisa dihapus (kelas yang belum pernah berjalan)
                            if (countClasses($classes, $classes[$i]["id"], true) > 0) {
                                // tampilkan pesan nama kelas yang akan dihapus 
                                echo "Maaf data kelas " . $classes[$i]["name"] . " tidak dapat dihapus!" . "\n";
                            } else {
                                $sentence = "Yakin untuk menghapus data kelas " . ' "' . $classes[$i]["name"] . '" ' . "(y/n)?";
                                if (isContinue($sentence) == true) {
                                    echo "Data kelas " . '"' . $classes[$i]["name"] . '"' .  " telah dihapus!" . "\n";
                                    unset($classes[$i]);
                                }
                                break;
                            }
                        }
                    }
                    $classes = array_values($classes);
                    break;
                }
            }
        }
    }
    return $classes;
}
