<?php

class BarangController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Barangmodel');
    }
    public function index() {
        $data['items'] = $this->Barangmodel->get_all_barang();
        $this->load->view('barang/index');
    }

    public function barang() {
        $data = $this->Barangmodel->get_all_barang();
        echo json_encode($data);
    }

    public function create_barang() {
        $data = array (
            'kategori' => $this->input->post('kategori'),
            'barang' => $this->input->post('barang'),
            'stok' => $this->input->post('stok'),
        );
        $insert = $this->Barangmodel->insert_barang($data);
        echo json_encode(['Success' => $insert]);
    }

    public function get_barang() {
        $id = $this->input->post('id_barang');
        $data = $this->Barangmodel->get_barang_by_id($id);
        echo json_encode($data);
    }

    public function update_barang() {
        $id = $this->input->post('id_barang');
        $data = array (
            'kategori_id' => $this->input->post('kategori_id'),
            'barang' => $this->input->post('barang'),
            'stok' => $this->input->post('stok'),
        );
        $update = $this->Barangmodel->update_barang($id, $data);
        echo json_encode(['Success' => $update]);
    }

    public function delete_barang() {
        $id = $this->input->post('id_barang');
        $delete = $this->Barangmodel->delete_barang($id);
        echo json_encode(['Success' => $delete]);
    }
    
}