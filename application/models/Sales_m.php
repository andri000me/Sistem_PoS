<?php
defined('BASEPATH') OR exit('No direct script access allowed !');

Class Sales_m extends CI_Model{

  /* Declare Table Trans Penjualan */
	var $ts_tb = 'trans_sales';
	var $ts_f  = array(
		'0' => 'ts_id',
		'1' => 'ts_trans_code',
		'2' => 'ts_date',
		'3' => 'ts_payment_metode',
		'4' => 'ts_sales_price',
		'5' => 'ts_account_fk',
		'6' => 'ts_paid',
		'7' => 'ts_insufficient',
		'8' => 'ts_status',
		'9' => 'ts_tenor',
		'10' => 'ts_tenor_periode',
		'11' => 'ts_due_date'
	);

  /* Declare table Detail Trans Penjualan */
	var $dts_tb = 'det_trans_sales';
	var $dts_f  = array(
		'0' => 'dts_id',
		'1' => 'dts_ts_fk',
		'2' => 'dts_product_fk',
		'3' => 'dts_product_amount',
		'4' => 'dts_sale_price',
		'5' => 'dts_discount',
		'6' => 'dts_total_price'
	);

  /* Declare table temp / keranjang trans penjualan */
	var $temp_ts = 'temp_sales';
	var $temp_f  = array(
		'0' => 'temps_id',
		'1' => 'temps_product_fk',
		'2' => 'temps_product_amount',
		'3' => 'temps_sale_price',
		'4' => 'temps_discount',
		'5' => 'temps_total_paid'
	);

  /* Start Query table trans sales */
  	/* Query get next autoincrement table transaksi */
  	function getNextIncrement(){
  		$this->db->select('AUTO_INCREMENT');
  		$this->db->from('information_schema.TABLES');
  		$this->db->where('TABLE_SCHEMA', $this->db->database);
  		$this->db->where('TABLE_NAME', $this->ts_tb);
  		$resultAI = $this->db->get();
  		return $resultAI->result_array();
  	}

  /* Start Query Table Temp Trans Purchase */
    /* Query insert table temp product pembelian */
    function insertTemp($data){
      $insertData = array(
        $this->temp_f[1] => $data['post_product_id'],
        $this->temp_f[2] => $data['post_product_jumlah'],
        $this->temp_f[3] => $data['post_harga_satuan'],
        $this->temp_f[4] => $data['post_potongan'],
        $this->temp_f[5] => $data['post_total_bayar']
      );

      $resultInsert = $this->db->insert($this->temp_ts, $insertData);
      return $resultInsert;
    }

    /* Query get temp product pembelian */
    function getTemp(){
      $this->db->select($this->temp_ts.'.*, tb_product.prd_nama');
      $this->db->from($this->temp_ts);
      $this->db->join('tb_product', 'tb_product.prd_id = '.$this->temp_ts.'.'.$this->temp_f[1]);
      $resultSelect = $this->db->get();
      return $resultSelect->result_array();
    }

    /* Query Truncate / Hapus semua data di table temp */
    function truncateTemp(){
      $resultTruncate = $this->db->truncate($this->temp_ts);
      return $resultTruncate;
    }
}