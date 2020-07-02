<h2 style="font-weight: normal;"><?php echo $title; ?></h2>
<div class="push">
    <ol class="breadcrumb">
        <li><i class='fa fa-home'></i> <a href="javascript:void(0)">Home</a></li>
        <li><?php echo anchor($this->uri->segment(1), $title); ?></li>
        <li class="active">Data</li>
    </ol>
</div>

<script>
    function Anfis() {
        var JDTraining = $("#JDTraining").val();
        var JIterasi = $("#JIterasi").val();

        $.ajax({
            url: "<?php echo base_url() . '' . $this->uri->segment(1); ?>anfis",
            data: "JDTraining=" + JDTraining,
            "JITerasi=" + JIterasi
            success: function(html) {
                $("#anfisdisini").html('sukses');
            }
        });
    }
</script>


<?php
error_reporting(0);
$readon = null;
if ($_POST['JDTraining'] != 0 || $_POST['JIterasi'] != 0) {

    $jdtraining = $_POST['JDTraining'];
    $jd = $jdtraining;
    $jiterasi = $_POST['JIterasi'];
    $ji = $jiterasi;

    $readon = "readonly";
} else {
    $jdtraining = 'Pilih Jumlah Data Training';
    $jd = 0;
    $jiterasi = 'Pilih Jumlah Iterasi';
    $ji = 0;
}

?>
<div class="row" style="margin-bottom:20px;">

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Inisialisasi ANFIS
            </div>

            <div class="panel-body">

                <form method="post" action="<?php echo base_url() . '' . $this->uri->segment(1) ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Data Training</label>
                        <select class="form-control" <?php echo $readon ?> name="JDTraining" id="JDTraining">
                            <option value="<?php echo $jd ?>"><?php echo $jdtraining ?></option>
                            <?php
                            $query = mysql_query("select count(kode_uji) from data_uji_beton");
                            $jum = mysql_fetch_array($query);
                            $percentage = 10;
                            while ($percentage < 100) {
                                $jumlahdata = round(($percentage / 100) * $jum[0]);
                                echo '<option value= "' . $percentage . '">' . $percentage . '% (' . $jumlahdata . ' data)</option>';
                                $percentage = $percentage + 10;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah Iterasi</label>
                        <select class="form-control" <?php echo $readon ?> name="JIterasi" id="JIterasi">
                            <option value="<?php echo $ji ?>"><?php echo $jiterasi ?></option>
                            <?php
                            $loop = 10;
                            while ($loop < 50) {
                                echo '<option value= "' . $loop . '">' . $loop . ' </option>';
                                $loop = $loop + 10;
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="simpantr">
                        <label class="form-check-label" for="defaultCheck1">
                            Simpan Hasil Training
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Training</button>
                </form>
            </div>
        </div>

    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p>Proses Training Dengan ANFIS</p>
            </div>
            <div class="panel-body">
                <div id="anfisdisini" style="width:100%; overflow-y: scroll; height: 190px;">

                    <?php include 'anfis.php'; ?>

                </div>
            </div>
        </div>

        <?php

        $id_training = kdauto('data_training', 'TRN');
        $cekkd = mysql_query("select kode_training from fk_training where kode_training ='" . $id_training . "'");
        $amb = mysql_fetch_array($cekkd);

        if ($amb['kode_training'] != "") {

            $indekmse = count($mse) - 1;
            $msem = $mse[$indekmse];
            $fk_training = json_encode($nfk);
            $kirim = $_POST['JDTraining'] . '/' . $_POST['JIterasi'] . '/' . $msem;

            echo form_open($this->uri->segment(1) . '/post/' . $kirim);
        ?>


            <button type="submit" name="simpan" class="btn btn-warning">Simpan</button>

            </form>

        <?php
        } else {
            echo '<button type="button" class="btn btn-success" >Reset</button>';
        }

        ?>




    </div>

</div>

<!-- END Breadcumbs -->

<table id="example-datatables" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th width="7">No</th>
            <th>ID Training</th>
            <th>Tgl Training</th>
            <th>Error Performance</th>
            <th>Testing</th>
            <th>Aksi</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($record as $r) {
            $md = 'mymodal' . $no;
            $idmd = 'id ="' . $md . '"';
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo strtoupper($r->id_training) ?></td>
                <td><?php echo strtoupper($r->tgl_training) ?></td>
                <td><?php echo strtoupper($r->mse) ?></td>
                <td><a href="<?php echo base_url() . '' . $this->uri->segment(1) . '/testing/' . $r->id_training; ?>" class="btn btn-warning">Testing</a></td>
                <td><a href="<?php echo base_url() . '' . $this->uri->segment(1) . '/delete/' . $r->id_training; ?>" data-toggle="toolip" title="Hapus data" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    <button title="Detail data" class="btn btn-xs btn-success" data-toggle="modal" data-target="<?php echo '#' . $md; ?>"><i class="fa fa-eye"></i></button>
                </td>
            </tr>

        <?php
            include 'modaldetail.php';
            $no++;
        }
        ?>

    </tbody>
</table>