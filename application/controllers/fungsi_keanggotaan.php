<?php
class fungsi_keanggotaan extends CI_Controller{
    
    var $folder =   "fungsi_keanggotaan";
    var $tables =   "fungsi_keanggotaan";
    var $pk     =   "kode";
    var $title  =   "Fungsi Keanggotaan";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $sql="select * from fungsi_keanggotaan";
        $sql2 = "select kode_ling from fungsi_keanggotaan where kode_ling like 'A%'";
        $data['title']  = $this->title;
        $data['desc']    =   "";
        $data['desc']    =   "full integration datatables";
        $data['record'] =  $this->db->query($sql)->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $kode       =   $this->input->post('RulesID');
            $kode_mf    =   $this->input->post('Air');
            $kode_ling  =   $this->input->post('Pasir');
            $a          =   $this->input->post('Kerikil');
            $b          =   $this->input->post('Semen');
            $c          =   $this->input->post('Umur');
        
            $data   =   array(  'kode'=>$kode,
                                'kode_mf'=>$kode_mf, 
                                'kode_ling'=>$kode_ling,
                                'a'=>$a,
                                'b'=>$b,
                                'c'=>$c
                            );
            $this->mcrud->update($this->tables,$data, $this->pk);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']  = $this->title;
            $data['desc']    =   "";
            $id          =  $this->uri->segment(3);
            $data['r']   =  $this->mcrud->getByID($this->tables, $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/edit',$data);
        }
    }
    

        function pencarian()
    {
        $key=$_GET['key'];
        $query="select * from guru where nama_guru LIKE '%$key%'";

        echo "<table class='table table-bordered'>
            <tr><th width=15>No</th><th>Program Studi</th><th width=315>Ketua</th><th width=215>No Izin</th><th colspan=3 width=30>Option</th></tr>";
        $data=  $this->db->query($query)->result();
        $no=1;
        foreach ($data as $r)
        {
             echo "<tr>
                 <td>$no</td>
                 <td>".  strtoupper($r->nama_guru)."</td>

                 <td width=10><span class='glyphicon glyphicon-trash' onclick='hapus($r->nip)'></span></td>
                 <td width=10>".anchor($this->uri->segment(1).'/edit/'.$r->nip,"<span class='glyphicon glyphicon-edit'></span>")."</td>
                 <td width=10><span class='fa fa-list-alt'></span></td>
                 </tr>";
             $no++;
        }

        echo"</table>";
    }

}