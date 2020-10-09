function confirmDelete(item, getid, url, msg){
	event.preventDefault();
	
	switch(item){
		case "ctgr":
			var warningMsg = "Penghapusan data bersifat permanen !  Menghapus data kategori akan mengubah detail data product dengan kategori ini !"
			var cancelMsg  = "Batal menghapus data kategori !";
			break;
		case "unit":
			var warningMsg = "Penghapusan data bersifat permanen ! Menghapus data kategori akan mengubah detail data product dengan satuan ini !"
			var cancelMsg  = "Batal menghapus data satuan !";
			break;
		default :
			var warningMsg = msg;
			var cancelMsg  = "Batal menghapus data !";
	}

    /* Custom tombol sweetalert 2 */
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    /* Fire sweetAlert untuk konfirmasi */
    swalWithBootstrapButtons.fire({
        title: 'ANDA YAKIN MENGHAPUS DATA ?',
        text: warningMsg,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Data !',
        cancelButtonText: 'Tidak, Batalkan !',
        reverseButtons: true
    }).then((result) => {
        /* jika klik tombol confirm, kirim data id via ajax */
        if (result.value){
            $.ajax({
                type: 'POST',
                url: url,
                data: {"postID":getid},
                proccesData: false,
                /* jika ajax sukses mengirim data */
                success: function(data){
                    /* jika hasil return function delete success */
                    if(data==='successDelete'){
                        Swal.fire({
                            position: 'center',
                            showConfirmButton: true,
                            timer: 1500,
                            icon: 'success',
                            title: 'Data berhasil dihapus !'
                        }).then((result)=>{
                            location.reload();
                        })
                    } else if (data==='failedDelete') {
                        Swal.fire({
                            position: 'center',
                            showConfirmButton: true,
                            timer: 1500,
                            icon: 'error',
                            title: 'Data gagal dihapus !'
                        }).then((result)=>{
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            showConfirmButton: true,
                            timer: 150000,
                            icon: 'error',
                            //title: 'Terjadi Kesalahan pada sistem. Silahkan coba beberapa saat lagi !'
                            title: data
                        }).then((result)=>{
                            location.reload();
                        })
                    }
                },
                /* Jika ajax gagal mengirim data */
                error: function (data) {
                    Swal.fire({
                        posisiton: 'center',
                        showConfirmButton: true,
                        timer: 1500,
                        icon: 'error',
                        title: data
                    }).then((result)=>{
                        location.reload();
                    })
                }
            })
        /* Jika klik tombol batal */
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Dibatalkan',
                cancelMsg,
                'warning'
            )
        }
    })

}