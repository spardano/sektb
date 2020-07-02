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
$umur = array(1=>'3', 2=>'7', 3=>'14', 4=>'21', 5=>'28');
$class = "class='col-sm-4' id='umur'";
        
?>



<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Data Uji Kuat Tekan Beton</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered">
   
     <tr>
    <td width="150">Air</td><td>
        <?php echo inputan('number', 'air','col-sm-4','Jumlah Air (Liter) ..', 1, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Pasir</td><td>
        <?php echo inputan('number', 'pasir','col-sm-4','Jumlah Pasir (Kg) ..', 1, '','');?>
        </td>
    </tr>
    <tr>
    <td width="150">Kerikil</td><td>
        <?php echo inputan('number', 'kerikil','col-sm-4','Jumlah Kerikil (Kg) ..', 1, '','');?>
    </td>
    </tr>
    <tr>
    <td width="150">Semen</td><td>
        <?php echo inputan('number', 'semen','col-sm-4','Jumlah Semen (Kg) ..', 1, '','');?>
    </td>
    </tr>
    
     <tr>
    <td width="150">Umur</td><td>
        <?php echo form_dropdown('jk', $umur,'', $class);?>
    </td>
    </tr>
    <tr>
    <td width="150">Kuat Tekan Beton</td><td>
        <?php echo inputan('number', 'kuat_tekan','col-sm-4','Kuat Tekan Beton ..', 1, '','');?>
    </td>
    </tr>
    
    
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div>
</div>
</form>