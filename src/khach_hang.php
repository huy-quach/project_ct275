<?php

namespace CT275\Labs;

class khach_hang{
	private $db;
	public $ten;
	public $id = -1;
	public $email;
    public $mat_khau;
    public $so_dt;
    public $dia_chi;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['email'])) {
			$this->email = trim($data['email']);
		}

		if (isset($data['mat_khau'])) {
			$this->mat_khau =hash("sha1",(trim($data['mat_khau'])));

		}
		if (isset($data['ten'])) {
			$this->ten = trim($data['ten']);
		}

		if (isset($data['dia_chi'])) {
			$this->dia_chi =trim($data['dia_chi']);

		}
		if (isset($data['so_dt'])) {
			$this->so_dt =trim($data['so_dt']);

		}
		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate():bool
	{	
		if (!$this->ten) {
			$this->errors['ten'] = 'Tên không được rỗng.';
		}

		$validEmail = preg_match(
			'/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/',
			$this->email
		);
		if (!$validEmail) {
            $this->errors['email'] = 'Email không hợp lệ.';
        }

		if (!$this->email) {
			$this->errors['email'] = 'Email không được rỗng.';
		}

		if (!$this->dia_chi) {
			$this->errors['dia_chi'] = 'Địa chỉ không được rỗng.';
		}

		$validso_dt = preg_match(
            '/^(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b$/',
            $this->so_dt
        );
        if (!$validso_dt) {
            $this->errors['so_dt'] = 'Số điện thoại không hợp lệ.';
        }

		if(!$this->so_dt) {
            $this->errors['so_dt'] = 'Số điện thoại không được rỗng.';
        }

		if(!$this->mat_khau) {
            $this->errors['mat_khau'] = 'Mật khẩu không được rỗng.';
        }


		return empty($this->errors);
	}

	public function all()
	{
		$khach_hangs = [];
		$stmt = $this->db->prepare('select * from khach_hang');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$khach_hang = new khach_hang($this->db);
			$khach_hang->fillFromDB($row);
			$khach_hangs[] = $khach_hang;
		}
		return $khach_hangs;
	}
	
	protected function fillFromDB(array $row) // truyen doi tuong tu db
	{
		[
			'id' => $this->id,
			'ten' => $this->ten,	
			'dia_chi' => $this->dia_chi,
			'so_dt' => $this->so_dt,
			'email' => $this->email,
            'mat_khau' => $this->mat_khau,

		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		if ($this->id >= 0) {
			$stmt = $this->db->prepare(
				'update khach_hang set email = :email,
					mat_khau = :mat_khau where id = :id'
			);
			$result = $stmt->execute([
				'ten' => $this->ten,
				'email' => $this->email,
				'mat_khau' => $this->mat_khau,
				'id' => $this->id
			]);
		} else {
			$stmt = $this->db->prepare(
				'insert into khach_hang (
					ten,dia_chi,so_dt,email, mat_khau) 
					values (:ten,:dia_chi,:so_dt,:email, :mat_khau)'
			);
			$result = $stmt->execute([
				'email' => $this->email,
				'mat_khau' => $this->mat_khau,
				'ten' => $this->ten,
				'dia_chi' => $this->dia_chi,
				'so_dt' => $this->so_dt,
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId();// lay id giao dich cuoi cung
			}
		}
		return $result;
	}
	public function find($id)
	{
		$stmt = $this->db->prepare('select * from khach_hang where id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}
	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}
	public function delete()
	{
		$stmt = $this->db->prepare('delete from khach_hang where id = :id');
		return $stmt->execute(['id' => $this->id]);
	}
}
