<?php
include "header.php";
include "navbar.php";
include '../koneksi.php';
?>
<div class="card mt-2">
    <div class="card-body">
        <?php
        $PelangganID = $_GET['PelangganID'];
        $no = 1; 
        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
        while($d = mysqli_fetch_array($data)){
            ?>
            <?php if($d['PelangganID'] == $PelangganID) { ?>
                <table>
                    <tr>
                        <td>ID Pelanggan</td>
                        <td>: <?php echo $d['PelangganID']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>: <?php echo $d['NamaPelanggan']; ?></td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td>: <?php echo $d['NomorTelepon']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?php echo $d['Alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Total Pembelian</td>
                        <td>: <?php echo $d['TotalHarga']; ?></td>
                    </tr>
                </table>
                <form action="tambah_detail_penjualan.php" method="post">
                    <input type="hidden" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hiiden>
                    <input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hiiden>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">
                      Tambah Barang
                    </button>
                </form>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Beli</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nos = 1;
                        $detailpenjualan = mysqli_query($koneksi, "SELECT * FROM detailpenjualan");
                        while($d_detailpenjualan = mysqli_fetch_array($detailpenjualan)){ ?>
                        <?php
                        if($d_detailpenjualan['PenjualanID'] == $d['PenjualanID']) { ?>
                        <tr>
                            <td><?php echo $nos++; ?></td>
                            <td>
                                 <form action="simpan_barang_beli.php" method="post">
                                    <div class="form-group">
                                        <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                        <input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
                                        <select name="ProdukID" class="form-control" onchange="this.form.submit()">
                                            <option name="ProdukID">--- Pilih Produk ---</option>
                                            <?php
                                            include '../koneksi.php';
                                            $no = 1;
                                            $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                                            while($d_produk = mysqli_fetch_array($produk)){ 
                                                ?>
                                            <option value="<?php echo $d_produk['ProdukID']; ?>" <?php if($d_produk['ProdukID'] == $d_detailpenjualan['ProdukID']) { echo "selected"; }?>><?php echo $d_produk['NamaProduk']; ?></option>
                                           <?php } ?>
                                        </select>
                                    </div>
                                 </form>
                            </td>
                            <td>
                                <form action="hitung_subtotal.php" method="post">
                                    <?php
                                    $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                                    while($d_produk = mysqli_fetch_array($produk)){
                                        ?>
                                        <?php
                                        if($d_produk['ProdukID'] ==$d_detailpenjualan['ProdukID']) { ?> 
                                        <input type="text" required name="Harga" value="<?php echo $d_produk['Harga']; ?>" hidden>
                                        <input type="text" name="ProdukID" value="<?php echo $d_produk['ProdukID']; ?>" hidden>
                                        <input type="text" name="Stok" value="<?php echo $d_produk['Stok']; ?>" hidden>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input type="number" name="JumlahProduk" value="<?php echo $d_detailpenjualan['JumlahProduk']; ?>" class="form-control">
                                    </div>
                                 
                            </td>
                            <td><?php echo $d_detailpenjualan['Subtotal']; ?></td>
                            <td>
                                <input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
                                <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                <button type="submit" class="btn btn-warning btn-sm">Proses</button>
                                </form>
                            <form action="hapus_detail_pembelian.php" method="post">
                                    <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                    <input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
                                    <button type="submit" class="btn btn-danger btn-sm mt-2">Hapus</button>
                                </form>
                            </td>

                        </tr>
                       <?php } else {
                        ?>
                        <?php
                       }
                        }
                        ?>
                    </tbody>
                </table>
                <form method="post" action="simpan_total_harga.php">
                    <?php
                    include '../koneksi.php';
                    $detailpenjualan = mysqli_query($koneksi, "SELECT SUM(Subtotal) AS TotalHarga FROM detailpenjualan WHERE PenjualanID='$d[PenjualanID]'");
                    $row = mysqli_fetch_assoc($detailpenjualan);
                    $sum = $row['TotalHarga'];
                    ?>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="from-group">
                                <input type="number" class="form-control" name="TotalHarga" value="<?php echo $sum; ?>">
                                <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>"hidden>
                                <input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>"hidden>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                            <button type="submit" class="btn btn-info btn-sm form-control">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
         <?php   } else { ?>
        <?php
        }
        }
        ?>
    </div>
</div>
<?php
include "footer.php";
?>