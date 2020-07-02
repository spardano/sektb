<h2 style="font-weight: normal;"><?php echo $title;?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1),$title);?></li>
        <li class="active">Data</li>
    </ol>
</div>
                    <!-- END Breadcumbs -->
                   
                    <table id="example-datatables" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="7">No</th>
                                <th>Kode</th>
                                <th>Kode MF</th>
                                <th>Kode Linguistik</th>
                                <th>a</th>
                                <th>b</th>
                                <th>c</th>
                                <th>Aksi</th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($record as $r)
                            { ?>
                                <tr><td><?php echo $no; ?></td>
                                    <td><?php echo strtoupper($r->kode) ?></td>
                                    <td><?php echo strtoupper($r->kode_mf) ?></td>
                                    <td><?php echo strtoupper($r->kode_ling)?></td>
                                    <td><?php echo strtoupper($r->a)?></td>
                                    <td><?php echo strtoupper($r->b)?></td>
                                    <td><?php echo strtoupper($r->c)?></td>
                                    <td><a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->kode;?>" data-toggle="toolip" title="Edit data" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    
                                    </tr>
                                <?php $no++;
                            }
                            ?>

                        </tbody>
                    </table>
