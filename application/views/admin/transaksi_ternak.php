
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="content">
<div class="row">
<div class="col-md-7" style="background-color: #f0f0f0;">
<div class="block" style="background-color: #f0f0f0;">
                                <div class="block-header" >
                                    <h3 class="block-title">TRANSAKSI DO</h3>
                                    <div class="block-options">
                                        <div class="block-options-item">
                                            <b style="color: red;">Total Barang : <?= $this->db->count_all('barang') ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <table class="table table-sm table-vcenter js-dataTable-full-pagination">
                                        <thead>
                                            <tr class="bg-success" style="background-color: #78acff; color:white;">
                                                <th class="text-center" style="width: 50px;">#</th>
                                                <th class="text-success" style="width:0.1px;">.</th>
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
                                                <?php echo anchor('transaksi/add_cart_do/'.$b['id_barang'],'<button class="btn btn-sm btn-success"><i class="fa fa-fw fa-cart-plus"></i></button>') ?>
                                                </td>
                                                <!-- color: rgba(255,255,255,0.8); text-shadow: 0 0 10px rgba(0,0,0,0.2); -->
                                                <!-- <td class="font-w600 font-size-sm">
                                                    <a href="be_pages_generic_profile.html">Amanda Powell</a>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <span class="badge badge-primary">Personal</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td> -->
                                            </tr>
                                            <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>             
</div>
<div class="col-md-5">
<form action="<?= base_url('transaksi/save_trans_do') ?>" method="POST">

<div class="card mb-2">
  <div class="card-header bg-success text-light">
   <i class="fa fa-fw fa-sticky-note"></i> Informasi Nota
  </div>
  <div class="card-body">
  <table>
    <tr>
        <td>No. Nota </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="kode" class="font-weight-bold" value="DO<?= time() ?>" style="width:100%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Tanggal </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" value="<?= date('d M Y') ?>" style="width:100%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Kasir </td>
        <td class="pl-1 pr-1">: </td>
        <td><input type="text" name="nama_kasir" class="font-weight-bold" value="<?= $this->session->userdata('nama') ?>" style="width:100%; background: #e6e6e6; border:1px solid #e6e6e6;" required readonly></td>
    </tr>
    <tr>
        <td>Nama Pelanggan </td>
        <td class="pl-1 pr-1">: </td>
        <td><select name="pembeli" style="width:100%">
        <?php foreach ($pelanggan as $p): ?>
        <option value="<?= $p['nama_pelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
        <?php endforeach; ?>
        </select></td>
        <!-- <td><input type="text" name="pembeli" class="" style="width:100%;" value="UMUM" required></td> -->
    </tr>
  </table>
    <!-- <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
    </blockquote> -->
  </div>
</div>
<table class="table table-vcenter">
    <thead>
        <tr class="bg-success" style="background-color: #389fff; color: white;">
            <th>Nama</th>
            <th class="text-center">Ket</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Harga</th>
            <!-- <th>Subtotal</th> -->
            <th class="text-center"><i class="fa fa-fw fa-sync"></i></th>
        </tr>
    </thead>
    <tbody>
    <?php if($this->cart->total_items()>0){?>
    <div class="row">
    <div class="col-md-1">
    <a href="<?= base_url('transaksi/hapus_do'); ?>" class="btn btn-sm btn-warning mb-2 mr-2"><i class="fa fa-fw fa-trash-alt" style="color:white;"></i></a>
    </div>
    <div class="col-md-1">
    <!-- <i href="<?= base_url('transaksi/print'); ?>" target="_blank" class="btn btn-sm btn-primary mb-2 mr-2" onClick="return confirm('Anda Yakin ingin cetak struk?')"><i class="fa fa-fw fa-print" style="color:white;"></i></a> -->
    </div>
    <div class="offset-md-6 pl-3">
    <h5 class="btn btn-sm btn-warning font-w600">TRANSAKSI DO</h5>
    <!-- <label class="sr-only" for="inlineFormInputGroup">Bayar</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Rp. </div>
        </div>
        <input type="number" class="form-control" id="inlineFormInputGroup" name="jumlah_bayar" placeholder="Jumlah bayar" value="0" style="width:162px"; required>
      </div>
    </div> -->
    </div>
    
   
    <?php foreach($this->cart->contents() as $items): ?>
        <input type="hidden" name="id_barang[]" value="<?=$items['id']?>">
		<input type="hidden" name="rowid[]" value="<?=$items['rowid']?>">
        <tr>
        <td><?= $items['name'] ?></td>
        <td class="text-center"><?= $items['keterangan'] ?></td>
        <td class="text-center"><input type="text" name="qty[]" value="<?= $items['qty'] ?>" style="width:40px;" class="text-center"></td>
        <td class="text-center"><?= number_format($items['price']*$items['qty']) ?></td>
        <td>
        <a href="<?= base_url('transaksi/hapus_cart_do/') ?><?= $items['rowid'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> </a></td>
        </tr>
    <?php endforeach; ?>
        <tr class="table table-hover">
        <td></td>
        <input type="hidden" name="total" value="<?= $this->cart->total(); ?>"> 
        <td colspan="4" class="text-right"><b> Total : Rp. <?= number_format($this->cart->total()); ?></b></td>
        </tr>
    <?php }else {?>
        <tr>
            <td colspan="5" class="text-center bg-light"><b>Keranjang Kosong</b></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php if($this->cart->total_items()>0){?>
<input type="submit" name="update" style="background:white; color:white; border:1px solid white;"></input>
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