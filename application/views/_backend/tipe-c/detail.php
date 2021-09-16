<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <div class="float-left">
                                <h1 class="h5 text-gray-800"><strong>DETAIL LAPORAN TIPE C</strong></h1>
                            </div>
                            <div class="float-right">
                                <form action="<?= base_url('doc/tipec'); ?>" method="post" target="_blank">
                                    <input type="hidden" name="id" value="<?= $tipec[0]->ID_TIPEC; ?>">
                                    <button class="btn btn-primary" type="submit"><strong>Print Laporan</strong> <i class="fas fa-print"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            NIK<br>
                            Nama<br>
                            T/Tgl. Lahir<br>
                            Agama<br>
                            No. Tlpn<br>
                            Email<br>
                            Alamat<br>
                            Kewarganegaraan<br>
                            Pekerjaan<br>
                            Dikirim Pada<br>
                        </div>
                        <div class="col-10">
                            : <?= $tipec[0]->NIK; ?><br>
                            : <?= $tipec[0]->NAMA; ?> / <?= $tipec[0]->JENKEL; ?><br>
                            : <?= $tipec[0]->TMPT_LAHIR; ?>, <?= $tipec[0]->TGL_LAHIR; ?><br>
                            : <?= $tipec[0]->AGAMA; ?><br>
                            : <?= $tipec[0]->NO_TLPN; ?><br>
                            : <?= $tipec[0]->EMAIL; ?><br>
                            : <?= $tipec[0]->ALAMAT; ?><br>
                            : <?= $tipec[0]->KEWARGANEGARAAN; ?><br>
                            : <?= $tipec[0]->PEKERJAAN; ?><br>
                            : <?= $tipec[0]->CREATE_AT; ?> WIB<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>KRONOLOGI</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            Tanggal Kejadian<br>
                            Lokasi Kejadian<br>
                        </div>
                        <div class="col-10">
                            : <?= $tipec[0]->TGL_KEJADIAN; ?><br>
                            : <?= $tipec[0]->LOKASI_KEJADIAN; ?><br>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>JENIS</td>
                                        <th>ATAS NAMA</td>
                                        <th>ID</th>
                                        <th>JUMLAH</th>
                                        <th>KET</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black;">
                                    <?php
                                    $CI = &get_instance();
                                    $CI->load->model('backend/Tipec_model');
                                    $result = $CI->tipec->getdet($tipec[0]->TOKEN_GENERATE);
                                    foreach ($result as $record1) : ?>
                                        <tr>
                                            <td><?= $record1->JENIS_KEHILANGAN; ?></td>
                                            <td><?= $record1->IDENTITAS_NAMA; ?></td>
                                            <td><?= $record1->NOMOR_IDENTITAS; ?></td>
                                            <td><?= $record1->JUMLAH_IDENTITAS; ?></td>
                                            <td><?= $record1->KETERANGAN_IDENTITAS; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>