<div class="content">
    <div class="row col-6 pt-3" style="background:white;">
        <table class="table table-hover">
            <tr class="text-center">
                <td colspan="3"><img src="<?= base_url('assets/admin/') ?>assets/media/avatars/avatar10.jpg" alt="admin"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $data['nama'] ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?= $data['username'] ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>Administrator</td>
            </tr>
            <tr>
                <td>Aktif</td>
                <td>:</td>
                <td><i class="fa fa-fw fa-check"></i></td>
            </tr>
            <tr>
                <td>Tanggal Terdaftar</td>
                <td>:</td>
                <td><?= date('d M Y',$data['created_at']) ?></td>
            </tr>
        </table>
    </div>
</div>