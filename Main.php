<?php


require_once "Utils.php";

// pengajar
require_once __DIR__ . "/includes/lecturers/Create.php";
require_once __DIR__ . "/includes/lecturers/Edit.php";
require_once __DIR__ . "/includes/lecturers/Delete.php";
require_once __DIR__ . "/includes/lecturers/Search.php";


// siswa
require_once __DIR__ . "/includes/students/Create.php";
require_once __DIR__ . "/includes/students/Edit.php";
require_once __DIR__ . "/includes/students/Delete.php";
require_once __DIR__ . "/includes/students/Search.php";

// classes
require_once __DIR__ . "/includes/classes/Create.php";
require_once __DIR__ . "/includes/classes/Edit.php";
require_once __DIR__ . "/includes/classes/Search.php";
require_once __DIR__ . "/includes/classes/Delete.php";
require_once __DIR__ . "/includes/classes/Enrollments.php";
require_once __DIR__ . "/includes/classes/Close.php";

/**
 * fungsi untuk menampilkan menu utama 
 */
function showMainMenu()
{
    echo "\n" . "MyBimbels:" . "\n";
    echo "  1. Pengajar" . "\n";
    echo "  2. Siswa" . "\n";
    echo "  3. Kelas" . "\n";
    echo "  4. Keluar" . "\n";
    echo "Pilih menu: ";
}

/**
 * function untuk menampikan pilihan menu pengajar
 */
function kelolaPengajar()
{
    echo  "\n" . "Kelola pengajar" . "\n";
    echo    "1. Cari" . "\n";
    echo    "2. Tambah" . "\n";
    echo    "3. Edit" . "\n";
    echo    "4. Hapus" . "\n";
    echo    "5. Menu utama" . "\n";
    echo "Pilih menu:";
}

/**
 * function untuk memanggil function dari kelola pengajar
 */
function startKelolaPengajar()
{
    global $lecturers;
    global $classes;
    $exit = false;
    while ($exit == false) {
        kelolaPengajar();
        $menu = getNumeric();
        if ($menu == 1) {
            searchPengajar($lecturers, $classes);
        } else if ($menu == 2) {
            $lecturers = addLecturersData($lecturers);
        } else if ($menu == 3) {
            $lecturers = editDataPengajar($lecturers, $classes);
        } else if ($menu == 4) {
            $lecturers = deleteLecturers($lecturers, $classes);
        } else if ($menu == 5) {
            echo "Menu utama" . "\n";
            $exit = true;
        } else {
            echo "please input 1, 2, 3, 4, or 5" . "\n";
        }
    }
}

/**
 * function untuk menampilkan pilihan menu kelola siswa
 */
function kelolaSiswa()
{
    echo  "\n" . "Kelola Siswa" . "\n";
    echo    "1. Cari" . "\n";
    echo    "2. Tambah" . "\n";
    echo    "3. Edit" . "\n";
    echo    "4. Hapus" . "\n";
    echo    "5. Menu utama" . "\n";
    echo "Pilih menu:";
}

/**
 * function untuk memanggil function kelola siswa
 */
function startKelolaSiswa()
{
    global $students;
    global $classes;
    global $enrollments;
    global $lecturers;

    $exit = false;
    while ($exit == false) {
        kelolaSiswa();
        $menu = getNumeric();
        if ($menu == 1) {
            searchStudent($students, $classes, $enrollments, $lecturers);
        } else if ($menu == 2) {
            $students = addStudent($students);
        } else if ($menu == 3) {
            $students = editStudent($students, $classes, $enrollments, $lecturers);
        } else if ($menu == 4) {
            $students = deleteStudent($students, $classes, $enrollments, $lecturers);
        } else if ($menu == 5) {
            echo "Menu Utama" . "\n";
            $exit = true;
        } else {
            echo "please input 1, 2, 3, 4, or 5" . "\n";
        }
    }
}

/**
 * function untuk menampilkan menu dari kelas 
 */
function kelolaKelas()
{
    echo "\n" . "Kelola kelas" . "\n";
    echo "1. Cari" . "\n";
    echo "2. Tambah" . "\n";
    echo "3. Edit" . "\n";
    echo "4. Pendaftaran siswa" . "\n";
    echo "5. Tutup kelas" . "\n";
    echo "6. Hapus" . "\n";
    echo "7. Menu utama" . "\n";
    echo "Pilih menu: ";
}

/**
 * function untuk memanggil function dari kelola kelas
 */
function startKelolaKelas()
{
    // clearScreen();
    global $students;
    global $classes;
    global $enrollments;
    global $lecturers;
    $exit = false;
    while ($exit == false) {
        kelolaKelas();
        $menu = getNumeric();
        if ($menu == 1) {
            searchClasses($enrollments, $classes, $lecturers, $students);
        } else if ($menu == 2) {
            $classes = addClassesData($classes, $lecturers);
        } else if ($menu == 3) {
            $classes = editClassData($classes, $enrollments, $lecturers, $students);
        } else if ($menu == 4) {
            $enrollments = pendaftaranSiswa($enrollments, $classes, $lecturers, $students);
        } else if ($menu == 5) {
            $classes = closeClass($enrollments, $classes, $lecturers, $students);
        } else  if ($menu == 6) {
            $classes = deleteClasses($classes, $enrollments, $lecturers, $students);
        } else if ($menu == 7) {
            echo "Menu utama" . "\n";
            $exit = true;
        } else {
            echo " Please input number 1, 2, 3, 4, 5, 6, or 7" . "\n";
        }
    }
}

/**
 * function main untuk memanggil semua function 
 */
function main()
{
    global $students;
    global $lecturers;
    global $classes;
    $exit = true;
    while ($exit == true) {
        clearScreen();
        showMainMenu();
        // minta inputan untuk main menu
        $menu = getNumeric();
        if ($menu == 1) {
            clearScreen();
            startKelolaPengajar($lecturers);
        } else if ($menu == 2) {
            clearScreen();
            startKelolaSiswa($students);
        } else if ($menu == 3) {
            clearScreen();
            startKelolaKelas($classes);
        } else if ($menu == 4) {
            echo "keluar";
            $exit = false;
        } else {
            echo "please input 1, 2, 3, or 4" . "\n";
        }
    }
}
