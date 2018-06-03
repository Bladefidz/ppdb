<div class="row">
    <div class="panel-heading">
        <h2>
            Hasil Seleksi Calon Peserta Didik PPDB Gelombang <?php echo $gel ?> Tahun Ajaran <?php echo $thn.'/'.($thn+1) ?>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class='dataTable_wrapper'>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numData; ?> calon peserta didik diseleksi</button>
                        </div>
            <?php if ($numData > 0): ?>
                        <div class='btn-group pull-right'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle btn-xs'>Simpan <span class='caret'></span></button>
                            <ul class='dropdown-menu'>
                                <li><a href='#'>PDF</a></li>
                                <li><a href='#'>Excel</a></li>
                            </ul>
                        </div>
                    </div>
                    <div claa="table-responsive">
                        <table class='table col-sm-12 table-bordered table-striped table-condensed cf' id='dataTables-seleksi'>
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>NP/KAP</th>
                                    <th>Nama</th>
                                    <th>Skor Total</th>
                                    <th>Hasil Keputusan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=0; ?>
                            <?php foreach($selData as $row): ?>
                                <tr class=''>
                                    <td> <?php echo ++$no; ?></td>
                                    <td> <?php echo $row['kode']; ?> </td>
                                    <td> <?php echo $row['nama']; ?> </td>
                                <?php if($row['sel_skor_prestasi'] > $row['max_skor_prestasi']): ?>
                                    <td>
                                        <?php $fixSum = $row['skor_total']-($row['sel_skor_prestasi']-$row['max_skor_prestasi']); ?>
                                        <?php echo $fixSum; ?>
                                    </td>
                                <?php else: ?>
                                    <td> <?php echo $row['skor_total']; ?> </td>
                                <?php endif; ?>
                                <?php if(!empty($row['keputusan'])): ?>
                                    <?php $kep = $row['id_jalur_penerimaan']; ?>
                                    <td>
                                        <span class="label label-success" style="font-size: 12px">
                                            <?php echo $row['keputusan']; ?>
                                        </span>
                                    </td>
                                <?php else: ?>
                                    <?php $kep = 0; ?>
                                    <td>
                                        <span class="label label-danger" style="font-size: 12px">
                                            Tidak Diterima
                                        </span>
                                    </td>
                                <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <table class='table table-striped table-bordered table-hover' id='dataTables-seleksi'>
                    <tr>
                        <td>Data Tidak Ditemukan</td>
                    </tr>
                </table>
            <?php endif; ?>
            <br/>
            </div>
        </div>
    </div>
</div>
