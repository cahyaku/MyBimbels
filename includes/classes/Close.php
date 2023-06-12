<?php

require_once __DIR__ . "/../../Utils.php";
require_once "Search.php";

/**
 * function untuk melakukan penutupan kelas
 */
function closeClass(array $enrollments, array $classes, array  $lecturers, array $students)
{
    if (count($classes) == 0) {
        echo "Empty Data" . "\n";
        return $classes;
    } else {
        echo "\n" . "PENUTUPAN KELAS";
        // cek jika kelas masih berjalan maka bisa ditutup
        // hanya kelas yang masih berjalan yang akan di tampilkan 
        // foreach ($classes as $key) {
        //     while ($key["ongoing"] == true) {
        $searchClass = searchKelas($enrollments, $classes, $lecturers, $students);
        if (count($searchClass) > 0) {
            // while (true) {
            echo "\n" . "Pilih kelas yang akan ditutup: ";
            $input = getNumeric();
            $target = $input - 1;
            if ($input > count($searchClass) || $input <= 0) {
                echo "Ordinal number was not found!" . "\n";
            } else {
                // dapat id dari inputan user
                $id = $searchClass[$target]["id"];
                for ($i = 0; $i < count($classes); $i++) {
                    if ($id == $classes[$i]["id"]) {
                        $sentence = "Yakin untuk menutup kelas " . ' "' . $searchClass[$target]["name"] . '" ' . "(y/n)?";
                        if (isContinue($sentence) == true) {
                            // tutup kelas yang dipilih 
                            // $closeClass[] = $searchClass[$target]["ongoing"] = false;
                            $classes[$i] = $searchClass[$target]["ongoing"] = false;
                            echo "Kelas " . '"' . $searchClass[$target]["name"] . '"' .  " telah ditutup!" . "\n";
                        }
                        break;
                    }
                }
            }
        }
        // }
    }
    return $classes;
}
    // }
// }
