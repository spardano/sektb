<?php

            $id_training            = kdauto('data_training', 'TRN');
            $tgl_training           = date('m/d/Y');
            $qty_data_training      = $this->input->post('JDTraining');
            $iterasi                = $this->input->post('JIterasi');
            $gradient_decent        = $this->input->post('GD');
          
      
             $data   =   array('id_training'=>$id_training,
                                'tgl_training'=>$tgl_training,
                                'qty_data_training'=>$qty_data_training, 
                                'iterasi'=>$iterasi,
                                'gradient_decent'=>$gradient_decent
                              );
            $this->db->insert($this->tables,$data);
            redirect($this->uri->segment(1));

?>