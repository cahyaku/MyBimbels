<?php

// /**
//  * function mengecek NIK ada atau tidak
//  * 
//  * @param $array array of data
//  * @param $nik int NIK yang akan dicek ada/tidaknya
//  * @param @id int | null
//  * @return bool jika nik ditemukan maka return true, dan sebaliknya
//  */
// function isNikExists(array $array, int $nik, $id): bool
// {
//     for ($i = 0; $i < count($array); $i++) :
//         // ini pengecekan NIK exists saat penambahan data baru
//         if ($id == null) {
//             if ($nik == $array[$i]["nik"]) {
//                 return true;
//             }
//         }
//         // ini pengecekan NIK exists saat edit data yg sudah ada
//         else {
//             if ($nik == $array[$i]["nik"] && $id != $array[$i]["id"]) {
//                 return true;
//             }
//         }
//     endfor;
//     return false;
// }