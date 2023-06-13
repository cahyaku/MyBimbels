<?php

function saveDataIntoJson(array $array, string $fileName)
{
    $json = json_encode($array);
    $array = file_put_contents($fileName, $json);
}

function loadDataFromJson(string $fileName): array
{
    if (file_exists($fileName)) {
        $data = file_get_contents($fileName);
        $result = json_decode($data, true);
        return $result;
    }
    return [];
}

function generateId(array $array): int
{
    if (count($array) == 0) {
        return 1;
    }
    return end($array)["id"] + 1;
}

// fungsi untuk validasi int
function getNumeric(): int
{
    $input = trim(fgets(STDIN));
    if (is_numeric($input)) {
        return (int) $input;
    }
    return 0;
}

// fungsi untuk validasi string
function getString(): string
{
    $input = trim(fgets(STDIN));
    // if (ctype_alpha($input)) {
    return (string) $input;
    // }
    // return "";
}

function clearScreen()
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        popen('cls', 'w');
    } else {
        system('clear');
    }
}

/**
 * function untuk menanyakan data yang berupa int 
 * 
 * @param string $sentence1 untuk mengisi kalimat ke-1 saat meminta inputan
 * @param string $sentence2 untuk mengisi kalimat ke-2 saat inputan itu kosong(empty data)
 */
function askForNumber($sentence1, $sentence2): int
{
    while (true) {
        echo $sentence1;
        $harga = getNumeric();
        if ($harga == 0) {
            echo $sentence2 . "\n";
        } else {
            return $harga;
        }
    }
}

/**
 * function untuk menanyakan nama 
 * 
 * @return string nama yang telah diinputkan 
 */
function askForName($sentence): string
{
    while (true) {
        // echo "name : ";
        echo $sentence;
        $name = getString();
        if ($name == "") {
            echo "please type your name " . "\n";
            // cek jika inputan  yang dimasukan melebihi batas yang ditentukan 
        } else if (strlen($name) > 30) {
            echo "masukan inputan nama maksimal 30 karakter" . "\n";
        } else {
            return $name;
        }
    }
}

/**
 * function untuk menanyakan pendidikan terakhir dari user
 * 
 * @return string pendidikan terakhir dari si user
 */
function askForLastEducation(): string
{
    while (true) {
        echo "Last Education: ";
        $lastEducation = getString();
        if ($lastEducation == "") {
            echo "Please type your last education" . "\n";
        } else {
            return $lastEducation;
        }
    }
}

/**
 * function untuk lanjut atau tidak
 * 
 * @return bool jika y maka true, jika n maka false
 */
function isContinue($sentence): bool
{
    // perulangan untuk mengecek jika yang di inputkan bukan y atau n maka akan terus berulang
    while (true) {
        // meminta inputan pada user
        echo $sentence;
        $input = getString();
        if ($input == "y") {
            return true;
        } else if ($input == "n") {
            return false;
        }
    }
}

/**
 * function untuk menghitung jumlah kelas
 */
function countClasses(array $classes, $lecturerId, $ongoing)
{
    $count = 0;
    for ($i = 0; $i < count($classes); $i++) {
        if ($classes[$i]["ongoing"] == $ongoing && $lecturerId == $classes[$i]["lecturerId"]) {
            $count++;
        }
    }
    return $count;
}

/**
 * function untuk meghitung jumlah omzet
 * 
 * @param array $classes berisi keseluruhan dari data  kelas yang ada 
 * @param $lecturerId berisikan int dari "lecturerId"
 * 
 */
function countRevenue(array $classes, $lecturerId)
{
    $sum = 0;
    for ($i = 0; $i < count($classes); $i++) {
        if ($lecturerId == $classes[$i]["lecturerId"]) {
            $sum = $sum + ($classes[$i]["price"]);
        }
    }
    return number_format($sum);
}

/**
 * function untuk mencari jumlah siswa
 * 
 * @param array $enrollments berisi data dari semua pendaftaran yang ada
 * @param int $classId int dari classId
 */
function countStudents(array $enrollments, int $classId)
{
    $countStudents = 0;
    for ($index = 0; $index < count($enrollments); $index++) {
        if ($enrollments[$index]["classId"] == $classId) {
            $countStudents++;
        }
    }
    return $countStudents;
}


/**
 * function untuk mendapatkan array element (siswa) dari array $enrollments yang key "classId" nya bernilai $classId
 * 
 * @param array $enrolments data pendataran yang ada
 * @param array $students berisi data siswa yang ada
 */
function getStudentsByClassId(array $enrollments, array $students, int $classId): array
{
    $temp = [];
    for ($index = 0; $index < count($enrollments); $index++) {
        if ($enrollments[$index]["classId"] == $classId) {
            $theStudent = getFirstDataById($students, $enrollments[$index]["studentId"]);
            if ($theStudent != null) {
                // masukkan ke daftar siswa
                $temp[] = $theStudent;
            }
        }
    }
    return $temp;
}

/**
 * function untuk menampikan informasi dari siswa
 * 
 * @param array $students berisi data dari semua siswa yang ada
 * @param array $classes berisi data dari semua kelas yang ada
 * @param array $enrollments berisi data pendaftaran untuk mengikuti kelas yang ada 
 * @param array $lecturers berisi data dari pangajar yang ada
 * 
 */
function showStudentsInfo(array $students, array $classes, array $enrollments, array $lecturers)
{
    if (count($students) == 0) {
        echo "Empty data";
    } else {
        for ($index = 0; $index < count($students); $index++) {
            // array yang akan menampung registrasi siswa di suatu kelas 
            $studentEnrollments = getEnrollmentsByStudentId($students[$index]["id"], $enrollments);

            // array of int untuk menampung hanya "classId" dari $studentEnrollments
            $classIds = [];
            for ($i = 0; $i < count($studentEnrollments); $i++) {

                $classIds[] = $studentEnrollments[$i]["classId"];
            }

            // array yang menampung kelas yang diikuti siswa, sesuai data $studentEnrollments
            $studentClasses = getClassesByClassIds($classIds, $classes);
            // array of int untuk menampung hanya "lecturerId" dari $studentClasses
            $lecturerIds = [];
            for ($i = 0; $i < count($studentClasses); $i++) {
                $lecturerIds[] = $studentClasses[$i]["lecturerId"];
            }

            // array pengajar yang mengajar di kelas $studentClasses
            $classLecturers = getLecturersByLecturerIds($lecturers, $lecturerIds);

            // finally: show data
            echo "\n" . ($index + 1) . ". " . "Name: " . $students[$index]["name"] . " (NISN: " . $students[$index]["nisn"] . ")";

            // tampilkan kelas
            for ($i = 0; $i < count($studentClasses); $i++) {
                // untuk mengecek apakah kelas sedang berjalan atau tidak
                $berjalanStr = "selesai";
                if ($studentClasses[$i]["ongoing"] == true) {
                    $berjalanStr = "berjalan";
                }

                echo "\n" . "   - Kelas \"" . $studentClasses[$i]["name"] . "\"" .  " - " . $studentClasses[$i]["subject"] . " ($berjalanStr)" . PHP_EOL;

                // pengajarnya gimana?
                // loop untuk menampilkan pengajar
                for ($j = 0; $j < count($classLecturers); $j++) {
                    if ($classLecturers[$j]["id"] == $studentClasses[$i]["lecturerId"]) {
                        echo "        - Pengajar: " . $classLecturers[$j]["name"] . PHP_EOL;
                    }
                    // echo "        - Pengajar: " . $siPengajar . PHP_EOL;
                }
                // tampilkan harga dari kelas 
                echo "        - Harga kelas: Rp " . number_format($studentClasses[$i]["price"]) . PHP_EOL;
                // cek tanggal ditutup 
                $closedAt = $studentClasses[$i]["closedAt"];
                if ($closedAt == null) {
                    $closedAt = "sekarang";
                } else {
                    $closedAt = date('j F Y', $studentClasses[$i]["closedAt"]);
                }
                // ini untuk waktu saat ini
                // $startedAt = time();
                // $date = date('j F Y  H : i');
                // cek tanggal mulai
                $date = date('j F Y', $classes[$i]["startedAt"]);
                echo "        - " . $date . "  - (" . $closedAt . ")" . "\n";
            }
        }
        echo "\n";
    }
}

/**
 * fuction untuk mendapatkan data dengan id
 */
function getFirstDataById(array $array, int $id)
{
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i]["id"] == $id) {
            return $array[$i];
        }
    }
    return null;
}

/**
 * Helper function untuk mendapatkan data dari $array, yang memiliki key of array bernama $idName dengan nilai = $id
 */
function getDataFromArrayUsingId(array $array, int $id, string $idName)
{
    $result = [];
    for ($i = 0; $i < count($array); $i++) :
        if ($id == $array[$i][$idName]) {
            $result[] = $array[$i];
        }
    endfor;
    return $result;
}

/**
 * function untuk mendaptakan data dari suatu array dengan Ids
 */
function getDataFromArrayUsingIds(array $array, array $ids, string $idName)
{
    // pastikan $ids tidak memiliki nilai yang duplikat di dalamnya
    $noDuplicateIds = array_unique($ids);

    // menampung kelas-kelas yang memiliki id = ada di array $noDuplicateClassIds
    $result = [];
    for ($i = 0; $i < count($noDuplicateIds); $i++) {
        for ($j = 0; $j < count($array); $j++) {
            if ($array[$j][$idName] == $noDuplicateIds[$i]) {
                // masukkan class saat ini ke $result
                $result[] = $array[$j];
            }
        }
    }
    return $result;
}

/**
 * function untuk mendapatkan enrollments atau pendaftaran yang siswanya = studentId
 */
function getEnrollmentsByStudentId(int $studentId, array $enrollments): array
{
    return getDataFromArrayUsingId($enrollments, $studentId, "studentId");
}

/**
 * function untuk mendapatkan kelas dari classId
 */
function getClassesByClassId(int $classId, array $classes): array
{
    return getDataFromArrayUsingId($classes, $classId, "id");
}

/**
 * Function untuk mendapatkan array of class dari $classes, yang id nya ada di array $classIds
 */
function getClassesByClassIds(array $classIds, array $classes): array
{
    return getDataFromArrayUsingIds($classes, $classIds, "id");
}

/**
 * function untuk mendapatkan pengajar dari lecturersId
 */
function getLecturersByLecturerId(int $lecturerId, array $lecturers): array
{
    return getDataFromArrayUsingId($lecturers, $lecturerId, "lecturerId");
}

/**
 * Function untuk mendapatkan array pengajar dari $lecturers, yang id nya ada di array $lecturersIds
 */
function getLecturersByLecturerIds(array $lecturers, array $lecturerIds): array
{
    return getDataFromArrayUsingIds($lecturers, $lecturerIds, "id");
}
