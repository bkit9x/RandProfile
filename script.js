var ho = [], hoTen, tenNam = [], tenNu = [], gioiTinh, tonGiaoJson = [], tonGiao, sdt = "09", ngaysinh, thangsinh, namsinh, diachi;
$(document).ready(function(){
    $.get("ho.json", function(data, status){
        if (status == "success") {
            ho = data;
        }
    });

    $.get("ton-giao.json", function(data, status){
        if (status == "success") {
            tonGiaoJson = data;
        }
    });

    $.get("ten-nam.json", function(data, status){
        if (status == "success") {
            tenNam = data;
        }
    });

    $.get("ten-nu.json", function(data, status){
        if (status == "success") {
            tenNu = data;
        }
    });
});

function taoThongTin(){
    var x = Math.floor((Math.random()*2));
    sdt = "09" + Math.floor((Math.random()*99999999) + 10000000);
    tonGiao = tonGiaoJson[Math.floor((Math.random() * tonGiaoJson.length))];
    ngaysinh = Math.floor((Math.random()*31) + 1);
    thangsinh = Math.floor((Math.random()*12) + 1);
    namsinh = Math.floor((Math.random()*2000) + 1975);

    if (x == 0) {
        gioiTinh = "Nữ";
        hoTen = ho[Math.floor((Math.random() * ho.length))] + " " + tenNu[Math.floor((Math.random() * tenNu.length))];
    }
    else{
        gioiTinh = "Nam";
        hoTen = ho[Math.floor((Math.random() * ho.length))] + " " + tenNam[Math.floor((Math.random() * tenNam.length))];
    }

    return [hoTen, gioiTinh, tonGiao, sdt, ngaysinh, thangsinh, namsinh];
}

function batdau() {
    var thongtin = taoThongTin();
    // var ifr = document.getElementById("myframe");
    // var iframe = ifr.contentWindow.document;    
    $('#thongtin').append("<input value='" + thongtin[0] + "'><input value='" + thongtin[1] + "'><input value='" + thongtin[2]  + "'><input value='" + thongtin[3] +"'>");
}