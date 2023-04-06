// Nút reset form upload
$('#formUpload .btn-reset').on('click', function() {
    // Làm trống khung chứa hình ảnh xem trước
    $('#formUpload .box-preview-img').html('');
 
    // Hide khung chứa hình ảnh xem trước
    $('#formUpload .box-preview-img').hide();
 
    // Hide khung hiển thị kết quả
    $('#formUpload .output').hide();
});