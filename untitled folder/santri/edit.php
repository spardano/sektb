<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo form_open_multipart($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[santri_id]'>";
$gender=array(1=>'Putra',2=>'Putri');
$class      ="class='form-control' id='gender'";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Data Santri</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">

    <tr>
    <td width="150">No Induk</td><td>
        <?php echo inputan('text', 'no_induk','col-sm-4','No Induk ..', 1, $r['santri_id'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Nama Santri</td><td>
        <?php echo inputan('text', 'nama','col-sm-4',' ..', 1, $r['nama_santri'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Jenis Kelamin</td><td>
      <div class="col-sm-4">
      <?php echo form_dropdown('gender',$gender,'',$class,$r['jk']);?>
    </div>
    </td>
    </tr>
    <tr><td>Tempat, Tanggal Lahir</td>
        <td>
          <?php echo inputan('text', 'tempat_lahir','col-sm-8','Tempat Lahir ..', 0, $r['tepat_lahir'],'');?>
      <?php echo inputan('text', 'tanggal_lahir','col-sm-4','Tanggal Lahir ..', 0, $r['tanggal_lahir'],array('id'=>'datepicker'));?>
    <tr>
    <td width="150">Kelas</td><td>
    <!--<div class="col-sm-3">
    <?php echo form_dropdown('level',$level,'',$class);?>
    </div>-->
      <?php echo editcombo('kelas', 'akademik_kelas','col-sm-4','nama_kelas', 'kelas_id', '','',$r['kelas_id']);?>
    </td>
    </tr>
    </table>
  </div></div>

    <div class="panel panel-default">
 <div class="panel-heading">
   <h3 class="panel-title">Edit Data Orang Tua / Wali Santri</h3>
 </div>
 <div class="panel-body">
<table class="table table-bordered">

    <tr>
    <td width="150">Nama Ayah</td><td>
    <?php echo inputan('text', 'nama_ayah','col-sm-4','Nama Ayah ..', 1,$r['nama_ayah'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Nama Ibu</td><td>
    <?php echo inputan('text', 'nama_ibu','col-sm-4','Nama Ibu ..', 1,$r['nama_ibu'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">No Tlp Orangtua</td><td>
    <?php echo inputan('text', 'no_hp_ortu','col-sm-4','No Telp ..', 1,$r['no_hp_ort'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Alamat Kedua Orangtua</td><td>
    <?php echo inputan('text', 'alamat_ortu','col-sm-02','Alamat Kedua Orangtua ..', 1,$r['alamat_ort'],'');?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2">
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>

</table>
  </div></div>
</form>
