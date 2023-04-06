<?php
require_once '../../partials/mysqli_connect.php';
include('./function.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>ADMIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/phantrang.css" rel="stylesheet">

    <style>
    a{
      text-decoration: none;
    }
    </style>

  </head>
<body class="w3-light-grey">
<?php include './sidebar.php' ?>

<?php 
    if(isset($_GET['page_layout'])){
        switch ($_GET['page_layout']){
            case 'tonghop':
                require_once './tonghop.php';
                break;
            case 'sanpham':
                require_once './sanpham/danhsach.php';
                break;
            case 'them':
                require_once './sanpham/them.php';
                break;
            case 'sua':
                require_once './sanpham/sua.php';
                break;
            case 'xoaanh':
              require_once './sanpham/xoaanh.php';
              break;
            case 'xoa':
                require_once './xoa.php';
                break;
            case 'mausac':
              require_once './sanpham/mausac/danhsach.php';
              break;
            case 'themmau':
              require_once './sanpham/mausac/them.php';
              break;
            case 'xoamau':
              require_once './sanpham/mausac/xoa.php';
              break;
            case 'danhmuc':
              require_once './danhmuc/danhsach.php';
              break;
            case 'themloai':
                require_once './danhmuc/them.php';
                break;
            case 'sualoai':
                require_once './danhmuc/sua.php';
                break;
            case 'xoaloai':
                require_once './danhmuc/xoa.php';
                break;
            case 'donhang':
                require_once './donhang/danhsach.php';
                break;
            case 'xemchitiet':
                require_once './donhang/xemchitiet.php';
                break;
            case 'khachhang':
                require_once './khachhang/danhsach.php';
                break;
            case 'nguoidung':
                require_once './nguoidung/danhsach.php';
                break;
            // case 'lienhe':
            //   require_once './lienhe_admin.php';
            //   break;
            case 'tintuc':
              require_once './tintuc/danhsach.php';
              break;
            case 'themtintuc':
              require_once './tintuc/them.php';
              break;
            case 'suatt':
              require_once './tintuc/sua.php';
              break;
            case 'binhluan':
              require_once './binhluan/danhsach.php';
              break;
            case 'suabinhluan':
              require_once './binhluan/sua.php';
              break;
            default:
                require_once './tonghop.php';
                break;
        }
    }else{
        require_once './tonghop.php';
    }
    ?>
    <hr>
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by Admin</a></p>
  </footer>

  <!-- End page content -->
</div>
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <!-- Boostrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- <script>
      
      function formatState (state) {
        if (!state.id) {
          return state.text;
        }
        var baseUrl = "hinh/mausac";
        var $state = $(
          '<span><img class="img-flag" /> <span></span></span>'
        );

        // Use .text() instead of HTML string concatenation to avoid script injection issues
        $state.find("span").text(state.text);
        $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".jpg");

        return $state;
      };

      $(document).ready(function() {
          $('.js-example-basic-multiple').select2({
            templateResult: formatState
          });
      });
  </script> -->

<script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  var y = document.getElementById("btnArrow");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    y.className = "fa-solid fa-chevron-down";
  } else {
    x.className = x.className.replace(" w3-show", "");
    y.className = y.className.replace("fa-solid fa-chevron-down", "fa-solid fa-chevron-left")
  }
}
document.getElementById("myBtn").click();

// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
</body>
</html>
