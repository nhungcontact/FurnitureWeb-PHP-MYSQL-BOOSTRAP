function previewImg(event) {
    // Gán giá trị các file vào biến files
    var files = document.getElementById('img_file').files; 
 
    // Show khung chứa ảnh xem trước
    $('#formUpload .box-preview-img').show();
 
    // Thêm chữ "Xem trước" vào khung
    $('#formUpload .box-preview-img').html('<p>Xem trước</p>');
 
    // Dùng vòng lặp for để thêm các thẻ img vào khung chứa ảnh xem trước
    for (i = 0; i < files.length; i++)
    {
        // Thêm thẻ img theo i
        $('#formUpload .box-preview-img').append('<img src="" id="' + i +'">');
 
        // Thêm src vào mỗi thẻ img theo id = i
        $('#formUpload .box-preview-img img:eq('+i+')').attr('src', URL.createObjectURL(event.target.files[i]));
    }   
}