<?php
defined('BASEPATH') OR exit('No direct script access allowed !');

Class Product_m extends CI_Model {

  /* Declare Table */
   /* Table Product */
	var $prd_tb = 'tb_product';
	var $prd_f  = array(
		'0' => 'prd_id',
		'1' => 'prd_kode',
		'2' => 'prd_nama',
		'3' => 'prd_kategori_id_fk',
		'4' => 'prd_harga_beli',
		'5' => 'prd_harga_jual',
		'6' => 'prd_satuan_id_fk',
		'7' => 'prd_isi_per_satuan',
		'8' => 'prd_deskripsi'
	);

   /* Table Kategori */
    var $kat_tb = 'tb_kategori';
    var $kat_f  = array(
   		'0' => 'ktgr_id',
   		'1' => 'ktgr_nama'
    );

   /* Table Satuan */
    var $sat_tb = 'tb_satuan';
    var $sat_f  = array(
   		'0' => 'satuan_id',
   		'1' => 'satuan_nama'
    );

  /* Function CRUD Product */
    /* Query next Increment Product */
    function getNextIncrement(){
        $this->db->select('AUTO_INCREMENT');
        $this->db->from('information_schema.TABLES');
        $this->db->where('TABLE_SCHEMA', $this->db->database);
        $this->db->where('TABLE_NAME', $this->prd_tb);
      $returnValue = $this->db->get();
      return $returnValue->result_array();
    }

    /* Query insert product */
    function insertProduct($data){
      $resultInsert = $this->db->insert($this->prd_tb, $data);
      return $resultInsert;
    }

    /* Query select semua data product */
    function getAllProduct(){
      $this->db->select('prd.*, kat.'.$this->kat_f[1].', sat.'.$this->sat_f[1]);
      $this->db->from($this->prd_tb.' as prd');
      $this->db->join($this->kat_tb.' as kat', 'kat.'.$this->kat_f[0].'=prd.'.$this->prd_f[3]);
      $this->db->join($this->sat_tb.' as sat', 'sat.'.$this->sat_f[0].'=prd.'.$this->prd_f[6]);
      $this->db->order_by($this->prd_f[0], 'ASC');
      $resultSelect = $this->db->get();
      return $resultSelect->result_array();
    }

    /* Query select 1 data product berdasar product id */
    function getProductOnID($id){
      $this->db->where($this->prd_f[0], $id);
      $resultSelect = $this->db->get($this->prd_tb);
      return $resultSelect->result_array();
    }

    /* Query update data product */
    function updateProduct($id, $data){
      $this->db->set($data);
      $this->db->where($this->prd_f[0], $id);
      $resultUpdate = $this->db->update($this->prd_tb);
      return $resultUpdate;
    }

  /* Function CRUD Kategori */
   /* Function : Insert Kategori */
  	function insertKategori($data){
  		$resultInsert = $this->db->insert($this->kat_tb, $data);
  		return $resultInsert;
  	}

   /* Function : Select semua kategori, dan sort berdasar ktgr_nama */
    function getKategori(){
      $this->db->order_by($this->kat_f[1], 'ASC');
      $resultInsert = $this->db->get($this->kat_tb);
      return $resultInsert->result_array();
    }

   /* Function : Update Kategori */
    function updateKategori($data){
      $this->db->set($this->kat_f[1], $data['ktgr_nama']);
      $this->db->where($this->kat_f[0], $data['ktgr_id']);
      $resultUpdate = $this->db->update($this->kat_tb);
      return $resultUpdate;
    }

  /* Function CRUD Satuan */
   /* Function : Insert Satuan */
  	function insertSatuan($data){
  		$resultInsert = $this->db->insert($this->sat_tb, $data);
  		return $resultInsert;
  	}

   /* Function : Select semua Satuan, dan sort berdasar sat_nama */
  	function getSatuan(){
  		$this->db->order_by($this->sat_f[1], 'ASC');
  		$resultInsert = $this->db->get($this->sat_tb);
  		return $resultInsert->result_array();
  	}

   /* Function : Update Satuan */
    function updateSatuan($data){
      $this->db->set($this->sat_f[1], $data['satuan_nama']);
      $this->db->where($this->sat_f[0], $data['satuan_id']);
      $resultUpdate = $this->db->update($this->sat_tb);
      return $resultUpdate;
    }
}