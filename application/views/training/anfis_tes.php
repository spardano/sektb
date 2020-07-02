<?php
error_reporting(0); 
set_time_limit(50000);

if($_POST['id_training'] != 0  || $_POST['air'] != 0 || $_POST['pasir'] != 0 || $_POST['kerikil'] != 0 || $_POST['semen'] != 0 || $_POST['umur'] != 0 ) {

$fk [][] = 0;		
$nfk [] = 0;
$totalz = 0;
$z [] =0;


    //untuk menentukan banyaknya range yang diambil
    $array_mf_kode  = array(
    0 =>'A',
    1 =>'H',
    2 =>'K',
    3 =>'S',
    4 =>'U');
    //untuk mengambil data
    $array_varia  = array(
    0 =>'air',
    1 =>'pasir',
    2 =>'kerikil',
    3 =>'semen',
	4 =>'umur');

    
    $jumlah_mf = count($array_mf_kode);
    $hitung =0;
    
    while ($hitung < $jumlah_mf) {
			$mf = $array_mf_kode [$hitung];
       		$kode = countLinguistic($mf);
        
        $indeksparameter = 1;
        while ($indeksparameter <= $kode) {
			$indeks_kolom = 0;
			$ling = $array_mf_kode[$hitung].$indeksparameter;
			
			$abc = mysql_fetch_array(mysql_query("select a, b, c from fk_training where kode_ling = '".$ling."' and kode_training = '".$r['id_training']."'"));
            
           	$fk [$ling][$indeks_kolom] = $abc['a'];
			$indeks_kolom++;
			
            $fk [$ling][$indeks_kolom]=  $abc['b'];
            $indeks_kolom++;

            $fk [$ling][$indeks_kolom] = $abc['c'];
			$indeks_kolom++;

            
            $indeksparameter++;
        }
    $hitung++;
    }
    
	
//fuzzyfikasi (Lapisan ke-1)
//mengambil data

$msepembagi =0;
$msebw =0;

$data ['air'] = $_POST['air'];
$data ['pasir'] = $_POST['pasir'];
$data ['kerikil'] = $_POST['kerikil'];
$data ['semen'] = $_POST['semen'];
$data ['umur'] = $_POST['umur'];



$indeksnfk =0;
for($n1=0; $n1<count($array_mf_kode); $n1++){

	//untuk mengambil kode linguistik
	$mf          = $array_mf_kode[$n1];
	$linguistik  = $array_varia[$n1];
	$jumlahling  = countLinguistic($mf);
	

	for($baris=1; $baris<=$jumlahling; $baris++){
		$kodebaris = $mf.$baris;
		$indek_fk = 0;

		$aa = $fk[$kodebaris][$indek_fk];
		$indek_fk++;

		$bb = $fk[$kodebaris][$indek_fk];
		$indek_fk++;

		$cc = $fk[$kodebaris][$indek_fk];
		$indek_fk++;


		$x = $data[$linguistik];

		$nfk [$indeksnfk] = $Nilaifk = NilaiFk($x, $aa, $bb, $cc);
		$nfa [$indeksnfk] = nilaifa($x, $aa, $bb, $cc);
		$nfc [$indeksnfk] = nilaifc($x, $aa, $bb, $cc);
		$indeksnfk++;
	
	}
	
}



$queryf = mysql_query("select KuatTekan from rules");

$no=0;
while($a = mysql_fetch_array($queryf)){
$ambilf [$no] = $a['KuatTekan'];
$no++;
}

//rules layer (lapisan ke-2)
$indeksw = 0;
$indeksz = 0;
$wp;
for($a = 0; $a<3; $a++){
	for ($h = 3; $h<6; $h++){
		for($k=6; $k<9; $k++){
			for($s = 9; $s<12; $s++){
				for($u = 12; $u<15; $u++){
					
				
				
							$A = $nfk[$a];
							$H = $nfk[$h];
							$K = $nfk[$k];
							$S = $nfk[$s];
							$U = $nfk[$u];
							
							$lap2 [$indeksw] = $A*$H*$K*$S*$U;

					$min [$indeksw] = min($nfk[$a],$nfk[$h],$nfk[$k],$nfk[$s],$nfk[$u]);


				
					$ambilf[0];
					$fnya = $ambilf[$indeksw];

					if($min[$indeksw] != 0) {
					$zv = hitungZ($fnya, $min[$indeksw]);
					$z [$indeksz] = $zv;
					$indeksz++;
					}

					$indeksw++;
					
				}
			}
		}
	}
}




 $dibagi = array_sum($z);
 $pembagi = count($z);

 $defuzzyfikasi = $dibagi/$pembagi;
 
 if($defuzzyfikasi != 0){
			$id_testing             = kdauto('data_testing', 'TST');
            $id_training            = $r['id_training'];
            $tgl_testing            = date('y-m-d');
			$air					= $data['air'];
			$pasir					= $data['pasir'];
			$kerikil				= $data['kerikil'];
			$semen					= $data['semen'];
			$umur					= $data['umur'];
			$kuat_tekan				= $defuzzyfikasi;
			$query = mysql_query("insert into data_testing values ('$id_testing', '$id_training', '$tgl_testing', $air, $pasir, $kerikil, $semen, $umur, $kuat_tekan)");

			if($query){
				header('location:http://localhost/sektb/training/testing/'.$id_training);
			}
            
 }
 
}


function simpanoptimal($kode_mf, $kode_ling, $a, $b, $c){
	$kode_training = kdauto('data_training', 'TRN');
	$kode_fk_training = kdauto2('fk_training', 'MFT');
	$query = "insert into fk_training values('".$kode_fk_training."','".$kode_training."','".$kode_mf."','".$kode_ling."','".$a."','".$b."','".$c."')";
	$ekse = mysql_query($query);
}




function countLinguistic($mf){
	$query = mysql_query("select count(kode_mf) as mf from fungsi_keanggotaan where kode_mf ='".$mf."'");
	$countlinguistic = mysql_fetch_array($query);
	return $countlinguistic ['mf'];
}


function NilaiFk($x, $aa, $bb, $cc){
		$nilaiFK =0;
		if( $x <= $aa and $x >= $cc ){
			$nilaiFK =0;
		}

		else if ($x > $aa and $x <= $bb){
			$nilaiFK = round(($x - $aa)/($bb - $aa), 3);
		}

		else if($x > $bb and $x < $cc){
			$nilaiFK = round(($cc - $x)/($cc - $bb), 3);
		}

	 return $nilaiFK; }

function nilaifa($x, $aa, $bb, $cc){
	$nilaiFKa = round(($x - $aa)/($bb - $aa), 3);
	return $nilaiFKa;
}
function nilaifc($x, $aa, $bb, $cc){
	$nilaiFKc = round(($cc - $x)/($cc - $bb), 3);
	return $nilaiFKc;
}
function hitungZ($ling, $min){
	$abc = mysql_fetch_array(mysql_query("select a, b, c from fungsi_keanggotaan where kode_ling = '".$ling."'"));       
	$a = $abc['a'];
	$b = $abc['b'];
	$c = $abc['c'];
	$z = $min*($b-$a)+$a;
	return $z;
}

function error5($d, $x){
    $e5 = (($x-$d)^2)/($x^2);
    return $e5;
}
function error3 ($lap2, $e4){
    $e4 = $lap2*$e4;
    return $e4;
}
function error2($sumwmin, $sumw, $redw){
    $e2 = ($sumwmin/$sumw)*$redw;
    return $e2;
}


function kdauto2( $tabel , $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= 20;

	 $qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel);
	 $row	= mysql_fetch_array($qry); 
	 if ($row[0]=="") {
		 $angka=0;
	}
	 else {
		 $angka		= substr($row[0], strlen($inisial));
	 }
	
	 $angka++;
	 $angka	=strval($angka); 
	 $tmp	="";
	 for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
	 return $inisial.$tmp.$angka;
}

function kdauto( $tabel , $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= 10;

	 $qry	= mysql_query("SELECT max(".$field.") FROM ".$tabel);
	 $row	= mysql_fetch_array($qry); 
	 if ($row[0]=="") {
		 $angka=0;
	}
	 else {
		 $angka		= substr($row[0], strlen($inisial));
	 }
	
	 $angka++;
	 $angka	=strval($angka); 
	 $tmp	="";
	 for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
	 return $inisial.$tmp.$angka;
}
?>