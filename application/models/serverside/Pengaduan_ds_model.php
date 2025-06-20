<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan_ds_model extends CI_Model
{
    var $table = 'tbl_pengaduan';
    var $column_order = array(NULL, 'NAMA', 'EMAIL', 'CREATE_AT');
    var $column_search = array('NIK', 'NAMA', 'PERIHAL', 'ISI', 'TLP', 'EMAIL', 'CREATE_AT');
    var $order = array('ID_PENGADUAN' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $this->db->where(array('STATUS' => $this->input->post("STATUS"), 'JENIS_ADUAN' => $this->input->post("JENIS_ADUAN")));
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->where(array('STATUS' => $this->input->post("STATUS"), 'JENIS_ADUAN' => $this->input->post("JENIS_ADUAN")));
        return $this->db->count_all_results();
    }
}
