<div class="row">
    <div class="panel-heading">
        <h2>
            DATA CALON PESERTA DIDIK PPDB TAHUN <?php echo $year ?> <strong>TERDAFTAR</strong>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class='table-responsive'>
                <?php if ($numDataCpd != 0): ?>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numDataCpd; ?> calon peserta didik terdaftar</button>
                        </div>
                        <div class='btn-group'>
                            <a href=<?php echo HOME.'/pendaftaran/verifikasi' ?>><button class='btn btn-primary btn-xs'>Data Baru <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
                        </div>
                        <div class='btn-group pull-right'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle btn-xs'>Simpan <span class='caret'></span></button>
                            <ul class='dropdown-menu'>
                                <li><a href='#'>PDF</a></li>
                                <li><a href='#'>Excel</a></li>
                            </ul>
                        </div>
                    </div>
                    <table cellpadding='0' cellspacing='0' border='0' class='table col-sm-12 table-bordered table-striped table-condensed cf' id='dataTables-pendaftaran'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pendaftaran</th>
                                <th>NISN</th>
                                <th>Nama Lengkap</th>
                                <th>Sekolah Asal</th>
                                <th>Gelombang</th>
                                <th>Jalur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0 ?>
                        <?php foreach($cpd as $row): ?>
                            <tr class=''>
                                <td> <?php echo ++$no ?></td>
                                <td> <?php echo $row['kode']; ?> </td>
                                <td> <?php echo $row['nisn']; ?> </td>
                                <td> <?php echo $row['nama']; ?> </td>
                                <td> <?php echo $row['nama_skl']; ?> </td>
                                <td> <?php echo $row['gelombang']; ?> </td>
                                <td> <?php echo $row['nama_jalur']; ?> </td>
                                <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                                    <div class="btn-group">
                                        <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/pendaftaran/edit/'.$row['id_pendaftaran'].'/'.$row['id_validasi']; ?>" >
                                            <i class='glyphicon glyphicon-edit icon-white'></i>
                                            Edit
                                        </a>
                                        <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/pendaftaran/delete/'.$row['id_pendaftaran'].'/'.$row['id_validasi']; ?>" onclick="return konfirmasi('Menghapus data <?php echo $row['nama']; ?> ?')">
                                            <i class='glyphicon glyphicon-remove icon-white'></i>
                                            Delete
                                        </a>
                                        <?php $cetakAction = HOME.'/pendaftaran/cetak/'.$row['id_validasi'].'/'.$row['id_pendaftaran']; ?>
                                        <a class='btn btn-info btn-xs' onclick="buka('<?php echo $cetakAction; ?>')">
                                            <i class='glyphicon glyphicon-edit icon-white'></i>
                                            Cetak
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Tidak ada data</p>
            <?php endif; ?>
            <br/>
            </div>
        </div>
    </div>
</div>
