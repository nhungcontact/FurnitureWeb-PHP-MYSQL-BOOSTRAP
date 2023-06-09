// Xử lý ảnh và upload
$('#formUpload .btn-submit').on('click', function() {
    // Gán giá trị của nút chọn tệp vào var img_file
    $img_file = $('#formUpload #img_file').val();
 
    // Cắt đuôi của file để kiểm tra
    $type_img_file = $('#formUpload #img_file').val().split('.').pop().toLowerCase();
 
    // Nếu không có ảnh nào
    if ($img_file == '')
    {
        // Show khung kết quả
        $('#formUpload .output').show();
 
        // Thông báo lỗi
        $('#formUpload .output').html('Vui lòng chọn ít nhất một file ảnh.');
    }
    // Ngược lại nếu file ảnh không hợp lệ với các đuôi bên dưới
    else if ($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1)
    {
        // Show khung kết quả
        $('#formUpload .output').show();
 
        // Thông báo lỗi
        $('#formUpload .output').html('File ảnh không hợp lệ với các đuôi .png, .jpeg, .jpg, .gif.');
    }
    // Ngược lại
    else
    {
        // Tiến hành upload 
        $('#formUpload').ajaxSubmit({ 
            // Trước khi upload
            beforeSubmit: function() {
                target:   '#formUpload .output',
 
                // Ẩn khung kết quả
                $('#formUpload .output').hide();
 
                // Show thanh tiến trình
                $("#formUpload .progress").show();
 
                // Đặt mặc định độ dài thanh tiến trình là 0
                $("#formUpload .progress-bar").width('0');
            },
 
            // Trong quá trình upload
            uploadProgress: function(event, position, total, percentComplete){ 
                // Kéo dãn độ dài thanh tiến trình theo % tiến độ upload
                $("#formUpload .progress-bar").css('width', percentComplete + '%');
 
                // Hiển thị con số % trên thanh tiến trình
                $("#formUpload .progress-bar").html(percentComplete + '%');
            },
            // Sau khi upload xong
            success: function() {    
                // Show khung kết quả 
                $('#formUpload .output').show();
 
                // Thêm class success vào khung kết quả
                $('#formUpload .output').addClass('success');
 
                // Thông báo thành công
                $('#formUpload .output').html('Upload ảnh thành công.');
            },
            // Nếu xảy ra lỗi
            error : function() {
                // Show khung kết quả
                $('#formUpload .output').show();
 
                // Thông báo lỗi
                $('#formUpload .output').html('Không thể upload ảnh vào lúc này, hãy thử lại sau.');
            }
        }); 
        return false; 
    }
});