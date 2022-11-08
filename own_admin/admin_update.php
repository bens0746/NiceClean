<?php
    require_once("../config/db.php");
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center">
        <h2>แก้ไขข้อมูล</h2>
    <form action="" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">ชื่อ</label>
            <div class="col-sm-6">
                <input type="text" name="txt_name" id="" class="form-control" placeholder="กรอกชื่อ">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">สกุล</label>
            <div class="col-sm-6">
                <input type="text" name="txt_name" id="" class="form-control" placeholder="กรอกสกุล">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">E-Mail</label>
            <div class="col-sm-6">
                <input type="text" name="txt_name" id="" class="form-control" placeholder="กรอก E-Mail">
            </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="/own_admin/admin_editer.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </div>
    </form>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>