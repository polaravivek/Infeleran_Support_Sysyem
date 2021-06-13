<?php
    include('../database/db.php');
if(isset($_POST['id']) && $_POST['id']>0) {
    $id=mysqli_real_escape_string($link, $_POST['id']);
    if(isset($_COOKIE['like'.$id])) {
        setcookie('like'.$id, "yes", 1);
         $sql = "update solved set liked=liked-1, class_id = 'far' where id='$id'";
        $op = "unlike";
    }
    else
    {
        setcookie('like'.$id, "yes", time()+60*600*24*5);
         $sql = "update solved set liked=liked+1, class_id = 'fas' where id='$id'";
        $op = "like";
    }

    mysqli_query($link, $sql);

    $row=mysqli_fetch_assoc(mysqli_query($link, "select * from solved where id='$id'"));
    
    echo json_encode([
        'op'=>$op,
        'like_count'=>$row['liked']
    ]);
}
?>