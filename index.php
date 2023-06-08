<?php

include "Main.php";

$enrollments = [
    // cahya (Flying Horses)
    array(
        "id" => 1,
        "classId" => 1,
        "studentId" => 1,
    ),
    // Kumala kelas (Suka Matimatika)
    array(
        "id" => 2,
        "classId" => 2,
        "studentId" => 2,
    ),
    // kumala kelas (Flying Horses)
    array(
        "id" => 3,
        "classId" => 1,
        "studentId" => 2,
    ),
    // kumala kelas (Suka fisika)
    array(
        "id" => 4,
        "classId" => 3,
        "studentId" => 2,
    ),
];

$students = [
    // kelas (Flying Horses)
    array(
        "id" => 1,
        "name" => "cahya",
        "nisn" => "6767",
        "lastEducation" => "SMA NEGERI 1 BATURTI",
    ),
    // kelas (Suka matimatika, flying horses, suka fisika)
    array(
        "id" => 2,
        "name" => "Kumala",
        "nisn" => "9090",
        "lastEducation" => "SMA NEGERI 1 KUTA",
    ),
    // data siswa yang belum memiliki kelas
    // siswa yang belum pernah mengikuti kelas bisa dihapus
    array(
        "id" => 3,
        "name" => "Ayong",
        "nisn" => "7878",
        "lastEducation" => "SMA NEGERI 1 DENPASAR",
    )
];

$classes = [
    array(
        // siswa "cahya" dan "kumala"
        "id" => 1,
        "name" => "Flying Horses",
        "price" => 900000,
        "subject" => "English",
        "lecturerId" => 1,
        "ongoing" => true,
        "startedAt" => 1686117435,
        "closedAt" => null,
    ),
    array(
        // siswa "kumala"
        "id" => 2,
        "name" => "Suka Matimatika",
        "price" => 800000,
        "subject" => "Matimatika",
        "lecturerId" => 2,
        "ongoing" => true,
        "startedAt" => 1124457990,
        "closedAt" => 1684410490,
    ),
    array(
        // siswa "kumala"
        "id" => 3,
        "name" => "Suka Fisika",
        "price" => 600000,
        "subject" => "Fisika",
        "lecturerId" => 2,
        "ongoing" => true,
        "startedAt" => 1684411490,
        "closedAt" => null,
    ),
    array(
        // data kelas yang belum memiliki siswa
        // kelas yang belum meliki siswa bisa dihapus
        "id" => 4,
        "name" => "Kimia Menyenangakan",
        "price" => 600000,
        "subject" => "Kimia",
        "lecturerId" => 2,
        "ongoing" => false,
        "startedAt" => 1686191629,
        "closedAt" => null,
    ),
];

$lecturers = [
    array(
        "id" => 1,
        "name" => "MALIN",
        "nik" => "9090",
        "lastEducation" => "D3 Informatika",
    ),
    array(
        "id" => 2,
        "nik" => "8989",
        "name" => "MARLINTON",
        "lastEducation" => "S1 MATEMATIKA",
    ),
    // data pengajar yang belum memiliki siswa
    // pengajar yang belum memiliki kelas bisa dihapus
    array(
        "id" => 3,
        "nik" => "7878",
        "name" => "NIA",
        "lastEducation" => "S1 FISIKA",
    ),
    // data pengajar yang belum memiliki kelas
    array(
        "id" => 4,
        "nik" => "09090",
        "name" => "NIAT",
        "lastEducation" => "S1 BIOLOGI",
    ),
];
main();
