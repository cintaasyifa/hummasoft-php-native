<!DOCTYPE html>
<html>
<head>
</head>
<body>
</body>
</html>
<?php
/* Skrip ini tidak menggunakan OOP */
/* Memanggil file koneksi hanya satu kali */
require_once('koneksi.php');

// Query untuk mengambil data Rawat Inap dengan menggabungkan tabel inap, pasien, dan kamar menggunakan INNER JOIN
$query  = "SELECT inap.id_inap, pasien.nama_pasien, inap.tgl_masuk, inap.tgl_keluar, inap.lama, kamar.id_kamar FROM ((inap INNER JOIN pasien ON inap.id_pasien = pasien.id_pasien) INNER JOIN kamar ON inap.id_kamar = kamar.id_kamar)";
$link   = "index.php?lihat=inap/";
?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-primary">Data Rawat Inap</h3>
        <hr style="border-top:1px dotted #000;" />
        <!-- Tombol Tambah -->
        <a href="<?= $link.'tambah' ?>" class="btn btn-success btn-sm">
            <span class="glyphicon glyphicon-plus"></span> Tambah
        </a>

        <!-- Menampilkan Tabel -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered" style="margin-top: 10px">
                <tr class="info">
                    <th>No</th>
                    <th>Id Inap</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Lama Inap</th>
                    <th>Id Kamar</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>

                <?php
                if ($data = mysqli_query($koneksi, $query)) {
                    $no = 1;
                    while ($tampil = mysqli_fetch_object($data)) {
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $tampil->id_inap ?></td>
                        <td><?= $tampil->nama_pasien ?></td>
                        <td><?= $tampil->tgl_masuk ?></td>
                        <td><?= $tampil->tgl_keluar ?></td>
                        <td><?= $tampil->lama ?></td>
                        <td><?= $tampil->id_kamar ?></td>
                        <td style="text-align: center;">
                            <form action="<?= $link.'edit&id_inap='.$tampil->id_inap ?>" method="POST" class="inline">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </button>
                            </form>
                            <form action="<?= $link.'hapus&id_inap='.$tampil->id_inap ?>" method="POST" class="inline">
                                <button type="submit" onclick="return confirm('Apakah yakin data akan dihapus?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                    $no++;
                    } // Tutup while
                } // Tutup if
                ?>
            </table>
        </div><!-- .table-responsive -->
    </div>
</div>
