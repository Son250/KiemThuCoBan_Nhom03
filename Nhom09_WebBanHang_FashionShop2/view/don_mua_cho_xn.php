<div class="content">
    <div class="title_cart" align='center'>
        <h3>ĐƠN HÀNG CỦA TÔI</h3>
    </div>
    <div class="nav_donmua">
        <ul>
            <li><a href="index.php?act=ct_donhang&iduser=<?=$_SESSION['iduser']?>">Tất cả</a></li>
            <li><a href="index.php?act=ct_donhang_cho_xn&iduser=<?=$_SESSION['iduser']?>">Chờ xác nhận</a></li>
            <li><a href="">Đã xác nhận</a></li>
            <li><a href="">Đang giao hàng</a></li>
            <li><a href="">Hoàn thành</a></li>
            <li><a href="">Đã hủy</a></li>
            <li><a href="">Trả hàng/Hoàn tiền</a></li>
        </ul>
    </div>
    <?php
        foreach($ct_donhang as $ct){
            extract($ct);
            echo '
            <div class="product_donmua">
        <div class="trang_thai">
            <ul>
                <li><a href="">Fashion Shop</a></li>
                <li><a href="">Trạng thái: <span>'.$status.' <i class="fa-regular fa-face-smile-beam"></i></span></a></li>
            </ul>
        </div>
        <hr>
        <div class="product_mua">
            <div class="_prod">
                <div class="img_prod">
                    <img src="../upload/'.$img.'" alt="">
                </div>
                <div class="name_prod">
                    <p class="name">'.$tensp.'</p>
                    <p class="phan_loai">Phân loại hàng: '.$mau_sac.', Size '.$kich_thuoc.'</p>
                    <p class="so_luong">x'.$so_luong.'</p>
                </div>
            </div>

            <div class="price_prod">
                <p class="price"><span>'.number_format($price_niemyet).'đ</span> <span>'.number_format($gia).'đ</span></p>
            </div>
        </div>

        <div class="thanh_tien">
            <p>Thành tiền: <span>'.number_format($so_luong*$gia).'đ</span></p>
        </div>
    </div>
            ';
        }
    ?>
    <!-- <div class="product_donmua">
        <div class='trang_thai'>
            <ul>
                <li><a href="">Fashion Shop</a></li>
                <li><a href="">Trạng thái: <span>HOÀN THÀNH <i class="fa-regular fa-face-smile-beam"></i></span></a></li>
            </ul>
        </div>
        <hr>
        <div class="product_mua">
            <div class="_prod">
                <div class="img_prod">
                    <img src="../assets/img/Áo Khoác Gió NEWSEVEN Racing Wind Breaker AK.165 3.jpg" alt="">
                </div>
                <div class='name_prod'>
                    <p class='name'>Áo Khoác Gió NEWSEVEN Racing Wind Breaker AK.165</p>
                    <p class='phan_loai'>Phân loại hàng: Màu đen, Size L</p>
                    <p class='so_luong'>x1</p>
                </div>
            </div>

            <div class="price_prod">
                <p class="price"><span>389.000đ</span> <span>175.000đ</span></p>
            </div>
        </div>

        <div class="thanh_tien">
            <p>Thành tiền: <span>200.000đ</span></p>
        </div>
    </div>

    <div class="product_donmua">
        <div class='trang_thai'>
            <ul>
                <li><a href="">Fashion Shop</a></li>
                <li><a href="">Trạng thái: <span>HOÀN THÀNH <i class="fa-regular fa-face-smile-beam"></i></span></a></li>
            </ul>
        </div>
        <hr>
        <div class="product_mua">
            <div class="_prod">
                <div class="img_prod">
                    <img src="../assets/img/Quần Short Basic NEWSEVEN.jpeg" alt="">
                </div>
                <div class='name_prod'>
                    <p class='name'>Quần Short Basic NEWSEVEN</p>
                    <p class='phan_loai'>Phân loại hàng: Màu đen, Size L</p>
                    <p class='so_luong'>x1</p>
                </div>
            </div>

            <div class="price_prod">
                <p class="price"><span>389.000đ</span> <span>175.000đ</span></p>
            </div>
        </div>

        <div class="thanh_tien">
            <p>Thành tiền: <span>200.000đ</span></p>
        </div>
    </div> -->


</div>