<?php

require_once __DIR__ . "/../../Utils.php";

/**
 * function mengecek NIK ada atau tidak
 * 
 * @param $array array of data
 * @param $nik int NIK yang akan dicek ada/tidaknya
 * @param @id int | null
 * @return bool jika nik ditemukan maka return true, dan sebaliknya
 */
function isNikExists(array $array, int $nik, $id): bool
{
    for ($i = 0; $i < count($array); $i++) :
        // ini pengecekan NIK exists saat penambahan data baru
        if ($id == null) {
            if ($nik == $array[$i]["nik"]) {
                return true;
            }
        }
        // ini pengecekan NIK exists saat edit data yg sudah ada
        else {
            if ($nik == $array[$i]["nik"] && $id != $array[$i]["id"]) {
                return true;
            }
        }
    endfor;
    return false;
}

/**
 * function untuk menampilkan data pengajar
 * 
 * @param array $lecturers berisikan data dari pengajar yang diproses
 */
function showTeacher(array $lecturers, array $classes)
{
    if (count($lecturers) == 0) {
        echo "Empty data";
    } else {
        for ($i = 0; $i < count($lecturers); $i++) {
            echo "\n" . ($i + 1) . ". " . "Name: " . $lecturers[$i]["name"] . " (NIK: " . $lecturers[$i]["nik"] . ") \n";
            // cek jumlah kelas yang berjalan
            $countBerjalan = countClasses($classes, $lecturers[$i]["id"], true);
            // cek jumlah kelas yang tidak berjalan
            $countDiTutup = countClasses($classes, $lecturers[$i]["id"], false);
            $omzet = countRevenue($classes, $lecturers[$i]["id"]);
            echo "   - " . $countBerjalan . " kelas berjalan" . "\n";
            echo "   - " . $countDiTutup . " kelas ditutup" . "\n";
            echo "   - Omzet Rp. " . $omzet . "\n";
        }
        echo "\n";
    }
}

function askForLectureData($nik, $id): array
{
    $sentence = "Nama pengajar: ";
    $name = askForName($sentence);
    $lastEducation = askForLastEducation();
    return [
        "id" => $id,
        "nik" => $nik,
        "name" => $name,
        "lastEducation" => $lastEducation,
    ];
}
