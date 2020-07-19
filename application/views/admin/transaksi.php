<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<div class="content">
<div class="row">
<div class="col-md-7" style="background-color: #f0f0f0;">
<div class="block" style="background-color: #f0f0f0;">
                                <div class="block-header bg-primary" >
                                    <h3 class="block-title text-white"><i class="fa fa-shopping-cart"></i> TRANSAKSI <small class="text-white"><?= date('d F Y') ?></small></h3>
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <b class="badge badge-danger">Total Barang : <?= $this->db->count_all('barang') ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content bg-white">
                                    <table class="table table-vcenter js-dataTable-full-pagination table-sm">
                                        <thead>
                                            <tr class="bg-info" style="color:white;">
                                                <th class="text-center" style="width: 50px;">#</th>
                                                <th class="text-primary">.</th>
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
                                                <td class="text-center">Rp. <?= number_format($b['harga_jual']) ?></td>
                                                <?php if($b['stok']<11) {?>
                                                    <td class="text-center text-danger"><b class="btn btn-sm btn-danger"><?= $b['stok'] ?></b></td>
                                                <?php }else{?>
                                                    <td class="text-center"><?= $b['stok'] ?></td>
                                                <?php } ?>
                                                <td class="text-center">
                                                <?php echo anchor('transaksi/add_cart/'.$b['id_barang'],'<button class="btn btn-sm btn-info"><i class="fa fa-fw fa-cart-plus"></i></button>') ?>
                                                </td>

                                            </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
</div>
<div class="col-md-5">
<form action="<?= base_url('transaksi/save_trans') ?>" method="POST">

<div class="block mb-2">
  <div class="block-header bg-primary text-light">
    <div class="block-title">

      <i class="fa fa-fw fa-sticky-note"></i> Informasi Nota
    </div>
  </div>
  <div class="block-content">
  <table class="mb-3">
    <tr>
        <td>No. Nota </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="kode" class="font-weight-bold form-control form-control-sm" value="INV<?= time() ?>" style="width:125%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Tanggal </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" class="form-control form-control-sm" value="<?= date('d/m/Y') ?>" style="width:125%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Kasir </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="nama_kasir" class="font-weight-bold form-control form-control-sm" value="<?= $this->session->userdata('nama') ?>" style="width:125%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Nama Pelanggan </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="pembeli" class="form-control form-control-sm" style="width:125%;" value="Umum" required></td>
    </tr>
  </table>
  </div>
</div>
<table class="table table-vcenter bg-white table-sm">
    <thead>
        <tr class="bg-primary" style="background-color: #389fff; color: white;">
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
    <div class="col-md-1">
    <a href="<?= base_url('transaksi/hapus'); ?>" class="btn btn-sm btn-danger mb-2 mr-2" data-toggle="tooltip" title="Kosongkan"><i class="fa fa-fw fa-trash-alt" style="color:white;"></i></a>
    </div>
    <div class="col-md-1">
    <!-- <i href="<?= base_url('transaksi/print'); ?>" target="_blank" class="btn btn-sm btn-primary mb-2 mr-2" onClick="return confirm('Anda Yakin ingin cetak struk?')"><i class="fa fa-fw fa-print" style="color:white;"></i></a> -->
    </div>
    <div class="offset-md-4">
    <label class="sr-only" for="inlineFormInputGroup"></label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text p-0 pl-2 pr-2 bg-info text-white"><b><i class="fa fa-wallet"></i></b></div>
        </div>
        <input type="text" class="form-control form-control-sm" id="rupiah inlineFormInputGroup" name="jumlah_bayar" value="0" placeholder="Jumlah bayar" style="width:178px"; required>
      </div>
    </div>
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
        <a href="<?= base_url('transaksi/hapus_cart/') ?><?= $items['rowid'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-times-circle"></i> </a></td>
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
    <input type="submit" name="update" style="background:#f5f5f5; color:#f5f5f5; border:1px solid #f5f5f5;"></input>
		<input type="submit" name="bayar" onclick="return confirm('Anda yakin ingin cetak nota?')" class="btn btn-sm btn-info offset-md-7 font-weight-bold" value="PRINT" style="width:105px;">
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

<script>
var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat ketik nominal di form kolom input
    // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
});
/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split           = number_string.split(','),
    sisa             = split[0].length % 3,
    rupiah             = split[0].substr(0, sisa),
    ribuan             = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>
