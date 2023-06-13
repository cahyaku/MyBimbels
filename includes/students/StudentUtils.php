<?php

require_once __DIR__ . "/../../Utils.php";

function isNisnExists(array $array, int $nisn, $id): bool
{
    for ($i = 0; $i < count($array); $i++) :
        if ($nisn == $array[$i]["nisn"]) {
            if ($id != null) {
                if ($id != $array[$i]["id"]) {
                    return true;
                }
            } else {
                return true;
            }
        }
    endfor;
    return false;
}

/**
 * function untuk show data students
 * 
 * @param array $students berisi data siswa yang akan diproses
 * 
 */
function showAllStudents(array $students)
{
    if (count($students) == 0) {
        echo "Empty Data";
    } else {
        for ($i = 0; $i < count($students); $i++) {
            echo "\n" . "Name: " . $students[$i]["name"] . "\n";
            echo "NISN: " . $students[$i]["nisn"] . "\n";
            echo "Last Education: " . $students[$i]["lastEducation"] . "\n";
        }
        echo "\n";
    }
}

function askForStudentData($nisn, $id): array
{
    $sentence = "Nama siswa: ";
    $name = askForName($sentence);
    $lastEducation = askForLastEducation();
    return [
        "id" => $id,
        "name" => $name,
        "nisn" => $nisn,
        "lastEducation" => $lastEducation,
    ];
}
