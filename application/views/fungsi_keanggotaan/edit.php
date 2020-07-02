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
echo "<input type='hidden' name='nip' value='$r[kode]'>";
?>



<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered">
    
    <tr>
    <td width="150">Kode MF</td>
    <td>
        <?php echo inputan('text', 'air','col-sm-4','Kode MF..', 1, $r['kode_mf'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">Kode Linguistik</td>
    <td>
        <?php echo inputan('text', 'pasir','col-sm-4','Kode Ling..', 1, $r['kode_ling'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">a</td>
    <td>
        <?php echo inputan('text', 'kerikil','col-sm-4','Parameter a..', 1, $r['a'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">b</td>
    <td>
        <?php echo inputan('text', 'semen','col-sm-4','Parameter b..', 1, $r['b'],'');?>
    </td>
    </tr>
    
    <tr>
    <td width="150">c</td>
    <td>
        <?php echo inputan('text', 'umur','col-sm-4','Parameter c..', 1, $r['c'],'');?>
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