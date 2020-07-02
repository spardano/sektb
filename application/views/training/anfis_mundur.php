<?php

echo '<h1>Langkah Mundur</h1>';
echo '<br>';
echo '<h3>error langkah 5</h3>';
echo 'error pada lapisan 5 adalah =';

echo $error5 = error5($defuzzyfikasi, $data['kuat_tekan']);

echo '<h3>error langkah 4</h3>';
echo 'error pada lapisan 4 adalah =';
echo $error4 = $error5;
echo '<br/>';

echo '<h3>error langkah 3</h3>';

    for($yb=0; $yb<count($min); $yb++){
        $w3 = $min [$yb];
        echo 'error 3.'.$yb.' = ';
        echo $error3 [$yb] = error3($w3, $error4);
        echo '<br/>';
    }

    echo '<h3>error langkah 3</h3>';

    for($yb=0; $yb<count($min); $yb++){
        $w3 = $min [$y];
        echo 'error 3.'.$yb.' = ';
        echo $error3 [$yb] = error3($w3, $error4);
        echo '<br/>';
    }

echo '<h3>error langkah 2</h3>';

    $sumw = array_sum($lap2);
    $sume3min = array_sum($error3)-$error3[0];
    $redw = $error3[0]-$sume3min;
    
    for($i=0; $i<count($lap2); $i++){
        $sumwmin = $sumw-$lap2[$i];
        echo 'error 2.'.$i.' = ';
        echo $error2[$i] = error2($sumwmin, $sumw, $redw);
        echo '<br/>';
    }


echo '<h3>error langkah 1</h3>';
    $indekserror =0;
    for($in=0; $in<count($nfk); $in++){
        if($in == 0 || $in == 1 || $in == 2){
            $v1 = array_slice ($nfk, 3, 3);
            $v2 = array_slice ($nfk, 6, 3);
            $v3 = array_slice ($nfk, 9, 3);
            $v4 = array_slice ($nfk, 12, 3);
        }
        else if($in == 3 || $in == 4 || $in == 5){
            $v1 = array_slice ($nfk, 0, 3);
            $v2 = array_slice ($nfk, 6, 3);
            $v3 = array_slice ($nfk, 9, 3);
            $v4 = array_slice ($nfk, 12, 3);
        }
        else if($in == 6 || $in == 7 || $in == 8){
            $v1 = array_slice ($nfk, 0, 3);
            $v2 = array_slice ($nfk, 3, 3);
            $v3 = array_slice ($nfk, 9, 3);
            $v4 = array_slice ($nfk, 12, 3);
        }
        else if($in == 9 || $in == 10 || $in == 11){
            $v1 = array_slice ($nfk, 0, 3);
            $v2 = array_slice ($nfk, 3, 3);
            $v3 = array_slice ($nfk, 6, 3);
            $v4 = array_slice ($nfk, 12, 3);
        }
        else if($in == 12 || $in == 13 || $in == 14){
            $v1 = array_slice ($nfk, 0, 3);
            $v2 = array_slice ($nfk, 3, 3);
            $v3 = array_slice ($nfk, 6, 3);
            $v4 = array_slice ($nfk, 9, 3);
        }
    
      
        $q = 0;
        for($v=0; $v<count($v1); $v++){
            for($w=0; $w<count($v2); $w++){
                for($x=0; $x<count($v3); $x++){
                    for($y=0; $y<count($v4); $y++){
                        if($indekserror == 243){
                            $indekserror = 0;
                        }
                       
                             $q +=  ($error2[$indekserror]*$v1[$v]*$v2[$w]*$v3[$x]*$v4[$y]);
    
                        $indekserror++;
                    }
                }
            }
        }
        echo 'Nilai error 1.'.$in.' =';
        echo $error1 [$in] = $q;
        echo '<br>';
      
    }
    

echo tampilfk($array_mf_kode, $fk);
echo '<br>';

echo '<h3>error langkah 1 Variabel Masukan</h3>';

$gd = 0.0001;


echo '<br>';
for($ib=0; $ib < count($error1); $ib++){
  echo 'Nilai error A dan C ke-'.$ib.' =';
  echo $parametera [$ib] = round($error1[$ib]*$nfk[$ib], 3);
  echo ' || ';
  echo $parameterc [$ib] = round($error1[$ib]*$nfc[$ib], 3);
  echo '<br>';
}

echo '<h3>nilai perubahan parameter a dan c</h3>';

$in = 0;
for($i=0; $i<count($array_varia); $i++){
  
  $indeksdata = $array_varia[$i];
  for($j=0; $j<3; $j++){
		  echo 'Nilai perubahan A dan C ke-'.$in.' =';
		  echo $deltaA [$in] = round($gd*$data[$indeksdata]*$parametera[$in], 5);
		  echo ' || ';
		  echo $deltaC [$in] = round($gd*$data[$indeksdata]*$parameterc[$in], 5);
		  echo '<br>';
		  $in++;
  }
}
  
echo '<h3>Perubahan FK</h3>';
$indeksdelta =0;
for($prb=0; $prb<count($array_mf_kode); $prb++){
    $mf = $array_mf_kode[$prb];
    $jling = countLinguistic($mf);
    $ko = 1;
    for($ling=0; $ling<$jling; $ling++){
        $kodeling = $mf.$ko;

        for($ling2=0; $ling2<count($fk[$kodeling]); $ling2++){
            if($ling2 == 0){
                $fkbaru = round($deltaA[$indeksdelta]+$fk [$kodeling][$ling2],5);
                $fk [$kodeling][$ling2] = $fkbaru;
            }
            else if ($ling2 == 2){
                $fkbaru = round($deltaC[$indeksdelta]+$fk [$kodeling][$ling2],5);
                $fk [$kodeling][$ling2] = $fkbaru;
            }
		
        }
		$indeksdelta++;
        $ko++;
    }

    
}

for($prb=0; $prb<count($array_mf_kode); $prb++){
    $mf = $array_mf_kode[$prb];
    $jling = countLinguistic($mf);
    $ko = 1;
    for($ling=0; $ling<$jling; $ling++){
        $kodeling = $mf.$ko;

        for($ling2=0; $ling2<count($fk[$kodeling]); $ling2++){
            if($ling2 == 1){
                $fk[$kodeling][$ling2] = ($fk[$kodeling][0]+$fk[$kodeling][2])/2;
            }

        }

        $ko++;
    }
    
}

    
?>