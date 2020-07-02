<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Entry Record</li>
    </ol>
</div>
<?php
echo form_open_multipart($this->uri->segment(1).'/post');
$gender=array(1=>'Putra',2=>'Putri');
$class      ="class='form-control' id='gender'";
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Data Santri</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">

    <tr>
    <td width="150">No Induk</td><td>
        <?php echo inputan('text','no_induk','col-sm-4','No Induk ..', 1, '','');?>
    </td>
    </tr>
    <tr>
<td width="150">Nama Santri</td><td>
  <?php echo inputan('text', 'nama','col-sm-4','Nama Santri ..', 1, '','');?>
</td>
</tr>
    <tr>
    <td width="150">Jenis Kelamin</td><td>
      <div class="col-sm-4">
      <?php echo form_dropdown('gender',$gender,'',$class);?>
    </div>
    </td>

  </tr>
  <tr><td>Tempat, Tanggal Lahir</td>
      <td>
          <?php echo inputan('text', 'tempat_lahir','col-sm-6','Tempat Lahir ..', 0, '','');?>
          <?php echo inputan('text', 'tanggal_lahir','col-sm-2','Tanggal Lahir ..', 0, '',array('id'=>'datepicker'));?>
      </td></tr>
  <tr>
<td width="150">Kelas</td><td>
<!--<div class="col-sm-3">
<?php echo form_dropdown('level',$level,'',$class);?>
</div>-->
  <?php echo buatcombo('kelas','akademik_kelas','col-sm-4','nama_kelas','kelas_id','',''); ?>
</td>
</tr>
</table>
  </div></div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Data Orang Tua / Wali Santri</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
<tr>
<td width="150">Nama Ayah</td><td>
<?php echo inputan('text', 'nama_ayah','col-sm-4','Nama Ayah ..', 0, '','');?>
</td>
</tr>
<tr>
<td width="150">Nama Ibu</td><td>
<?php echo inputan('text', 'nama_ibu','col-sm-4','Nama Ibu ..', 0, '','');?>
</td>
</tr>
<tr>
<td width="150">No Tlp Orangtua</td><td>
<?php echo inputan('text', 'no_hp_ortu','col-sm-4','No Telp ..', 1, '','');?>
</td>
</tr>
<tr>
    <td width="150">Alamat Kedua Orangtua</td><td >
<?php echo inputan('text', 'alamat_ortu','from-control','Alamat Kedua Orangtua ..', 0, '','');?>
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
