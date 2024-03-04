<div class="thanhtoan">
    <div class="link">GIỎ HÀNG > CHI TIẾT THANH TOÁN > HOÀN THÀNH</div>
    <div class="add_voucher">
        <p>Bạn có mã ưu đãi ? Ấn vào đây để nhập mã </p>
        <div class="ip_add_voucher">
            <p>Nếu bạn có mã giảm giá, vui lòng điền vào phía bên dưới.</p>
            <form action="index.php?act=thanhtoan" method="post">
                <input type="text" name="voucher" id="" placeholder="Mã giảm giá">
                <input type="submit" name="add_voucher" value="ÁP DỤNG">
            </form>

        </div>
    </div>
    <div class="tt_thanhtoan">
        <form action="index.php?act=thanhtoan" method="post">
            <div class="tt_user">
                <h2>THÔNG TIN THANH TOÁN</h2>
                <input type="text" hidden name="iduser" value="<?= $_SESSION['iduser'] ?>">
                <label for="">Họ và tên*</label>
                <input type="text" required name="name" placeholder="Họ tên của bạn...">

                <div class="ip_bottom">
                    <div class="ip_in_bottom">
                        <label for="">Số điện thoại*</label>
                        <input type="number" required name="phone" placeholder="Số điện thoại của bạn">
                    </div>
                    <div class="ip_in_bottom">
                        <label for="">Địa chỉ email (không bắt buộc)*</label>
                        <input type="text" required name="email" placeholder="Email của bạn">
                    </div>
                    <!-- <div class="ip_in_bottom">
                        <select name="" id="province">
                        </select>

                        <select name="" id="district">
                            <option  value="">chọn quận</option>
                        </select>

                        <select name="" id="ward">
                            <option   value="">chọn phường</option>
                        </select>
                        
                    </div> -->
                    <input type="text" hidden name="diachi" id="result">
                    <div class="ip_in_bottom">
                        <label for="">Tỉnh/Thành phố *</label>
                        <select name="" required id="province">
                            <option value="">Chọn tỉnh</option>
                            <option value="">Hà Nội</option>
                        </select>
                    </div>
                    <div class="ip_in_bottom">
                        <label for="">Quận/Huyện *</label>
                        <select name="" required id="district">
                            <option value="">Chọn quận</option>
                            <option value="">Hà Đông</option>
                        </select>
                    </div>
                    <div class="ip_in_bottom">
                        <label for="">Xã/Phường *</label>
                        <select name="" required id="ward">
                            <option value="">Chọn phường</option>
                            <option value="">Phú Nghĩa</option>
                        </select>
                    </div>
                    <div class="ip_in_bottom">
                        <label for="">Địa chỉ*</label>
                        <input type="text" required name="dchi">
                    </div>
                </div>
                <label for="">Ghi chú đơn hàng (không bắt buộc)</label>
                <textarea name="note" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="tt_donhang">
                <h2>ĐƠN HÀNG CỦA BẠN</h2>
                <div class="space">
                    <h3>Sản phẩm</h3>
                    <h3>Tạm tính</h3>
                </div>
                <?php
                if (is_array($ds_sp_thanhtoan)) {
                    extract($ds_sp_thanhtoan);
                }
                $i = 0;
                $tong = 0;
                foreach ($count_sp_add as $count_sp) {
                    // echo "<pre>";
                    // print_r($count_sp);
                    $i += $count_sp['so_sp'];
                }
                // $_SESSION['so_sp_giohang'] = $so_sp = $i;
                // echo $so_sp;
                // echo $i.'<br>';
                for ($j = 0; $j < $i; $j++) {
                    // echo $ds_sp_thanhtoan[$j]['id_bienthe'];
                    echo '<input type="text" hidden name="id_bienthe' . $j . '" value="' . $ds_sp_thanhtoan[$j]['id_bienthe'] . '">';
                    echo '<input type="text" hidden name="so_luong' . $j . '" value="' . $ds_sp_thanhtoan[$j]['so_luong'] . '">';
                    echo '<input type="text" hidden name="price_sale' . $j . '" value="' . $ds_sp_thanhtoan[$j]['price_sale'] . '">';
                    echo '<input type="text" hidden name="ten_sp' . $j . '" value="' . $ds_sp_thanhtoan[$j]['ten_sp'] . '">';

                    echo '
                    <div class="space">
                        <p>' . $ds_sp_thanhtoan[$j]['ten_sp'] . ', ' . $ds_sp_thanhtoan[$j]['mau_sac'] . ', ' . $ds_sp_thanhtoan[$j]['kich_thuoc'] . ' x ' . $ds_sp_thanhtoan[$j]['so_luong'] . '</p>
                        <span>' . number_format($ds_sp_thanhtoan[$j]['price_sale'] * $ds_sp_thanhtoan[$j]['so_luong']) . 'đ</span>
                    </div>
                    ';
                    $tong += $ds_sp_thanhtoan[$j]['price_sale'] * $ds_sp_thanhtoan[$j]['so_luong'];
                    // $tong+= 25000; 
                }

                // echo $id_bienthe;
                ?>
                <input type="text" hidden name="tong" value="<?= $tong + 25000 ?>">
                <div class="space">
                    <p>Giao hàng</p>
                    <span><?php echo ($tong > 0) ? '25,000' : '0' ?>đ</span>
                </div>

                <div class="space">
                    <p>Tổng</p>
                    <span><?= number_format($tong + 25000) ?>đ</span>
                </div>
                <select name="pt_thanhtoan" id="pt_thanhtoan">
                    <option value="cod">Thanh toán khi nhận hàng</option>
                    <option value="online">Thanh toán online</option>
                </select><BR>

                <input type="submit" name="dat_hang" value="ĐẶT HÀNG">
                <!-- <input type="hidden" name="payment_method" id="payment_method" value=""> -->

            </div>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../assets/js/tinh_thanh.js"></script>