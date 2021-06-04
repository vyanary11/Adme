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
                const response = await window.axios.delete('fitur/delete/', { data: { id: id }});
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

$('#action-selected').on('change', function() {
    const value = this.value;
    if(this.value!=""){
        var id = [];
        $.each($("input[name='id']:checked"), function(){
            id.push($(this).val());
        });
        if (id.length==0) {
            Swal.fire(
                'Error!',
                'Pilih setidaknya satu data!',
                'error'
            );
        } else {
            deleteOrUpdateSelected(id.join(","), this.value);
        }
    }
    $(this).prop('selectedIndex', 0).selectric('refresh');
    $("#checkbox-all").prop('checked', false);
    $("input[name='id']:checked").prop('checked', false);
});

window.deleteOrUpdateSelected = function(id, value){
    Swal.fire({
        allowEnterKey:true,
        title: 'Apakah anda yakin ?',
        text: "Data yang dipilih akan dirubah ke "+value+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Tidak',
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            try {
                var response = null;
                if(value=="delete"){
                    response = await window.axios.delete('fitur/delete-selected/', {
                        data: {
                            id: id
                        }
                    });
                }else{
                    response = await window.axios.post('fitur/update-selected/', {
                        id: id,
                        status : value
                    });
                }
                if (response.statusText!="OK") {
                    throw new Error(response.statusText);
                }
                return await response;
            } catch (error) {
                Swal.showValidationMessage(
                    `Gagal: ${error}`
                );
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            if(value=="delete"){
                Swal.fire(
                    'Berhasil!',
                    'Data telah dihapus!',
                    'success'
                );
            }else{
                Swal.fire(
                    'Berhasil!',
                    'Data telah diubah!',
                    'success'
                );
            }
            dataTable.ajax.reload(null, false);
        }
    })
}


// MODAL
$('.loading-modal').hide();

formModal.on('hidden.bs.modal', function (event) {
    clearFormModal();
    formModalTittle.html('Tambah Fitur');
    form.attr('action','/admin/fitur/store');
    buttonSubmit.attr('disabled',false);
    buttonSubmit.text('Simpan');
    $('.loading-modal').hide();
    $('.content-modal').show();
});

window.clearFormModal = function () {
    form.trigger('reset');
    form.removeClass('was-validated');
    $('.is-invalid').removeClass("is-invalid");
}

window.editFormModal = function (id) {
    form.attr('action','/admin/fitur/update/'+id);
    formModalTittle.html('Edit Fitur');
    buttonSubmit.text('Perbarui');
    formModal.modal('show');
    buttonSubmit.attr('disabled',true);
    $('.loading-modal').show();
    $('.content-modal').hide();
    window.axios.get('fitur/update/'+id).then(function (response) {
        $('.loading-modal').hide();
        $('.content-modal').show();
        buttonSubmit.attr('disabled',false);
        const data = response.data;

        $('input[name="icon"]').val(data.icon);
        $('input[name="name"]').val(data.name);
        $('textarea[name="description"]').val(data.description);
    }).catch(function (error) {
        console.log(error);
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
        console.log(error);
        buttonSubmit.attr('disabled',false);
        $('.loading-modal').hide();
        $('.content-modal').show();
        if(data.status!=422){
            Swal.fire('Error',error.message,'error');
        }else{
            for (const [key, value] of Object.entries(data.data.errors)) {
                $("[name='"+key+"']").closest(".form-group").find(".invalid-feedback").text(value);
            }
        }
    });
})
