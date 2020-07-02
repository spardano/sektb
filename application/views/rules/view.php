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
                                <th>Rules ID</th>
                                <th>Air</th>
                                <th>Pasir</th>
                                <th>Kerikil</th>
                                <th>Semen</th>
                                <th>Umur</th>
                                <th>KuatTekan</th>
                                <th>Aksi</th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($record as $r)
                            { ?>
                                <tr><td><?php echo $no; ?></td>
                                    <td><?php echo strtoupper($r->RulesID) ?></td>
                                    <td><?php echo strtoupper($r->Air) ?></td>
                                    <td><?php echo strtoupper($r->AgregatHalus)?></td>
                                    <td><?php echo strtoupper($r->AgregatKasar)?></td>
                                    <td><?php echo strtoupper($r->Semen)?></td>
                                    <td><?php echo strtoupper($r->Umur)?></td>
                                    <td><?php echo strtoupper($r->KuatTekan)?></td>
                                    <td><a href="<?php echo base_url().''.$this->uri->segment(1).'/edit/'.$r->RulesID;?>" data-toggle="toolip" title="Edit data" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    
                                    </tr>
                                <?php $no++;
                            }
                            ?>

                        </tbody>
                    </table>
