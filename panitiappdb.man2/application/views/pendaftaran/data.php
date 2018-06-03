<div class="row">
    <div class="col-lg-12">
        <div class="well well-sm">
            Data Calon Peserta Didik PPDB
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class='table-responsive'>
                <?php if ($numDataCpd > 0): ?>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numDataCpd; ?> calon peserta didik</button>
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
                    <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='dataTables-pendaftaran'>
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>NISN</th>
                                <th>Nama Lengkap</th>
                                <th>Sekolah Asal</th>
                                <th>Gelombang</th>
                                <th>Jalur</th>
                                <th>Status</th>
                                <th>Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($dataCpd as $row): ?>
                            <tr class=''>
                                <td> <?php echo $row['id_pendaftaran']; ?></td>
                                <td> <?php echo $row['nisn']; ?> </td>
                                <td> <?php echo $row['nama']; ?> </td>
                                <td> <?php echo $row['nama_skl']; ?> </td>
                                <td> <?php echo $row['gelombang']; ?> </td>
                            <?php if ($row['id_validasi'] === 1): ?>
                                <td> <span class="label label-warning" style="font-size: 14px">belum pilih</span> </td>
                                <td> <span class="label label-warning" style="font-size: 14px"><?php echo $row['keterangan_validasi']; ?></span> </td>
                                <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                                    <a class='btn btn-primary btn-xs' href="<?php echo HOME.'/pendaftaran/data/update/'.$row['id_pendaftaran']; ?>" >
                            <?php else: ?>
                                <td> <span class="label label-success" style="font-size: 14px"><?php echo $row['nama_jalur']; ?></span> </td>
                                <td> <span class="label label-success" style="font-size: 14px"> <?php echo $row['keterangan_validasi']; ?> </span> </td>
                                <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                                    <a class='btn btn-default btn-xs disabled'>
                            <?php endif; ?>
                                        <i class='glyphicon glyphicon-edit icon-white'></i>
                                        Daftar
                                    </a>
                                    <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/pendaftaran/data/edit/'.$row['id_pendaftaran']; ?>" >
                                        <i class='glyphicon glyphicon-edit icon-white'></i>
                                        Edit
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/pendaftaran/data/delete/'.$row['id_pendaftaran']; ?>" onclick="return konfirmasi('Menghapus data <?php echo $row['nama']; ?> ?')">
                                        <i class='glyphicon glyphicon-remove icon-white'></i>
                                        Delete
                                    </a>
                                    <?php $cetakAction = HOME."/pendaftaran/cetak/".$row['id_pendaftaran']; ?>
                                    <a class='btn btn-info btn-xs' onclick="buka('<?php echo $cetakAction; ?>')">
                                        <i class='glyphicon glyphicon-print icon-white'></i>
                                        Print
                                    </a>
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
