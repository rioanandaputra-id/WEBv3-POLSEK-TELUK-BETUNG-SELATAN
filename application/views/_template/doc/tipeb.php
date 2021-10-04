<html>

<head>
    <link href="<?= base_url('assets/backend/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-size: 12pt;
            font-family: 'Times New Roman', Times, serif;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body style="margin-left: 5%; margin-right:15%;">
    <?php foreach ($tipeb as $record) : ?>
        <div class="book">
            <div class="page">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="float-left"><strong>POLRI DAERAH LAMPUNG</strong></div>
                                <div class="float-right"><strong>MODEL B</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>
                                    KOTA BANDAR LAMPUNG<br>
                                    SEKTOR TELUK BETUNG SELATAN<br>
                                </strong>
                                <u>Jl. Gatot Subroto No.130, Sukaraja, Bumi Waras, 35226</u><br>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/backend/img/polri-black.png') ?>" width="100px" height=""><br>
                                    <strong><u>LAPORAN POLISI</u></strong><br>
                                    Nomor: LP/B/<?= $record->NO_LAP . "/" . getRomawi(date("n", strtotime($record->CREATE_AT))) . "/" . date("y", strtotime($record->CREATE_AT)) . "/RESTA BALAM/SEKTOR TBS"; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong><u>YANG MELAPORKAN</u></strong>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3">
                                Nama<br>
                                T/TGL. Lahir<br>
                                Jenis Kelamin<br>
                                Pekerjaan<br>
                                Alamat<br>
                                Tlpn/Fax/Emai/HP<br>
                                Agama<br>
                            </div>
                            <div class="col">
                                : <?= $record->NAMA_PELAPOR; ?><br>
                                : <?= $record->TMPT_LAHIR_PELAPOR; ?>, <?= date('d-m-Y', strtotime($record->TGL_LAHIR_PELAPOR)); ?><br>
                                : <?= $record->JENKEL_PELAPOR; ?><br>
                                : <?= $record->PEKERJAAN_PELAPOR; ?><br>
                                : <?= $record->ALAMAT_PELAPOR; ?><br>
                                : -/-/<?= $record->EMAIL_PELAPOR; ?>/<?= $record->TLP_PELAPOR; ?><br>
                                : <?= $record->AGAMA_PELAPOR; ?><br>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <strong><u>PERISTIWA YANG DILAPORKAN</u></strong>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3">
                                1. Waktu Kejadian<br>
                                2. Tempat Kejadian<br>
                                3. Apa Yan Terjadi<br>
                                4. Korban<br>
                            </div>
                            <div class="col">
                                : <?= tgl_indo(date('d-m-Y', strtotime($record->WAKTU_KEJADIAN))); ?> Pukul <?= date('H:i', strtotime($record->WAKTU_KEJADIAN)); ?> Wib.<br>
                                : <?= $record->TMPT_KEJADIAN; ?><br>
                                : <?= $record->YG_TERJADI; ?><br>
                                : <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-3">
                                <?php
                                $CI = &get_instance();
                                $CI->load->model('backend/tipeb_model');
                                $result = $CI->tipeb->getdet(array("ID_TIPEB" => $record->ID_TIPEB, "KET" => "Korban"));
                                if ($CI->db->affected_rows() > 0) {
                                    $i = 1;
                                    foreach ($result as $record1) : ?>
                                        - Nama Ke-<?= $i; ?>: <?= $record1->NAMA; ?><br>
                                        - Jenis Kelamin Ke-<?= $i; ?>: <?= $record1->JENKEL; ?><br>
                                        - T/Tgl. Lahir Ke-<?= $i; ?>: <?= $record1->TMPT_LAHIR; ?>,<?= $record1->TGL_LAHIR; ?><br>
                                        - Alamat Ke-<?= $i; ?>: <?= $record1->ALAMAT; ?><br>
                                    <?php $i++;
                                    endforeach;
                                } else { ?>
                                    - Nama : Pelapor<br>
                                    - Jenis Kelamin : Pelapor<br>
                                    - T/Tgl. Lahir : Pelapor<br>
                                    - Alamat : Pelapor<br>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3">
                                5. Terlapor<br>
                            </div>
                            <div class="col">
                                : <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-3">
                                <?php
                                $CI = &get_instance();
                                $CI->load->model('backend/tipeb_model');
                                $result = $CI->tipeb->getdet(array("ID_TIPEB" => $record->ID_TIPEB, "KET" => "Terlapor"));
                                if ($CI->db->affected_rows() > 0) {
                                    $i = 1;
                                    foreach ($result as $record1) : ?>
                                        - Nama Ke-<?= $i; ?>: <?= $record1->NAMA; ?><br>
                                        - Jenis Kelamin Ke-<?= $i; ?>: <?= $record1->JENKEL; ?><br>
                                        - T/Tgl. Lahir Ke-<?= $i; ?>: <?= $record1->TMPT_LAHIR; ?>,<?= $record1->TGL_LAHIR; ?><br>
                                        - Alamat Ke-<?= $i; ?>: <?= $record1->ALAMAT; ?><br>
                                    <?php $i++;
                                    endforeach;
                                } else { ?>
                                    - Nama : Lidik<br>
                                    - Jenis Kelamin : Lidik<br>
                                    - T/Tgl. Lahir : Lidik<br>
                                    - Alamat : Lidik<br>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3">
                                6. Saksi<br>
                            </div>
                            <div class="col">
                                : <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-3">
                                <?php
                                $CI = &get_instance();
                                $CI->load->model('backend/tipeb_model');
                                $result = $CI->tipeb->getdet(array("ID_TIPEB" => $record->ID_TIPEB, "KET" => "Saksi"));
                                if ($CI->db->affected_rows() > 0) {
                                    $i = 1;
                                    foreach ($result as $record1) : ?>
                                        - Nama Ke-<?= $i; ?>: <?= $record1->NAMA; ?><br>
                                        - Jenis Kelamin Ke-<?= $i; ?>: <?= $record1->JENKEL; ?><br>
                                        - T/Tgl. Lahir Ke-<?= $i; ?>: <?= $record1->TMPT_LAHIR; ?>,<?= $record1->TGL_LAHIR; ?><br>
                                        - Alamat Ke-<?= $i; ?>: <?= $record1->ALAMAT; ?><br>
                                    <?php $i++;
                                    endforeach;
                                } else { ?>
                                    - Nama : -<br>
                                    - Jenis Kelamin : -<br>
                                    - T/Tgl. Lahir : -<br>
                                    - Alamat : -<br>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <table border="1px" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;"></th>
                                            <th style="text-align:center">URAIAN KEJADIAN</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th style="color:white;">.</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td><?= $record->URAIAN_KEJADIAN; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <strong><u>CATATAN KEPOLISIAN</u></strong>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                1. Tindakan Yang Diambil<br>
                            </div>
                            <div class="col">
                                :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $record->TINDAKAN_DIAMBIL; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                2. Tindak Pidana Apa<br>
                                3. Barang Bukti<br>
                            </div>
                            <div class="col">
                                : <?= $record->TINDAK_PIDANA; ?><br>
                                : <?= $record->BRG_BUKTI; ?><br>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <div class="float-left"><br><strong>PELAPOR</strong><br><br><br><br><br><br><strong><?= $record->NAMA_PELAPOR; ?></strong></div>
                                <div class="float-right">Bandar Lampung, <?= tgl_indo(date('d-m-Y', strtotime(date('d-m-Y')))); ?><br>
                                    <strong>a.n KEPALA KEPOLISIAN SEKTOR<br>TELUK BETUNG SELATAN
                                    </strong>
                                    <br><br><br><br><br>
                                    <strong>Komisaris Hari Budianto<br>NRP 123456789</strong>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="<?= base_url('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>