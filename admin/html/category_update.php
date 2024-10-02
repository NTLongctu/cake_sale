<?php
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/admin/inc/header.php");
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/database/connect.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM `category` WHERE CategoryId = '$id'";
    $data = mysqli_query($conn, $query);
    $cate = mysqli_fetch_assoc($data);
  }

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(empty($_POST['name'])){
    echo "Dữ liệu rỗng";
  }else{
    $name = $_POST['name'];
      $query = "UPDATE `category` SET CategoryName='$name' where CategoryId = '$id'";
      $data = mysqli_query($conn, $query);
      if ($data) {
        header("location: category_list.php");
      } else {
        echo "Xảy ra lỗi khi thêm mới";
      }
    }
}

?>

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"> Sửa loại bánh</h4>
    <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-body">
            <form method="POST">
              <div class="mb-3">
                <label class="form-label" for="name">Tên loại bánh</label>
                <input value="<?php echo $cate['CategoryName'] ?>"type="text" class="form-control" id="name" name="name" placeholder="Bánh kem Le Castella" required />
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/admin/inc/footer.php");
?>