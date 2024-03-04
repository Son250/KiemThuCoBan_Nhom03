<?php
session_start();
// $date = date('Y-m-d H:i:s');
// echo $date;
include "../model/pdo.php";
include "../model/danhmuc.php";
include "../model/sanpham.php";
include "../model/taikhoan.php";
include "../model/binhluan.php";
include "../model/cart.php";
include "../model/thanhtoan.php";
?>

<?php
include "_header.php";


?>
 <?php
    //Các biến dùng chung
    $dssp = danhsach_sanpham();
    $dsdm = danhsach_danhmuc();
    $top5 = top5_sanpham();

    //Controller
    if (isset($_GET['act']) && $_GET['act'] != "") {
        $act = $_GET['act'];
        switch ($act) {
            case 'home': {
                    include "home.php";
                    break;
                }
            case 'update_kh':
                include "login/update_kh.php";
                break;
            case "dangky":
                if (isset($_POST['dangky'])) {
                    $email = $_POST['email'];
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    insert_taikhoan($email, $user, $pass);
                    $thongbao = "Đăng ký thành công ! Vui lòng đăng nhập";
                }
                include "login/login.php";
                break;
            case "dangnhap":
                if (isset($_POST['dangnhap'])) {
                    $loginMess = dangnhap($_POST['user'], $_POST['pass']);
                    // header('location:index.php');
                }
                include "login/login.php";
                break;
            case "dangxuat":
                dangxuat();
                include "home.php";
                break;
            case "quenmk":
                if (isset($_POST['guiemail']) && ($_POST['guiemail'])) {
                    $email = $_POST['email'];
                    $checkemail = check_email($email);
                    if (is_array($checkemail)) {
                        $thongbao = "Mật khẩu của bạn là: " . $checkemail['pass'];
                    } else {
                        $thongbao = "Email này không tồn tại !";
                    }
                }
                include "login/quenmk.php";
                break;
            case 'timkiem': {
                    if (isset($_POST['timkiem'])) {
                        $keyword = $_POST['keyword'];
                        $dssp = tim_kiem_san_pham($keyword);
                    } else {
                        echo " <style>
                        .hotSale2 {
                            display: none;
                        }
                    </style>";
                    }

                    include "home.php";
                    break;
                }
            case 'timdm': {
                    if (isset($_GET['iddm']) && $_GET['iddm'] > 0) {
                        $dssp = tim_sanpham_theodm($_GET['iddm']);
                    }
                    include "home.php";
                    break;
                }
            case 'tim_b_dm': {
                    if (isset($_GET['id_b_dm']) && $_GET['id_b_dm'] > 0) {
                        $dssp = tim_sanpham_theo_big_dm($_GET['id_b_dm']);
                    }
                    include "home.php";
                    break;
                }

            case "chitietsp": {
                    if (isset($_GET['idsp']) && $_GET['idsp'] > 0) {
                        $dsbl = load_binhluan($_GET['idsp']);
                        $sanpham = one_sanpham($_GET['idsp']);
                        $hinhanh = load_anhcon($_GET['idsp']);
                        $sanpham_tt = sanpham_tuongtu($_GET['idsp']);
                        tangluotxem($_GET['idsp']);
                        $bien_the = load_id_bienthe($_GET['idsp']);
                    }
                    if (isset($_POST['btnBinhluan'])) {
                        add_binhluan($_POST['noidung'], $_POST['iduser'], $_POST['idpro'], $_POST['datetime']);
                        header("Location: ?act=chitietsp&idsp=" . $_GET['idsp']);
                    }
                    include "detail_prod.php";
                    break;
                }

            case "add_to_cart": {
                    if (isset($_POST['btnSubmit'])) {

                        $id_user = $_POST['iduser'];
                        $id_bt_sanpham = $_POST['id_bt_sanpham'];
                        $so_luong = $_POST['so_luong'];

                        $dscart = loadall_cart($_POST['iduser']);

                        add_cart($id_user, $id_bt_sanpham, $so_luong);
                    }

                    include "cart.php";
                    break;
                }

            case "delete_sp_cart": {
                    if (isset($_GET['id_cart'])) {
                        delete_cart($_GET['id_cart']);
                    }
                    $dscart = loadall_cart($_SESSION['iduser']);
                    include "cart.php";
                }

                break;
            case 'cart': {
                    if (isset($_GET['iduser']) && $_GET['iduser'] > 0) {
                        $dscart = loadall_cart($_GET['iduser']);
                    }

                    include "cart.php";
                    break;
                }
            case "bill": {
                    include "cart/bill.php";
                    break;
                }
            case "bill_confirm": {
                    if (isset($_POST['btnSubmit'])) {
                        $name = $_POST['user'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $tel = $_POST['tel'];
                        $ngayDatHang = date('Y-m-d H:i:s', strtotime('+5 hours'));

                        $_SESSION['myCart'] = [];
                    }
                    include "cart/bill_confirm.php";
                    break;
                }
            case "thanhtoan":

                // echo (isset($_COOKIE['voucher']))? $_COOKIE['voucher']:"";
                $ds_sp_thanhtoan = loadall_cart($_SESSION['iduser']);
                $count_sp_add = count_sp_add($_SESSION['iduser']);
                if (isset($_POST['dat_hang'])) {
                    $id_user = $_SESSION['iduser'];
                    $diachi = $_POST['diachi'] . ', ' . $_POST['dchi'];
                    $name = $_POST['name'];
                    $sdt = $_POST['phone'];
                    $email = $_POST['email'];
                    $note = $_POST['note'];
                    $tong_thanhtoan = $_POST['tong'];

                    $_SESSION['thongtin_dathang'] = array(
                        'diachi' => $_POST['diachi'] . ', ' . $_POST['dchi'],
                        'name' => $_POST['name'],
                        'sdt' => $_POST['phone'],
                        'email' => $_POST['email'],
                        'note' => $_POST['note'],
                        'tong_thanhtoan' => $_POST['tong']
                    );


                    if ($_POST['pt_thanhtoan'] == 'cod') {

                        insetr_donhang($id_user, $diachi, $sdt, $email, $tong_thanhtoan, $name);

                        $donhang_new = loadone_donhang_new();
                        extract($donhang_new);
                        // print_r($donhang_new);
                        // echo '<br>id don hàng vừa nhập là: ' . $id . '<br>';

                        $id_donhang = $id;

                        $i = 0;
                        foreach ($count_sp_add as $count_sp) {
                            $i += $count_sp['so_sp'];
                        }
                        // echo $i;
                        // $id_bienthe = '';
                        for ($j = 0; $j < $i; $j++) {
                            $id_bienthe[$j] = $_POST['id_bienthe' . $j];
                            $so_luong[$j] = $_POST['so_luong' . $j];
                            $price[$j] = $_POST['price_sale' . $j];
                            $ten_sp[$j] = $_POST['ten_sp' . $j];
                            // echo '<br>id biến thể:' . $id_bienthe[$j] . '<br>';
                            insert_ct_donhang($id_donhang, $id_bienthe[$j], $so_luong[$j], $price[$j], $ten_sp[$j]);
                        }
                        // echo $count_sp_add['so_sp'];
                        delete_sp_buy($id_user);
                        update_donhang_new();
                        echo $id_user . '|' . $diachi;
                    } elseif ($_POST['pt_thanhtoan'] == 'online') {


                        header("location:../assets/vnpay_php/vnpay_pay.php");
                    }
                }

                include "thanhtoan.php";
                break;
            case 'thanhtoanonline':
                $ds_sp_thanhtoan = loadall_cart($_SESSION['iduser']);
                $count_sp_add = count_sp_add($_SESSION['iduser']);
                if (isset($_POST['tieptuc'])) {
                    $id_user = $_SESSION['iduser'];
                    $diachi = $_POST['diachi'];
                    $name = $_POST['name'];
                    $sdt = $_POST['sdt'];
                    $email = $_POST['email'];
                    $note = $_POST['note'];
                    $tong_thanhtoan = $_POST['tong_thanhtoan'];

                    insetr_donhang_online($id_user, $diachi, $sdt, $email, $tong_thanhtoan, $name);

                    $donhang_new = loadone_donhang_new();
                    extract($donhang_new);
                    // print_r($donhang_new);
                    // echo '<br>id don hàng vừa nhập là: ' . $id . '<br>';

                    $id_donhang = $id;

                    $i = 0;
                    foreach ($count_sp_add as $count_sp) {
                        $i += $count_sp['so_sp'];
                    }
                    // echo $i;
                    // $id_bienthe = '';
                    for ($j = 0; $j < $i; $j++) {
                        $id_bienthe[$j] = $_POST['id_bienthe' . $j];
                        $so_luong[$j] = $_POST['so_luong' . $j];
                        $price[$j] = $_POST['price_sale' . $j];
                        $ten_sp[$j] = $_POST['ten_sp' . $j];
                        // echo '<br>id biến thể:' . $id_bienthe[$j] . '<br>';
                        insert_ct_donhang($id_donhang, $id_bienthe[$j], $so_luong[$j], $price[$j], $ten_sp[$j]);
                    }
                    // echo $count_sp_add['so_sp'];
                    delete_sp_buy($id_user);
                    update_donhang_new();
                    // echo $id_user . '|' . $diachi;
                }
                break;
            case 'mua_ngay':
                if (isset($_POST['submit'])) {
                    // echo $_POST['id_bt_sanpham_mua_ngay'];
                    $id_bt_sanpham = $_POST['id_bt_sanpham_mua_ngay'];
                    $id_user = $_SESSION['iduser'];
                    $so_luong = $_POST['so_luong_mua_ngay'];
                    $sp_mua_ngay = load_sanpham_mua_ngay($id_bt_sanpham);
                    include 'mua_ngay.php';
                }
                if (isset($_POST['dat_hang'])) {
                    $id_user = $_SESSION['iduser'];
                    $diachi = $_POST['diachi'] . ', ' . $_POST['dchi'];
                    $name = $_POST['name'];
                    $sdt = $_POST['phone'];
                    $email = $_POST['email'];
                    $note = $_POST['note'];
                    $tong_thanhtoan = $_POST['tong'];

                    $price = $_POST['price'];
                    $ten_sp = $_POST['ten_sp'];
                    $id_bt_sanpham = $_POST['id_bt_sanpham'];
                    $so_luong = $_POST['so_luong'];

                    // echo $diachi;
                    // echo $name;
                    insetr_donhang($id_user, $diachi, $sdt, $email, $tong_thanhtoan, $name);

                    $donhang_new = loadone_donhang_new();
                    extract($donhang_new);
                    // print_r($donhang_new);
                    // echo '<br>id don hàng vừa nhập là: ' . $id . '<br>';

                    $id_donhang = $id;
                    insert_ct_donhang($id_donhang, $id_bt_sanpham, $so_luong, $price, $ten_sp);
                    // echo $so_luong;
                    // $diachi = $_POST['tp'] . ', ' . $_POST['qh'] . ', ' . $_POST['xp'] . ', ' . $_POST['dchi'];
                    // $name = $_POST['name'];
                    // $sdt = $_POST['phone'];
                    // $email = $_POST['email'];
                    // $note = $_POST['note'];
                    // $tong_thanhtoan = $_POST['tong'];
                    update_donhang_new();
                    include "thanhtoan_tc.php";
                }



                break;
            case 'voucher':

                include "thanhtoan.php";
                break;
            case 'ct_donhang':
                if (isset($_GET['iduser'])) {
                    $ct_donhang = loadall_ct_donhang($_GET['iduser']);
                    // echo "<pre>";
                    // print_r($ct_donhang);
                }
                include 'don_mua.php';
                break;
            case 'ct_donhang_cho_xn':
                if (isset($_GET['iduser'])) {
                    $ct_donhang = loadall_ct_donhang_cho_xn($_GET['iduser']);
                    // echo "<pre>";
                    // print_r($ct_donhang);
                }
                include 'don_mua.php';
                break;
            case 'ct_donhang_da_xn':
                if (isset($_GET['iduser'])) {
                    $ct_donhang = loadall_ct_donhang_da_xn($_GET['iduser']);
                    // echo "<pre>";
                    // print_r($ct_donhang);
                }
                include 'don_mua.php';
                break;
            case 'ct_donhang_dang_giao':
                if (isset($_GET['iduser'])) {
                    $ct_donhang = loadall_ct_donhang_dang_giao($_GET['iduser']);
                    // echo "<pre>";
                    // print_r($ct_donhang);
                }
                include 'don_mua.php';
                break;
            case 'ct_donhang_hoan_thanh':
                if (isset($_GET['iduser'])) {
                    $ct_donhang = loadall_ct_donhang_hoan_thanh($_GET['iduser']);
                    // echo "<pre>";
                    // print_r($ct_donhang);
                }
                include 'don_mua.php';
                break;
            case 'ct_donhang_da_huy':
                if (isset($_GET['iduser'])) {
                    $ct_donhang = loadall_ct_donhang_da_huy($_GET['iduser']);
                    // echo "<pre>";
                    // print_r($ct_donhang);
                }
                include 'don_mua.php';
                break;
            case 'huy_don':
                if (isset($_GET['iddh'])) {
                    $iddh = $_GET['iddh'];
                    huy_don($iddh);
                }
                $ct_donhang = loadall_ct_donhang_cho_xn($_SESSION['iduser']);
                include 'don_mua.php';
                break;
            case 'hoan_thanh':
                if (isset($_GET['iddh'])) {
                    $iddh = $_GET['iddh'];
                    huy_don($iddh);
                }
                $ct_donhang = loadall_ct_donhang_hoan_thanh($_SESSION['iduser']);
                include 'don_mua.php';
                break;
            case 'hoanthanh_tt':


                include "thanhtoan_tc.php";
                break;


            default: {
                    include "home.php";
                    break;
                }
        }
    } else {
        include "home.php";
    }
    ?>



<?php
include "_footer.php";
?>
    
