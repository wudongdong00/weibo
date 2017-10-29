<?php
function Check_verify($code,$id=1){
    $verify = new \Think\Verify();
    $verify->reset=false;
    return $verify->check($code,$id);
}

function encryption($username, $type = 0) {
    $key = sha1(C('COOKIE_key'));

    if (!$type) {
        return base64_encode($username ^ $key);
    }

    $username = base64_decode($username);
    return $username ^ $key;
}