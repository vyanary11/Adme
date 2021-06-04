"use strict";

window.readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.img-thumbnail')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
