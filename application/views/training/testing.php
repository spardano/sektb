<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>


<div class="row" style="margin-bottom:20px;">

<div class="col-md-4">
<div class="panel panel-default">
    <div class="panel-heading">
        Testing ID Training <?php echo $r['id_training'];  ?>
    </div>

    <div class="panel-body">
    
    <form method="post" action="<?php echo base_url().''.$this->uri->segment(1).'/testing/'.$r['id_training'] ?>">

    <input type="hidden" required  name="id_training"  value="<?php echo $r['id_training']; ?>" class="form-control" required id="id_training" >

  <div class="form-group">
    <label for="exampleInputEmail1">Jumlah Air (L)</label>

    <input type="text" name="air"   class="form-control" required id="air" >
  
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Jumlah Pasir (Kg)</label>
    <input type="text" name="pasir"   class="form-control" required id="pasir" >
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Jumlah Kerikil (Kg)</label>
    <input type="text" name="kerikil"   class="form-control" required id="kerikil" >
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Jumlah Semen (Kg)</label>
    <input type="text" name="semen"   class="form-control" required id="kerikil" >
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Umur Beton (Hari)</label>
    <select class="form-control" name="umur">
	<option value="Null">Pilih Hari</option>
	<option value="3">3</option>
	<option value="7">7</option>
	<option value="14">14</option>
	<option value="21">21</option>
	<option value="28">28</option>
	</select>
  </div>

  <button type="submit"  class="btn btn-primary">Testing</button>
</form>
    </div>
</div>

</div>


 <?php include 'anfis_tes.php'; ?>
		<div class="col-md-8">
			   <!-- END Breadcumbs -->
						   
							<table id="example-datatables" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="7">No</th>
										<th>ID Testing</th>
										<th>Tgl Testing</th>
										<th>Hasil Estimasi</th> 
										<th>Detail</th> 
										<th>Aksi</th> 
										
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach ($record as $b)
									{ 
									   $id_testing = $b->id_testing;
										?>
										<tr><td><?php echo $no; ?></td>
											<td><?php echo strtoupper($b->id_testing) ?></td>
											<td><?php echo strtoupper($b->tgl_testing) ?></td>
											<td><?php echo strtoupper($b->kuat_tekan)?></td>
											<td><button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modaldetail<?php print $b->id_testing ?>">Detail</button></td>
											<td> <a href="<?php echo base_url().''.$this->uri->segment(1).'/deletetesting/'.$id_testing.'/'.$b->id_training;?>" data-toggle="toolip" title="Hapus data" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
										</tr>
										
										<?php 
										
										$idmodal = 'id = modaldetail'.$id_testing;
										?>
																				
												<!-- Modal -->
												<div class="modal fade" <?php print $idmodal ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">


													  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
															<center> <h3 class="modal-title" id="exampleModalLabel" style="color:black;">DETAIL HASIL TESTING ANFIS PADA DATA TRAINING <?php print $b->id_training ?> </h3> </center>
														
													  </div>
													
													  <div class="modal-body">

													
												   <?php  ?>

												   <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>ID Testing</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->id_testing; ?>
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>ID Training</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->id_training; ?>
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>Air</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->air; ?> Liter
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>Pasir</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->pasir; ?> Kg
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>Kerikil</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->kerikil; ?> Kg
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>Semen</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->semen; ?> Kg
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>Umur</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->umur; ?> Hari
																</div>
													  </div>

													  <div class="row" style="margin-bottom:20px;">
																<div class="col-md-3">
																	<label>Nilai Estimasi Kuat Tekan Beton</label>
																</div>
																<div class="col-md-9">
																	  <?php echo $b->kuat_tekan; ?> f
																</div>
													  </div>

													
															
													  </div>
												 
													  <div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
													  </div>
													
													</div>
												  </div>
												</div>

										<?php                        
										
										$no++;
									}
									?>

								</tbody>
							</table>


		</div>

</div>

                 




