$("body").on("change", "#owner_image", function (e) {
    var file_name = (e.target.files.length > 0) ? e.target.files[0].name : 'Upload Owner Image';
    $(this).next(".custom-file-label").html(file_name);
    file_name = null;
});

$("body").on("change", "#logo", function (e) {
    var file_name = (e.target.files.length > 0) ? e.target.files[0].name : 'Upload Salon Logo';
    $(this).next(".custom-file-label").html(file_name);
    file_name = null;
})

$("body").on("change", "#banner", function (e) {
    var file_name = (e.target.files.length > 0) ? e.target.files[0].name : 'Upload Salon Banner';
    $(this).next(".custom-file-label").html(file_name);
    file_name = null;
})
