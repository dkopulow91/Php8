<?php
include_once "../models/Model.php";

$goods = getAll ($connect, 'goods');

if (isset($_GET[id])) {
    $id = $_GET[id];
}

$good = getOne ($connect, $id, 'goods');

if ($_POST['send']) {
    $nameShort = trim(strip_tags($_POST['nameShort']));
    $nameFull = trim(strip_tags($_POST['nameFull']));
    $param = trim(strip_tags($_POST['param']));
    $price = (int)trim(strip_tags($_POST['param']));
    $filePath = $_FILES['userfile'] ['tmp_name'];
    $fileName = translit($_FILES[;userfile] ['name']);
    $type = $_FILES['userfile'] ['type'];
    size = $_FILES['userfile'] ['size'];

    if ($type == 'image/jpeg' || $type == 'image.png' || $type == 'image.gif') {
        if ($size > 0 and $size < 1000000) {
            if (copy($filePath, '../public/'. DIR_BIG . $fileName)) {
                $type = explode('/', $_FILES['userfile'] ['type']) [1];
                changeImage(225,150,'../public'. DIR_BIG . $fileName, '../public/', DIR_SMALL . $fileName, $type);
                if (isset($_POST['edit'])) {
                    $id = (int)trim(strip_tags($_POST[id]));
                    goods_edit($connect, $id, $nameShot, $nameFull, $price, $param);
                    header("location: admin.php");
                } else {
                    good_new($connect,$id, $nameShot, $nameFull, $price, $param );
                    header("location: admin.php");
                }
                $message = "<h3>Файл загружен</h3>";
            } else {
                $message = "<h3>Ошибка. Не удалось загрузить!</h3>";
                exit;
            }
        } else {
            $message = "<h3>Ошибка. Картинка больше 1 МБ!</h3>";
        }
    } else {
        message = "<h3>Картинка не подходит!</h3>";
    }
}