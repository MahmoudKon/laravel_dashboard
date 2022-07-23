function previewFile(file) {
    if (file.files && file.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            if (file.files[0].type.split("/")[0] == 'application')
                $('#show-file').attr('href', e.target.result);
            else if (file.files[0].type.split("/")[0] == 'image')
                $('#show-file').attr('src', e.target.result);
            else
                $('#show-file').attr('src', e.target.result).parent()[0].load();
        }
        reader.readAsDataURL(file.files[0]);
    } else {
        $('#show-file').attr('src', file.value).parent()[0].load();
    }
}

$('body').on('click', '.preview-modal-image', function() {
    let ele = $('#modal-view-image');
    let img = $(this);
    ele.slideUp(500, function() {
        ele.find('img').attr('src', img.attr('src')).attr('alt', img.attr('src').split('/').at(-1));
        ele.slideDown(500);
    });
});

$('#modal-view-image button[data-close], #modal-view-image').click(function (e) {
    $('#modal-view-image').slideUp(500);
});

$('#modal-view-image button[data-download]').click(function (e) {
    e.stopPropagation();
    let image = $('#modal-view-image').find('img').attr('src');
    let image_name = image.split('/').at(-1);

    var a = document.createElement("a");
    a.href = image;
    a.download = image_name;
    a.click();
    a.remove;
});
