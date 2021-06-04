"use strict";

window.countData = function () {
    window.axios.get('blog/count-data/').then(function (response) {
        const data = response.data;
        document.getElementById("all").innerHTML = data.all;
        document.getElementById("draft").innerHTML = data.draft;
        document.getElementById("published").innerHTML = data.published;
        document.getElementById("archived").innerHTML =data.archived;
    })
    .catch(function (error) {
        console.log(error);
    })
}

countData();

window.filterDataTable = function (a) {
    var element = document.getElementById('filter_active');
    element.id = "";
    element.classList.remove('active');
    element.children[0].classList.remove('badge-white');
    element.children[0].classList.add('badge-primary');
    a.id = "filter_active";
    a.classList.add("active");
    a.children[0].classList.remove('badge-primary');
    a.children[0].classList.add('badge-white');
    status = $("#filter_active").attr("data-filter");
    dataTable.draw();
}

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
                const response = await window.axios.delete('blog/delete/', { data: { id: id }});
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
            countData();
            dataTable.ajax.reload(null, false);
        }
    })
}

window.actionSelected = function(value){
    if(value!=""){
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
            deleteOrUpdateSelected(id.join(","), value);
        }
    }
    $("#checkbox-all").prop('checked', false);
    $("input[name='id']:checked").prop('checked', false);
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
                    response = await window.axios.delete('blog/delete-selected/', {
                        data: {
                            id: id
                        }
                    });
                }else{
                    response = await window.axios.post('blog/update-selected/', {
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
            countData();
            dataTable.ajax.reload(null, false);
        }
    })
}
