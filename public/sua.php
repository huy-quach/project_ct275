<?php
require_once '../bootstrap.php'; // tu dong nap lop,khong gian ten,dbconnect
if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
	session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  }
use CT275\Labs\loai_dien_thoai;
use CT275\Labs\dien_thoai;
$dien_thoai = new dien_thoai($PDO);
$loai_dien_thoai = new loai_dien_thoai($PDO);
$loai_dien_thoais = $loai_dien_thoai->all();

$id = isset($_REQUEST['id']) ?
	filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
$dien_thoai->find($id);
if ($id < 0 || !($dien_thoai->find($id))) {
	redirect(BASE_URL_PATH);
	}

if(!isset($_SESSION['admin_formdb'])){
    echo ('
  <div style="style="padding-bottom: 100px; margin-top:100px; width: 50%; padding-top: 100px; position: relative" class="text-center">
  <h1 style ="text-align: center; margin-top: 100px;"><p> Không có quyền truy cập trang này!!!</p></h1>
    <div style ="text-align: center;">
  <a href="index.php"> <button style ="background-color: #0d6efd; color: white; font-size: 14px;border: none; padding: 12px 26px;cursor: pointer;" class="btn btn-primary">Đi đến trang chủ</button></a>
  <a href="dien_thoai.php"> <button style ="background-color: #0d6efd; color: white; font-size: 14px;border: none; padding: 12px 26px;cursor: pointer;" class="btn btn-primary">Đi đến trang sản phẩm</button></a>
  </div>
  </div>');
    exit();

}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($dien_thoai->update($_POST, $_FILES)) {
		// Cập nhật dữ liệu thành công
		redirect('admin.php');
	}
	// Cập nhật dữ liệu không thành công
	$errors = $dien_thoai->getValidationErrors();
}
include '../partials/header.php';
?>
<main class="container">
	<section class="nav--product row ">
		<div class=" col-7 mt-4 mb-4">
			<h7><a  style ="text-decoration : none;" class="text-black font-weight-bold" href="index.php">Trang chủ</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i> <a  style ="text-decoration : none;" class="text-black font-weight-bold" href="admin.php">Admin</a> <i  style="font-size: 14px" class="bi bi-chevron-right "></i><a  style ="text-decoration : none;" class="text-secondary" href="">Chỉnh sửa sản phẩm</a></h7>
		</div>
		<div class=" col-12">
			<h5 class="text-center mt-4 display-6 font-weight-bold"><div class="text-black" href="">Chỉnh sản phẩm <span class="text-warning"><?=$dien_thoai->ten_dien_thoai ?></span></div> </h5>
		</div>
	</section>
	<section class="row pb-5">
		<div class="col-3"></div>

		<form name="frm" id="frm" action="" method="post" class="col-md-6 col-md-offset-3 was-validated" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= htmlspecialchars($dien_thoai->getId()) ?>">
			<input type="hidden" name="ten_loai" value="<?= htmlspecialchars($dien_thoai->ten_loai) ?>">
			<!-- Name -->
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="ten_dien_thoai" >Tên sản phẩm</label>
				<input type="text" name="ten_dien_thoai" class="form-control is-invalid" maxlen="255" id="ten_dien_thoai" placeholder="Nhập tên sản phẩm..." value="<?= htmlspecialchars($dien_thoai->ten_dien_thoai) ?>" required>
				<?php if (isset($errors['ten_dien_thoai'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['ten_dien_thoai']) ?>
					</div>
				<?php endif ?>
			</div>

			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="gia">Giá sản phẩm</label>
				<input type="number" min="0" name="gia" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập giá sản phẩm..." value="<?= htmlspecialchars($dien_thoai->gia) ?>" required>	
				<?php if (isset($errors['gia'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['gia']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="ten">Hình ảnh</label>
				<input type="file" name="hinh" class="form-control is-invalid" maxlen="255" id="name" placeholder="Nhập hình ảnh sản phẩm..." value="adad.pdf" required >
				<script>
					// Get a reference to our file input
					const fileInput = document.querySelector('input[type="file"]');

					// Create a new File object
					const myFile = new File(['Hello World!'], '<?= $dien_thoai->hinh ?>', {
						type: 'text/plain',
						lastModified: new Date(),
					});

					// Now let's create a DataTransfer to get a FileList
					const dataTransfer = new DataTransfer();
					dataTransfer.items.add(myFile);
					fileInput.files = dataTransfer.files;
				</script>
				<?php if (isset($errors['hinh'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['hinh']) ?></strong>
					</div>
				<?php endif ?>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="mo_ta" class="form-label">Mô tả sản phẩm</label>
				<input type="text" name="mo_ta" class="form-control is-invalid" maxlen="255" id="mo_ta" placeholder="Nhập mô tả sản phẩm..." value="<?= htmlspecialchars($dien_thoai->mo_ta) ?>" required>
				<?php if (isset($errors['mo_ta'])) : ?>
					<div class="invalid-feedback">
						<?= htmlspecialchars($errors['mo_ta']) ?>
					</div>
				<?php endif ?>
			</div>
			
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="loai_dien_thoai">Loại sản phẩm</label>
				<select name="id_loai" class="form-control">
					<option value=" <?= $dien_thoai->id_loai ?>" selected> <?php  if ($dien_thoai->id_loai == 1) {
                                       echo ("Laptop");
                                   } if ($dien_thoai->id_loai == 2) {
                                       echo ("SamSung");
                                   } else if ($dien_thoai->id_loai == 3) {
                                       echo ("Iphone");
                                   } ?></option>
					<?php foreach ($loai_dien_thoais as $loai_dien_thoai) : ?>
						<?php if ($dien_thoai->id_loai != $loai_dien_thoai->id) : ?>
							<option value=" <?= $loai_dien_thoai->id ?>"> <?= $loai_dien_thoai->ten_loai ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label display-7 font-weight-bold "  for="so_luong_hang">Số lượng</label>

				<input type="number" min="1" name="so_luong_hang" class="form-control is-invalid" maxlen="255" id="phone" placeholder="Nhập số lượng sản phẩm... " value="<?= htmlspecialchars($dien_thoai->so_luong_hang)?>" required>
				<?php if (isset($errors['so_luong_hang'])) : ?>
					<div class="invalid-feedback">
						<strong><?= htmlspecialchars($errors['so_luong_hang']) ?></strong>
					</div>
				<?php endif ?>
			</div>

			<!-- Submit -->
			<br>
			<button type="submit" name="submit" id="submit" class="btn btn-primary">Lưu sản phẩm</button>
		</form>
	</section>
</main>

