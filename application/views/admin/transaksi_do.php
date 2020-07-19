<div class="content">
<div class="row">
<div class="col-md-7" style="background-color: #f0f0f0;">

<div class="block" style="background-color: white;">
      <div class="block-header bg-dark" >
          <h3 class="block-title text-white"><i class="fa fa-shopping-cart"></i> TRANSAKSI DO <small class="text-white"><?= date('d F Y') ?></small></h3>
          <div class="block-options">
              <div class="block-options-item">
                  <b class="badge badge-danger">Total Barang : <?= $this->db->count_all('barang') ?></b>
              </div>
          </div>
      </div>
      <div class="block-content">
          <table class="table table-vcenter js-dataTable-full-pagination table-sm">
              <thead>
                  <tr class="bg-secondary" style="background-color: #78acff; color:white;">
                      <th class="text-center" style="width: 50px;">#</th>
                      <th class="text-dark" style="width:0.1px;">.</th>
                      <th>Nama</th>
                      <th class="d-none d-sm-table-cell">ket</th>
                      <th class="text-center" style="width:120px;;">Harga</th>
                      <th class="text-center">Stok</th>
                      <th class="text-center"><i class="fa fa-fw fa-cart-plus"></i></th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no=1; foreach($barang as $b): ?>
                  <tr>
                      <th class="text-center" scope="row"><?= $no++ ?></th>
                      <td style="font-size: 0.1px; width:none;"><?= $b['kode'] ?></td>
                      <td class="text-left"><?= $b['nama_barang'] ?></td>
                      <td class="text-center"><?= $b['keterangan'] ?></td>
                      <td class="text-center">Rp. <?= number_format($b['harga_do']) ?></td>
                      <?php if($b['stok']<11) {?>
                          <td class="text-center text-danger"><b class="btn btn-sm btn-danger"><?= $b['stok'] ?></b></td>
                      <?php }else{?>
                          <td class="text-center"><?= $b['stok'] ?></td>
                      <?php } ?>
                      <td class="text-center">
                      <?php echo anchor('transaksi/add_cart_do/'.$b['id_barang'],'<button class="btn btn-sm btn-secondary"><i class="fa fa-fw fa-cart-plus"></i></button>') ?>
                      </td>

                  </tr>
                  <?php endforeach; ?>

              </tbody>
          </table>
      </div>
  </div>
</div>
<div class="col-md-5">
<form action="<?= base_url('transaksi/save_trans_do') ?>" method="POST">

<div class="block mb-2">
  <div class="block-header bg-dark text-light">
    <h3 class="block-title text-white"><i class="fa fa-fw fa-sticky-note"></i> Informasi Nota</h3>
  </div>
  <div class="block-content">
  <table class="mb-2">
    <tr>
        <td>No. Nota </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="kode" class="font-weight-bold form-control form-control-sm" value="DO<?= time() ?>" style="width:120%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Tanggal </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" class="form-control form-control-sm" value="<?= date('d/m/Y') ?>" style="width:120%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Kasir </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="nama_kasir" class="font-weight-bold form-control form-control-sm" value="<?= $this->session->userdata('nama') ?>" style="width:120%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Nama Pelanggan </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="pembeli" class="form-control form-conrol-sm" style="width:120%; height:25px;" value="Umum" required></td>
    </tr>
    <tr class="text-small">
        <td class="font-weight-bold" style="color: #fcba03;">Catatan Struk* </td>
        <td class="pl-1 pr-1 font-weight-bold" style="color: #fcba03;">: </td>
        <td><input type="text" name="catatan" class="form-control small" style="width:120%; height:25px; border-color:;" placeholder="-"></td>
    </tr>
  </table>

  </div>
</div>
<table class="table table-vcenter table-sm bg-white">
    <thead>
        <tr class="bg-dark" style="background-color: #389fff; color: white;">
            <th>Nama</th>
            <th class="text-center">Ket</th>
            <th class="text-left">Jumlah</th>
            <th class="text-center">Harga</th>
            <!-- <th>Subtotal</th> -->
            <th class="text-center"><i class="fa fa-fw fa-sync"></i></th>
        </tr>
    </thead>
    <tbody>
    <?php if($this->cart->total_items()>0){?>
    <div class="row">
      <div class="row ml-2">
        <div class="col-2" style="margin-left:-8px">
          <a href="<?= base_url('transaksi/hapus_do'); ?>" class="btn btn-sm btn-warning mb-2 mr-2" data-toggle="tooltip" title="Kosongkan"><i class="fa fa-fw fa-trash-alt" style="color:white;"></i></a>
        </div>
        <div class="offset-1" style="margin-left:247px">
          <h5 class="btn btn-sm btn-warning btn-rounded font-w600 mb-0">TRANSAKSI DO</h5>
        </div>

        <!-- <div class="offset-md-6 p-0 m-0">
        </div> -->
      </div>

    <?php foreach($this->cart->contents() as $items): ?>
    <input type="hidden" name="id_barang[]" value="<?=$items['id']?>">
		<input type="hidden" name="rowid[]" value="<?=$items['rowid']?>">
        <tr>
        <td><?= $items['name'] ?></td>
        <td class="text-center"><?= $items['keterangan'] ?></td>
        <td class="text-center"><input type="text" class="form-control form-control-sm text-center" name="qty[]" value="<?= $items['qty'] ?>" style="width:80px;" class="text-center"></td>
        <td class="text-center"><?= number_format($items['price']*$items['qty']) ?></td>
        <td>
        <a href="<?= base_url('transaksi/hapus_cart_do/') ?><?= $items['rowid'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-times-circle"></i> </a></td>
        </tr>
    <?php endforeach; ?>
        <tr class="table table-hover bg-white">
        <td></td>
        <input type="hidden" name="total" value="<?= $this->cart->total(); ?>">
        <td colspan="4" class="text-right"><b> Total : Rp. <?= number_format($this->cart->total()); ?></b></td>
        </tr>
    <?php }else {?>
        <tr>
            <td colspan="5" class="text-center bg-white"><b>Keranjang Kosong</b></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php if($this->cart->total_items()>0){?>
<input type="submit" name="update" style="background:#f9f9f9; color:#f9f9f9; border:1px solid #f9f9f9;"></input>
<input type="submit" name="bayar" onclick="return confirm('Anda yakin ingin cetak nota?')" class="btn btn-sm btn-primary offset-md-7 font-weight-bold" value="PRINT" style="width:105px;">
<?php }?>
</form>
<?= $this->session->flashdata('notif') ?>
</div>
</div>


<script>
	function myFunction(){
		/* tombol F6 */
		if(event.keyCode == 117) {
			event.preventDefault()
			alert('Anda menekan tombol F11');
		}
	}
	</script>
