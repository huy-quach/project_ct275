<?php

namespace CT275\Labs;

class dien_thoai
{
	private $db;

	private $id = -1;
	public $ten;
	public $gia;
	public $hinh;
	public $id_loai;
	public $ten_loai;
	public $so_luong;
	public $ngay_nhap;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data, $FILES)
	{

		$this->ten = trim($data['ten']);


		if (isset($data['gia'])) {
			$this->gia = $data['gia'];
		}
		if (isset($_FILES['hinh'])) {
			$file = $_FILES['hinh'];
			$this->hinh = $file['name'];
			$upload_dir = 'uploads/';
			$upload_file = $upload_dir . $this->hinh;
			if (file_exists($upload_file)) {
				echo "File already exists.";
			} else {
				move_uploaded_file($file['tmp_name'], $upload_file);
			}
		}
		if (isset($data['id_loai'])) {
			$this->id_loai =  preg_replace('/\D+/', '', $data['id_loai']);
		}
		if (isset($data['so_luong'])) {
			$this->so_luong = trim($data['so_luong']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->ten) {
			$this->errors['ten'] = 'Tên không hợp lệ.';
		}
		if (!$this->gia) {
			$this->errors['gia'] = 'Giá không hợp lệ.';
		} elseif ($this->gia > 40000000) {
			$this->errors['gia'] = 'Giá không thể lớn hơn 40.000.000vnđ.';
		}
		if (!$this->hinh) {
			$this->errors['hinh'] = 'Hình ảnh không hợp lệ.';
		}
		if (!$this->so_luong) {
			$this->errors['so_luong'] = 'Số lượng không hôp lệ.';
		} elseif (($this->so_luong) < 0 || ($this->so_luong) > 1000) {
			$this->errors['so_luong'] = 'Số lượng không được phép nhỏ hơn 0 và lớn hơn 500.';
		}
		return empty($this->errors); //
	}

    public  function all()
    {
        $dien_thoais=[];
        $get_data= $this->db->prepare('select * from dien_thoai');
        $get_data->execute();
        while ($row = $get_data->fetch()) {
			$dien_thoai = new dien_thoai($this->db);
			$dien_thoai->fillFromDB($row);
			$dien_thoais[] = $dien_thoai;   
		}
		return $dien_thoais;
    }


	public function COUNT()
	{
		$stmt = $this->db->prepare('select COUNT(id) from dien_thoai');
		$stmt->execute();
		$count = $stmt->fetch();
		$count1 = $count[0];
		return $count1;
	}
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'ten' => $this->ten,
			'gia' => $this->gia,
			'hinh' => $this->hinh,
			'id_loai' => $this->id_loai,
			'so_luong' => $this->so_luong,
			'ngay_nhap' => $this->ngay_nhap,
		] = $row;
		return $this;
	}

	public function save(){
		$result = false;
		if ($this->id >= 0) {
			$stmt = $this->db->prepare('update dien_thoai set ten = :ten,
			gia = :gia, hinh = :hinh,id_loai = :id_loai, so_luong = :so_luong, ngay_nhap = now() where id = :id');
			$result = $stmt->execute([
				'ten' => $this->ten,
				'gia' => $this->gia,
				'hinh' => $this->hinh,
				'id_loai' => $this->id_loai,
				'so_luong' => $this->so_luong,
				'id' => $this->id,

			]);
		} else {
			$stmt = $this->db->prepare(
				'insert into dien_thoai (ten, gia,so_luong,hinh,id_loai,ngay_nhap)
values (:ten, :gia,:so_luong, :hinh,:id_loai,now())'
			);
			$result = $stmt->execute([
				'ten' => $this->ten,
				'gia' => $this->gia,
				'hinh' => $this->hinh,
				'id_loai' => $this->id_loai,
				'so_luong' => $this->so_luong
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId(); // lay id giao dich cuoi cung
			}
		}

		return $result;
	}
	public function find($id){
		$stmt = $this->db->prepare('SELECT * FROM dien_thoai WHERE id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}
	public function update(array $data, $FILES)
	{
		$this->fill($data, $FILES);

		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}
	public function delete()
	{
		$stmt = $this->db->prepare('delete from dien_thoai where id = :id');
		return $stmt->execute(['id' => $this->id]);
	}
	
    public function have_id($id){
        $dien_thoais=[];
        $get_data=$this->db->prepare('SELECT * FROM dien_thoai WHERE id= :id');
        $get_data->execute(['id' => $id]);
        while ($row = $get_data->fetch()) {
			$dien_thoai = new dien_thoai($this->db);
			$dien_thoai->fillFromDB($row);
			$dien_thoais[] = $dien_thoai;   
		}
		return $dien_thoais;
    }
    public function all_have_idloai($id){
        $dien_thoais=[];
        $get_data=$this->db->prepare('SELECT * FROM dien_thoai WHERE id_loai = :id');
        $get_data->execute(['id' => $id]);
		while ($row = $get_data->fetch()) {
			$dien_thoai = new dien_thoai($this->db);
			$dien_thoai->fillFromDB($row);
			$dien_thoais[] = $dien_thoai;   
		}
		return $dien_thoais;
    }

    public function all_have_ten($ten){
        $dien_thoais=[];
        $get_data=$this->db->prepare("SELECT * FROM dien_thoai WHERE ten LIKE :ten");
        $get_data->execute(['ten'=>"%$ten%"]);
        while ($row = $get_data->fetch()) {
			$dien_thoai = new dien_thoai($this->db);
			$dien_thoai->fillFromDB($row);
			$dien_thoais[] = $dien_thoai;   
		}
        return $dien_thoais;
    }
}