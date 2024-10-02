<?php
ob_start();
require __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . '/admin/inc/header.php');
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/admin/inc/navbar.php");
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/database/connect.php");

$status = "";
$total_price = 0;
if (isset($_GET['id'])) {
    $id_order = $_GET['id'];

    $query = "SELECT * FROM oders where OderId = '$id_order'";
    $order_query = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($order_query);

    $id_custommer = $order['CustomerId'];

    $custommer_query = mysqli_query($conn, "SELECT * from customers where CustomerId = '$id_custommer'");
    $customer = mysqli_fetch_assoc($custommer_query);

    $products_query = "SELECT a.Quantity, a.Price, p.Image, p.Name  FROM orderdetails a, products p, oders o 
                where a.ProductId = p.ProductId  and a.Order_Detail_Id = o.OderId and o.OderId = '$id_order'";
    $products = mysqli_query($conn, $products_query);

    if (isset($_POST['submit'])) {


        $status = $_POST['status'];
        $query = "UPDATE oders set status = '$status' WHERE  OderId = '$id_order'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("location: order_list.php");
        } else {
            echo "xảy ra lỗi";
        }
    }
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
            <div class="row">
                <div class="panel panel-infor">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin khách hàng</h3>
                    </div>
                    <div class="panel-body text-left">
                        <p>Tên khách hàng: <?php echo $customer['Fullname'] ?></p>
                        <p>Số điện thoại: <?php echo $order['number_phone'] ?></p>
                        <p>Địa chỉ nhận hàng: <?php echo $order['address'] ?></p>
                        <p>Ngày đặt hàng: <?php echo $order['order_date'] ?></p>
                        <p>Ghi chú của khách hàng: <?php echo $order['Note'] ?> </p>
                        <p>Trạng thái đơn hàng:
                            <?php if ($order['status'] == 0) { $status = "chưa xử lý"?>
                                chưa xử lý
                            <?php } else if ($order['status'] == 1) { $status = "đang xử lý"?>
                                đang xử lý
                            <?php } else if ($order['status'] == 2) { $status = "thành công"?>
                                thành công
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin chi tiết đơn hàng</h3>
            </div>
            <div class="card">
                <div class="table-responsive text-nowrap">

                    <table class="table" style="text-align: center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            foreach ($products as $key => $value) : $total_price += $value['Price']  * $value['Quantity']; ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $value['Name'] ?></td>
                                    <td>
                                        <img src="..//uploads//<?php echo $value['Image'] ?>" alt="" width="100">
                                    </td>
                                    <td><?php echo $value['Quantity'] ?></td>
                                    <td><?php echo $value['Price'] ?></td>
                                    <td><?php echo $value['Quantity'] * $value['Price']  ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>Tổng tiền: </td>
                                <td class="bg-infor"><?php echo $total_price ?> VND</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="POST">
                <div class="form-group mt-4">
                    <select name="status" id="" required>
                        <option name="status" value="0">Chưa xử lý</option>
                        <option name="status" value="1">Đang xử lý</option>
                        <option name="status" value="2">Đã xử lý</option>
                    </select>
                </div>
                <button class="mt-4 btn btn-primary" type="submit" name="submit">Cập nhật</button>
                <!-- Thêm nút xuất Excel -->
                <button class="mt-4 btn btn-success" type="submit" name="exportExcel">Xuất Excel</button>
            </form>
        </div>
    </div>
    <?php
    include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . '/admin/inc/footer.php');

if (isset($_POST['exportExcel'])) {

    $orderDate = $order['order_date'];
    $dateTime = new DateTime($orderDate);

// Định dạng lại thành giờ:phút:giây ngày tháng năm
    $formattedDate = $dateTime->format('H:i:s d-m-Y');

    // Tạo một đối tượng Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Tạo một trang tính mới
    $sheet = $spreadsheet->getActiveSheet();

    // Thêm dòng tiêu đề lớn cho "Thông tin khách hàng"
    $sheet->mergeCells('A1:H1'); // Gộp các ô từ A1 đến H1
    $sheet->setCellValue('A1', 'Thông tin khách hàng');
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getFont()->setSize(16);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Đặt tên các cột

    $headerValues = [
        'Mã hóa đơn',
        'Tên khách hàng',
        'Số điện thoại',
        'Địa chỉ nhận hàng',
        'Ngày đặt hàng',
        'Ghi chú của khách hàng',
        'Trạng thái đơn hàng',
        'Tổng tiền (VND)',
    ];

    $headerRanges = ['A3', 'B3', 'C3', 'D3', 'E3', 'F3', 'G3', 'H3'];

// Đặt giá trị và vẽ bảng border cho hàng đầu tiên
    foreach ($headerRanges as $index => $cell) {
        $sheet->setCellValue($cell, $headerValues[$index]);

        $style = $sheet->getStyle($cell);
        $style = $sheet->getStyle($cell);
        $font = $style->getFont();
        $font->setBold(true);

        $borders = $style->getBorders();

        // Đặt bảng border cho ô
        $borders->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }


    $cellValues = [
        $id_order,
        $customer['Fullname'],
        $order['number_phone'],
        $order['address'],
        $formattedDate,
        $order['Note'],
        $status,
        $total_price,
    ];

    $cellRanges = ['A4', 'B4', 'C4', 'D4', 'E4', 'F4', 'G4', 'H4'];

// Đặt giá trị và vẽ bảng border cho các ô
    foreach ($cellRanges as $index => $cell) {
        $sheet->setCellValue($cell, $cellValues[$index]);

        $style = $sheet->getStyle($cell);
        $borders = $style->getBorders();

        // Đặt bảng border cho ô
        $borders->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }


    // Thêm dòng tiêu đề lớn cho "Thông tin chi tiết đơn hàng"
    $sheet->mergeCells('A7:E7'); // Gộp các ô từ A1 đến H1
    $sheet->setCellValue('A7', 'Thông tin chi tiết đơn hàng');
    $sheet->getStyle('A7')->getFont()->setBold(true);
    $sheet->getStyle('A7')->getFont()->setSize(16);
    $sheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $productHeaderValues = [
        'STT',
        'Tên sản phẩm',
        'Số lượng',
        'Giá (VND)',
        'Thành tiền (VND)',
    ];

    $productHeaderRanges = ['A8', 'B8', 'C8', 'D8', 'E8'];

// Đặt giá trị và vẽ bảng border cho dòng thứ 8
    foreach ($productHeaderRanges as $index => $cell) {
        $sheet->setCellValue($cell, $productHeaderValues[$index]);

        $style = $sheet->getStyle($cell);
        $style = $sheet->getStyle($cell);
        $font = $style->getFont();
        $font->setBold(true);

        $borders = $style->getBorders();

        // Đặt bảng border cho ô
        $borders->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $borders->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    // Dữ liệu từ danh sách sản phẩm
    $row = 9;
    foreach ($products as $key => $value) {
        $currentRow = $row + $key;

        $sheet->setCellValue('A' . $currentRow, $key + 1);
        $sheet->setCellValue('B' . $currentRow, $value['Name']);
        $sheet->setCellValue('C' . $currentRow, $value['Quantity']);
        $sheet->setCellValue('D' . $currentRow, $value['Price']);
        $sheet->setCellValue('E' . $currentRow, $value['Quantity'] * $value['Price']);

        $cellRanges = ['A', 'B', 'C', 'D', 'E'];

        // Vẽ bảng border cho dòng dữ liệu
        foreach ($cellRanges as $cellRange) {
            $cell = $cellRange . $currentRow;
            $style = $sheet->getStyle($cell);
            $borders = $style->getBorders();

            // Đặt bảng border cho ô
            $borders->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $borders->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $borders->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $borders->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }
    }

    // Tự động điều chỉnh độ rộng của ô vừa với nội dung
    foreach (range('A', 'H') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
        $sheet->getRowDimension(1)->setRowHeight(40);
    }

    // Xuất file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'order_details_' . $id_order . '.xlsx';

    // Xóa bất kỳ dữ liệu đệm nào tồn tại
    ob_end_clean();

// Thiết lập header để tải file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output'); // Sử dụng 'php://output' để trực tiếp xuất file ra trình duyệt
    exit();
}

    ?>