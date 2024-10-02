<?php

require __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/database/connect.php");

$selectedMonth = isset($_GET['thang']) ? $_GET['thang'] : null;
if ($selectedMonth === '') {
    // Nếu là chuỗi rỗng, gán giá trị null để hiển thị tất cả
    $selectedMonth = null;
}
$query = "SELECT o.OderId, o.number_phone, o.order_date, o.note, o.address, c.Fullname, o.total_price, o.status
          FROM oders o, Customers c 
          WHERE o.CustomerId = c.CustomerId AND o.status = 0 ";

// Nếu $selectedMonth không phải là null
if ($selectedMonth !== null) {
    $query .= "AND MONTH(o.order_date) = $selectedMonth ";
}

$query .= "ORDER BY o.order_date DESC 
           LIMIT 5";



$Orders = mysqli_query($conn, $query);

// Tạo một đối tượng Spreadsheet
$spreadsheet = new Spreadsheet();

// Tạo một trang tính mới
$sheet = $spreadsheet->getActiveSheet();

// Thêm dòng tiêu đề lớn cho "Thông tin khách hàng"
$sheet->mergeCells('A1:H1'); // Gộp các ô từ A1 đến H1

if($selectedMonth == null){
    $sheet->setCellValue('A1', 'Thông tin khách hàng (Tất cả)');
} else{
    $sheet->setCellValue('A1', 'Thông tin khách hàng (Tháng '.$selectedMonth.')');
}

$sheet->getStyle('A1')->getFont()->setBold(true);
$sheet->getStyle('A1')->getFont()->setSize(16);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Đặt tên các cột

$headerValues = [
    'STT',
    'Tên khách hàng',
    'Số điện thoại',
    'Địa chỉ nhận hàng',
    'Ghi chú của khách hàng',
    'Trạng thái đơn hàng',
    'Ngày đặt hàng',
    'Tổng tiền (USD)',
];

$headerRanges = ['A2', 'B2', 'C2', 'D2', 'E2', 'F2', 'G2', 'H2'];

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

foreach ($Orders as $key => $value) {
    $row = $key + 3;
// Chuyển đổi giá trị order_date thành định dạng mong muốn
    $orderDate = date('d-m-Y', strtotime($value['order_date']));
    // Thiết lập giá trị cho từng ô
    $sheet->setCellValue('A' . $row, $key + 1);
    $sheet->setCellValue('B' . $row, $value['Fullname']);
    $sheet->setCellValue('C' . $row, $value['number_phone']);
    $sheet->setCellValue('D' . $row, $value['address']);
    $sheet->setCellValue('E' . $row, $value['Note']);
    $sheet->setCellValue('F' . $row, getStatusLabel($value['status'])); // Định nghĩa hàm getStatusLabel() để lấy nhãn trạng thái
    // Định dạng ngày giờ
    $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss');

    $sheet->setCellValue('G' . $row, $orderDate);
    $sheet->setCellValue('H' . $row, $value['total_price']);

    // Thiết lập border cho ô
    $styleArray = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];
    $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);
}


// Tự động điều chỉnh độ rộng của ô vừa với nội dung
foreach (range('A', 'H') as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
    $sheet->getRowDimension(1)->setRowHeight(40);
}

// Xuất file Excel
$writer = new Xlsx($spreadsheet);
if($selectedMonth == null){
    $filename = 'order_list_all.xlsx';
} else{
    $filename = 'order_list_month_'.$selectedMonth.'.xlsx';
}


// Xóa bất kỳ dữ liệu đệm nào tồn tại
ob_end_clean();

// Thiết lập header để tải file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output'); // Sử dụng 'php://output' để trực tiếp xuất file ra trình duyệt
exit();

// Định nghĩa hàm getStatusLabel() nếu cần
function getStatusLabel($status)
{
    switch ($status) {
        case 0:
            return 'Chưa xử lý';
        case 1:
            return 'Đang xử lý';
        case 2:
            return 'Đã xử lý';
        case 3:
            return 'Đã giao hàng';
        default:
            return '';
    }
}
