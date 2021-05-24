<?php
include './thongTinND.php';

$gioitinh = (isset($_GET['gioitinh'])) ? $_GET['gioitinh'] : "";
$ho = (isset($_GET['ho'])) ? $_GET['ho'] : "";
$tongiao = (isset($_GET['tongiao'])) ? $_GET['tongiao'] : "";
$nsmin = (isset($_GET['nsmin'])) ? $_GET['nsmin'] : "";
$nsmax = (isset($_GET['nsmax'])) ? $_GET['nsmax'] : "";

$u = new thongTinND();
echo json_encode($u->Tao($gioitinh, $ho, $tongiao, $nsmin, $nsmax));
