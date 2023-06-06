<?php

include "main.php";

$enrollments = [
    // cahya (Flying Horses)
    array(
        "id" => 0,
        "classId" => 1,
        "studentId" => 1,
    ),
    // Kumala kelas (KUTER)
    array(
        "id" => 1,
        "classId" => 2,
        "studentId" => 2,
    ),
    // kumala kelas (Flying Horses)
    array(
        "id" => 2,
        "classId" => 1,
        "studentId" => 2,
    ),
    // kumala kelas (CEP)
    array(
        "id" => 2,
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
    // kelas (KUTER)
    array(
        "id" => 2,
        "name" => "Kumala",
        "nisn" => "9090",
        "lastEducation" => "SMA NEGERI 1 KUTA",
    ),
    // data siswa yang belum memiliki kelas
    array(
        "id" => 0,
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
        "price" => 900.000,
        "subject" => "English",
        "lecturerId" => 1,
        "ongoing" => true,
        "startedAt" => 1684410490,
        "closedAt" => null,
    ),
    array(
        // siswa "kumala"
        "id" => 2,
        "name" => "KUTER",
        "price" => 800.000,
        "subject" => "Matimatika",
        "lecturerId" => 2,
        "ongoing" => true,
        "startedAt" => 1124457990,
        "closedAt" => "1 desember 2021",
    ),
    array(
        // siswa "kumala"
        "id" => 3,
        "name" => "CEP",
        "price" => 600.000,
        "subject" => "Fisika",
        "lecturerId" => 2,
        "ongoing" => true,
        "startedAt" => 1684411490,
        "closedAt" => null,
    ),
    array(
        // kelas yang belum memiliki siswa
        "id" => 4,
        "name" => "Suka Fisika",
        "price" => 600.000,
        "subject" => "Fisika",
        "lecturerId" => 2,
        "ongoing" => true,
        "startedAt" => 1794411490,
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
    array(
        "id" => 3,
        "nik" => "7878",
        "name" => "NIA",
        "lastEducation" => "S1 FISIKA",
    ),
];
main();
