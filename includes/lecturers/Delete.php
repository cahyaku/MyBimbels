<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function deleteLecturers(array $lecturers, array $classes): array
{
    // while (true) {
    if (count($lecturers) == 0) {
        echo "Empty Data" . "\n";
        return $lecturers;
    } else {
        // tampilkan menu pencarian
        $searchResult = searchPengajar($lecturers, $classes);
        if (count($searchResult) > 0) {
            while (true) {
                echo "\n" . "Pilih data pengajar yang akan dihapus? " . "\n";
                echo "Please type ordinal number above: ";
                $input = getNumeric();
                $indexToDelete = $input - 1;

                // cek jika yang diinputan oleh user lebih dari jumlah data yang ada dan lebih besar dari 0
                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$indexToDelete]["id"];
                    for ($i = 0; $i < count($lecturers); $i++) {

                        // cek apakah id pengajar sama dengan id yang akan dihapus
                        if ($id == $lecturers[$i]["id"]) {

                            // cek data pengajar yang akan dihapus
                            // hanya pengajar yang tidak memiliki kelas yang bisa dihapus
                            if (countClasses($classes, $lecturers[$i]["id"], true) > 0) {

                                // echo "Data pengajar" . ' "' . $lecturers[$indexToDelete]["name"] . '" ';
                                echo "Data pengajar" . ' "' . $lecturers[$i]["name"] . '" ';
                                echo "tidak dapat dihapus karena terdapat kelas yang masih berjalan" . "\n";
                            } else {
                                // $sentence = "Yakin untuk menghapus data pengajar" . ' "' . $lecturers[$indexToDelete]["name"] . '" ' . "(y/n)?";
                                $sentence = "Yakin untuk menghapus data pengajar" . ' "' . $lecturers[$i]["name"] . '" ' . "(y/n)?";
                                if (isContinue($sentence) == true) {
                                    echo "Data pengajar " . '"' . $lecturers[$i]["name"] . '"' . " telah dihapus!" . "\n";
                                    unset($lecturers[$i]);
                                }
                                break;
                            }
                        }
                    }
                    $lecturers = array_values($lecturers);
                    break;
                }
            }
        }
        // else {
        //     echo "Data was not found";
        // }
        // }
    }
    return $lecturers;
}
