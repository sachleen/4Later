<?php
$message = "";
if(isset($_GET['user']) && isset($_GET['key']))
{
    $user = $_GET['user'];
    $key = $_GET['key'];
    $myFile = 'urls/' . md5($user . $key);
    
    if(file_exists($myFile))
    {
        $arr = file($myFile);

        $c = count($arr);
        for($i = 1; $i <= $c; $i+=2)
        {
            $message .= sprintf('<div class="delLink"><a href="#" onclick="deleteLink(%d)"><img src="images/delete.png" /></a></div><div onclick="location=\'%s\'"><a href="%s">%s</a></div>', $i-1, decrypt($arr[$i], $key), decrypt($arr[$i], $key), decrypt($arr[$i-1], $key));
        }
        
        if($message == "")
            $message = "<div>You have no saved pages.</div>";
    }
    else
    {
        $title = "Error!";
        $message = "<div>The user or key is invalid.</div>";
    }
}
else
{
    $title = "Error!";
    $message = "<div>The user or key is invalid.</div>";
}

function decrypt($string, $key)
{
    $result = '';
    $string = base64_decode($string);

    for($i=0; $i<strlen($string); $i++)
    {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result .= $char;
    }

    return $result;
}
?>

<html>
<head>
    <title>4Later</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
    <link rel="apple-touch-icon-precomposed" href="images/icon.png"/> 
    <script type="text/javascript">
        function deleteLink(id)
        {
            <?php
                echo 'user = "' . $user . '";';
                echo 'key = "' . $key . '";';
            ?>
            document.location.href='delete.php?user=' + user + '&key=' + key + '&id=' + id;
        }
    </script>
</head>
<body>
    <div class="title">Saved Pages</div>
    <div class="items">
        <?php echo $message; ?>
    </div>
</body>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
var pageTracker = _gat._getTracker("UA-2893329-1");
pageTracker._trackPageview();
</script>

</html>