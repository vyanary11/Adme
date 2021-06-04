require('./bootstrap');

$("body").niceScroll();

$('#app').tooltip({
    selector: '[data-toggle="tooltip"]',
    trigger: "hover"
});

window.changeImageUpload = function (input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var mimeType=input.files[0].type;
        if (mimeType.includes('image/')) {
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function(e) {
                $('.container-image-upload').css('background-image', 'url(' + reader.result + ')');
            }
        }else{
            Swal.fire('Error!!',"Harus file gambar", 'error');
        }
    }
}

window.emptyState = function (title, message, status, url) {
    return ''+
    '<div class="empty-state">'+
        '<div class="empty-state-icon bg-'+status+'">'+
            '<i class="'+(status=="danger") ? 'fas fa-times' : 'fas fa-times'+'"></i>'+
        '</div>'+
        '<h2>'+title+'</h2>'+
        '<p class="lead">'+message+'</p>'+
        '<button onclick="" class="btn btn-'+status+' mt-4">Coba Lagi</button>'+
    '</div>';
}
