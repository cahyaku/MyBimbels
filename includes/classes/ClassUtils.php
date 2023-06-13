<?php

require_once __DIR__ . "/../../Utils.php";

/**
 * function untuk menampilkan semua data kelas yang ada 
 * 
 * @param array $classes berisi data siswa yang akan diproses
 */
function showAllClasses(array $classes)
{
    if (count($classes) == 0) {
        echo "Empty Data";
    } else {
        for ($i = 0; $i < count($classes); $i++) {
            echo "\n" . ($i + 1) .  ". Nama kelas: " . $classes[$i]["name"] . "\n";
            echo "    - Nama matapelajaran: " . $classes[$i]["subject"] . "\n";
            echo "    - Harga Rp " . number_format($classes[$i]["price"]) . "\n";
            $date = date('j F Y', $classes[$i]["startedAt"]);
            // echo "    - Tanggal dimulai: " . $classes[$i]["startedAt"] . "\n";
            echo "    - Tanggal dimulai: " . $date . "\n";
        }
        echo "\n";
    }
}

/**
 * function untuk menanyakan nama mata pelajaran
 * 
 * @return string nama yang telah diinputkan 
 */
function askForSubject(): string
{
    while (true) {
        echo "mata pelajaran : ";
        $mapel = preg_quote(getString());
        if ($mapel == "") {
            echo "silahkan ketik mata pelajaran yang benar " . "\n";
            // cek jika inputan  yang dimasukan melebihi batas yang ditentukan 
        } else if (strlen($mapel) > 100) {
            echo "masukan inputan nama mata pelajaran maksimal 100 karakter" . "\n";
        } else {
            return $mapel;
        }
    }
}

/**
 * function untuk menanyakan started date school dari person 
 * 
 * @return string started date 
 */
function askForStartedDate(): string
{
    while (true) {
        echo "Started Date: ";
        // inputan tanggal mulai
        $startedDate = strtotime(getString());
        // $startedDate = getString();

        if ($startedDate == "") {
            echo "Please type the started date!" . "\n";
        } else {
            return $startedDate;
        }
    }
}

function askForNewClassData($id): array
{
    $sentence = "Nama Kelas: ";
    $name = askForName($sentence);
    $subject = askForSubject();
    $sentence1 = "Harga: ";
    $sentence2 = "Silahkan masukan harga kelas!";
    $price = askForNumber($sentence1, $sentence2);
    $startedAt = askForStartedDate();
    return [
        // "lecturerId" tidak diset disini
        "id" => $id,
        "name" => $name,
        "price" => $price,
        "subject" => $subject,
        "ongoing" => true,
        "startedAt" => $startedAt,
        "closedAt" => null
    ];
}

/**
 * function untuk menampilkan informasi kelas
 */
function showClassesInfo($enrollments, $classes, $lecturers, $students)
{
    if (count($classes) == 0) {
        echo "Empty Data";
    } else {
        // loop untuk mendapatkan kelas
        for ($i = 0; $i < count($classes); $i++) {
            $berjalanStr = "selesai";
            if ($classes[$i]["ongoing"] == true) {
                $berjalanStr = "berjalan";
            }
            echo "\n" . ($i + 1) . "   - Kelas \"" . $classes[$i]["name"] . "\"" .  " - " . $classes[$i]["subject"] . " ($berjalanStr)" . PHP_EOL;
            // tampilkan nama kelas, mata pelajaran dan keterangan apakah kelas masih berjalan atau tidak
            // loop untuk mendapatkan nama pengajar
            for ($j = 0; $j < count($lecturers); $j++) {
                if ($lecturers[$j]["id"] == $classes[$i]["lecturerId"]) {
                    // if ($lecturers[$j]["id"] == $classes[$i]["lecturerId]") {
                    // tampilkan nama pengajar 
                    echo "      - Pengajar " . $lecturers[$j]["name"] . PHP_EOL;
                }
            }
            // tampilkan tanggal mulai 
            $date = date('j F Y', $classes[$i]["startedAt"]);
            echo "      - Dimulai " . $date . "\n";
            echo "      - Harga kelas Rp " . number_format($classes[$i]["price"]) . "\n";

            // dapatkan jumlah siswa dari si kelas
            $countStudents = countStudents($enrollments, $classes[$i]["id"]);
            echo "      - Jumlah siswa: $countStudents\n";

            // dapatkan para siswa dari si kelas
            $classStudents = getStudentsByClassId($enrollments, $students, $classes[$i]["id"]);
            foreach ($classStudents as $student) {
                echo "          - " . $student["name"] . " (NISN: " . $student["nisn"] . ")\n";
            }
        }
    }
}
