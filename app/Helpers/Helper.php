<?php
// function formatRupiah($nominal, $prefix = null){
//     $prefix = $prefix ? $prefix : 'Rp. ';
//     return $prefix . number_format($nominal, 3, '.', '.');
// }

function formatRupiah($nominal, $prefix = false){
    if($prefix){
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }
    return number_format($nominal, 0, ',', '.');
   
}
?>