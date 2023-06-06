<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

function editDataPengajar(array $lecturers, array $classes): array
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
                // minta inputan data yang akan diubah dari user
                echo "\n" . "Data pengajar yang akan diubah ? " . "\n";
                echo "Please type ordinal number above: ";
                $input = getNumeric();
                $indexToModify = $input - 1;

                // cek jika inputan dari user lebih dari jumlah data yang ada dan jika kurang dari atau sama dengan 0
                if ($input > count($searchResult) || $input <= 0) {
                    echo "Ordinal number was not found!" . "\n";
                    break;
                } else {
                    $id = $searchResult[$indexToModify]["id"];

                    // loop untuk menemukan data pengajar yang akan diubah
                    for ($i = 0; $i < count($lecturers); $i++) {

                        // cek id jika id pengajar sama dengan id yang akan diubah dari hasil pecarian
                        // maka lanjut minta inputan data yang baru dari user
                        if ($id == $lecturers[$i]["id"]) {
                            // tampilkan pesan nama pengajar yang akan diubah
                            echo "Mengubah data" . ' "' . $lecturers[$i]["name"] . '"' . "\n";
                            // minta inputan nik dari user
                            // echo "\n" . "NIK: ";
                            $nik = askForNik();
                            if (isNikExists($lecturers, $nik, $id) == false) {
                                $lecturers[$i] = askForLectureData($nik, $id);
                                echo "Data pengajar " .  '"' .  $lecturers[$i]["name"] . '"' .  " telah diperbarui!" . "\n";
                            } else {
                                // echo "NIK pengajar" . ' "' . $lecturers[$i]["name"] . '" ' . "sudah ada di database" . "\n";
                                echo "maaf NIK tersebut sudah ada di database" . "\n";
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
    return $lecturers;
}
