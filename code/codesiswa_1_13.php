<?php
function palindrome($teks){
  $cek = strrev($teks);
    if($cek == $teks){
        return "true";
    }
    else {
        return false;
    }
}
      