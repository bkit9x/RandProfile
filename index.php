<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Thông Tin Người Dùng</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <form action="" method="get" onsubmit="return false">
        <input type="text" name="gioitinh" id="gioitinh" placeholder="gioitinh">
        <input type="text" name="ho" id="ho" placeholder="ho">
        <input type="text" name="tongiao" id="tongiao" placeholder="tongiao">
        <input type="text" name="nsmin" id="nsmin" placeholder="nsmin">
        <input type="text" name="nsmax" id="nsmax" placeholder="nsmax">
        <button onclick="laythongtin()">Tạo</button>
    </form>
    <input type="text" name="sdt" id="kqsdt" placeholder="kqsdt">
    <input type="text" name="hoten" id="kqhoten" placeholder="kqhoten">
    <input type="text" name="tongiao" id="kqtongiao" placeholder="kqtongiao">
    <input type="text" name="quequan" id="kqquequan" placeholder="kqquequan">
    <input type="text" name="ngaysinh" id="kqngaysinh" placeholder="kqngaysinh">
    <input type="text" name="thangsinh" id="kqthangsinh" placeholder="kqthangsinh">
    <input type="text" name="namsinh" id="kqnamsinh" placeholder="kqnamsinh">
    <input type="text" name="gioitinh" id="kqgioitinh" placeholder="kqgioitinh">
</body>
<script>
    function laythongtin() {
        $.ajax({
            url: './create.php?gioitinh=' + $("#gioitinh").val() + '&ho=' + $("#ho").val() + '&tongiao=' + $("#tongiao").val() + '&nsmin=' + $("#nsmin").val() + '&nsmax=' + $("#nsmax").val(),
            type: 'get',
            dataType: 'json',
            success: function(ketqua) {
                console.log(ketqua['sdt']);
                $('#kqsdt').val(ketqua['sdt']);
                $('#kqhoten').val(ketqua['hoten']);
                $('#kqtongiao').val(ketqua['tongiao']);
                $('#kqquequan').val(ketqua['quequan']);
                $('#kqngaysinh').val(ketqua['ngaysinh']);
                $('#kqthangsinh').val(ketqua['thangsinh']);
                $('#kqnamsinh').val(ketqua['namsinh']);
                $('#kqgioitinh').val(ketqua['gioitinh']);
            }
        });
    }
</script>

</html>