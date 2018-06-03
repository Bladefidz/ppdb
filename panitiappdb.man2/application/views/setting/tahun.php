<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN TAHUN PPDB
        </h2>
    </div>
    <div class="col-lg-12">
        <div class='btn-group'>
            <a href=<?php echo HOME.'/setting/tahun/add' ?>><button class='btn btn-primary btn-xs'>Tambah Tahun <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
        </div>
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($tahun as $row): ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td><?php echo $row['tahun_ajaran'] ?></td>
                <?php if($row['aktif']): ?>
                    <td> <span class="label label-success" style="font-size: 14px">Aktif</span> </td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <a class='btn btn-primary btn-xs disabled' >
                            <i class='glyphicon glyphicon-ok icon-white'></i>
                            Aktifkan
                        </a>
                <?php else: ?>
                    <td> <span class="label label-warning" style="font-size: 14px">Tidak Aktif</span> </td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <a class='btn btn-primary btn-xs' href="<?php echo HOME.'/setting/tahun/aktifkan/'.$row['id_tahun_ajaran']; ?>" >
                            <i class='glyphicon glyphicon-ok icon-white'></i>
                            Aktifkan
                        </a>
                <?php endif; ?>
                        <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/setting/tahun/update/'.$row['id_tahun_ajaran']; ?>" >
                            <i class='glyphicon glyphicon-edit icon-white'></i>
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
