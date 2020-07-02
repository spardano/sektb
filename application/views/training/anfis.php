<?php
//error_reporting(0); 

if($_POST['JDTraining'] != 0 || $_POST['JIterasi'] != 0 ) {

$jumlah_iterasi = $_POST['JIterasi'];		
$iterasi =0;
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


//hitung jumlah data
$countdatauji = mysql_query("select count(*) as jumlahdata from data_uji_beton");
$datasize = mysql_fetch_array($countdatauji);
$jumlahdata = $datasize['jumlahdata'];



//mengambil data
$limitdata = floor($jumlahdata*($_POST['JDTraining']/100));

$querydata = mysql_query("select * from data_uji_beton ORDER BY RAND() LIMIT ".$limitdata);
$nomordt =0;
while($row = mysql_fetch_array($querydata)){
	$datasimpan [$nomordt] = $row;
	$nomordt++;
}


//perulangan
while($iterasi < $jumlah_iterasi){

echo '<h2>Iterasi ke-'.$iterasi.'</h2>';
//inisialisasi fungsi keanggotaan pada iterasi ke-0
if($iterasi == 0){


    
    $jumlah_mf = count($array_mf_kode);
    $hitung =0;
    
    while ($hitung < $jumlah_mf) {
			$mf = $array_mf_kode [$hitung];
       		$kode = countLinguistic($mf);
        
        $indeksparameter = 1;
        while ($indeksparameter <= $kode) {
			$indeks_kolom = 0;
			$ling = $array_mf_kode[$hitung].$indeksparameter;
			
			$abc = mysql_fetch_array(mysql_query("select a, b, c from fungsi_keanggotaan where kode_ling = '".$ling."'"));
            
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
    
	}
	
	echo tampilfk($array_mf_kode, $fk);
	
	echo '<br>';
	
	
//fuzzyfikasi (Lapisan ke-1)


$nomordata =1;
$msepembagi =0;
$msebw =0;
foreach($datasimpan as $data){

echo '<br>';

echo 'DATA KE '.$nomordata;
echo '<br>';

echo 'Air = '.$data['air'].' Liter';
echo '<br>';
echo 'Pasir = '.$data['pasir'].' Kg';
echo '<br>';
echo 'Kerikil = '.$data['kerikil'].' Kg';
echo '<br>';
echo 'Semen = '.$data['semen'].' Kg';
echo '<br>';
echo 'Umur = '.$data['umur'].' Hari';
echo '<br>';
echo 'Kuat Tekan = '.$data['kuat_tekan'].' f';
echo '<br>';

echo '<h3>Lapisan ke- 1 (Proses Fuzzyfikasi)</h3>';

echo '<table border=1>';

	echo '<tr>
	<td>Linguistik</td><td>A1</td><td>A2</td><td>A3</td><td>P1</td><td>P2</td><td>P3</td><td>K1</td><td>K2</td><td>K3</td><td>S1</td><td>S2</td><td>S3</td><td>U1</td><td>U2</td><td>U3</td>
	
	</tr>';

	echo '<tr>';
    echo '<td>Nilai fuzzyfikasi</td>';

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
		
		$nfc [$indeksnfk] = nilaifc($x, $aa, $bb, $cc);
	
		$indeksnfk++;
		echo '<td>'.$Nilaifk.'</td> ';
	}
	
}

echo '</tr>';
echo '</table>';


$queryf = mysql_query("select KuatTekan from rules");

$no=0;
while($a = mysql_fetch_array($queryf)){
$ambilf [$no] = $a['KuatTekan'];
$no++;
}


echo '<h3>Lapisan ke- 2 (Rules Layer)</h3>';
//rules layer (lapisan ke-2)
$indeksw = 0;
$indeksz = 0;
$wp;
for($a = 0; $a<3; $a++){
	for ($h = 3; $h<6; $h++){
		for($k=6; $k<9; $k++){
			for($s = 9; $s<12; $s++){
				for($u = 12; $u<15; $u++){
					
					echo 'W'.$indeksw.' = ';
					echo 	$nfk[$a].' x '.$nfk[$h].' x '.$nfk[$k].' x '.$nfk[$s].' x '.$nfk[$u].' = ';
							$A = $nfk[$a];
							$H = $nfk[$h];
							$K = $nfk[$k];
							$S = $nfk[$s];
							$U = $nfk[$u];
							
					echo 	$lap2 [$indeksw] = $A*$H*$K*$S*$U;

					$min [$indeksw] = min($nfk[$a],$nfk[$h],$nfk[$k],$nfk[$s],$nfk[$u]);


				
					$ambilf[0];
					$fnya = $ambilf[$indeksw];

					if($min[$indeksw] != 0) {
					$zv = hitungZ($fnya, $min[$indeksw]);
					$z [$indeksz] = $zv;
					$indeksz++;
					}

					$indeksw++;
					echo '</br>';
				}
			}
		}
	}
}

echo '<h3>Lapisan ke- 3 (Implikasi)</h3>';
for($y=0; $y<count($min); $y++){
	echo 'Nilai Min W'.$y.' = '.$min[$y];
	echo '<br/>';
}

echo '<h3>Lapisan ke- 4 (agregasi)</h3>';
for($y=0; $y<count($z); $y++){
	echo 'Nilai z'.$y.' = '.$z[$y];
	echo '<br/>';
}

echo '<h3>Lapisan ke- 5 (Defuzzyfikasi)</h3>';

echo 'Hasil Defuzzyfikasi = ';

 $dibagi = array_sum($z);
 $pembagi = count($z);

 $defuzzyfikasi = $dibagi/$pembagi;
 echo $defuzzyfikasi;
 echo '<br>';

 $msepembagi = $msepembagi + msep($defuzzyfikasi, $data['kuat_tekan']);
 $dt = $data['kuat_tekan']^2;
 $msebw = $msebw + $dt;

 include 'anfis_mundur.php';

 $nomordata++;
}

echo '<br>'; 
echo 'Nilai MSE Iterasi ke-'.$iterasi.' =';

echo $mse [$iterasi] = mse($msepembagi, $msebw);
echo '<br>';

$iterasi++;
}

if($_POST['simpantr'] == 1){

	for($l1=0; $l1<count($array_mf_kode); $l1++){
		for($l2=1; $l2<=3; $l2++){
			$in =0;
			$kode_ling = $array_mf_kode[$l1].$l2;
			$kode_mf = $array_mf_kode[$l1];
	
			$a = $fk [$kode_ling][$in];
			$in++;
			$b = $fk[$kode_ling][$in];
			$in++;
			$c = $fk[$kode_ling][$in];
	
			simpanoptimal($kode_mf, $kode_ling, $a, $b, $c);
			
		}
	}

}

}


function simpanoptimal($kode_mf, $kode_ling, $a, $b, $c){
	$kode_training = kdauto('data_training', 'TRN');
	$kode_fk_training = kdauto2('fk_training', 'MFT');
	$query = "insert into fk_training values('".$kode_fk_training."','".$kode_training."','".$kode_mf."','".$kode_ling."','".$a."','".$b."','".$c."')";
	$ekse = mysql_query($query);
}


function mse($msepembagi, $msebw){
	$rm = abs($msepembagi/$msebw);
	$mse = sqrt($rm);
	return $mse;
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
	if($x <= $aa and $x >= $cc ){
	$nilaiFKa =0;
	}
	else{
	$nilaiFKa = round(($x - $aa)/($bb - $aa), 3);	
	}
	return $nilaiFKa;
}
function nilaifc($x, $aa, $bb, $cc){
	if($x <= $aa and $x >= $cc ){
	$nilaiFKc =0;
	}else{
	$nilaiFKc = round(($cc - $x)/($cc - $bb), 3);
	}
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
function msep($d, $x){
	$rmse = ($x - $d)^2;
	return $rmse;
}
function error5($d, $x){
    $e5 = (($x-$d)^2)/($x^2);
	return $e5;
}
function error3 ($w3, $e4){
    $e4 = $w3*$e4;
    return $e4;
}

function error2($sumwmin, $sumw, $redw){
    $e2 = ($sumwmin/$sumw)*$redw;
    return $e2;
}


function kdauto2($tabel , $inisial){
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

function tampilfk($array_mf_kode, $fk){
	$tabeltampilfk = 
	'<table border="1">
	<tr>
	<td>Linguistik</td>
	<td>a</td>
	<td>b</td>
	<td>c</td>
	</tr>';
	
	for($x=0; $x<count($array_mf_kode); $x++){
		
		for($y=1; $y<=3; $y++){
			$lingi = $array_mf_kode [$x].$y;
			$tabeltampilfk = $tabeltampilfk.'<tr>
			<td>'.$lingi.'</td>
			<td>'.$fk[$lingi] [0].'</td>
			<td>'.$fk[$lingi] [1].'</td>
			<td>'.$fk[$lingi] [2].'</td>
			</tr>';
		}
	}
	return $tabeltampilfk = $tabeltampilfk.'</table>';
}
?>