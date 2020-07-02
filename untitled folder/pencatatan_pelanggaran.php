<?php
class pencatatan_pelanggaran extends CI_Controller{

    var $folder =   "pencatatan_pelanggaran";
    var $tables =   "pencatatan_pelanggaran";
    var $pk     =   "pp_id";
    var $title  =   "Daftar Santri Melanggar";

    function __construct() {
        parent::__construct();
      //  $this->load->model('post_pp');
    }

    function index()
    {
        $sql="SELECT a.*,m.nama_santri,m.jk,n.nama_pelanggaran,r.nama_peraturan, s.nama_level,t.nama_kelas
              FROM pencatatan_pelanggaran as 
              a,santri as m, 
              pelanggaran as n, 
              peraturan as r,
              level as s,
              akademik_kelas as t
              WHERE a.santri_id=m.santri_id 
              and a.pelanggaran_id=n.pelanggaran_id 
              and n.peraturan_id=r.peraturan_id
              and n.level_id=s.level_id
              and m.kelas_id=t.kelas_id
                ";
        $data['record']  =  $this->db->query($sql)->result();
        $data['title']=  $this->title;
        $data['desc']="";
        $data['desc']    =  "Full DataTables Integration";


  
$this->template->load('template', $this->folder.'/view',$data);

    }


    function post()
    {
        if(isset($_POST['submit']))
        {
            // pribadi
            $santri               =   $this->input->post('santri');
            $pelanggaran          =   $this->input->post('pelanggaran');
            $tanggal              =   $this->input->post('tanggal');
            $asatidz              =   $this->input->post('asatidz');
            
            $data          = array('santri_id'=>$santri,
                'pelanggaran_id'=>$pelanggaran,
                'tanggal_pelanggaran'=>$tanggal,'asatidz_id'=>$asatidz);
            $this->db->insert($this->tables,$data);
            $data1=array('pp_id');
            $this->session->set_flashdata('pesan', "<div class='alert alert-success'>Data $nama Sudah Tersimpan </div>");
            redirect('pencatatan_pelanggaran/post');
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="";
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }

    function edit()
    {
        $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $query      = "SELECT * from pencatatan_pelanggaran a
                    left join santri b on a.santri_id=b.santri_id
                    left join akademik_kelas c on b.kelas_id=c.kelas_id
                    left join akademik_madrasah d on c.madrasah_id=d.madrasah_id
                where a.pp_id ='$id'";;
            $data['record']   =  $this->db->query($query)->result();
        if(isset($_POST['submit']))
        {
            $id     = $this->input->post('id');
                        // pribadi
                        $santri               =   $this->input->post('santri');
                        $ppelanggaran          =   $this->input->post('ppelanggaran');
                        $tanggal             =   $this->input->post('tanggal');
                        $asatidz             =   $this->input->post('asatidz');
                        $data          = array('santri_id'=>$santri,'pelanggaran_id'=>$ppelanggaran,'tanggal_pelanggaran'=>$tanggal, 'asatidz_id'=>$asatidz);
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            $pesan="<div class='alert alert-success'>Data Pencatatan Pelanggaran $santri Sudah diubah Kedatabase !!</div>";
            $this->session->set_flashdata('pesan', $pesan);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            $data['desc']="";
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
    function pencarian()
    {
        $key=$_GET['key'];
        $query="select * from pp_id where santri_id LIKE '%$key%'";

        echo "<table class='table table-bordered'>
            <tr><th width=15>No</th><th>Program Studi</th><th width=315>Ketua</th><th width=215>No Izin</th><th colspan=3 width=30>Option</th></tr>";
        $data=  $this->db->query($query)->result();
        $no=1;
        foreach ($data as $r)
        {
             echo "<tr>
                 <td>$no</td>
                 <td>".  strtoupper($r->pp_id)."</td>

                 <td width=10><span class='glyphicon glyphicon-trash' onclick='hapus($r->santri_id)'></span></td>
                 <td width=10>".anchor($this->uri->segment(1).'/edit/'.$r->santri_id,"<span class='glyphicon glyphicon-edit'></span>")."</td>
                 <td width=10><span class='fa fa-list-alt'></span></td>
                 </tr>";
             $no++;
        }

        echo"</table>";
    }
    function tampilkanlanggar()
    {
        $peraturan      =   $_GET['peraturan'];
        $level          =   $_GET['level'];
        $data           =   $this->db->get_where('pelanggaran',array('peraturan_id'=>$peraturan, 'level_id'=>$level))->result();
        foreach ($data as $r)
        {
            echo "<option value='$r->pelanggaran_id'>".  strtoupper($r->nama_pelanggaran)."</option>";
        }
    }
    function detail(){

        $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $query      = "SELECT * from pencatatan_pelanggaran a
                    left join santri b on a.santri_id=b.santri_id
                    left join akademik_kelas c on b.kelas_id=c.kelas_id
                    left join akademik_madrasah d on c.madrasah_id=d.madrasah_id
                    left join pelanggaran e on a.pelanggaran_id=e.pelanggaran_id
                    left join peraturan f on e.peraturan_id=f.peraturan_id
                    left join level g on e.level_id=g.level_id
                    left join asatidz h on a.asatidz_id = h.asatidz_id
                where a.pp_id ='$id'";
            $data['record']   =  $this->db->query($query)->result();
            $this->template->load('template', $this->folder.'/detail',$data);
    }
    
    


}
