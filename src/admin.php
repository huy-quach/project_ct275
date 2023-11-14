<?php

namespace CT275\Labs;

class admin{
	private $db;
	private $id = -1;
	public $ten;
	public $email;
    public $mat_khau;
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
		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

    public function validate()
	{
		if (!$this->email) {
			$this->errors['email'] = 'Email không được rỗng.';
		}
        if (!$this->mat_khau) {
			$this->errors['mat_khau'] = 'Mật khẩu không được rỗng.';
		}

		return empty($this->errors);
	}


	public function all()
	{
		$admins = [];
		$stmt = $this->db->prepare('select * from admin');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$admin = new admin($this->db);
			$admin->fillFromDB($row);
			$admins[] = $admin;
		}
		return $admins;
	}
	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'ten' => $this->ten,
            'email' => $this->email,
			'mat_khau' => $this->mat_khau,
		] = $row;
		return $this;
	}

	public function save()
	{
		$result = false;
		if ($this->id >= 0) {
			$stmt = $this->db->prepare('
            update admin set ten = :ten,
                email = :email, mat_khau = :mat_khau, where id = :id'
            );
			$result = $stmt->execute([
				'ten' => $this->ten,
				'email' => $this->email,
				'mat_khau' => $this->mat_khau,
				'id' => $this->id,
			]);
		} else {
			$stmt = $this->db->prepare(
				'insert into admin (ten, email, mat_khau)
                    values (:ten, :email, :mat_khau)'
			);
			$result = $stmt->execute([
				'email' => $this->email,
				'mat_khau' => $this->mat_khau
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId();// lay id giao dich cuoi cung
			}
		}
		return $result;
	}

	public function find($id)
	{
		$stmt = $this->db->prepare('select * from admin where id_nv = :id');
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
		$stmt = $this->db->prepare('delete from admin where id = :id');
		return $stmt->execute(['id' => $this->id]);
	}

}