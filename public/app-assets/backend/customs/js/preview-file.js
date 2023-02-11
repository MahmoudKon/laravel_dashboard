function previewFile(file) {
    let targetEle = $('#show-file');
    let reader = new FileReader();
    targetEle.closest('#file-preview').addClass('load');
    if (file.files && file.files[0]) {
        reader.onload = function(e) {
            console.log(e.target);
            if (file.files[0].type.split("/")[0] == 'application')
                targetEle.attr('href', e.target.result);
            else if (file.files[0].type.split("/")[0] == 'image')
                targetEle.attr('src', e.target.result);
            else
                targetEle.attr('src', e.target.result).parent()[0].load();
        }
        reader.readAsDataURL(file.files[0]);
    } else {
        targetEle.attr('src', file.value).parent()[0].load();
    }

    reader.onloadend = function(e) {
        targetEle.closest('#file-preview').removeClass('load');
    }
}

$('body').on('click', '.preview-modal-image', function() {
    let ele = $('#modal-view-image');
    let img = $(this);
    ele.modal('show');
    ele.find('.modal-body').slideDown(500);
    ele.find('.modal-body').css('background-image', `url('${img.attr('src')}')`).find('img').attr('src', img.attr('src')).attr('alt', img.attr('src').split('/').at(-1));;
});

$('#modal-view-image button[data-close]').click(function (e) {
    $('#modal-view-image').find('.modal-body').slideUp(500, function() { $('#modal-view-image').modal('hide'); });
});

$('#modal-view-image').on('hide.bs.modal', function() {
    $(this).find('.modal-body').slideUp(500);
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
