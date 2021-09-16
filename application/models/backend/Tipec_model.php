<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tipec_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    var $tb = 'tbl_tipec';
    var $pk = 'ID_TIPEC';
    var $fg = 'TOKEN_GENERATE';
    var $tb1 = 'tbl_tipec_detail';

    public function getdet($id)
    {
        $this->db->where($this->fg, $id);
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
    public function save($data)
    {
        return $this->db->insert($this->tb, $data);
    }
    public function update($data, $id)
    {
        return $this->db->where_in($this->pk, $id)->update($this->tb, $data);
    }
    public function delete($data)
    {
        return $this->db->where_in($this->pk, $data)->delete($this->tb);
    }
}
