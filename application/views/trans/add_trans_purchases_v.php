    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Halaman Transaksi Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('Page_c') ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('Transaksi_c') ?>"><i class="fas fa-cubes"></i> Transaksi</a></li>
              <li class="breadcrumb-item active">Tambah Pembelian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-orange card-outline">
              <div class="card-header">
                <h5 class="m-0">Form transaksi pembelian</h5>
              </div>
              <div class="card-body">
                <div id="alert-trans"></div>
                <!-- Form daftar barang -->
                <form method="POST" action="<?php echo site_url('Transaksi_c/addTransProduct/Purchases') ?>">
                  <!-- Autocomplete product -->
                    <div class="row">
                      <div class="col-md-4 col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Product</label>
                          <input type="hidden" name="postIdPrd">
                          <input type="text" class="form-control" name="postNamaPrd" id="inputNamaPrd" placeholder="Masukan nama atau barcode product">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label>Jumlah</label>
                          <input type="text" class="form-control" name="postJumlahPrd" id="inputJumlahPrd" onkeyup="totalBayar()" placeholder="Enter ...">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label>Harga Beli Satuan</label>
                          <input type="text" class="form-control" name="postHargaPrd" id="inputHargaPrd" placeholder="Enter ...">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label>Total</label>
                          <input type="text" class="form-control" name="postTotalPrd" id="inputTotalPrd" placeholder="Enter ..." readonly>
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                          <label> &nbsp; </label>
                          <input type="submit" class="form-control btn btn-success" value="Tambah">
                        </div>
                      </div> 
                    </div>
                  <!-- Table tampilkan product yang dipilih -->
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <th>No.</th>
                          <th>Product</th>
                          <th>Jumlah</th>
                          <th>Harga satuan</th>
                          <th>Total</th>
                          <th>Aksi</th>
                        </thead>
                        <tbody>
                          <?php 
                          $no = 1;
                          $totalBayar = 0; 
                          foreach ($daftarPrd as $row): 
                            $totalBayar += $row['tp_total_paid'];
                          ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['prd_name']; ?></td>
                            <td><?php echo $row['tp_product_amount'] ?></td>
                            <td><?php echo $row['tp_purchase_price'] ?></td>
                            <td><?php echo $row['tp_total_paid'] ?></td>
                            <td class="text-center">
                              <a href="<?php echo site_url('Transaksi_c/deleteTransProduct/Purchases') ?>/<?php echo urlencode(base64_encode($row['tp_product_fk'])) ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                          <th colspan="4" class="text-right">Total : </th>
                          <th><?php echo $totalBayar ?></th>
                          <th>&nbsp;</th>
                        </tfoot>
                      </table>
                    </div>            
                </form>

                <!-- Form Transaksi -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo site_url('Transaksi_c/addPurchasesProses') ?>">

                  <!-- Form-part input Kode Transaksi : Otomatis -->
                    <div class="form-group row">
                      <label for="inputTransKode" class="col-sm-3 col-form-label">Kode Transaksi <a class="float-right"> : </a></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control float-right" name="postTransKode" id="inputTransKode" value="<?php echo $nextTransCode ?>" placeholder="Kode transaksi terisi otomatis oleh sistem" required readonly>
                      </div>
                    </div>

                  <!-- Form-part input Nomor Nota -->
                    <div class="form-group row">
                      <label for="inputTransNota" class="col-sm-3 col-form-label">Nomor Nota Pembelian <a class="float-right"> : </a></label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control float-right" name="postTransNota" id="inputTransNota" placeholder="Masukkan nomor nota pembelian" required>
                      </div>
                    </div>

                  <!-- Form-part input File Nota -->
                    <div class="form-group row">
                      <label for="inputTransFileNota" class="col-sm-3 col-form-label">File Pembelian <a class="float-right"> : </a></label>
                      <div class="col-sm-6">
                        <div class="custom-file">
                          <input type="file" class="form-control float-right custom-file-input" name="postTransFileNota" id="inputTransFileNota" required>
                          <label class="custom-file-label" for="inputTransFileNota"><p>Pilih File Nota Pembelian</p></label>
                        </div>
                      </div>
                    </div>

                  <!-- Form-part input tanggal transaksi -->
                    <div class="form-group row">
                      <label for="inputTransTgl" class="col-sm-3 col-form-label">Tanggal Transaksi<a class="float-right"> : </a></label>
                      <div class="col-sm-3">
                        <input type="date" class="form-control float-right" name="postTransTgl" id="inputTransTgl" required>
                      </div>
                    </div>

                  <!-- Form-part input supplier -->
                    <div class="form-group row">
                      <label for="inputTransSupp" class="col-sm-3 col-form-label">Supplier <a class="float-right"> : </a></label>
                      <div class="col-sm-8">
                        <select class="form-control float-right" name="postTransSupp" id="inputTransSupp">
                          <option> -- Pilih Supplier -- </option>
                          <?php foreach ($optSupp as $showOpt): ?>
                            <option value="<?php echo $showOpt['supp_id'] ?>"> <?php echo $showOpt['supp_name'] ?> </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                  <!-- Form-part input Status Pembayaran -->
                    <div class="form-group row">
                      <label for="inputTransStatus" class="col-sm-3 col-form-label">Status Pembayaran <a class="float-right"> : </a></label>
                      <div class="col-sm-5">
                        <select class="form-control float-right" name="postTransStatus" id="inputTransStatus">
                          <option> -- Pilih Status -- </option>
                          <option value="K"> Kredit / Angsur </option>
                          <option value="T"> Tunai </option>
                        </select>
                      </div>
                    </div>

                  <!-- Form-part input Metode Pembayaran -->
                    <div class="form-group row">
                      <label for="inputTransMetode" class="col-sm-3 col-form-label">Metode Pembayaran <a class="float-right"> : </a></label>
                      <div class="col-sm-5">
                        <select class="form-control float-right" name="postTransMetode" id="inputTransMetode">
                          <option> -- Pilih Metode -- </option>
                          <option value="TF"> Transfer </option>
                          <option value="TN"> Tunai </option>
                        </select>
                      </div>
                    </div>

                  <!-- Form-part input Rekening -->
                    <div class="form-group row" id="formpartRekening" style="display:none">
                      <label for="inputTransRek" class="col-sm-3 col-form-label">Rekening <a class="float-right"> : </a></label>
                      <div class="col-sm-5">
                        <select class="form-control float-right" name="postTransRek" id="inputTransRek" required>
                          <option> -- Pilih Rekening -- </option>
                          <?php foreach($optRek as $showOpt): ?>
                          <option value="<?php echo $showOpt['rek_id'] ?>"> <?php echo '['.$showOpt['bank_name'].'] '.$showOpt['rek_nomor'].' - '.$showOpt['rek_atas_nama'] ?> </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                  <!-- Form-part input total harga beli -->
                    <div class="form-group row">
                      <label for="inputTransTotalBayar" class="col-sm-3 col-form-label">Total Pembelian <a class="float-right"> : </a></label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control float-right" step="0.01" name="postTransTotalBayar" id="inputTransTotalBayar" value="<?php echo $totalBayar ?>" readonly required>
                      </div>
                    </div>

                  <!-- Form-part input Dibayar -->
                    <div class="form-group row">
                      <label for="inputTransPembayaran" class="col-sm-3 col-form-label">Pembayaran Pertama <a class="float-right"> : </a></label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control float-right" step="0.01" name="postTransPembayaran" id="inputTransPembayaran" placeholder="Pembayaran pertama" required>
                      </div>
                    </div>

                  <!-- Form-part input Tenor -->
                    <div class="form-group row">
                      <label for="inputTransTenor" class="col-sm-3 col-form-label">Tenor <a class="float-right"> : </a></label>
                      <div class="col-sm-3">  
                        <div class="input-group sm-3">
                            <input type="number" class="form-control tenortempo" name="postTransTenor" id="inputTransTenor" min="0" required="" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-times"></i></span>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <select class="form-control float-right tenortempo" name="postTransTenorPeriode" id="inputTransTenorPeriode" required="" disabled>
                          <option value="D">Harian</option>
                          <option value="W">Mingguan</option>
                          <option value="M">Bulanan</option>
                          <option value="Y">Tahunan</option>
                        </select>
                      </div>
                    </div>

                  <!-- Form-part input Angsuran -->
                    <div class="form-group row">
                      <label for="inputTransAngsuran" class="col-sm-3 col-form-label">Besar Angsuran <a class="float-right"> : </a></label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control float-right" name="postTransAngsuran" id="inputTransAngsuran" required="" disabled>
                      </div>
                    </div>

                  <!-- Form-part input Tempo -->
                    <div class="form-group row">
                      <label for="inputTransTempo" class="col-sm-3 col-form-label"> Tempo selanjutnya <a class="float-right"> : </a></label>
                      <div class="col-sm-3">
                        <input type="date" class="form-control float-right tenortempo" name="postTransTempo" id="inputTransTempo" value="" required="" disabled>
                      </div>
                    </div>

                  <!-- Form Submit Button -->
                  <div class="float-right">
                    <button type="reset" class="btn btn-secondary"><b> Reset </b></button>
                    <button type="submit" class="btn btn-success"><b> Simpan </b></button>
                  </div>

                </form>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->