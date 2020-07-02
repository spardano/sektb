<?php
class santri extends CI_Controller{

    var $folder =   "santri";
    var $tables =   "santri";
    var $pk     =   "santri_id";
    var $title  =   "Data Santri";

    function __construct() {
        parent::__construct();
    }

    function index()
    {
        $sql=   "SELECT a.*,t.nama_kelas,u.nama_madrasah
              FROM santri as a,
              akademik_kelas as t,
              akademik_madrasah as u 
              WHERE a.kelas_id=t.kelas_id
              and t.madrasah_id=u.madrasah_id";
      $data['record']  =  $this->db->query($sql)->result();
      $data['title']   =  "Data Santri";
      $data['desc']    =  "Full DataTables Integration";
      $this->template->load('template', $this->folder.'/view',$data); 
    }
    function post()
    {
        if(isset($_POST['submit']))
        {
          $no_idnuk           =   $this->input->post('no_induk');
          $nama               =   $this->input->post('nama');
          $alamat             =   $this->input->post('alamat');
          $tahun              =   $this->input->post('tahun_angkatan');
          $tempat_lahir       =   $this->input->post('tempat_lahir');
          $tgl_lahir          =   $this->input->post('tanggal_lahir');
          $gender             =   $this->input->post('gender');
          $angkatan           =   $this->input->post('tahun_angkatan');
          $kelas              =   $this->input->post('kelas');
          // orang tua
          $nama_ayah          =   $this->input->post('nama_ayah');
          $nama_ibu           =   $this->input->post('nama_ibu');
          $alamat_ortu        =   $this->input->post('alamat_ortu');
          $no_hp_ortu         =   $this->input->post('no_hp_ortu');

          // catatan pelanggaran
          $level              =   $this->input->post('level');

            $data   =   array('santri_id'=>$no_idnuk,'nama_santri'=>$nama,
                                            'jk'=>$gender,
                                            'tepat_lahir'=>$tempat_lahir,
                                            'tanggal_lahir'=>$tgl_lahir,
                                            'kelas_id'=>$kelas,
                                            'angkatan_id'=> $angkatan,
                                            'nama_ayah'=>$nama_ayah,
                                            'nama_ibu'=>$nama_ibu,
                                            'alamat_ort'=>$alamat_ortu,
                                            'no_hp_ort'=>$no_hp_ortu,
                                            'pp_id'=>$level);

            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }

        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }



    function edit()
    {
        if(isset($_POST['submit']))
        {
          $no_idnuk           =   $this->input->post('no_induk');
          $nama               =   $this->input->post('nama');
          $alamat             =   $this->input->post('alamat');
          $tahun              =   $this->input->post('tahun_angkatan');
          $tempat_lahir       =   $this->input->post('tempat_lahir');
          $tgl_lahir          =   $this->input->post('tanggal_lahir');
          $gender             =   $this->input->post('gender');
          $angkatan           =   $this->input->post('tahun_angkatan');
          $kelas              =   $this->input->post('kelas');
          // orang tua
          $nama_ayah          =   $this->input->post('nama_ayah');
          $nama_ibu           =   $this->input->post('nama_ibu');
          $alamat_ortu        =   $this->input->post('alamat_ortu');
          $no_hp_ortu         =   $this->input->post('no_hp_ortu');

          // catatan pelanggaran
          $level              =   $this->input->post('level');
            $id     = $this->input->post('id');
            $data   =   array('santri_id'=>$no_idnuk,'nama_santri'=>$nama,
                                            'jk'=>$gender,
                                            'tepat_lahir'=>$tempat_lahir,
                                            'tanggal_lahir'=>$tgl_lahir,
                                            'kelas_id'=>$kelas,
                                            'angkatan_id'=> $angkatan,
                                            'nama_ayah'=>$nama_ayah,
                                            'nama_ibu'=>$nama_ibu,
                                            'alamat_ort'=>$alamat_ortu,
                                            'no_hp_ort'=>$no_hp_ortu,
                                            'pp_id'=>$level);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }

    function delete()
    {
        $id     =  $this->uri->segment(3);
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid->num_rows()>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $this->uri->segment(3));
        }
        redirect($this->uri->segment(1));
    }
    function detail()
    {
        $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $query      = "SELECT * from santri a
                    left join akademik_kelas b on a.kelas_id=b.kelas_id
                    left join akademik_madrasah c on b.madrasah_id=c.madrasah_id
                where a.santri_id ='$id'";
            $data['record']   =  $this->db->query($query)->result();
             $this->template->load('template', $this->folder.'/detail',$data);
    }
    function tambah(){
        $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $query      = "SELECT * from dt_siswa 
                where nisn ='$id'";
            $data['record']   =  $this->db->query($query)->result();
            
            
          if(isset($_POST['submit']))
        {
          $santri                 =   $this->input->post('santri');
          $ppelanggaran           =   $this->input->post('ppelanggaran');
          $tanggal             =   $this->input->post('tanggal');
          $asatidz                =   $this->input->post('asatidz');
          

            $data   =   array('santri_id'=>$santri,'tanggal_pelanggaran'=>$tanggal, 'pelanggaran_id'=>$ppelanggaran,'keterangan'=>'t', 'asatidz_id'=>$asatidz);
            $this->db->insert('pencatatan_pelanggaran',$data,$this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $this->template->load('template', $this->folder.'/tambah',$data);
        }
    }
    function pencarian()
    {
        $key=$_GET['key'];
        $query="select * from santri where nama_santri LIKE '%$key%'";

        echo "<table class='table table-bordered'>
            <tr><th width=15>No</th><th>Program Studi</th><th width=315>Ketua</th><th width=215>No Izin</th><th colspan=3 width=30>Option</th></tr>";
        $data=  $this->db->query($query)->result();
        $no=1;
        foreach ($data as $r)
        {
             echo "<tr>
                 <td>$no</td>
                 <td>".  strtoupper($r->nama_santri)."</td>

                 <td width=10><span class='glyphicon glyphicon-trash' onclick='hapus($r->santri_id)'></span></td>
                 <td width=10>".anchor($this->uri->segment(1).'/edit/'.$r->santri_id,"<span class='glyphicon glyphicon-edit'></span>")."</td>
                 <td width=10><span class='fa fa-list-alt'></span></td>
                 </tr>";
             $no++;
        }

        echo"</table>";
    }
}
