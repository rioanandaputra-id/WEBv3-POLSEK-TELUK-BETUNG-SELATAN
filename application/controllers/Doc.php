<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Doc extends BaseController
{
    public function tipec()
    {
        $id = explode(",", $this->input->get_post('id'));
        $this->load->model('backend/Tipec_model', 'tipec');
        $this->tipec->update(array('STATUS' => 'SUDAH'), $id);
        $data['tipec'] = $this->tipec->get($id);
        $this->load->view("_template/doc/tipec", $data);
    }
}
