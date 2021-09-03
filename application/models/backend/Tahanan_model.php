<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tahanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    var $table = 'tbl_tahanan';
    var $primkey = 'ID_TAHANAN';
    public function get($id)
    {
        if ($id) {
            $this->db->where($this->primkey, $id);
        }
        $this->db->from($this->table);
        $result = $this->db->get();
        return $result->result();
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function update($data, $id)
    {
        return $this->db->where_in($this->primkey, $id)->update($this->table, $data);
    }
    public function delete($data)
    {
        return $this->db->where_in($this->primkey, $data)->delete($this->table);
    }
}
