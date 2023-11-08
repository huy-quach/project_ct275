<?php
namespace CT275\Labs;

use Error;

class loai_dien_thoai{
    private $db;

    public $id_loai;
    public $ten_loai;
    private $errors=[];

    public function getid_loai(){
        return $this->id_loai;
    }

    public function __construct($pdo){
         $this->db=$pdo;
    }

    public function fill(array $data){
        $this->ten_loai= trim($data[`ten_loai`]);
        return $this;
    }

    protected function fillFromDB(array $row){
        [
            'id_loai'=> $this->id_loai,
            'ten_loai' => $this->ten_loai
        ] = $row;
        return $this;
    }

    public  function get_valid_loaiate_error(){
        return $this->errors;
    }

    public  function all()
    {
        $loai_dien_thoais=[];
        $get_data= $this->db->prepare('select * from loai_dien_thoai');
        $get_data->execute();
        while ($row = $get_data->fetch()) {
			$loai_dien_thoai = new loai_dien_thoai($this->db);
			$loai_dien_thoai->fillFromDB($row);
			$loai_dien_thoais[] = $loai_dien_thoai;   
		}
		return $loai_dien_thoais;
    }
}