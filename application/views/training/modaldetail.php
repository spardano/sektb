
<!-- Modal -->
<div class="modal fade" <?php echo $idmd; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            <center> <h3 class="modal-title" id="exampleModalLabel" style="color:black;">HASIL TRAINING ANFIS</h3> </center>
        
      </div>
    
      <div class="modal-body">

    
   <?php  ?>

   <div class="row" style="margin-bottom:20px;">
                <div class="col-md-3">
                    <label>ID Training</label>
                </div>
                <div class="col-md-9">
                      <?php echo $r->id_training; ?>
                </div>
      </div>

      <div class="row" style="margin-bottom:20px;">
                <div class="col-md-3">
                    <label>Tanggal Training</label>
                </div>
                <div class="col-md-9">
                      <?php echo $r->tgl_training; ?>
                </div>
      </div>

      <div class="row" style="margin-bottom:20px;">
                <div class="col-md-3">
                    <label>Jumlah Iterasi</label>
                </div>
                <div class="col-md-9">
                      <?php echo $r->iterasi.' Iterasi'; ?>
                </div>
      </div>

      <div class="row" style="margin-bottom:20px;">
                <div class="col-md-3">
                    <label>Jumlah Data Training</label>
                </div>
                <div class="col-md-9">
                      <?php echo $r->qty_data_training.'%'; ?>
                </div>
      </div>


      <div class="row" style="margin-bottom:20px;">
                <div class="col-md-3">
                    <label>Nilai RMSE</label>
                </div>
                <div class="col-md-9">
                      <?php
                      echo $r->mse?>
                </div>
      </div>

      <div class="row" style="margin-bottom:20px;">
                <div class="col-md-3">
                    <label>Susunan MF Teroptimasi:</label>
                </div>
                <div class="col-md-9">

               <?php
               
               $ambek = mysql_query("select * from fk_training where kode_training ='".$r->id_training."'");
                    
               while( $dt = mysql_fetch_array($ambek)){
                  

                   echo $dt['kode_ling'].'&nbsp';
                   echo '| &nbsp';
                   echo 'a ='.$dt['a'].'&nbsp';
                   echo 'b ='.$dt['b'].'&nbsp';
                   echo 'c ='.$dt['c'].'&nbsp';

                   echo '<br>';
               }
               
               ?>
				
                </div>
            </div>
            
      </div>
    

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
        
    </div>
  </div>
</div>
