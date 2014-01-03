<?php
if(isset($_GET['user']) && isset($_GET['key']) && isset($_GET['title']) && isset($_GET['url']))
{
    $user = $_GET['user'];
    $key = $_GET['key'];
    $title = $_GET['title'];
    $url = $_GET['url'];
    $myFile = 'urls/' . md5($user . $key);
    
    $arr = array();
    if(file_exists($myFile))
    {
       $arr = file($myFile);
    }
    
    $fp = fopen($myFile, 'w');
    
    fwrite($fp, encrypt($title, $key) . "\n");
    fwrite($fp, encrypt($url, $key) . "\n");
    
    foreach($arr as $line) { fwrite($fp,$line); }
    fclose($fp);
    
    $title = "Page Saved";
    $message = "The page has been saved. You can pull up the 4Later bookmark from any other device to view a list of saved pages.";
    $message .= '<script>setTimeout(window.close, 2000);</script>';
}
else
{
    $title = "Error";
    $message = "Uh oh! Something went wrong.";
}

function encrypt($string, $key)
{
    $result = '';
    for($i=0; $i<strlen($string); $i++)
    {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
}
?>

<html>
<head>
    <title>Add to 4Later</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div class="title"><?PHP echo $title; ?></div>
    <div class="box"><?php echo $message; ?></div>
</body>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
var pageTracker = _gat._getTracker("UA-2893329-1");
pageTracker._trackPageview();
</script>

</html>