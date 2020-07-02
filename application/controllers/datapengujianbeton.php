<?php
class datapengujianbeton extends CI_Controller
{

    var $folder =   "datapengujianbeton";
    var $tables =   "data_uji_beton";
    var $pk     =   "kode_uji";
    var $title  =   "Data Beton";

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $sql = "select * from data_uji_beton";
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['desc']    =   "full integration datatables";
        $data['record'] =  $this->db->query($sql)->result();
        $this->template->load('template', $this->folder . '/view', $data);
    }
    function post()
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
                'kode_uji' => $kode_uji,
                'air' => $air,
                'pasir' => $pasir,
                'kerikil' => $kerikil,
                'semen' => $semen,
                'umur' => $umur,
                'kuat_tekan' => $kuat_tekan
            );
            $this->db->insert($this->tables, $data);
            redirect($this->uri->segment(1));
        } else {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder . '/post', $data);
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
    function delete()
    {
        $kode_uji     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables, array($this->pk => $kode_uji));
        if ($chekid->num_rows() > 0) {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
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
