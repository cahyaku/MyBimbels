<?php



/**
 * function untuk search kelas siswa 
 * 
 * @param array $persons data dari siswa yang akan diproses
 * @param array $classes data kelas yang dimiliki oleh siswa
 */
function searchClasses($classes, $enrollments, $lecturers): array
{
    if (count($classes) == 0) {
        echo "empty data" . "\n";
    } else {
        while (true) {
            // meminta inputan nama siswa dari user
            echo "\n" . "Nama kelas: ";
            $inputDataClasses = preg_quote(getString());
            echo "Hasil pencarian: " . "\n";
            $searchResult = [];
            // loop untuk mendapatkan siswa
            for ($i = 0; $i < count($classes); $i++) {
                if (preg_match("/$inputDataClasses/i", $classes[$i]["name"])) {
                    if (in_array($classes[$i]["nisn"], $searchResult) == false) {
                        $searchResult[] = $classes[$i];
                    }
                }
            }
            if (count($searchResult) == 0) {
                echo "Data kelas tidak ditemukan" . "\n";
            } else {
                // loop untuk menampilkan data
                // for ($i = 0; $i < count($searchResult); $i++) :
                showclassesInfo($searchResult, $classes, $enrollments, $lecturers);
                break;
                // endfor;
                // break;
            }
        }
    }
    return $searchResult;
}

/**
 * function untuk menampilkan informasi kelas
 */
function showclassesInfo($students, $classes, $enrollments, $lecturers)
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
                echo "\n" . "   - Kelas \"" . $studentClasses[$i]["name"] . "\"" . PHP_EOL;

                // pengajarnya gimana?
                for ($j = 0; $j < count($classLecturers); $j++) {
                    if ($classLecturers[$j]["id"] == $studentClasses[$i]["lecturerId"]) {
                        $siPengajar = $classLecturers[$j]["name"];
                        // echo "   - Pengajar: " . $siPengajar . PHP_EOL;
                    }
                    echo "        - Pengajar: " . $siPengajar . PHP_EOL;
                }
                echo "        - Harga kelas: Rp " . $studentClasses[$i]["price"] . PHP_EOL;

                $closedAt = $studentClasses[$i]["closedAt"];
                if ($closedAt == null) {
                    $closedAt = "sekarang";
                } else {
                    $closedAt = $studentClasses[$i]["closedAt"];
                }
                // $currentTimestamp = time();
                // $date = date("j F Y H:i", $currentTimestamp);
                // echo "        - " . $date . "  - (" . $closedAt . ")" . "\n";
                echo "        - " . $studentClasses[$i]["startedAt"] . "  - (" . $closedAt . ")" . "\n";
            }
        }
        echo "\n";
    }
}
