<div class="section_policy">
    <div class="container">
        <div class="row">
            <div class="col-3 giaohang">
                <i class="fa-solid fa-truck-fast"></i>
                <div class="text">
                    <b>GIAO HÀNG MIỄN PHÍ</b>
                    <p>Với đơn trên 300.000 đ</p>
                </div>                    
            </div>
            <div class="col-3 giaohang">
            <i class="fa-brands fa-creative-commons-sampling"></i>

                <div class="text">
                    <b>HỖ TRỢ 24/7</b>
                    <p>Nhanh chóng thuận tiện</p>
                </div>                    
            </div>
            <div class="col-3 giaohang">
            <i class="fa-solid fa-box-open"></i>
                <div class="text">
                    <b>ĐỔI TRẢ 3 NGÀY</b>
                    <p>Hấp dẫn chưa từng có</p>
                </div>                    
            </div>
            <div class="col-3 giaohang">
            <i class="fa-solid fa-clipboard-list"></i>
                <div class="text">
                    <b>GIÁ TIÊU CHUẨN</b>
                    <p>Tiết kiệm 10% giá cả</p>
                </div>                    
            </div>
        </div>
    </div>
</div>
<footer class="footer ft">
        <div class="container">
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>
            <div class="row my-3 py-4  link_web ">
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <a href="#" class="logo justify-content-md-center">
                      HOME's
                  </a>
                  
                  <ul>
                    <li><b>Địa Chỉ:</b> số nhà 123, đường số 1, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ</li>
                    <li><b>Hotline:</b> 1900 6777</li>
                    <li><b>Email:</b> homes@company.vn</li>
                  </ul>
                  <h5>Liên kết mạng xã hội</h5>
                  <div class="is-divider small"></div>
                      <ul class="row ps-4 ">
                          <li class="col-2"><a href="#">
                              <i class="fa-brands fa-facebook-f"></i>
                          </a></li>
                          <li class="col-2"><a href="#">
                              <i class="fa-brands fa-instagram"></i>
                          </a></li>
                          <li class="col-2"><a href="#">
                              <i class="fa-brands fa-twitter"></i>
                          </a></li>
                      </ul>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <ul class="about_me">
                      <h5>VỀ CHÚNG TÔI</h5>
                      <div class="is-divider small"></div>
                      <li><a href="trangchu.php">Trang Chủ</a></li>
                      <li><a href="gioithieu.php">Giới Thiệu</a></li>
                      <li><a href="sanpham.php">Sản Phẩm</a></li>
                      <li><a href="tintuc.php">Tin Tức</a></li>
                      <li><a href="lienhe.php">Liên Hệ</a></li>
                      <h5>Đánh Giá</h5>
                      <div class="is-divider small"></div>
                      <li class="widget">
                          <!-- Đánh giá -->
                          <div class="rating">
                              <input type="radio" name="rate" id="rate-5">
                              <label for="rate-5"><i class="fa-solid fa-star"></i></label>
                              <input type="radio" name="rate" id="rate-4">
                              <label for="rate-4"><i class="fa-solid fa-star"></i></label>
                              <input type="radio" name="rate" id="rate-3">
                              <label for="rate-3"><i class="fa-solid fa-star"></i></label>
                              <input type="radio" name="rate" id="rate-2">
                              <label for="rate-2"><i class="fa-solid fa-star"></i></label>
                              <input type="radio" name="rate" id="rate-1">
                              <label for="rate-1"><i class="fa-solid fa-star"></i></label>
                          </div>
                      </li>
                  </ul>
              </div>
              <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                  <div>
                      <h5>THƯ GỬI</h5>
                      <div class="is-divider small"></div>
                      <p>Hãy để lại email của bạn để nhận được những ý tưởng trang trí mới và những thông tin, ưu đãi từ <b>HOME's</b></p>
                      <form class="py-1">
                          <div class="mb-3">
                              <label style="color: #fff;" for="exampleFormControlInput1" class="form-label">Họ Tên:</label>
                              <input type="text" class="form-control" style="width: fit-content;" id="exampleFormControlInput1">
                          </div>
                          <div class="mb-3">
                              <label style="color: #fff;" for="exampleFormControlInput2" class="form-label">Email:</label>
                              <input type="email" class="form-control" style="width: fit-content;" id="exampleFormControlInput2" placeholder="name@example.com">
                          </div>
                          <button type="submit" class="btn_login">Đăng Ký</button>
                      </form>
                      
                  </div>
              </div>
          </div>
        </div>
    </footer>

   <!-- dropdown -->
    <script>
        $(".drop")
            .mouseover(function() {
            $(".dropdown_nav").show(300);
            });
            $(".drop")
            .mouseleave(function() {
            $(".dropdown_nav").hide(300);     
            });
    </script>

    <!-- drop_taikhoan -->
    <script>
        $(".drop-1")
            .mouseover(function() {
            $(".dropdown_nav-1").show(300);
            });
            $(".drop-1")
            .mouseleave(function() {
            $(".dropdown_nav-1").hide(300);     
        });
    </script>
    <!-- nut top -->
    <script>
        var mybutton = document.getElementById("myBtn");
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            mybutton.style.display = "block";
            } else {
            mybutton.style.display = "none";
            }
        }
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script> 
    <script>
        function submitFn(obj, evt){
            value = $(obj).find('.search_text').val().trim();
            if(!value.length){
                html = "Bạn chưa nhập nội dung tìm kiếm";
                $(obj).html(alert(html));
                evt.preventDefault();
            }
        }
    </script>

<script>
    $('input.input-qty').each(function() {
        var $this = $(this),
            qty = $this.parent().find('.is-form'),
            min = Number($this.attr('min')),
            max = Number($this.attr('max'))
        if (min == 0) {
            var d = 0
        } else d = min
        $(qty).on('click', function() {
            if ($(this).hasClass('minus')) {
            if (d > min) d += -1
            } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1
            if (x <= max) d += 1
            }
            $this.attr('value', d).val(d)
        })
        })
</script>

</body>
</html>