<?php

class Barangmodel extends CI_Model {

    public function get_all_barang() {
        $this->db->select('tb_barang.*, tb_kategori.kategori as kategori');
        $this->db->from('tb_barang'); // Primary table
        $this->db->join('tb_kategori', 'tb_barang.kategori_id = tb_kategori.id_kategori', 'left'); // Join condition
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_barang($data) {
        return $this->db->insert('tb_barang', $data);
    }

    public function get_barang_by_id($id) {
        $this->db->where('id_barang', $id);
        $query = $this->db->get('tb_barang');
        return $query->row_array();
    }

    public function update_barang($id, $data) {
        $this->db->where('id_barang', $id);
        return $this->db->update('tb_barang', $data);
    }

    public function delete_barang($id) {
        $this->db->where('id_barang', $id);
        return $this->db->delete('tb_barang');
    }
}