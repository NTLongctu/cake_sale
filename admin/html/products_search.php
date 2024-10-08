<?php
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . '/admin/inc/header.php');
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/admin/inc/navbar.php");
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/database/connect.php");


if (isset($_POST['submit'])) {
    $search = $_POST['search'];
   
    $query = "SELECT a.ProductId, a.Name, a.Image, c.CategoryName, b.BrandName, a.BuyPrice,a.SellPrice, a.CountView, a.Status 
    FROM `products` a, category c, brands b 
    WHERE a.CategoriId = c.CategoryId and a.BrandId = b.BrandId and is_accept = 1  and a.Name like '%$search%'
    ORDER BY SellPrice DESC";

    $Products = mysqli_query($conn, $query);
    $total = mysqli_num_rows($Products);
    $limit = 5;
    $page = ceil($total / $limit);
    $cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
    $start = ($cr_page - 1) * $limit;

    $query2 = "SELECT a.ProductId, a.Name, a.Image, c.CategoryName, b.BrandName, a.BuyPrice,a.SellPrice, a.CountView, a.Status 
    FROM `products` a, category c, brands b 
    WHERE a.CategoriId = c.CategoryId and a.BrandId = b.BrandId and is_accept = 1  and a.Name like '%$search%'
    ORDER BY SellPrice DESC 
    LIMIT $start,$limit";
    $Products = mysqli_query($conn, $query2);

    $query3 = "SELECT *FROM Category where status = 1";
    $Category = mysqli_query($conn, $query3);

} else if(isset($_POST['submit1'])) {
    $search = $_POST['search'];
    $query = "SELECT a.ProductId, a.Name, a.Image, c.CategoryName, b.BrandName, a.BuyPrice,a.SellPrice, a.CountView, a.Status 
    FROM `products` a, category c, brands b 
    WHERE a.CategoriId = c.CategoryId and a.BrandId = b.BrandId and is_accept = 1  and a.Name like '%$search%'
    ORDER BY SellPrice DESC";

    $Products = mysqli_query($conn, $query);
    $total = mysqli_num_rows($Products);
    $limit = 5;
    $page = ceil($total / $limit);
    $cr_page = (isset($_GET['page']) ? $_GET['page'] : 1);
    $start = ($cr_page - 1) * $limit;

    $query2 = "SELECT a.ProductId, a.Name, a.Image, c.CategoryName, b.BrandName, a.BuyPrice,a.SellPrice, a.CountView, a.Status 
    FROM `products` a, category c, brands b 
    WHERE a.CategoriId = c.CategoryId and a.BrandId = b.BrandId and is_accept = 1  and a.Name like '%$search%'
    ORDER BY SellPrice DESC 
    LIMIT $start,$limit";
    $Products = mysqli_query($conn, $query2);

    $query3 = "SELECT *FROM Category where status = 1";
    $Category = mysqli_query($conn, $query3);
}

?>

<div class="layout-page">
    <!-- Navbar -->

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?php echo session::get('Username') ?></span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                    <span class="flex-grow-1 align-middle">Billing</span>
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?action=logout">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Danh sách sản phẩm</h4>
            <form action="" method="GET" class="form-control">
                <select name="id_category" id="id_category" onchange="location = this.value;">
                    <option value="">Loại bánh</option>
                    <?php foreach ($Category as $key => $value) { ?>
                        <option value='view_product_by_id_category.php?id=<?php echo $value["CategoryId"] ?>'>
                            <?php echo $value["CategoryName"] ?>
                        </option>
                    <?php } ?>
                </select>
            </form>
            <form action="products_search.php" class="form-control" method="POST">
                <input placeholder="tim kiem" name="search" type="text">
                <input class="btn btn-primary" type="submit" name = "submit1">
            </form>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Loại bánh</th>
                                <th>Thương hiệu</th>
                                <th>Giá nhập</th>
                                <th>Giá bán</th>
                                <th>Số lượt xem</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            foreach ($Products as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $value['Name'] ?></td>
                                    <td>
                                        <img src="..//uploads//<?php echo $value['Image'] ?>" alt="" width="100">
                                    </td>
                                    <td><?php echo $value['CategoryName'] ?></td>
                                    <td><?php echo $value['BrandName'] ?></td>
                                    <td><?php echo $value['BuyPrice'] ?></td>
                                    <td><?php echo $value['SellPrice'] ?></td>
                                    <td><?php echo $value['CountView'] ?></td>
                                    <?php if ($value['Status'] == 1) { ?>
                                        <td>Hiện</td>
                                    <?php } else { ?>
                                        <td>Ẩn</td>
                                    <?php } ?>
                                    <td>
                                        <button type="button" class="btn btn-primary">
                                            <a style="color: white" ; href="product_update.php?id=<?php echo $value['ProductId'] ?>">Sửa</a>
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            <a style="color: white" ; href="product_delete.php?id=<?php echo $value['ProductId'] ?>" onclick="return confirm('Bạn có chắc chắn xóa ?')">Xóa</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if ($page > 1) { ?>
                <hr>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        if ($cr_page - 1 > 0) {
                        ?>
                            <li class="page-item first">
                                <a class="page-link" href="product_list.php?page=1"><i class="tf-icon bx bx-chevrons-left"></i></a>
                            </li>
                            <li class="page-item prev">
                                <a class="page-link" href="product_list.php?page=<?php echo $cr_page - 1 ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for ($i = 1; $i <= $page; $i++) { ?>
                            <li class="page-item  <?php echo (($cr_page == $i) ? 'active' : '') ?>">
                                <a class="page-link" href="product_list.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        </li>
                        <?php
                        if ($cr_page + 1 <= $page) {
                        ?>
                            <li class="page-item next">
                                <a class="page-link" href="product_list.php?page=<?php echo $cr_page + 1 ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
                            </li>
                            <li class="page-item last">
                                <a class="page-link" href="product_list.php?page=<?php echo $page ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . '/admin/inc/footer.php');
    ?>