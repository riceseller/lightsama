<?php require_once 'init.php'; 
      require_once '../supplyment/dbAccess.php'; ?>

<?php
if($user->isLoggedIn() and !empty($_POST['avaUrl'])){
    $avaUrl = $_POST['avaUrl'];
    $get_info_id = $user->data()->id;
    $query = "update users set custom2='$avaUrl' where id=$get_info_id";
    $conn->query($query);
    echo '<script type="text/javascript">alert("success!");</script>';
}else{
    echo '<script type="text/javascript">alert("fail!");</script>';
}
echo "<script>window.location = '../users/account.php'</script>";
?>
