<?php
if(isset($_GET['user']) && isset($_GET['key']) && isset($_GET['id']) && is_numeric($_GET['id']))
{
    $user = $_GET['user'];
    $key = $_GET['key'];
    $deleteId = $_GET['id'];
    $myFile = 'urls/' . md5($user . $key);
    
    if(file_exists($myFile))
    {
        $arr = file($myFile);
        unset($arr[$deleteId]);
        unset($arr[$deleteId+1]);
        
        $fp = fopen($myFile, 'w+');
        foreach($arr as $line) { fwrite($fp,$line); }
        fclose($fp);
        header("Location:get.php?user=$user&key=$key");
    }
    else
        echo "Error! Code 1";
}
else
{
    echo "Error! Code 2";
}
?>