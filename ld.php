<?php
// mengecek kemiripan dengan soal
function similarity($str1, $str2) {
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    
    // Membuat matriks untuk menyimpan jarak antara karakter-karakter di kedua string
    $matrix = array();
    for ($i = 0; $i <= $len1; $i++) {
      $matrix[$i] = array();
      for ($j = 0; $j <= $len2; $j++) {
        $matrix[$i][$j] = 0;
      }
    }
    
    // Mengisi matriks dengan jarak antara karakter-karakter di kedua string
    for ($i = 0; $i <= $len1; $i++) {
      $matrix[$i][0] = $i;
    }
    for ($j = 0; $j <= $len2; $j++) {
      $matrix[0][$j] = $j;
    }
    for ($i = 1; $i <= $len1; $i++) {
      for ($j = 1; $j <= $len2; $j++) {
        $cost = ($str1[$i-1] == $str2[$j-1]) ? 0 : 1;
        $matrix[$i][$j] = min(
          $matrix[$i-1][$j] + 1,
          $matrix[$i][$j-1] + 1,
          $matrix[$i-1][$j-1] + $cost
        );
      }
    }
    
    // Menghitung persentase kemiripan antara kedua string
    $maxLen = max($len1, $len2);
    $similarity = ($maxLen - $matrix[$len1][$len2]) / $maxLen * 100;
    return $similarity;
  }
  ?>