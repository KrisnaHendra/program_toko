<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Export Data Barang (<?=date('d-m-Y')?>)</title>
  </head>
  <body>
  <hr>
    <h1 class="text-center">Data Barang Cahaya Titan</h1>
    <!-- <h3 class="text-center">JUAL PAKAN AYAM, DOC, OBAT, VAKSIN/ALAT PETERNAKAN</h3> -->
    <h3 class="text-center">Desa Pulungdowo - Kec. Tumpang - Kab. Malang</h3>
    <h3 class="text-center">Telp. 0813 3503 4007, 0812 3523 0001</h3>
    <hr>

    <table class="table table-bordered">
        <tr class="" style="background-color: grey; height:50px">
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Keterangan</th>
            <th>Harga Jual</th>
            <th>Harga DO</th>
            <th>Stok</th>
        </tr>
        <?php $no = 1;foreach ($barang as $b): ?>
        <tr style="height:50px">
            <td><?=$no++;?></td>
            <td><?=$b['kode']?></td>
            <td><?=$b['nama_barang']?></td>
            <td><?=$b['keterangan']?></td>
            <td>Rp. <?=number_format($b['harga_jual'])?></td>
            <td>Rp. <?=number_format($b['harga_do'])?></td>
            <td><?=$b['stok']?></td>
        </tr>
        <?php endforeach;?>
    </table>


    <script>
        window.print();
        target = "_blank";
        window.close();
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>