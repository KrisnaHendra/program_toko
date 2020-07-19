<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Struk</title>
  </head>
  <body>
    <h1 class="text-center" style="font-size:60px;"><a href="<?= base_url('transaksi/backFromStruk') ?>">CAHAYA TITAN</a></h1>
    <h3 class="text-center">JUAL PAKAN AYAM, DOC, OBAT, VAKSIN/ALAT PETERNAKAN</h3>
    <h3 class="text-center">Desa Pulungdowo - Kec. Tumpang - Kab. Malang</h3>
    <h3 class="text-center">Telp. 0813 3503 4007, 0812 3523 0001</h3>
    <!-- <h5>==================================================================================</h5> -->
    <hr style="border:1px solid black">
    <table>
        <tr>
            <td><h2> No. Struk</h2></td>
            <td><h2 class="pl-2 pr-2">:</h2></td>
            <td><h2><?= $kode; ?></h2></td>
        </tr>
        <tr>
            <td><h2> Nama Kasir</h2></td>
            <td><h2 class="pl-2 pr-2">:</h2></td>
            <td><h2><?= $this->session->userdata('nama') ?></h2></td>
        </tr>
        <tr>
            <td><h2> Tanggal</h2></td>
            <td><h2 class="pl-2 pr-2">:</h2></td>
            <td><h2><?php
                    date_default_timezone_set('Asia/Jakarta');
                    echo date('d F Y H:i');?></h2></td>
        </tr>
        <tr>
            <td><h2> Nama Pelanggan</h2></td>
            <td><h2 class="pl-2 pr-2">:</h2></td>
            <td><h2><?= $pembeli; ?></h2></td>
        </tr>
    </table>
    <!-- <h5>==================================================================================</h5> -->
    <hr style="border:1px solid black">
    <table class="table table-sm table-bordered">
        <tr class="text-center">
            <th style="width:30%;"><h1>Nama Barang</h1></th>
            <th style="width:25%;"><h1>Harga</h1></th>
            <th style="width:20%;"><h1>Jumlah</h1></th>
            <th style="width:40%;"><h1>Total</h1></th>
        </tr>
        <?php foreach($data as $d):?>
        <tr class="text-center">
            <td class=""><p style="font-size:35px;"><?= $d['nama_barang'] ?></p></td>
            <td><p style="font-size:35px;">Rp. <?= number_format($d['harga']) ?></p></td>
            <td><p style="font-size:35px;"><?= $d['jumlah'] ?></p></td>
            <td><p style="font-size:35px;">Rp. <?= number_format($d['subtotal']) ?></p></td>
        </tr>
        <?php endforeach;?>

        <tr class="text-right">
            <td colspan="4"><h1>Total : Rp. <?= number_format($allTotal[0]['total']) ?></h1></td>
        </tr>

    </table>

    <?php if($catatan==''){?>
    <?php }else{?>
    <h2>NB* : <?= $catatan; ?>.</h2>
    <?php } ?>
    <hr style="border:1px solid black">
    <h2 class="text-center pb-0">Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</h2><br>
    <h1 class="text-center pt-0">~ TERIMA KASIH ~</h1>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        window.print();
        setTimeout(window.close(), 0);
    </script>
  </body>
</html>
