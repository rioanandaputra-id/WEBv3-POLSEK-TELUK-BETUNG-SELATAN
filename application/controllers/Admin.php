<?php defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Admin extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }
    // BERITA
    public function berita()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Berita', 'menuPage' => 2];
        $this->LvBackend('_backend/berita/list', $this->global, NULL, NULL, NULL);
    }
    public function berita_add()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Tambah Berita', 'menuPage' => 2];
        $this->LvBackend('_backend/berita/add', $this->global, NULL, NULL, NULL);
    }
    public function berita_edit($id)
    {
        $this->load->model('backend/Berita_model', 'berita');
        $data['berita'] = $this->berita->get($id);
        $this->global = ['pageTitle' => 'Menu Informasi Edit Berita', 'menuPage' => 2];
        $this->LvBackend('_backend/berita/edit', $this->global, NULL, $data, NULL);
    }
    public function berita_ajax()
    {
        $this->load->model('serverside/Berita_ds_model', 'ds_berita');
        $list = $this->ds_berita->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_BERITA;
            $retVal = ($field->TIPE_THUMBNAIL == 'url') ? $field->URL_THUMBNAIL : base_url('assets/upload/berita/') . $field->PATH . '/' . $field->URL_THUMBNAIL;
            $row[] = '<img height="50px" src="' . $retVal . '"/>';
            $row[] = $field->JUDUL . '<br> (<code>' . $field->DILIHAT . 'x dilihat</code>)';
            $row[] = '<strong>' . $field->USERNAME . '</strong><br>' . $field->CREATE_AT;
            // $button_view = '<a class="btn btn-sm btn-primary" href="' . base_url('informasi/berita/detail/') . $field->ID_BERITA . '" target="_BLANK"><i class="fas fa-eye"></i></a>';
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_BERITA . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<a class="btn btn-sm btn-warning" href="' . base_url('admin/informasi/berita/ubah') . $this->input->get_post("id_info") . "/" . $field->ID_BERITA . '"><i class="fas fa-edit text-white"></i></a>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_BERITA . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_BERITA . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update . $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_berita->count_all(),
            "recordsFiltered" => $this->ds_berita->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function berita_publish()
    {
        $this->load->model('backend/Berita_model', 'berita');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->berita->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function berita_delete()
    {
        $this->load->model('backend/Berita_model', 'berita');
        $data = $this->input->post('data');
        if (isset($data)) {
            if (is_array($data)) {
                foreach ($data as $key) {
                    $folder = $this->berita->get($key);
                    $path = "./assets/upload/berita/" . $folder[0]->PATH . "/";
                    if (is_dir($path)) {
                        delete_files($path, true);
                        rmdir($path);
                    }
                }
            } else {
                $folder = $this->berita->get($data);
                $path = "./assets/upload/berita/" . $folder[0]->PATH . "/";
                if (is_dir($path)) {
                    delete_files($path, true);
                    rmdir($path);
                }
            }
            $query = $this->berita->delete($data);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function berita_save()
    {
        $this->load->model('backend/Berita_model', 'berita');
        $rules = array(
            array(
                'field' => 'url_thumbnail',
                'label' => 'Gambar Utama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'judul',
                'label' => 'Judul Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'tgl',
                'label' => 'Tanggal Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'publish',
                'label' => 'Status Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'isi',
                'label' => 'Isi Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'ID_PENGGUNA' => 1,
                'PATH' => $this->input->get_post('path'),
                'URL_THUMBNAIL' => $this->input->get_post('url_thumbnail'),
                'TIPE_THUMBNAIL' => $this->input->get_post('tipe_thumbnail'),
                'JUDUL' => $this->input->get_post('judul'),
                'ISI' => $this->input->get_post('isi'),
                'CREATE_AT' =>  $this->input->get_post('tgl'),
                'PUBLISH' =>  $this->input->get_post('publish')
            );
            $query = $this->berita->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Berita Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Berita Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    function berita_image_upload()
    {
        $folder = $this->input->get_post("folder");
        $path1 = './assets/upload/berita/' . $folder . "/";
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        if ($this->input->get_post('url')) {
            $msg = array(
                "status" => true,
                "type" => "url",
                "url" => $this->input->get_post('url')
            );
            echo json_encode($msg);
        } else {
            if ($_FILES["unggah"]["name"] != "") {
                $config['upload_path'] =  $path1;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('unggah')) {
                    $this->output->set_status_header('404');
                } else {
                    $data = $this->upload->data();
                    $msg = array(
                        "status" => true,
                        "type" => "unggah",
                        "path" => $folder,
                        "url" =>  $data['file_name']
                    );
                    echo json_encode($msg);
                }
            } else {
                $this->output->set_status_header('404');
            }
        }
    }
    public function berita_image_delete()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (file_exists($file_name)) {
            unlink($file_name);
        }
    }
    public function berita_update()
    {
        $this->load->model('backend/Berita_model', 'berita');
        $rules = array(
            array(
                'field' => 'url_thumbnail',
                'label' => 'Gambar Utama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'judul',
                'label' => 'Judul Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'tgl',
                'label' => 'Tanggal Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'publish',
                'label' => 'Status Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'isi',
                'label' => 'Isi Berita',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'ID_PENGGUNA' => 1,
                'PATH' => $this->input->get_post('path'),
                'URL_THUMBNAIL' => $this->input->get_post('url_thumbnail'),
                'TIPE_THUMBNAIL' => $this->input->get_post('tipe_thumbnail'),
                'JUDUL' => $this->input->get_post('judul'),
                'ISI' => $this->input->get_post('isi'),
                'CREATE_AT' =>  $this->input->get_post('tgl'),
                'PUBLISH' =>  $this->input->get_post('publish')
            );
            $query = $this->berita->update($data, $this->input->get_post('id'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Berita Telah Ubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Berita Tidak Ubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    // BHABIN & KRINGSERSE
    public function bhabin()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Bhabinkamtibmas & Kring Serse', 'menuPage' => 2];
        $this->LvBackend('_backend/bhabin/list', $this->global, NULL, NULL, NULL);
    }
    public function bhabin_add()
    {
        $this->load->model('backend/Bhabin_model', 'bhabin');
        $data['wilayah'] = $this->bhabin->wilayah();
        $this->global = ['pageTitle' => 'Menu Informasi Tambah Bhabinkamtibmas & Kring Serse', 'menuPage' => 2];
        $this->LvBackend('_backend/bhabin/add', $this->global, NULL, $data, NULL);
    }
    public function bhabin_edit($id)
    {
        $this->load->model('backend/Bhabin_model', 'bhabin');
        $data['bhabin'] = $this->bhabin->get($id);
        $data['wilayah'] = $this->bhabin->wilayah();
        $this->global = ['pageTitle' => 'Menu Informasi Ubah Bhabinkamtibmas & Kring Serse', 'menuPage' => 2];
        $this->LvBackend('_backend/bhabin/edit', $this->global, NULL, $data, NULL);
    }
    public function bhabin_ajax()
    {
        $this->load->model('serverside/Bhabin_ds_model', 'ds_bhabin');
        $list = $this->ds_bhabin->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_BHABIN;
            $gambar1 = ($field->TIPE_FOTO_BHABIN == 'url') ? $field->FOTO_BHABIN : base_url('assets/upload/bhabin/') . $field->FOTO_BHABIN;
            $gambar2 = ($field->TIPE_FOTO_KRINGSERSE == 'url') ? $field->FOTO_KRINGSERSE : base_url('assets/upload/bhabin/') . $field->FOTO_KRINGSERSE;
            $row[] = '<img height="80px" src="' . $gambar1 . '"/>';
            $row[] = '<strong>' . $field->NAMA_BHABIN . '</strong><br>' . '<div class="d-grid gap-2 d-md-block"><a target="_BLANK" href="tel:' . $field->TLP_BHABIN . '" class="btn btn-sm btn-warning"><i class="fa fa-phone"></i> ' . $field->TLP_BHABIN . '</a> <a target="_BLANK" href="https://wa.me/' . $field->WA_BHABIN . '" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> ' . $field->WA_BHABIN . '</a></div>' . $field->KECAMATAN . '<br>' . $field->KELURAHAN;
            $row[] = '<img height="80px" src="' . $gambar2 . '"/>';
            $row[] = '<strong>' . $field->NAMA_KRINGSERSE . '</strong><br>' . '<div class="d-grid gap-2 d-md-block"><a target="_BLANK" href="tel:' . $field->TLP_KRINGSERSE . '" class="btn btn-sm btn-warning"><i class="fa fa-phone"></i> ' . $field->TLP_KRINGSERSE . '</a> <a target="_BLANK" href="https://wa.me/' . $field->WA_KRINGSERSE . '" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> ' . $field->WA_KRINGSERSE . '</a></div>' . $field->KECAMATAN . '<br>' . $field->KELURAHAN;
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_BHABIN . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<a class="btn btn-sm btn-warning" href="' . base_url('admin/informasi/bhabin/ubah/') . $field->ID_BHABIN . '"><i class="fas fa-edit text-white"></i></a>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_BHABIN . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_BHABIN . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update . $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_bhabin->count_all(),
            "recordsFiltered" => $this->ds_bhabin->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    function bhabin_image_upload()
    {
        $path1 = './assets/upload/bhabin/';
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        if ($this->input->get_post('url')) {
            $msg = array(
                "status" => true,
                "type" => "url",
                "url" => $this->input->get_post('url')
            );
            echo json_encode($msg);
        } else {
            if ($_FILES["unggah"]["name"] != "") {
                $config['upload_path'] =  $path1;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('unggah')) {
                    $this->output->set_status_header('404');
                } else {
                    $data = $this->upload->data();
                    $msg = array(
                        "status" => true,
                        "type" => "unggah",
                        "url" =>  $data['file_name']
                    );
                    echo json_encode($msg);
                }
            } else {
                $this->output->set_status_header('404');
            }
        }
    }
    public function bhabin_save()
    {
        $this->load->model('backend/Bhabin_model', 'bhabin');
        $rules = array(
            array(
                'field' => 'FOTO_BHABIN',
                'label' => 'Foto Bhabinkamtibmas',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum diunggah.',
                ),
            ),
            array(
                'field' => 'FOTO_KRINGSERSE',
                'label' => 'Foto Kring Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA_BHABIN',
                'label' => 'Nama Bhabin',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'WA_BHABIN',
                'label' => 'WhatsApp Bhabin',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TLP_BHABIN',
                'label' => 'Telpon Bhabin',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'NAMA_KRINGSERSE',
                'label' => 'Nama Kring Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'WA_KRINGSERSE',
                'label' => 'WhatsApp Kring Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TLP_KRINGSERSE',
                'label' => 'Telpon Krings Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'ID_KELURAHAN',
                'label' => 'Wilayah',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'NAMA_BHABIN' => $this->input->get_post('NAMA_BHABIN'),
                'TIPE_FOTO_BHABIN' => $this->input->get_post('TIPE_FOTO_BHABIN'),
                'FOTO_BHABIN' => $this->input->get_post('FOTO_BHABIN'),
                'WA_BHABIN' => $this->input->get_post('WA_BHABIN'),
                'TLP_BHABIN' => $this->input->get_post('TLP_BHABIN'),
                'NAMA_KRINGSERSE' => $this->input->get_post('NAMA_KRINGSERSE'),
                'TIPE_FOTO_KRINGSERSE' => $this->input->get_post('TIPE_FOTO_KRINGSERSE'),
                'FOTO_KRINGSERSE' => $this->input->get_post('FOTO_KRINGSERSE'),
                'WA_KRINGSERSE' => $this->input->get_post('WA_KRINGSERSE'),
                'TLP_KRINGSERSE' => $this->input->get_post('TLP_KRINGSERSE'),
                'ID_KELURAHAN' =>  $this->input->get_post('ID_KELURAHAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  date('Y-m-d')
            );
            $query = $this->bhabin->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Data Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Data Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function bhabin_delete()
    {
        $this->load->model('backend/Bhabin_model', 'bhabin');
        $data = $this->input->post('data');
        $path = "./assets/upload/bhabin/";
        if (isset($data)) {
            if (is_array($data)) {
                foreach ($data as $key) {
                    $folder = $this->bhabin->get($key);
                    if (file_exists($path . $folder[0]->FOTO_BHABIN)) {
                        unlink($path . $folder[0]->FOTO_BHABIN);
                    }
                    if (file_exists($path . $folder[0]->FOTO_KRINGSERSE)) {
                        unlink($path . $folder[0]->FOTO_KRINGSERSE);
                    }
                }
            } else {
                $folder = $this->bhabin->get($data);
                if (file_exists($path . $folder[0]->FOTO_BHABIN)) {
                    unlink($path . $folder[0]->FOTO_BHABIN);
                }
                if (file_exists($path . $folder[0]->FOTO_KRINGSERSE)) {
                    unlink($path . $folder[0]->FOTO_KRINGSERSE);
                }
            }
            $query = $this->bhabin->delete($data);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function bhabin_publish()
    {
        $this->load->model('backend/Bhabin_model', 'bhabin');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->bhabin->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function bhabin_update()
    {
        $this->load->model('backend/Bhabin_model', 'bhabin');
        $rules = array(
            array(
                'field' => 'FOTO_BHABIN',
                'label' => 'Foto Bhabinkamtibmas',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum diunggah.',
                ),
            ),
            array(
                'field' => 'FOTO_KRINGSERSE',
                'label' => 'Foto Kring Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA_BHABIN',
                'label' => 'Nama Bhabin',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'WA_BHABIN',
                'label' => 'WhatsApp Bhabin',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TLP_BHABIN',
                'label' => 'Telpon Bhabin',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'NAMA_KRINGSERSE',
                'label' => 'Nama Kring Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'WA_KRINGSERSE',
                'label' => 'WhatsApp Kring Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TLP_KRINGSERSE',
                'label' => 'Telpon Krings Serse',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'ID_KELURAHAN',
                'label' => 'Wilayah',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'NAMA_BHABIN' => $this->input->get_post('NAMA_BHABIN'),
                'TIPE_FOTO_BHABIN' => $this->input->get_post('TIPE_FOTO_BHABIN'),
                'FOTO_BHABIN' => $this->input->get_post('FOTO_BHABIN'),
                'WA_BHABIN' => $this->input->get_post('WA_BHABIN'),
                'TLP_BHABIN' => $this->input->get_post('TLP_BHABIN'),
                'NAMA_KRINGSERSE' => $this->input->get_post('NAMA_KRINGSERSE'),
                'TIPE_FOTO_KRINGSERSE' => $this->input->get_post('TIPE_FOTO_KRINGSERSE'),
                'FOTO_KRINGSERSE' => $this->input->get_post('FOTO_KRINGSERSE'),
                'WA_KRINGSERSE' => $this->input->get_post('WA_KRINGSERSE'),
                'TLP_KRINGSERSE' => $this->input->get_post('TLP_KRINGSERSE'),
                'ID_KELURAHAN' =>  $this->input->get_post('ID_KELURAHAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  date('Y-m-d')
            );
            $query = $this->bhabin->update($data, $this->input->get_post('ID'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Data Telah Diubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Data Tidak Diubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    // NOMOR DARURAT
    public function nomor()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Nomor Darurat', 'menuPage' => 2];
        $this->LvBackend('_backend/nomor/list', $this->global, NULL, NULL, NULL);
    }
    public function nomor_edit()
    {
        $this->load->model('backend/Nomor_model', 'nomor');
        $data = $this->nomor->get($this->input->get_post('id'));
        $respon = array(
            "ID" => $data[0]->ID_NOMOR,
            "INSTANSI" => $data[0]->INSTANSI,
            "TLP" => $data[0]->TLP,
            "WA" => $data[0]->WA,
            "PUBLISH" => $data[0]->PUBLISH,
        );
        echo json_encode($respon);
    }
    public function nomor_ajax()
    {
        $this->load->model('serverside/Nomor_ds_model', 'ds_nomor');
        $list = $this->ds_nomor->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_NOMOR;
            $row[] = $field->INSTANSI;
            if ($field->WA != '') {
                $btn_wa = '<a target="_BLANK" href="https://wa.me/' . $field->WA . '" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> ' . $field->WA . '</a>';
            } else {
                $btn_wa = '';
            }
            $row[] = '<div class="d-grid gap-2 d-md-block"><a target="_BLANK" href="tel:' . $field->TLP . '" class="btn btn-sm btn-warning"> <i class="fa fa-phone"></i> ' . $field->TLP . '</a> ' . $btn_wa . '</div>';
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_NOMOR . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<button class="btn btn-sm btn-warning" onclick="modal_update(' . $field->ID_NOMOR . ')"><i class="fas fa-edit text-white"></i></button>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_NOMOR . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_NOMOR . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update . $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_nomor->count_all(),
            "recordsFiltered" => $this->ds_nomor->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function nomor_delete()
    {
        $this->load->model('backend/Nomor_model', 'nomor');
        $data = $this->input->post('data');
        $query = $this->nomor->delete($data);
        echo json_encode($query);
    }
    public function nomor_save()
    {
        $this->load->model('backend/nomor_model', 'nomor');
        $rules = array(
            array(
                'field' => 'INSTANSI',
                'label' => 'Instansi',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TLP',
                'label' => 'Telpon',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosang.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'INSTANSI' => $this->input->get_post('INSTANSI'),
                'TLP' => $this->input->get_post('TLP'),
                'WA' => $this->input->get_post('WA'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  date('Y-m-d')
            );
            $query = $this->nomor->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Nomor Darurat Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Nomor Darurat Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function nomor_update()
    {
        $this->load->model('backend/nomor_model', 'nomor');
        $rules = array(
            array(
                'field' => 'INSTANSI',
                'label' => 'Instansi',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TLP',
                'label' => 'Telpon',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosang.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'INSTANSI' => $this->input->get_post('INSTANSI'),
                'TLP' => $this->input->get_post('TLP'),
                'WA' => $this->input->get_post('WA'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH')
            );
            $query = $this->nomor->update($data, $this->input->get_post('ID'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Nomor Darurat Telah Diubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Nomor Darurat Tidak Diubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function nomor_publish()
    {
        $this->load->model('backend/Nomor_model', 'nomor');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->nomor->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    // BARANG HILANG
    public function barang()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Barang Hilang', 'menuPage' => 2];
        $this->LvBackend('_backend/barang/list', $this->global, NULL, NULL, NULL);
    }
    public function barang_add()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Tambah Barang Hilang', 'menuPage' => 2];
        $this->LvBackend('_backend/barang/add', $this->global, NULL, NULL, NULL);
    }
    public function barang_edit($id)
    {
        $this->load->model('backend/Barang_model', 'barang');
        $data['barang'] = $this->barang->get($id);
        $this->global = ['pageTitle' => 'Menu Informasi Ubah Barang Hilang', 'menuPage' => 2];
        $this->LvBackend('_backend/barang/edit', $this->global, NULL, $data, NULL);
    }
    public function barang_ajax()
    {
        $this->load->model('serverside/Barang_ds_model', 'ds_barang');
        $list = $this->ds_barang->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_BARANG;
            $gambar = ($field->TIPE_FOTO == 'url') ? $field->FOTO : base_url('assets/upload/barang/') . $field->FOTO;
            $row[] = '<img height="80px" src="' . $gambar . '"/>';
            $row[] = $field->BARANG;
            $row[] = $field->LOKASI . '<br>' . $field->CREATE_AT;
            $row[] = $field->KETERANGAN;
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_BARANG . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<a class="btn btn-sm btn-warning" href="' . base_url('admin/informasi/barang/ubah/') . $field->ID_BARANG . '"><i class="fas fa-edit text-white"></i></a>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_BARANG . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_BARANG . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update  . $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_barang->count_all(),
            "recordsFiltered" => $this->ds_barang->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function barang_delete()
    {
        $this->load->model('backend/Barang_model', 'barang');
        $data = $this->input->post('data');
        $path = "./assets/upload/barang/";
        if (isset($data)) {
            if (is_array($data)) {
                foreach ($data as $key) {
                    $folder = $this->barang->get($key);
                    if (file_exists($path . $folder[0]->FOTO)) {
                        unlink($path . $folder[0]->FOTO);
                    }
                }
            } else {
                $folder = $this->barang->get($data);
                if (file_exists($path . $folder[0]->FOTO)) {
                    unlink($path . $folder[0]->FOTO);
                }
            }
            $query = $this->barang->delete($data);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function barang_publish()
    {
        $this->load->model('backend/Barang_model', 'barang');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->barang->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function barang_save()
    {
        $this->load->model('backend/Barang_model', 'barang');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto Barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'BARANG',
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'LOKASI',
                'label' => 'Lokasi Ditemukan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Waktu Ditemukan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'BARANG' => $this->input->get_post('BARANG'),
                'LOKASI' => $this->input->get_post('LOKASI'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->barang->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Barang Hilang Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Barang Hilang Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function barang_update()
    {
        $this->load->model('backend/Barang_model', 'barang');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto Barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'BARANG',
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'LOKASI',
                'label' => 'Lokasi Ditemukan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Waktu Ditemukan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'BARANG' => $this->input->get_post('BARANG'),
                'LOKASI' => $this->input->get_post('LOKASI'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->barang->update($data, $this->input->get_post('ID'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Barang Hilang Telah Diubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Barang Hilang Tidak Diubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    function barang_image_upload()
    {
        $path1 = './assets/upload/barang/';
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        if ($this->input->get_post('url')) {
            $msg = array(
                "status" => true,
                "type" => "url",
                "url" => $this->input->get_post('url')
            );
            echo json_encode($msg);
        } else {
            if ($_FILES["unggah"]["name"] != "") {
                $config['upload_path'] =  $path1;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('unggah')) {
                    $this->output->set_status_header('404');
                } else {
                    $data = $this->upload->data();
                    $msg = array(
                        "status" => true,
                        "type" => "unggah",
                        "url" =>  $data['file_name']
                    );
                    echo json_encode($msg);
                }
            } else {
                $this->output->set_status_header('404');
            }
        }
    }
    // ORANG HILANG
    public function orang()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Orang Hilang', 'menuPage' => 2];
        $this->LvBackend('_backend/orang/list', $this->global, NULL, NULL, NULL);
    }
    public function orang_add()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Tambah Orang Hilang', 'menuPage' => 2];
        $this->LvBackend('_backend/orang/add', $this->global, NULL, NULL, NULL);
    }
    public function orang_edit($id)
    {
        $this->load->model('backend/Orang_model', 'orang');
        $data['orang'] = $this->orang->get($id);
        $this->global = ['pageTitle' => 'Menu Informasi Ubah Orang Hilang', 'menuPage' => 2];
        $this->LvBackend('_backend/orang/edit', $this->global, NULL, $data, NULL);
    }
    public function orang_ajax()
    {
        $this->load->model('serverside/Orang_ds_model', 'ds_orang');
        $list = $this->ds_orang->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_ORANG;
            $gambar = ($field->TIPE_FOTO == 'url') ? $field->FOTO : base_url('assets/upload/orang/') . $field->FOTO;
            $row[] = '<img height="80px" src="' . $gambar . '"/>';
            $row[] = $field->NAMA . '<br>' . $field->TMP_LAHIR . ', ' . $field->TGL_LAHIR;
            $row[] = $field->CREATE_AT;
            $row[] = $field->KETERANGAN;
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_ORANG . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<a class="btn btn-sm btn-warning" href="' . base_url('admin/informasi/orang/ubah/') . $field->ID_ORANG . '"><i class="fas fa-edit text-white"></i></a>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_ORANG . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_ORANG . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update . $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_orang->count_all(),
            "recordsFiltered" => $this->ds_orang->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function orang_delete()
    {
        $this->load->model('backend/Orang_model', 'orang');
        $data = $this->input->post('data');
        $path = "./assets/upload/orang/";
        if (isset($data)) {
            if (is_array($data)) {
                foreach ($data as $key) {
                    $folder = $this->orang->get($key);
                    if (file_exists($path . $folder[0]->FOTO)) {
                        unlink($path . $folder[0]->FOTO);
                    }
                }
            } else {
                $folder = $this->orang->get($data);
                if (file_exists($path . $folder[0]->FOTO)) {
                    unlink($path . $folder[0]->FOTO);
                }
            }
            $query = $this->orang->delete($data);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function orang_publish()
    {
        $this->load->model('backend/Orang_model', 'orang');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->orang->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function orang_save()
    {
        $this->load->model('backend/Orang_model', 'orang');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TMP_LAHIR',
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TGL_LAHIR',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Tanggal Dilaporkan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'NAMA' => $this->input->get_post('NAMA'),
                'TMP_LAHIR' => $this->input->get_post('TMP_LAHIR'),
                'TGL_LAHIR' => $this->input->get_post('TGL_LAHIR'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->orang->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Orang Hilang Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Orang Hilang Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function orang_update()
    {
        $this->load->model('backend/Orang_model', 'orang');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TMP_LAHIR',
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TGL_LAHIR',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Tanggal Dilaporkan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'NAMA' => $this->input->get_post('NAMA'),
                'TMP_LAHIR' => $this->input->get_post('TMP_LAHIR'),
                'TGL_LAHIR' => $this->input->get_post('TGL_LAHIR'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->orang->update($data, $this->input->get_post('ID'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Orang Hilang Telah Diubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Orang Hilang Tidak Diubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    function orang_image_upload()
    {
        $path1 = './assets/upload/orang/';
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        if ($this->input->get_post('url')) {
            $msg = array(
                "status" => true,
                "type" => "url",
                "url" => $this->input->get_post('url')
            );
            echo json_encode($msg);
        } else {
            if ($_FILES["unggah"]["name"] != "") {
                $config['upload_path'] =  $path1;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('unggah')) {
                    $this->output->set_status_header('404');
                } else {
                    $data = $this->upload->data();
                    $msg = array(
                        "status" => true,
                        "type" => "unggah",
                        "url" =>  $data['file_name']
                    );
                    echo json_encode($msg);
                }
            } else {
                $this->output->set_status_header('404');
            }
        }
    }
    // TAHANAN
    public function tahanan()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Tahanan', 'menuPage' => 2];
        $this->LvBackend('_backend/tahanan/list', $this->global, NULL, NULL, NULL);
    }
    public function tahanan_add()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Tambah Tahanan', 'menuPage' => 2];
        $this->LvBackend('_backend/tahanan/add', $this->global, NULL, NULL, NULL);
    }
    public function tahanan_edit($id)
    {
        $this->load->model('backend/Tahanan_model', 'tahanan');
        $data['tahanan'] = $this->tahanan->get($id);
        $this->global = ['pageTitle' => 'Menu Informasi Ubah Tahanan', 'menuPage' => 2];
        $this->LvBackend('_backend/tahanan/edit', $this->global, NULL, $data, NULL);
    }
    public function tahanan_ajax()
    {
        $this->load->model('serverside/Tahanan_ds_model', 'ds_tahanan');
        $list = $this->ds_tahanan->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_TAHANAN;
            $gambar = ($field->TIPE_FOTO == 'url') ? $field->FOTO : base_url('assets/upload/orang/') . $field->FOTO;
            $row[] = '<img height="80px" src="' . $gambar . '"/>';
            $row[] = $field->NAMA . '<br>' . $field->TMP_LAHIR . ', ' . $field->TGL_LAHIR;
            $row[] = $field->KASUS . '<br>' . $field->CREATE_AT . '<br>' . $field->KESATUAN;
            $row[] = $field->KETERANGAN;
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_TAHANAN   . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<a class="btn btn-sm btn-warning" href="' . base_url('admin/informasi/tahanan/ubah/') . $field->ID_TAHANAN  . '"><i class="fas fa-edit text-white"></i></a>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_TAHANAN  . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_TAHANAN  . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update . $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_tahanan->count_all(),
            "recordsFiltered" => $this->ds_tahanan->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function tahanan_delete()
    {
        $this->load->model('backend/Tahanan_model', 'tahanan');
        $data = $this->input->post('data');
        $path = "./assets/upload/tahanan/";
        if (isset($data)) {
            if (is_array($data)) {
                foreach ($data as $key) {
                    $folder = $this->tahanan->get($key);
                    if (file_exists($path . $folder[0]->FOTO)) {
                        unlink($path . $folder[0]->FOTO);
                    }
                }
            } else {
                $folder = $this->tahanan->get($data);
                if (file_exists($path . $folder[0]->FOTO)) {
                    unlink($path . $folder[0]->FOTO);
                }
            }
            $query = $this->tahanan->delete($data);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function tahanan_publish()
    {
        $this->load->model('backend/Tahanan_model', 'tahanan');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->tahanan->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function tahanan_save()
    {
        $this->load->model('backend/Tahanan_model', 'tahanan');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TMP_LAHIR',
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TGL_LAHIR',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Tanggal Dilaporkan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'KASUS',
                'label' => 'Kasus',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'KESATUAN',
                'label' => 'Kesatuan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'NAMA' => $this->input->get_post('NAMA'),
                'TMP_LAHIR' => $this->input->get_post('TMP_LAHIR'),
                'TGL_LAHIR' => $this->input->get_post('TGL_LAHIR'),
                'KASUS' => $this->input->get_post('KASUS'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'KESATUAN' => $this->input->get_post('KESATUAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->tahanan->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Tahanan Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Tahanan Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function tahanan_update()
    {
        $this->load->model('backend/Tahanan_model', 'tahanan');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TMP_LAHIR',
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TGL_LAHIR',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Tanggal Dilaporkan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'KASUS',
                'label' => 'Kasus',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'KESATUAN',
                'label' => 'Kesatuan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'NAMA' => $this->input->get_post('NAMA'),
                'TMP_LAHIR' => $this->input->get_post('TMP_LAHIR'),
                'TGL_LAHIR' => $this->input->get_post('TGL_LAHIR'),
                'KASUS' => $this->input->get_post('KASUS'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'KESATUAN' => $this->input->get_post('KESATUAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->tahanan->update($data, $this->input->get_post('ID'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Tahanan Telah Diubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Tahanan Tidak Diubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    function tahanan_image_upload()
    {
        $path1 = './assets/upload/tahanan/';
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        if ($this->input->get_post('url')) {
            $msg = array(
                "status" => true,
                "type" => "url",
                "url" => $this->input->get_post('url')
            );
            echo json_encode($msg);
        } else {
            if ($_FILES["unggah"]["name"] != "") {
                $config['upload_path'] =  $path1;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('unggah')) {
                    $this->output->set_status_header('404');
                } else {
                    $data = $this->upload->data();
                    $msg = array(
                        "status" => true,
                        "type" => "unggah",
                        "url" =>  $data['file_name']
                    );
                    echo json_encode($msg);
                }
            } else {
                $this->output->set_status_header('404');
            }
        }
    }
    // BURONAN
    public function buronan()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Buronan', 'menuPage' => 2];
        $this->LvBackend('_backend/buronan/list', $this->global, NULL, NULL, NULL);
    }
    public function buronan_add()
    {
        $this->global = ['pageTitle' => 'Menu Informasi Tambah Buronan', 'menuPage' => 2];
        $this->LvBackend('_backend/buronan/add', $this->global, NULL, NULL, NULL);
    }
    public function buronan_edit($id)
    {
        $this->load->model('backend/Buronan_model', 'buronan');
        $data['buronan'] = $this->buronan->get($id);
        $this->global = ['pageTitle' => 'Menu Informasi Ubah Buronan', 'menuPage' => 2];
        $this->LvBackend('_backend/buronan/edit', $this->global, NULL, $data, NULL);
    }
    public function buronan_ajax()
    {
        $this->load->model('serverside/Buronan_ds_model', 'ds_buronan');
        $list = $this->ds_buronan->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_BURONAN;
            $gambar = ($field->TIPE_FOTO == 'url') ? $field->FOTO : base_url('assets/upload/buronan/') . $field->FOTO;
            $row[] = '<img height="80px" src="' . $gambar . '"/>';
            $row[] = $field->NAMA . '<br>' . $field->TMP_LAHIR . ', ' . $field->TGL_LAHIR;
            $row[] = $field->KASUS . '<br>' . $field->CREATE_AT;
            $row[] = $field->KETERANGAN;
            // $button_delete = '<button class="btn btn-sm btn-danger" onclick="delete_informasi(' . $field->ID_BURONAN  . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $button_update = '<a class="btn btn-sm btn-warning" href="' . base_url('admin/informasi/buronan/ubah/') . $field->ID_BURONAN  . '"><i class="fas fa-edit text-white"></i></a>';
            if ($field->PUBLISH == 1) {
                $button_publish = '<button class="btn btn-sm btn-info" onclick="publish_informasi(' . "0," . $field->ID_BURONAN  . ')"><i class="fas fa-times-circle"></i></button>';
            } else {
                $button_publish = '<button class="btn btn-sm btn-success" onclick="publish_informasi(' . "1," .  $field->ID_BURONAN  . ')"><i class="fas fa-check-circle"></i></button>';
            }
            $row[] = '<div class="btn-group btn-group-toggle">' . $button_update .  $button_publish . '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_buronan->count_all(),
            "recordsFiltered" => $this->ds_buronan->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function buronan_delete()
    {
        $this->load->model('backend/Buronan_model', 'buronan');
        $data = $this->input->post('data');
        $path = "./assets/upload/buronan/";
        if (isset($data)) {
            if (is_array($data)) {
                foreach ($data as $key) {
                    $folder = $this->buronan->get($key);
                    if (file_exists($path . $folder[0]->FOTO)) {
                        unlink($path . $folder[0]->FOTO);
                    }
                }
            } else {
                $folder = $this->buronan->get($data);
                if (file_exists($path . $folder[0]->FOTO)) {
                    unlink($path . $folder[0]->FOTO);
                }
            }
            $query = $this->buronan->delete($data);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function buronan_publish()
    {
        $this->load->model('backend/Buronan_model', 'buronan');
        $publish = $this->input->post('publish');
        $id = $this->input->post('id');
        if (isset($id) && isset($publish)) {
            $query = $this->buronan->update(array("PUBLISH" => $publish), $id);
            echo json_encode($query);
        } else {
            echo json_encode(false);
        }
    }
    public function buronan_save()
    {
        $this->load->model('backend/Buronan_model', 'buronan');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TMP_LAHIR',
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TGL_LAHIR',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Tanggal Dilaporkan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'KASUS',
                'label' => 'Kasus',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'NAMA' => $this->input->get_post('NAMA'),
                'TMP_LAHIR' => $this->input->get_post('TMP_LAHIR'),
                'TGL_LAHIR' => $this->input->get_post('TGL_LAHIR'),
                'KASUS' => $this->input->get_post('KASUS'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->buronan->save($data);
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Buronan Telah Disimpan",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Buronan Tidak Disimpan",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    public function buronan_update()
    {
        $this->load->model('backend/Buronan_model', 'buronan');
        $rules = array(
            array(
                'field' => 'FOTO',
                'label' => 'Foto',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum Diunggah.',
                ),
            ),
            array(
                'field' => 'NAMA',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TMP_LAHIR',
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'TGL_LAHIR',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'CREATE_AT',
                'label' => 'Tanggal Dilaporkan',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'KASUS',
                'label' => 'Kasus',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Tidak Boleh Kosong.',
                ),
            ),
            array(
                'field' => 'PUBLISH',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s Belum dipilih.',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'TIPE_FOTO' => $this->input->get_post('TIPE_FOTO'),
                'FOTO' => $this->input->get_post('FOTO'),
                'NAMA' => $this->input->get_post('NAMA'),
                'TMP_LAHIR' => $this->input->get_post('TMP_LAHIR'),
                'TGL_LAHIR' => $this->input->get_post('TGL_LAHIR'),
                'KASUS' => $this->input->get_post('KASUS'),
                'KETERANGAN' => $this->input->get_post('KETERANGAN'),
                'PUBLISH' =>  $this->input->get_post('PUBLISH'),
                'CREATE_AT' =>  $this->input->get_post('CREATE_AT')
            );
            $query = $this->buronan->update($data, $this->input->get_post('ID'));
            // $this->record_user_activity('Admin', 'Tambah', 'Berita',  $this->input->get_post('judul'));
            if ($query) {
                $respon = array(
                    "status" => "true",
                    "msg" => "Buronan Telah Diubah",
                );
                echo json_encode($respon);
            } else {
                $respon = array(
                    "status" => "false",
                    "msg" => "Buronan Tidak Diubah",
                );
                echo json_encode($respon);
            }
        } else {
            $respon = array(
                "status" => "false",
                "msg" => validation_errors(),
            );
            echo json_encode($respon);
        }
    }
    function buronan_image_upload()
    {
        $path1 = './assets/upload/buronan/';
        if (!file_exists($path1)) {
            mkdir($path1, 0777, true);
        }
        if ($this->input->get_post('url')) {
            $msg = array(
                "status" => true,
                "type" => "url",
                "url" => $this->input->get_post('url')
            );
            echo json_encode($msg);
        } else {
            if ($_FILES["unggah"]["name"] != "") {
                $config['upload_path'] =  $path1;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('unggah')) {
                    $this->output->set_status_header('404');
                } else {
                    $data = $this->upload->data();
                    $msg = array(
                        "status" => true,
                        "type" => "unggah",
                        "url" =>  $data['file_name']
                    );
                    echo json_encode($msg);
                }
            } else {
                $this->output->set_status_header('404');
            }
        }
    }

    public function pengaduan($id)
    {
        $this->global = ['pageTitle' => 'Menu Pengaduan ' . ucfirst($id), 'menuPage' => 3];
        $this->LvBackend('_backend/pengaduan/list', $this->global, NULL, NULL, NULL);
    }
    public function pengaduan_respon($id)
    {
        $this->load->model('backend/Pengaduan_model', 'pengaduan');
        $data['pengaduan'] = $this->pengaduan->get($id);
        $this->global = ['pageTitle' => 'Menu Respon Pengaduan Umum ID ' . $id, 'menuPage' => 3];
        $this->LvBackend('_backend/pengaduan/respon', $this->global, NULL, $data, NULL);
    }
    public function pengaduan_ajax()
    {
        $this->load->model('serverside/Pengaduan_ds_model', 'ds_pengaduan');
        $list = $this->ds_pengaduan->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_PENGADUAN;
            $row[] = $field->NIK . ',<br>' . $field->NAMA . ',<br>' . $field->JENKEL;
            $row[] = $field->TLP . '<br>' . $field->EMAIL;
            $row[] = $field->PERIHAL . ',<br>' . $field->CREATE_AT;
            // $btn_delete = '<button class="btn btn-sm btn-danger" title="Hapus" onclick="btn_delete(' . $field->ID_PENGADUAN  . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $btn_respon = '<a class="btn btn-sm btn-success" title="Respon" href="' . base_url('admin/pengaduan/' . $field->JENIS_ADUAN . '/respon/') . $field->ID_PENGADUAN  . '"><i class="fas fa-reply"></i></a>';
            $row[] = '<div class="btn-group btn-group-toggle">' . $btn_respon .  '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_pengaduan->count_all(),
            "recordsFiltered" => $this->ds_pengaduan->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function pengaduan_delete()
    {
        $this->load->model('backend/Pengaduan_model', 'pengaduan');
        $data = $this->input->post('data');
        $query = $this->pumum->delete($data);
        echo json_encode($query);
    }
    public function kotakmasuk()
    {
        $this->load->view("_backend/email/login");
    }

    function tipec()
    {
        $this->global = ['pageTitle' => 'Menu Laporan Tipe C', 'menuPage' => 4];
        $this->LvBackend('_backend/tipe-c/list', $this->global, NULL, NULL, NULL);
    }
    public function tipec_ajax()
    {
        $this->load->model('serverside/Tipec_ds_model', 'ds_tipec');
        $list = $this->ds_tipec->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_TIPEC;
            $row[] = $field->NIK . ' |<br>' . $field->NAMA . ' |<br>' . $field->JENKEL;
            $row[] = $field->NO_TLPN . ' |<br>' . $field->EMAIL;
            $row[] = $field->ALAMAT . ' |<br>dibuat pada ' . $field->CREATE_AT;
            // $btn_delete = '<button class="btn btn-sm btn-danger" title="Hapus" onclick="btn_delete(' . $field->ID_TIPEC  . ')"><i class="fas fa-trash-alt text-white"></i></button>';
            $btn_view = '<a class="btn btn-sm btn-primary" title="Lihat" href="' . base_url('admin/laporan/tipec/detail/') . $field->ID_TIPEC  . '"><i class="fas fa-eye"></i></a>';
            $row[] = '<div class="btn-group btn-group-toggle">' . $btn_view .  '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_tipec->count_all(),
            "recordsFiltered" => $this->ds_tipec->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function tipec_detail($id)
    {
        $this->load->model('backend/Tipec_model', 'tipec');
        $data['tipec'] = $this->tipec->get($id);
        $this->global = ['pageTitle' => 'Menu Lihat Laporan Tipe C', 'menuPage' => 4];
        $this->LvBackend('_backend/tipe-c/detail', $this->global, NULL, $data, NULL);
    }
    public function tipec_delete()
    {
        $this->load->model('backend/Tipec_model', 'tipec');
        $data = $this->input->post('data');
        $query = $this->tipec->delete($data);
        echo json_encode($query);
    }

    function tipeb()
    {
        $this->global = ['pageTitle' => 'Menu Laporan Tipe B', 'menuPage' => 4];
        $this->LvBackend('_backend/tipe-b/list', $this->global, NULL, NULL, NULL);
    }
    function tipeb_add()
    {
        $this->global = ['pageTitle' => 'Menu Tambah Laporan Tipe B', 'menuPage' => 4];
        $this->LvBackend('_backend/tipe-b/add', $this->global, NULL, NULL, NULL);
    }
    public function tipeb_ajax()
    {
        $this->load->model('serverside/Tipeb_ds_model', 'ds_tipeb');
        $list = $this->ds_tipeb->get_datatables();
        $data = array();
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->ID_TIPEC;
            $row[] = $field->NIK . ' |<br>' . $field->NAMA . ' |<br>' . $field->JENKEL;
            $row[] = $field->NO_TLPN . ' |<br>' . $field->EMAIL;
            $row[] = $field->ALAMAT . ' |<br>dibuat pada ' . $field->CREATE_AT;
            $btn_view = '<a class="btn btn-sm btn-primary" title="Lihat" href="' . base_url('admin/laporan/tipec/detail/') . $field->ID_TIPEC  . '"><i class="fas fa-eye"></i></a>';
            $row[] = '<div class="btn-group btn-group-toggle">' . $btn_view .  '</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ds_tipeb->count_all(),
            "recordsFiltered" => $this->ds_tipeb->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function tipeb_delete()
    {
        $this->load->model('backend/Tipeb_model', 'tipeb');
        $data = $this->input->post('data');
        $query = $this->tipec->delete($data);
        echo json_encode($query);
    }
}
