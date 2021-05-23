<?php
function down()
{
    $stt = file_get_contents("stt.txt");
    $stt += 1;
    file_put_contents($stt . ".jpg", file_get_contents("https://thispersondoesnotexist.com/image"));
    file_put_contents("stt.txt", $stt);
}

while (1) {
    down();
    sleep(0);
}
