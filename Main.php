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
require_once __DIR__ . "/includes/classes/Search.php";

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
    echo    "5. Tampilkan data pengajar" . "\n";
    echo    "6. Balik ke menu utama" . "\n";
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
            echo "cari" . "\n";
            searchPengajar($lecturers, $classes);
        } else if ($menu == 2) {
            echo "tambahkan data lecturers" . "\n";
            $lecturers = addLecturersData($lecturers);
        } else if ($menu == 3) {
            echo "edit person" . "\n";
            $lecturers = editDataPengajar($lecturers, $classes);
        } else if ($menu == 4) {
            echo "hapus data" . "\n";
            $lecturers = deleteLecturers($lecturers, $classes);
        } else if ($menu == 5) {
            showTeacher($lecturers, $classes);
        } else if ($menu == 6) {
            echo "Back to main menu" . "\n";
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
    echo    "5. Tampilkan data siswa" . "\n";
    echo    "6. Balik ke menu utama" . "\n";
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
    // global $lecturers;

    $exit = false;
    while ($exit == false) {
        kelolaSiswa();
        $menu = getNumeric();
        if ($menu == 1) {
            echo "cari";
            searchSiswa($students, $classes, $enrollments, $lecturers);
        } else if ($menu == 2) {
            echo "tambahkan data siswa" . "\n";
            $students = addStudentsData($students);
        } else if ($menu == 3) {
            echo "edit person" . "\n";
            $students = editDataStudents($students, $classes, $enrollments, $lecturers);
        } else if ($menu == 4) {
            echo "hapus" . "\n";
            $students = deleteStudents($students, $classes, $enrollments, $lecturers);
        } else if ($menu == 5) {
            showAllStudents($students, $classes);
        } else if ($menu == 6) {
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
    global $students;
    global $classes;
    global $enrollments;
    global $lecturers;
    $exit = false;
    while ($exit == false) {
        kelolaKelas();
        $menu = getNumeric();
        if ($menu == 1) {
            echo "cari" . "\n";
            searchClasses($enrollments, $classes, $lecturers, $students);
        } else if ($menu == 2) {
            echo "Tambah" . "\n";
        } else if ($menu == 3) {
            echo "edit" . "\n";
        } else if ($menu == 4) {
            echo "Pendaftaran siswa" . "\n";
        } else if ($menu == 5) {
            echo " Tutup kelas" . "\n";
        } else  if ($menu == 6) {
            echo "Hapus" . "\n";
        } else  if ($menu == 7) {
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
        showMainMenu();
        // minta inputan untuk main menu
        $menu = getNumeric();
        if ($menu == 1) {
            startKelolaPengajar($lecturers);
        } else if ($menu == 2) {
            startKelolaSiswa($students);
        } else if ($menu == 3) {
            startKelolaKelas($classes);
        } else if ($menu == 4) {
            echo "exit";
            $exit = false;
        } else {
            echo "please input 1, 2, 3, or 4" . "\n";
        }
    }
}
