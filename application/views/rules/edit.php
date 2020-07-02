<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Edit Record</li>
    </ol>
</div>
     <?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='nip' value='$r[RulesID]'>";
?>



<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered">
    
    <tr>
    <td width="150">AIR</td>
    <td>
        <?php echo inputan('text', 'air','col-sm-4','Jumlah Air (Liter)..', 1, $r['Air'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">Pasir</td>
    <td>
        <?php echo inputan('text', 'pasir','col-sm-4','Jumlah Pasir (Kg)..', 1, $r['AgregatHalus'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">Kerikil</td>
    <td>
        <?php echo inputan('text', 'kerikil','col-sm-4','Jumlah Kerikil (Kg)..', 1, $r['AgregatKasar'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">Semen</td>
    <td>
        <?php echo inputan('text', 'semen','col-sm-4','Jumlah Semen (Kg)..', 1, $r['Semen'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">Umur</td>
    <td>
        <?php echo inputan('text', 'umur','col-sm-4','Jumlah Umur (Kg)..', 1, $r['Umur'],'');?>
    </tr>
    
    <tr>
    <td width="150">Kuat Tekan</td>
    <td>
        <?php echo inputan('text', 'kuat_tekan','col-sm-4','Jumlah Kuat Tekan..', 1, $r['KuatTekan'],'');?>
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