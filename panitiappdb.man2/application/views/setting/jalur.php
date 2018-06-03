<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN JALUR PPDB
        </h2>
    </div>
    <div class="col-lg-12">
        <div class='btn-group'>
            <a href=<?php echo HOME.'/setting/jalur/add' ?>><button class='btn btn-primary btn-xs'>Tambah Jalur <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
        </div>
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jalur</th>
                    <th>Nama Jalur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($jalur as $row): ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td><?php echo $row['kode_jalur'] ?></td>
                    <td><?php echo $row['nama_jalur'] ?></td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                    <?php
                        $attributes = array('method' => 'POST', 'class' => "form-horizontal", 'role' => "form");
                        echo $this->formHelper->formOpen('setting/jalur/update', $attributes);
                    ?>
                        <input type="hidden" name="tes_id" value="<?php echo $row['id_jalur'] ?>"></input>
                        <button type="submit" name="action" value="Edit" class='btn btn-warning btn-xs'>
                            <span class='glyphicon glyphicon-edit icon-white'></span>
                            Edit
                        </button>
                        <button type="submit" name="action" value="Delete" class='btn btn-danger btn-xs' onclick="return konfirmasi('Melakukan penghapusan jalur sangat tidah dianjurkan! Penghapusan jalur sembarangan dapat mengakibatkan kegagalan sistem. Apakah anda yakin jalur <?php echo $row['nama_jalur'] ?> tidak berelasi dengan gelombang pendaftaran yang yang telah dan sedang berjalan ?')">
                            <i class='glyphicon glyphicon-remove icon-white'></i>
                            Delete
                        </button>
                    <?php echo $this->formHelper->formClose() ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
