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

    /**
     * Trả về mảng thông tin người dùng
     * @param string $gioitinh "Nam"||"Nữ"
     * @param string $ho Họ
     * @param string $tongiao Tôn giáo
     * @param integer $nsmin Năm sinh nhỏ nhất
     * @param integer $nsmax Năm sinh lớn nhất
     * @return array
     */
    public function Tao($gioitinh = NULL, $ho = NULL, $tongiao = NULL, $nsmin = NULL, $nsmax = NULL)
    {
        $this->TaoGioiTinh($gioitinh);
        $this->TaoHoTen($ho);
        $this->TaoTonGiao($tongiao);
        $this->TaoSDT();
        $this->TaoQueQuan();
        $this->TaoNamSinh($nsmin, $nsmax);
        $this->TaoThangSinh();
        $this->TaoNgaySinh();
        return ["hoten" => $this->hoten, "gioitinh" => $this->gioitinh, "tongiao" => $this->tongiao, "sdt" => $this->sdt, "ngaysinh" => $this->ngaysinh, "thangsinh" => $this->thangsinh, "namsinh" => $this->namsinh, "quequan" => $this->quequan, "NgayThangNamSinh" => $this->DinhDangNgay("d/m/Y")];
    }



    /**
     * Thêm số 0 ở trước các số < 10
     * @return string
     */
    public function TienTo($x)
    {
        return ($x < 10) ? "0" . $x : "" . $x;
    }


    /**
     * Trả về chuỗi chứa số điện thoại được tạo
     * @return string
     */
    public function TaoSDT()
    {
        $this->sdt = "0" . rand(900000000, 999999999);
        return $this->sdt;
    }

    /**
     * Trả về giới tính Nam hay Nữ
     * @param string $gioitinh Giới tính mong muốn
     * @return string
     */
    public function TaoGioiTinh($gioitinh = NULL)
    {
        if ($gioitinh == NULL)
            if (rand(0, 1) == 0)
                $this->gioitinh = "Nữ";
            else
                $this->gioitinh = "Nam";
        else
            $this->gioitinh = $gioitinh;
        return $this->gioitinh;
    }

    /**
     * Trả về họ tên được tạo
     * @param string $ho Họ mong muốn
     * @return string
     */
    public function TaoHoTen($ho = NULL)
    {
        if ($ho == NULL)
            $this->hoten = $this->ho[rand(0, count($this->ho) - 1)];
        else
            $this->hoten = $ho;
        $this->hoten .= " ";
        if ($this->gioitinh == "Nam")
            $this->hoten .=  $this->tenNam[rand(0, count($this->tenNam) - 1)];
        else
            $this->hoten .= $this->tenNu[rand(0, count($this->tenNu) - 1)];
        return $this->hoten;
    }


    /**
     * Trả về tôn giáo được tạo
     * @param string $tongiao Tôn giáo mong muốn
     * @return string
     */
    public function TaoTonGiao($tongiao = NULL)
    {
        if ($tongiao == NULL)
            $this->tongiao = $this->tongiaoJson[rand(0, count($this->tongiaoJson) - 1)];
        else
            $this->tongiao = $tongiao;
        return $this->tongiao;
    }


    /**
     * Trả về quê quán Xã Huyện Tỉnh
     * @return string
     */
    public function TaoQueQuan()
    {
        $this->quequan = $this->quequanJson[rand(0, count($this->quequanJson) - 1)];
        return $this->quequan;
    }


    /**
     * Trả về tháng từ tháng 01 -> tháng 12
     * @return string
     */
    public function TaoThangSinh()
    {
        $this->thangsinh = $this->TienTo(rand(1, 12));
        return $this->thangsinh;
    }


    /**
     * Trả về ngày sinh phù hợp với tháng sinh
     * @return string
     */
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


    /**
     * Trả về năm sinh nằm trong khoảng $min - $max
     * @param string $min Năm sinh nhỏ nhất
     * @param string $max Năm sinh lớn nhất
     * @return string
     */
    public function TaoNamSinh($min = NULL, $max = NULL)
    {

        if ($min == NULL)
            $min = 1970;
        if ($max == NULL)
            $max = 2010;

        $this->namsinh = rand($min, $max);
        return $this->namsinh;
    }


    /**
     * Trả về ngày tháng năm sinh theo định dạng 
     * @param string $format Định dạng ngày (d/m/Y)
     * @param string $min Năm sinh nhỏ nhất
     * @param string $max Năm sinh lớn nhất
     * @return string
     */
    public function TaoNgayThangNamSinh($format = "d/m/Y", $min = 1970, $max = 2010)
    {
        $this->TaoNamSinh($min, $max);
        $this->TaoThangSinh();
        $this->TaoNgaySinh();
        return $this->DinhDangNgay($format);
    }


    /**
     * Trả về ngày theo định dạng
     * @param string $format Định dạng ngày (d/m/Y)
     * @return string
     */
    public function DinhDangNgay($format = "d/m/Y")
    {
        return date($format, strtotime($this->namsinh . "/" . $this->thangsinh . "/" . $this->ngaysinh));
    }
}

$u = new thongTinND();
