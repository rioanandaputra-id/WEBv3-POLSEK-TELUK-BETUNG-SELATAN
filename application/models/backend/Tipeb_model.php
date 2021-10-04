<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tipeb_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    var $tb = 'tbl_tipeb';
    var $pk = 'ID_TIPEB';
    var $tb1 = 'tbl_tipeb_detail';

    public function save_1($data)
    {
        $this->db->insert($this->tb, $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }
    public function save_2($data)
    {
        return $this->db->insert_batch($this->tb1, $data);
    }
    public function get_lapdesc()
    {
        $this->db->select_max('NO_LAP');
        $this->db->from($this->tb);
        $result = $this->db->get();
        return $result->result();
    }
    public function getdet($id)
    {
        $this->db->where($id);
        $this->db->from($this->tb1);
        $result = $this->db->get();
        return $result->result();
    }
    public function get($id)
    {
        $this->db->where_in($this->pk, $id);
        $this->db->from($this->tb);
        $result = $this->db->get();
        return $result->result();
    }
    public function update($data, $id)
    {
        return $this->db->where_in($this->pk, $id)->update($this->tb, $data);
    }
    public function delete($data)
    {
        return $this->db->where_in($this->pk, $data)->delete($this->tb);
    }
    public function delete_1($data)
    {
        return $this->db->where_in($this->pk, $data)->delete($this->tb1);
    }
}
