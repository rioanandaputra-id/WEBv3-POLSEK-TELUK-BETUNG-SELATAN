<?php defined('BASEPATH') or exit('No direct script access allowed');

class Berita_ds_model extends CI_Model
{
    var $table = 'tbl_berita';
    var $column_order = array(NULL, NULL, 'JUDUL', 'CREATE_AT');
    var $column_search = array('USERNAME', 'JUDUL', 'CREATE_AT');
    var $order = array('ID_BERITA' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $this->db->where(array('PUBLISH' => $this->input->post("publish")));
        $this->db->join("tbl_pengguna", "tbl_pengguna.ID_PENGGUNA = tbl_berita.ID_PENGGUNA", "left");
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
        $this->db->where(array('PUBLISH' => $this->input->post("publish")));
        $this->db->join("tbl_pengguna", "tbl_pengguna.ID_PENGGUNA = tbl_berita.ID_PENGGUNA", "left");
        return $this->db->count_all_results();
    }
}
