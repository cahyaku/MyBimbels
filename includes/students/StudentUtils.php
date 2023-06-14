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
