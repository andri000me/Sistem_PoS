<!-- Core JS Goes here -->
	<!-- jQuery -->
	<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>

<!-- Addritional library needed -->
	<!-- DataTables -->
	<?php if(in_array('datatables',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<?php } ?>

	<!-- SweetAlert 2 -->
	<?php if(in_array('sweetalert2',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<?php } ?>

	<!-- JQuery UI -->
	<?php if(in_array('jqueryui',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.js"></script>
	<?php } ?>

	<!-- bs-custom-file-input -->
	<?php if(in_array('custominput',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
			  bsCustomFileInput.init();
			});
		</script>
	<?php } ?>


<!-- additional Page script goes here -->
	<!-- Page Kategori & Satuan -->
	<?php if(in_array('page_catunit',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/cat_unit_assets.js"></script>
	<?php } ?>	

	<!-- Page Add Product -->
	<?php if(in_array('page_add_product',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/add_prd_assets.js"></script>
	<?php } ?>	

	<!-- Page List Product -->
	<?php if(in_array('page_product',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/prd_assets.js"></script>
	<?php } ?>	

	<!-- Page Add Product -->
	<?php if(in_array('page_contact',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/contact_assets.js"></script>
	<?php } ?>	

	<!-- Page Add Trans -->
	<?php if(in_array('page_addtrans',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/addtransaction_assets.js"></script>
		<script type="text/javascript">
			autocompleteUrl = "<?php echo site_url('Product_c/autocompleteProduct') ?>";
		</script>
	<?php } ?>	

	<!-- Page Add Trans -->
	<?php if(in_array('page_add_purchase',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/add_purchase_assets.js"></script>
		<script type="text/javascript">
			autocompleteUrl = "<?php echo site_url('Product_c/autocompleteProduct') ?>";
		</script>
	<?php } ?>

	<!-- Page Add Trans -->
	<?php if(in_array('page_installment',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/add_installment_assets.js"></script>
	<?php } ?>

	<!-- Page List Trans -->
	<?php if(in_array('page_list_trans',$assets)){ ?>
		<script src="<?php echo base_url() ?>assets/dist/js/pages/list_transaction_assets.js"></script>
	<?php } ?>

	<!-- Page Konfirmasi Delete -->
	<?php if(in_array('f_confirm', $assets)){ ?>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/dist/js/pages/f_confirm.js"></script>
	<?php } ?>

	<!-- Untuk session input -->
	<?php if($this->session->flashdata('flashStatus')){ ?>
		<script type="text/javascript">
			var flashStatus = "<?php echo $this->session->flashdata('flashStatus') ;?>";
			var flashMsg = "<?php echo ($this->session->flashdata('flashMsg'))? $this->session->flashdata('flashMsg') : '' ;?>";
			<?php if($this->session->flashdata('flashInput')){ ?> // Khusus page kategori & Satuan 
				var flashInput = "<?php echo $this->session->flashdata('flashInput') ?>";
			<?php } ?>
			<?php if($this->session->flashdata('flashRedirect')){ ?> // Khusus page kategori & Satuan 
				var site_url = "<?php echo site_url($this->session->flashdata('flashRedirect')) ?>";
			<?php } ?>
		</script>
	<?php } ?>