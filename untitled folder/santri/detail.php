<!-- Datatables -->
<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
   <ol class="breadcrumb">
       <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
       <li><?php echo anchor($this->uri->segment(1),$title);?></li>
       <li class="active">Data Detail Sanksi Santri</li>
   </ol>
</div>
    <?php
echo form_open($this->uri->segment(1).'/detail');

?>
<div class="container">

   <div class="well">
       <h4 class="alert alert-info" style="text-align: center">Data Santri</h4>
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
                                  <br/>
                                  <dt>Tempat Lahir :</dt>
                                <dd>    <?php echo strtoupper($r->tepat_lahir);?></dd>
                                  <br/>
                                  <dt>Tanggal Lahir :</dt>
                                <dd>    <?php echo strtoupper($r->tanggal_lahir);?></dd>
                                  <br/>
                                   <dt>Madrasah :</dt>
                                <dd>    <?php echo strtoupper($r->nama_madrasah);?></dd>
                                  <br/>
                                <dt>Kelas :</dt>
                                <dd>     <?php echo strtoupper($r->nama_kelas);?></dd>



                       </dl></div>
                                 <div class="span10">
           <h4 class="alert alert-success" style="text-align: center">Data Orang Tua / Wali Santri</h4>
                       <dl class="dl-horizontal">
                         <br/>
                          <dt>Nama Ayah :</dt>
                       <dd>    <?php echo strtoupper($r->nama_ayah);?></dd>
                         <br/>
                         <dt>Nama Ibu :</dt>
                       <dd>    <?php echo strtoupper($r->nama_ibu);?></dd>
                         <br/>
                         <dt>Alamat Kedua Orang Tua :</dt>
                       <dd>    <?php echo strtoupper($r->alamat_ort);?></dd>
                         <br/>
                       <dt>No Tlp :</dt>
                       <dd>    <?php echo strtoupper($r->no_hp_ort);?></dd>
                         <br/>
                       


                       </dl>

                   </div>
                            <?php $i++;}?>
           <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>

</div>
</div>
