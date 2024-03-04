<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách tài khoản</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-secondary btn-sm">Chọn tất cả</button>
            <button class="btn btn-secondary btn-sm">Bỏ chọn tất cả</button>
            <button class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
            <a href="?act=addnguoidung"><button class="btn btn-secondary btn-sm">Nhập thêm</button></a>
            <form action="" class="float-right">
                <div class="input-group">
                    <input type="text" class="form-control" name="kyw" placeholder="Tìm kiếm...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="search">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                    
                            <th>STT</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Vai trò</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ds_nguoidung as $key => $value) :
                            extract($value);
                            
                        ?>
                    
                            <tr>
                       
                                <td class="align-middle text-center td_id"><?= $key + 1; ?> </td>
                               
                                <td class="col-1 align-middle"><?= $user ?></td>
                                <td class="fullname col-1 align-middle" style="width:100px"><?= $fullname ?></td>
                                <td class="col-1 align-middle"><?= $email ?></td>
                                <td class="col-1 align-middle"><?= $address ?></td>
                                <td class="col-1 align-middle"><?= $tel ?></td>
                                <td class="col-2 align-middle"><?php  
                                    if($role == "1") {
                                        echo "Admin";
                                    }else {
                                        echo "Khách hàng";
                                    }
                                ?></td>
                                <td class="col-2 align-middle text-center"><a href="?act=editnguoidung&idkh=<?php echo $id ?>"><button class="btn btn-secondary btn-sm">Sửa</button></a> |
                                    <a  onclick="confirmDelete('<?php echo $id ?>')"><button class="btn btn-secondary btn-sm">Xóa</button></a>
                                </td>
                            </tr>
                          

                        <?php endforeach; ?>
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function confirmDelete(id) {
        let ok = confirm('Bạn chắc chắc muốn xóa chứ ?');
        if (ok) {
            window.location.href = "?act=deletekh&idkh=" + id;  
        }

    }
</script>