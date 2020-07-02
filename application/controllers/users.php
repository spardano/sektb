<?php
class users extends CI_Controller{
    
    var $folder =   "users";
    var $tables =   "app_users";
    var $pk     =   "id_users";
    var $title  =   "Users";
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['title']=  $this->title;
        $data['record']=  $this->db->get($this->tables)->result();
	$this->template->load('template', $this->folder.'/view',$data);
    }
    
    
    function level($level)
    {
        if($level==1)
        {
            return 'admin';
        }
        elseif($level==2)
        {
            return 'pihak jurusan';
        }
        elseif($level==3)
        {
            return 'pegawai';
        }
        else
        {
            return 'mahasiswa';
        }
    }
    
    function post()
    {
        if(isset($_POST['submit']))
        {
            $username  =   $this->input->post('username');
            $password  =   $this->input->post('password');
            $level     =   $this->input->post('level');
            if($level==2)
            {
                 $data   =   array('username'=>$username,'password'=>md5($password),'level'=>$level);
            }
            else
            {
                 $data   =   array('username'=>$username,'password'=>md5($password),'level'=>$level);
            }
            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
            $this->template->load('template', $this->folder.'/post',$data);
        }
    }
    function edit()
    {
        if(isset($_POST['submit']))
        {
            $username  =   $this->input->post('username');
            $password  =   $this->input->post('password');
            $id     = $this->input->post('id');
            $data   =   array('username'=>$username,'password'=>md5($password));
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect($this->uri->segment(1));
        }
        else
        {
            $data['title']=  $this->title;
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
    
    function profile()
    {
        $id=  $this->session->userdata('id_users');
        if(isset($_POST['submit']))
        {
            $username=  $this->input->post('username');
            $password=  $this->input->post('password');
            $data    =  array('username'=>$username,'password'=>  md5($password));
            $this->mcrud->update($this->tables,$data, $this->pk,$id);
            redirect('users/profile');
        }
        else
        {
            $data['title']=  $this->title;
            $data['r']   =  $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
            $this->template->load('template', $this->folder.'/profile',$data);
        }
    }
    
    function account()
    {
        if(isset($_POST['submit']))
        {
            $nama           =   $this->input->post('nama');
            $nip            =   $this->input->post('nip');
            $tempat_lahir   =   $this->input->post('tempat_lahir');
            $tanggal_lahir  =   $this->input->post('tanggal_lahir');
            $gender         =   $this->input->post('gender');
            $agama          =   $this->input->post('agama');
            $alamat         =   $this->input->post('alamat');
            $hp             =   $this->input->post('hp');
            $data           =   array(  'nama_lengkap'=>$nama,
                                        'nip'=>$nip,
                                        'tempat_lahir'=>$tempat_lahir,
                                        'tanggal_lahir'=>$tanggal_lahir,
                                        'gender'=>$gender,
                                        'agama_id'=>$agama,
                                        'alamat'=>$alamat,'hp'=>$hp);
            $this->mcrud->update('guru',$data, 'nip',$id);
            redirect('users/account');
        }
        else
        {
            $data['title']=  $this->title;
            $data['r']   =  $this->mcrud->getByID('guru',  'nip',  $id)->row_array();
            $this->template->load('template', $this->folder.'/account',$data);
        }
    }
}