<?php
$step = 1;
if(!isset($_GET['user']) && !isset($_GET['key']))
{
    $step = 1;
    // Generate user and key strings
    $user = genRandomString();
    $key = genRandomString();
    while(file_exists('urls/' . $user . '.txt'))
    {
        $user = genRandomString();
    }
}
else
{
    $step = 2;
    // Generate URLs
    $user = $_GET['user'];
    $key = $_GET['key'];
    $baseUrl = 'http://sachleen.com/4Later/';
    $send = "javascript:window.open('".$baseUrl."add.php?user=".$user."&key=".$key."&title=' + document.title + '&url=' + encodeURIComponent(window.location.href), '4Later', 'height=150,width=320', false);";
    $get = $baseUrl . "get.php?user=".$user."&key=".$key;
}

function genRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string ='';
    for ($p = 0; $p < $length; $p++)
    {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
    return $string;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>4Later</title>
    <meta content="yes" name="apple-mobile-web-app-capable" /> 
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" /> 
    <style type="text/css">
        a, a:visited { color: #747883; text-decoration: none; }
        a:hover { text-decoration: underline; color:#000; }
        body {
            margin: 0;
            font-family: arial;
            font-size: 14px;
            background-color: #ddd;
        }
        #main {
            border: 1px solid #999;
            border-top: 0;
            width: 320px;
            min-height: 420px;
            margin: 0 auto;
            background-image: url('images/background.png');
        }
        .title {
            font-size: 17px;
            font-weight: bold;
            text-align: center;
            color: #FFF;
            text-shadow: #000 0px 1px 1px;
            background-image: url('images/header.png');
            height: 45px;
            line-height: 45px;
        }
        .box {
            margin:10px;
            background:#FFFFFF;
            padding: 5px;
            border: 1px solid gray;
            border-radius:5px;
        }
        .important {
            background-color:#FEEFB3;
            border: 1px solid #9F6000;
        }
        textarea {
            height: 120px;
            width: 283px;
            border: 1px solid #999;
        }
    </style>
</head>
<body>
    <div id="main">
        <div class="title">4Later</div>
        <?php if($step == 1) { ?>
            <div class="box">
                4Later is a <a href="http://www.instapaper.com/">Instapaper</a> alternative with a focus on simplicity and minimalism.<br /><br />It allows you to save pages for later reading from any of your devices. The UI is optimized for use with iOS devices but will work on any device that supports browser bookmarks.<br /><br />
                Click the link below to get your bookmarks and start using 4Later.
            </div>
            <div class="box" style="text-align: center; font-weight: bold; font-size: 20px;">
                <a href="index.php?user=<?php echo $user; ?>&key=<?php echo $key; ?>">Get 4Later</a>
            </div>
        <?php }else if($step == 2) { ?>
            <div class="box">
                Send a link to this page to all of the devices you want to use 4Later on and bookmark the following links.<br /><br />
                Simply drag-and-drop both of the links below to your bookmarks and use them to get and send pages.
            </div>
            <div class="box important">
                All of your devices must use the same pair of bookmarks for this to work!
            </div>
            <div class="box" style="text-align: center; font-weight: bold; font-size: 20px;">
                <a href="<?php echo $send; ?>">Save Page</a> - 
                <a href="<?php echo $get; ?>">4Later</a>
            </div>
            <div class="box">
                If you're on a mobile device and can't use the links above to add bookmarks, you can add <strong>this</strong> page to your bookmarks twice and edit the name/address fields to match the following:<br /><br />
                <strong>Save Page</strong><br />
                <textarea><?php echo $send; ?></textarea><br />
                <strong>4Later</strong><br />
                <textarea><?php echo $get; ?></textarea>
            </div>
        <?php } ?>
        
        <div class="box">
            <strong>Not good enough?</strong><br />I made 4Later because it does just what I want and nothing more. if you want more options or just to try another service, I recommend <a href="http://www.instapaper.com/">Instapaper</a> and <a href="http://readitlaterlist.com/">Read It Later</a>.
        </div>
    </div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
var pageTracker = _gat._getTracker("UA-2893329-1");
pageTracker._trackPageview();
</script>

</body>
</html>