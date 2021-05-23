<?php
class thongTinND
{
    private $ho;
    private $tenNam;
    private $tenNu;
    private $tongiaoJson;
    private $quequanJson;

    public $sdt;
    public $hoten;
    public $tongiao;
    public $quequan;
    public $ngaysinh;
    public $thangsinh;
    public $namsinh;
    public $gioitinh;

    public function __construct()
    {
        $this->ho = json_decode(file_get_contents("./ho.json"), 1);
        $this->tenNam = json_decode(file_get_contents("./ten-nam.json"), 1);
        $this->tenNu = json_decode(file_get_contents("./ten-nu.json"), 1);
        $this->tongiaoJson = json_decode(file_get_contents("./ton-giao.json"), 1);
        $this->quequanJson = json_decode(file_get_contents("./que-quan.json"), 1);
        $this->gioitinh = $this->TaoGioiTinh();
    }

    public function Tao()
    {
        $this->TaoGioiTinh();
        $this->TaoHoTen();
        $this->TaoTonGiao();
        $this->TaoSDT();
        $this->TaoQueQuan();
        $this->TaoNamSinh();
        $this->TaoThangSinh();
        $this->TaoNgaySinh();

        return ["hoten" => $this->hoten, "gioitinh" => $this->gioitinh, "tongiao" => $this->tongiao, "sdt" => $this->sdt, "ngaysinh" => $this->ngaysinh, "thangsinh" => $this->thangsinh, "namsinh" => $this->namsinh, "quequan" => $this->quequan, "NgayThangNamSinh" => $this->DinhDangNgay("d/m/Y")];
    }


    //thêm số 0 vào trước các số < 10
    public function TienTo($x)
    {
        return ($x < 10) ? "0" . $x : "" . $x;
    }

    public function TaoSDT()
    {
        $this->sdt = "0" . rand(900000000, 999999999);
        return $this->sdt;
    }

    public function TaoGioiTinh()
    {
        if (rand(0, 1) == 0)
            $this->gioitinh = "Nữ";
        else
            $this->gioitinh = "Nam";
        return $this->gioitinh;
    }

    public function TaoHoTen()
    {
        if ($this->gioitinh == "Nam") {
            $this->hoten = $this->ho[rand(0, count($this->ho) - 1)] . " " . $this->tenNam[rand(0, count($this->tenNam) - 1)];
        } else {
            $this->hoten = $this->ho[rand(0, count($this->ho) - 1)] . " " . $this->tenNu[rand(0, count($this->tenNu) - 1)];
        }
    }

    public function TaoTonGiao()
    {
        $this->tongiao = $this->tongiaoJson[rand(0, count($this->tongiaoJson) - 1)];
        return $this->tongiao;
    }

    public function TaoQueQuan()
    {
        $this->quequan = $this->quequanJson[rand(0, count($this->quequanJson) - 1)];
        return $this->quequan;
    }

    public function TaoThangSinh()
    {
        $this->thangsinh = $this->TienTo(rand(1, 12));
        return $this->thangsinh;
    }

    public function TaoNgaySinh()
    {
        if ($this->thangsinh == NULL)
            $this->TaoThangSinh();
        switch ($this->thangsinh) {
            case '01':
            case '03':
            case '05':
            case '07':
            case '08':
            case '10':
            case '12':
                $this->ngaysinh = $this->TienTo(rand(1, 31));
                break;
            case '02':
                $this->ngaysinh = $this->TienTo(rand(1, 28));
                break;
            default:
                $this->ngaysinh = $this->TienTo(rand(1, 30));
                break;
        }
        return $this->ngaysinh;
    }

    public function TaoNamSinh($min = 1970, $max = 2010)
    {
        $this->namsinh = "" . rand($min, $max);
        return $this->namsinh;
    }

    public function TaoNgayThangNamSinh($format = "d/m/Y", $min = 1970, $max = 2010)
    {
        $this->TaoNamSinh();
        $this->TaoThangSinh();
        $this->TaoNamSinh();
        return $this->DinhDangNgay($format);
    }

    public function DinhDangNgay($format = "d/m/Y")
    {
        return date($format, strtotime($this->namsinh . "/" . $this->thangsinh . "/" . $this->ngaysinh));
    }
}

// $u = new thongTinND();
// var_dump($u->Tao());
// var_dump($u->DinhDangNgay("d"));
