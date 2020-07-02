<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>

 <?php
echo anchor($this->uri->segment(1).'/post',"<i class='fa fa-pencil-square-o'></i> Tambah Data",array('class'=>'btn btn-danger   btn-sm','title'=>'Tambah Data'))
?>

                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%;">Aksi</th>
                                <th width="7">Nomor</th>
                                <th>No Induk</th>
                                <th>Nama Santri</th>
                                <th>Jenis Kelamin</th>
                                <th>Madrasah</th>
                                <th>Kelas</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i=1;
                            foreach ($record as $r)
                            {
                            ?>

                            <tr>
                                <td class="text-center" >
                                    <div class="btn-group">
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/tambah/'.$r->santri_id;?>" data-toggle="tooltip" title="Tambah Pelanggaran" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->santri_id;?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo base_url().''.$this->uri->segment(1).'/delete/'.$r->santri_id;?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                       
                                    </div>
                                </td>
                                <td><?php echo $i;?></td>

                                <td><?php echo strtoupper($r->santri_id);?></td>
                                <td><?php echo strtoupper($r->nama_santri);?></td>
                                <td>
                                    <?php
                                    if($r->jk==1)
                                    {
                                        echo "Putra";
                                    }
                                    elseif($r->jk==2)
                                    {
                                        echo "Putri";
                                    }

                                    ?>
                                </td>
                                <td><?php echo strtoupper($r->nama_madrasah);?></td>
                                <td><?php echo strtoupper($r->nama_kelas);?></td>
                            </tr>

                            <?php $i++;}?>


                        </tbody>
                    </table>
                    <!-- END Datatables -->
