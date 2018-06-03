<div class="row">
    <div class="panel-heading">
        <h2>
            Data Calon Peserta Didik PPDB Tahun <?php echo $year ?> <strong>Terverifikasi</strong>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class='table-responsive'>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numDataCpd; ?> calon peserta didik terverifikasi</button>
                        </div>
                        <div class='btn-group'>
                            <a href=<?php echo HOME.'/pendaftaran/verifikasi' ?>><button class='btn btn-primary btn-xs'>Data Baru <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
                        </div>
            <?php if ($numDataCpd != 0): ?>
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
                                <th>Kode Akses Pendaftaran</th>
                                <th>NISN</th>
                                <th>Nama Lengkap</th>
                                <th>Sekolah Asal</th>
                                <th>Gelombang</th>
                                <th>Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=0 ?>
                        <?php foreach($cpd as $row){ ?>
                            <tr class=''>
                                <td> <?php echo ++$no; ?></td>
                                <td> <?php echo $row['kode']; ?></td>
                                <td> <?php echo $row['nisn']; ?> </td>
                                <td> <?php echo $row['nama']; ?> </td>
                                <td> <?php echo $row['nama_skl']; ?> </td>
                                <td> <?php echo $row['gelombang']; ?> </td>
                                <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                                    <div class="btn-group">
                                        <?php echo $this->formHelper->formOpen('pendaftaran/daftar', array('method' => 'POST', 'class' => "form-horizontal", 'role' => "form")); ?>
                                            <button type="submit" name="cpd_id" value="<?php echo $row['id_pendaftaran'] ?>" class='btn btn-success btn-xs'>
                                                <i class='glyphicon glyphicon-ok icon-white'></i>
                                                Daftar
                                            </button>
                                        <?php echo $this->formHelper->formClose() ?>
                                        <?php echo $this->formHelper->formOpen('pendaftaran/edit', array('method' => 'POST', 'class' => "form-horizontal", 'role' => "form")); ?>
                                            <input type="hidden" name="val_id" value="<?php echo $row['id_validasi'] ?>"></input>
                                            <button type="submit" name="cpd_id" value="<?php echo $row['id_pendaftaran'] ?>" class='btn btn-warning btn-xs' >
                                                <i class='glyphicon glyphicon-edit icon-white'></i>
                                                Edit
                                            </button>
                                        <?php echo $this->formHelper->formClose() ?>
                                        <?php echo $this->formHelper->formOpen('pendaftaran/edit', array('method' => 'POST', 'class' => "form-horizontal", 'role' => "form")); ?>
                                            <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/pendaftaran/delete/'.$row['id_pendaftaran'].'/'.$row['id_validasi']; ?>" onclick="return konfirmasi('Menghapus data <?php echo $row['nama']; ?> ?')">
                                                <i class='glyphicon glyphicon-remove icon-white'></i>
                                                Delete
                                            </a>
                                        <?php echo $this->formHelper->formClose() ?>
                                        <?php $cetakAction = HOME.'/pendaftaran/cetak/'.$row['id_validasi'].'/'.$row['id_pendaftaran']; ?>
                                        <a class='btn btn-info btn-xs' onclick="buka('<?php echo $cetakAction; ?>')">
                                            <i class='glyphicon glyphicon-edit icon-white'></i>
                                            Cetak
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='dataTables-pendaftaran'>
                    <tr>
                        <td>Tidak ada data</td>
                    </tr>
                </table>
            <?php endif; ?>
            <br/>
            </div>
        </div>
    </div>
</div>
