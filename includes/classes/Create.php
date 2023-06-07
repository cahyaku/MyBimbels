<?php

require_once __DIR__ . "/../../Utils.php";


function addClassesData()
{
    $sentence = "Nama pengajar: ";
    $name = askForName($sentence);
    $subject = askForSubject();
    $price = askForStartedDate();

    return [
        "namaKelas" => $name,
        "subject" => $subject,
        "price" => $price,
    ];
}
