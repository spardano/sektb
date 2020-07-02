<?php
class rules extends CI_Controller{
    
    var $folder =   "rules";
    var $tables =   "rules";
    var $pk     =   "RulesID";
    var $title  =   "Aturan";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $sql="select * from rules";
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
            $RulesID    =   $this->input->post('RulesID');
            $Air        =   $this->input->post('Air');
            $Pasir      =   $this->input->post('Pasir');
            $Kerikil    =   $this->input->post('Kerikil');
            $Semen      =   $this->input->post('Semen');
            $umur       =   $this->input->post('Umur');
            $KuatTekan   =   $this->input->post('KuatTekan');
        
            $data   =   array(  'Air'=>$Air,
                                'AgregatHalus'=>$Pasir, 
                                'AgregatKasar'=>$Kerikil,
                                'Semen'=>$Semen,
                                'Umur'=>$umur,
                                'KuatTekan'=>$KuatTekan
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