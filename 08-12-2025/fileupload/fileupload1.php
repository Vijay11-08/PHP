<html>
<head>
  <title>Upload your files</title>
</head>

<body>

  <form method="post" enctype="multipart/form-data">
    <p>Upload your file</p>
    <input type="file" name="image"/><br><br>
    <input type="submit" name="Submit"/><br><br>
  </form>        

</body>            
</html>

<?php
if(isset($_FILES['image']))
{
  echo "<pre>";
  print_r($_FILES);
  }
?>