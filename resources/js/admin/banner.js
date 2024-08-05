var count_image = 1;
$('#addImage').click(function () {
    count_image = count_image + 1;
    $('#form_banner_images').append(`
         <div class="d-flex flex-row align-items-end w-100 item_image">
                <div class="flex-grow-1">
                    <label for="image">Image ${count_image}</label>
                    <input type="file" name="image[]" class="form-control">
                </div>
                <span class="btn btn-danger ms-2 remove_image_btn">Drop</span>
        </div>
    `);
    updateImageLabels();
})
$(document).on('click', '.remove_image_btn', function () {
    $(this).closest('.item_image').remove();
    updateImageLabels();
})

$('#addImageDone').click(function () {
    document.getElementById('form_banner_images').submit();
})

function updateImageLabels() {
    $('.item_image').each(function (index) {
        $(this).find('label').text('Image ' + (index + 1));
    });
}