<div class="container-fluid">
    <div class="row">
        <div class="col">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>MENU RESPON PENGADUAN <?= strtoupper($pengaduan[0]->JENIS_ADUAN); ?></strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>NIK</th>
                                        <td> : <?= $pengaduan[0]->NIK; ?></td>
                                        <th>Prihal</th>
                                        <td> : <?= $pengaduan[0]->PERIHAL; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama</td>
                                        <td> : <?= $pengaduan[0]->NAMA; ?> / <?= $pengaduan[0]->JENKEL; ?></td>
                                        <th>Lampiran</th>
                                        <td> : <a target="_blank" href="<?= base_url('assets/upload/pengaduan/umum/') . $pengaduan[0]->LAMPIRAN; ?>">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. Lahir</td>
                                        <td> : <?= $pengaduan[0]->TGL_LAHIR; ?></td>
                                        <th>Dibuat Pada</td>
                                        <td> : <?= $pengaduan[0]->CREATE_AT; ?> WIB</td>
                                    </tr>
                                    <tr>
                                        <th>No. Telpon</th>
                                        <td> : <?= $pengaduan[0]->TLP; ?></td>
                                        <th>Status Pengaduan</th>
                                        <td> : <?= ($pengaduan[0]->STATUS == 'DITERIMA') ? 'BELUM DITANGGAPI' : $pengaduan[0]->STATUS; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td> : <?= $pengaduan[0]->EMAIL; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</td>
                                        <td colspan="4" rowspan="2"> : <?= $pengaduan[0]->ALAMAT; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <strong>Isi Pengaduan :</strong><br>
                            <?= $pengaduan[0]->ISI; ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>PERCAKAPAN</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>






            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>KIRIM PESAN</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <input class="form-control" placeholder="Tulis Pesan..">
                        </div>
                        <div class="col-4">
                            <select id="STATUS" class="form-control">
                                <option <?= ($pengaduan[0]->STATUS == 'DITERIMA') ? 'selected' : ''; ?> value="DITERIMA">BELUM DITANGGAPI</option>
                                <option <?= ($pengaduan[0]->STATUS == 'DIPERIKSA') ? 'selected' : ''; ?> value="DIPERIKSA">SEDANG DIPERIKSA</option>
                                <option <?= ($pengaduan[0]->STATUS == 'DITANGANI') ? 'selected' : ''; ?> value="DITANGANI">SEDANG DITANGANI</option>
                                <option <?= ($pengaduan[0]->STATUS == 'SELESAI') ? 'selected' : ''; ?> value="SELESAI">ADUAN SELESAI</option>
                                <option <?= ($pengaduan[0]->STATUS == 'DITOLAK') ? 'selected' : ''; ?> value="DITOLAK">ADUAN DITOLAK</option>
                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary"> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>