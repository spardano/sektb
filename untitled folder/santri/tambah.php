<!-- Datatables -->
<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
   <ol class="breadcrumb">
       <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
       <li><?php echo anchor($this->uri->segment(1),$title);?></li>
       <li class="active">Entry Sanksi Santri</li>
   </ol>
</div>
    <?php
echo form_open($this->uri->segment(1).'/tambah');
if($this->session->userdata('level')==3)
{
    $param="";
}
else
{
    $param=array('madrasah_id'=>$this->session->userdata('keterangan'));
}
?>

 <script src="<?php echo base_url()?>assets/js/jquery.min.js"> </script>
<script>
$(document).ready(function(){
          loadlanggar();
  });
</script>

<script>
$(document).ready(function(){
  $("#peraturan").change(function(){
      loadlanggar()
  });
});
</script>

<script>
$(document).ready(function(){
  $("#level").change(function(){
      loadlanggar();
  });
});
</script>
<!--<script>
$(document).ready(function(){
  $("#ppelanggaran").change(function(){
      loadlanggar();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#langgar").change(function(){
      loadlanggar();
  });
});
</script>-->

<script type="text/javascript">
function loadlanggar()
{
    var peraturan=$("#pelanggaran").val();
    var level_id=$("#level").val();
    $.ajax({
    url:"<?php echo base_url();?>pencatatan_pelanggaran/tampilkanlanggar",
    data:"peraturan=" + peraturan + "&level=" + level_id ,
    success: function(html)
       {
          $("#ppelanggaran").html(html);
          //var ppelanggaran =$("#ppelanggaran").val();
       }
       });
}
</script>

<div class="container">

   <div class="well">
       <h4 class="alert alert-info" style="text-align: center">Data Murid</h4>
       <div class="row-fluid">
  <?php
                           $i=1;
                           foreach ($record as $r)
                           {
                           ?>

                             <div class="span6">
                       <dl class="dl-horizontal">
                               <dt>No Induk :</dt>
                                 <dd>  <?php echo strtoupper($r->santri_id);?></dd>
                                 <br/>

                                <dt>Nama :</dt>
                                <dd><?php echo strtoupper($r->nama_santri);?></dd>
                                  <br/>
                                  <dt>Santri :</dt>
                                <dd><?php
                                        if($r->jk==1)
                                        {
                                            echo "PUTRA";
                                        }
                                        elseif($r->jk==2)
                                        {
                                            echo "PUTRI";
                                        }


                                        ?>
                                </dd>

                       </dl></div>
                                 <div class="span10">
           <h4 class="alert alert-success" style="text-align: center">Sanksi Sekarang</h4>
                       <dl class="dl-horizontal">
                           <table>
                               <tr>
                                   <td hidden="">
                                       No Induk
                                   </td>
                                   <td hidden>
                                       <?php echo inputan('text', 'dt_siswa','col-sm-2','Tanggal Melanggar ..', 0, $r->nisn,array('id'=>'nisn'));?>
                                   </td>
                               </tr>
                        <tr><td>Peraturan, Level</td>
                                                <td>
                                                    <div class="col-sm-6">
                                                       <?php echo buatcombo('pelanggaran', 'pelanggaran', '', 'nama_langgar', 'huruf_langgar', $param, array('id'=>'pelanggaran'))?>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <?php echo buatcombo('pelanggaran', 'pelanggaran','','nama_langgar','huruf_langgar',$param,array('id'=>'level'))?>
                                                        
                                                       
                                                    </div>
                                             </td></tr>
                                       <tr><td>Pelanggaran, sanksi</td>
                                           <td>
                                        <div class="col-sm-6">
                                    <?php echo combodumy('ppelanggaran', 'ppelanggaran')?>
                                        </div>
                                        </td></tr>
                                        <tr><td>Tanggal Melanggar</td>
                                            <td>

                                                <?php echo inputan('text', 'tanggal','col-sm-2','Tanggal Melanggar ..', 1, '',array('id'=>'datepicker'));?>
                                            </td></tr>
                                        <tr><td>Di Catat Oleh Guru</td>
                                            <td>

                                                <?php echo buatcombo('guru', 'guru','col-sm-4','nama_guru', 'nip', '','');?>
                                            </td></tr>
                                        <tr> <td>
                                                <div class="col-sm-7">
                                                <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm"><br>
                                                </div>
                                                <div class="col-sm-1">
                                                      <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-success btn-sm'));?>
                                                </div>
                                                </td>
            </tr>
                                    </table>


                       </dl>

                   </div>
                            <?php $i++;}?>
          

</div>
</div>
