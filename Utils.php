<?php

// function savePersonsIntoJson(array $persons)
// {
//     $json = json_encode($persons);
//     $personsJson = file_put_contents("persons.json", $json);
// }
// function saveAcademicsIntoJson(array $academics)
// {
//     $json = json_encode($academics);
//     $academicsJson = file_put_contents("academics.json", $json);
// }

// function loadPersonsFromJson()
// {
//     if (file_exists("persons.json")) {
//         // $file = "persons.json";
//         $data = file_get_contents("persons.json");
//         $persons = json_decode($data, true);
//         return $persons;
//     } else {
//         return [];
//     }
// }

// function loadAcademicsFromJson()
// {
//     if (file_exists("academics.json")) {
//         // $file = "academics.json";
//         $data = file_get_contents("academics.json");
//         $academics = json_decode($data);
//         return $academics;
//     } else {
//         return [];
//     }
// }

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
 * function untuk menanyakan nama person
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

function askForClassData($id): array
{
    $sentence = "Nama Kelas: ";
    $name = askForName($sentence);
    $subject = askForSubject();
    $sentence1 = "Harga: ";
    $sentence2 = "Silahkan masukan harga kelas!";
    $price = askForNumber($sentence1, $sentence2);
    $startedAt = askForStartedDate();

    return [
        "id" => $id,
        "name" => $name,
        "subject" => $subject,
        "price" => $price,
        "startedAt" => $startedAt,
    ];
}

/**
 * function untuk menanyakan started date school dari person 
 * 
 * @return string started date school
 */
function askForStartedDate(): string
{
    while (true) {
        echo "Started Date: ";
        $startedDate = getString();
        if ($startedDate == "") {
            echo "Please type the started date" . "\n";
        } else {
            return $startedDate;
        }
    }
}

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
            // echo "Last education; " . $lecturers[$i]["lastEducation"] . "\n";

            $countBerjalan = countClasses($classes, $lecturers[$i]["id"], true);
            $countDiTutup = countClasses($classes, $lecturers[$i]["id"], false);
            $omzet = countRevenue($classes, $lecturers[$i]["id"]);
            echo "   - " . $countBerjalan . " kelas berjalan" . "\n";
            echo "   - " . $countDiTutup . " kelas ditutup" . "\n";
            echo "   - Omzet Rp. " . $omzet . "\n";
        }
        // break;
        echo "\n";
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

// //function untuk mengecek apakah kelas berjalan atau selesai
// function kelasBerjalan(array $classes, $lecturerId, $ongoing): bool
// {
//     for ($i = 0; $i < count($classes); $i++) {
//         if ($classes[$i]["ongoing"] == $ongoing && $lecturerId == $classes[$i]["lecturerId"]) {
//             return true;
//         }
//         return false;
//     }
// }

/**
 * function untuk meghitung jumlah omzet
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

// function untuk mencari jumlah siswa
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
 */
function showStudentsInfo($students, $classes, $enrollments, $lecturers)
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
 * 
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
