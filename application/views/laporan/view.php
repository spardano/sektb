
<?php

echo form_open('laporan');
?>
<table class="table table-bordered">
    <tr class="success"><td colspan="2">PERIODE LAPORAN PELANGGARAN</td></tr>
    <tr><td width="150">Tanggal Mulai</td><td><?php echo inputan('text', 'tanggal1','col-sm-3','Tanggal Awal ..', 1, $tanggal1,array('id'=>'datepicker'));?></td></tr>
     <tr><td>Tanggal Sampai</td><td><?php echo inputan('text', 'tanggal2','col-sm-3','Tanggal Akhir ..', 1, $tanggal2,array('id'=>'datepicker1'));?></td></tr>
     <tr><td colspan="2"><input type="submit" name="submit" value="Preview" class="btn btn-danger  btn-sm"> 
             <?php echo anchor(base_url().'laporan/laporanpembayaran/'.$tanggal1.'/'.$tanggal2.'/cetak','cetak',array('class'=>'btn btn-danger   btn-sm','target'=>'_blank'))?>
             <?php echo anchor(base_url().'laporan/laporanpembayaran/'.$tanggal1.'/'.$tanggal2.'/download','Export Ke Ms.Word',array('class'=>'btn btn-danger   btn-sm','target'=>'_blank'))?>
</table>
</form>
<?php
if(isset($_POST['submit']))
{
?>
<table class="table table-bordered">
    <tr><th width="10">No</th><th width="90">Tanggal</th>
        <th width="70">No Induk</th>
        <th>Nama Murid</th>
        <th width="60">Pelanggaran</th></tr>
    <?php
    $no=1;
    $jumlah=0;
    foreach ($transaksi as $r)
    {
        echo "<tr>
            <td>$no</td>
            <td>".  tgl_indo($r->tgl_pelanggaran)."</td>
            <td>".  strtoupper($r->nisn)."</td>
            <td>".  strtoupper($r->nama_panjang)."</td>
            <td>".  strtoupper($r->nama_pelanggaran)."</td>
            
            </tr>";
        
        $no++;
    }
    ?>
    <tr><td colspan="6"><p align='right'>Total Murid Melanggar</p></td><td align='right'><?php echo($no-1);?> <?php echo "Murid"?> </td></tr>
</table>
<?php } ?>

<script type="text/javascript">
function cetak(id,id2)
{
    window.open('http://localhost/akademik/laporan/cetak/','1397003076569','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
}
</script>



