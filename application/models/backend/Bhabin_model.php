<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bhabin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    var $table = 'tbl_bhabin';
    var $primkey = 'ID_BHABIN';
    public function get($id)
    {
        if ($id) {
            $this->db->where($this->primkey, $id);
        }
        $this->db->from($this->table);
        $result = $this->db->get();
        return $result->result();
    }
    public function wilayah()
    {
        $this->db->from('tbl_kelurahan');
        $this->db->join("tbl_kecamatan", "tbl_kecamatan.ID_KECAMATAN = tbl_kelurahan.ID_KECAMATAN", "left");
        $this->db->group_by('tbl_kelurahan.ID_KECAMATAN');
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
