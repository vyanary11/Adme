"use strict";

const formModal = $('#form-modal');
const formModalTittle = $('#form-modalLabel');
const form = $('#form');
const buttonSubmit = $('button[type="submit"]');

window.deleteData = function (id, name) {
    Swal.fire({
        allowEnterKey:true,
        title: 'Apakah anda yakin ingin menghapus ?',
        text: "Akan menghapus data "+name+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak',
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            try {
                const response = await window.axios.delete('footer-link/delete/', { data: { id: id }});
                if (response.statusText!="OK") {
                    throw new Error(response.statusText);
                }
                return await response;
            } catch (error) {
                Swal.showValidationMessage(
                    `Error: ${error}`
                );
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Berhasil!',
                'Data '+name+' telah dihapus!',
                'success'
            );
            dataTable.ajax.reload(null, false);
        }
    })
}

// MODAL
$('.loading-modal').hide();

formModal.on('hidden.bs.modal', function (event) {
    clearFormModal();
    formModalTittle.html('Tambah Fitur');
    form.attr('action','/admin/footer-link/store');
    buttonSubmit.attr('disabled',false);
    buttonSubmit.text('Simpan');
    $('.loading-modal').hide();
    $('.content-modal').show();
});

window.clearFormModal = function () {
    form.get(0).reset()
    form.removeClass('was-validated');
    $('.is-invalid').removeClass("is-invalid");
}

window.editFormModal = function (id) {
    form.attr('action','/admin/footer-link/update/'+id);
    formModalTittle.html('Edit Fitur');
    buttonSubmit.text('Perbarui');
    formModal.modal('show');
    buttonSubmit.attr('disabled',true);
    $('.loading-modal').show();
    $('.content-modal').hide();
    window.axios.get('footer-link/update/'+id).then(function (response) {
        $('.loading-modal').hide();
        $('.content-modal').show();
        buttonSubmit.attr('disabled',false);
        const data = response.data;

        $('input[name="name"]').val(data.name);
    }).catch(function (error) {
        console.log(error.message);
    });
}

form.submit(function (event) {
    event.preventDefault();
    buttonSubmit.attr('disabled',true);
    $('.loading-modal').show();
    $('.content-modal').hide();
    var bodyFormData = new FormData(this);
    window.axios.post($(this).attr('action'), bodyFormData).then(function (response) {
        const data = response.data;
        formModal.modal('hide');
        if(buttonSubmit.text()=="Simpan"){
            dataTable.order( [ 1, 'desc' ] ).draw();
        }else{
            dataTable.ajax.reload(null, false);
        }
        Swal.fire('Berhasil',data.message,'success');
    }).catch(function (error) {
        const data = error.response
        buttonSubmit.attr('disabled',false);
        $('.loading-modal').hide();
        $('.content-modal').show();
        if(data.status!=422){
            Swal.fire('Error',error.message,'error');
        }else{
            for (const [key, value] of Object.entries(data.data.errors)) {
                $("[name='"+key+"']").closest(".form-group").find(".invalid-feedback").text(value);
                $("[name='"+key+"']").addClass("is-invalid");
            }
        }
    });
})
