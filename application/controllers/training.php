<?php
class training extends CI_Controller
{

    var $folder =   "training";
    var $tables =   "data_training";
    var $tables2 = "fk_training";
    var $tables3 = "data_testing";
    var $pk     =   "id_training";
    var $title  =   "Training";

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $sql = "select * from data_training group by mse asc";
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['desc']    =   "full integration datatables";
        $data['record'] =  $this->db->query($sql)->result();
        $this->template->load('template', $this->folder . '/view', $data);
    }

    function post()
    {
        if (isset($_POST['simpan'])) {
            $id_training            = $this->kdauto('data_training', 'TRN');
            $tgl_training           = date('y-m-d');
            $qty_data_training      = $this->uri->segment(3);
            $iterasi                = $this->uri->segment(4);
            $error       = $this->uri->segment(5);
            //$fk_tr                 = $this->uri->segment(7);


            $data   =   array(
                'id_training' => $id_training,
                'tgl_training' => $tgl_training,
                'qty_data_training' => $qty_data_training,
                'iterasi' => $iterasi,
                'mse' => $error
            );

            $this->db->insert($this->tables, $data);
            //$this->simpanfktr($fk_tr, $id_training);
            redirect($this->uri->segment(1));
        }
    }

    function posttesting()
    {
        if (isset($_POST['simpan'])) {
            $id_testing             = $this->uri->segment(3);
            $id_training            = $this->uri->segment(4);
            $tgl_testing            = date('y-m-d');
            $air                    = $this->uri->segment(5);
            $pasir                  = $this->uri->segment(6);
            $kerikil                = $this->uri->segment(7);
            $semen                  = $this->uri->segment(8);
            $umur                   = $this->uri->segment(9);
            $kuat_tekan             = $this->uri->segment(10);


            $data   =   array(
                'id_testing' => $id_testing,
                'id_training' => $id_training,
                'tgl_testing' => $tgl_testing,
                'air' => $air,
                'pasir' => $pasir,
                'kerikil' => $kerikil,
                'semen' => $semen,
                'umur' => $umur,
                'kuat_tekan' => $kuat_tekan
            );

            $this->db->insert($this->tables3, $data);
            header('location:http://localhost/sektb/training/testing/' . $id_training);
        }
    }

    function simpanfktr($fk_tr, $id_training)
    {

        $kode_training = $id_training;
        $kode_mf_training = $this->kdauto2('fk_training', 'MFTR');
        $dekode = json_decode($fk_tr, true);
        $array_mf_kode  = array(
            0 => 'A',
            1 => 'H',
            2 => 'K',
            3 => 'S',
            4 => 'U'
        );

        for ($m = 0; $m < count($array_mf_kode); $m++) {
            for ($n = 1; $n <= 3; $n++) {
                $mf = $array_mf_kode[$m];
                $var = $mf . $n;
                $in2 = 0;

                $a = $dekode[$var][$in2];
                $in2++;
                $b = $dekode[$var][$in2];
                $in2++;
                $c = $dekode[$var][$in2];

                $data   =   array(
                    'kode_fk_training' => $kode_mf_training,
                    'kode_training' => $kode_training,
                    'kode_mf' => $mf,
                    'kode_ling' => $var,
                    'a' => $a,
                    'b' => $b,
                    'c' => $b
                );

                $this->db->insert($this->tables2, $data);
            }
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $kode_uji   = $this->input->post('kode_uji');
            $air        = $this->input->post('air');
            $pasir      = $this->input->post('pasir');
            $kerikil    = $this->input->post('kerikil');
            $semen      = $this->input->post('semen');
            $umur       = $this->input->post('umur');
            $kuat_tekan = $this->input->post('kuat_tekan');

            $data   =   array(
                'air' => $air,
                'pasir' => $pasir,
                'kerikil' => $kerikil,
                'semen' => $semen,
                'umur' => $umur,
                'kuat_tekan' => $kuat_tekan
            );

            $this->mcrud->update($this->tables, $data, $this->pk, $kode_uji);
            redirect($this->uri->segment(1));
        } else {

            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables, $this->pk, $id)->row_array();
            $this->template->load('template', $this->folder . '/edit', $data);
        }
    }


    function testing()
    {
        $id          =  $this->uri->segment(3);
        $sql = "select * from data_testing where id_training = '" . $id . "'";

        $umr = "select * from fk_training where kode_mf= 'U' and kode_training ='" . $id . "'";
        $data['umur'] = $this->db->query($umr)->result();
        $data['record'] =  $this->db->query($sql)->result();

        $data['title']  = "Testing";
        $data['desc']    =   "";

        $data['r']   =  $this->mcrud->getByID($this->tables, $this->pk, $id)->row_array();
        $this->template->load('template', $this->folder . '/testing', $data);
    }



    function delete()
    {
        $kode_uji     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables, array($this->pk => $kode_uji));
        if ($chekid->num_rows() > 0) {

            $del = "delete from data_training where id_training ='" . $kode_uji . "'";
            $p = mysql_query($del);

            if ($p == true) {
                echo $query = "delete from fk_training where kode_training ='" . $kode_uji . "'";
                $exek = mysql_query($query);
                if ($exek == true) {
                    redirect($this->uri->segment(1));
                }
            }
        }
    }

    function deletetesting()
    {
        $id_testing     =  $this->uri->segment(3);
        $id_training    =  $this->uri->segment(4);

        $del = "delete from data_testing where id_training ='$id_training' and id_testing = '$id_testing'";
        $p = mysql_query($del);

        if ($p == true) {
            header('location:http://localhost/sektb/training/testing/' . $id_training);
        }
    }


    function kdauto($tabel, $inisial)
    {
        $struktur    = mysql_query("SELECT * FROM $tabel");
        $field        = mysql_field_name($struktur, 0);
        $panjang    = 10;

        $qry    = mysql_query("SELECT max(" . $field . ") FROM " . $tabel);
        $row    = mysql_fetch_array($qry);
        if ($row[0] == "") {
            $angka = 0;
        } else {
            $angka        = substr($row[0], strlen($inisial));
        }

        $angka++;
        $angka    = strval($angka);
        $tmp    = "";
        for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
            $tmp = $tmp . "0";
        }
        return $inisial . $tmp . $angka;
    }

    function kdauto2($tabel, $inisial)
    {
        $struktur    = mysql_query("SELECT * FROM $tabel");
        $field        = mysql_field_name($struktur, 0);
        $panjang    = 20;

        $qry    = mysql_query("SELECT max(" . $field . ") FROM " . $tabel);
        $row    = mysql_fetch_array($qry);
        if ($row[0] == "") {
            $angka = 0;
        } else {
            $angka        = substr($row[0], strlen($inisial));
        }

        $angka++;
        $angka    = strval($angka);
        $tmp    = "";
        for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
            $tmp = $tmp . "0";
        }
        return $inisial . $tmp . $angka;
    }


    function pencarian()
    {
        $key = $_GET['key'];
        $query = "select * from data_uji_beton where kode_uji LIKE '%$key%'";

        echo "<table class='table table-bordered'>
            <tr><th width=15>No</th><th>Program Studi</th><th width=315>Ketua</th><th width=215>No Izin</th><th colspan=3 width=30>Option</th></tr>";
        $data =  $this->db->query($query)->result();
        $no = 1;
        foreach ($data as $r) {
            echo "<tr>
                 <td>$no</td>
                 <td>" .  strtoupper($r->nama_guru) . "</td>

                 <td width=10><span class='glyphicon glyphicon-trash' onclick='hapus($r->nip)'></span></td>
                 <td width=10>" . anchor($this->uri->segment(1) . '/edit/' . $r->nip, "<span class='glyphicon glyphicon-edit'></span>") . "</td>
                 <td width=10><span class='fa fa-list-alt'></span></td>
                 </tr>";
            $no++;
        }

        echo "</table>";
    }
}
