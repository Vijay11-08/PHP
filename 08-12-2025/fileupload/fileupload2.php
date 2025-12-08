<html>
<head>
        <title>File Upload Demo 2</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    
    Upload your file 
    <input type="file" name="file"><br><br>
    <input type="submit" name="button" value="Upload">

</form>

</body>
</html>

<?php

if (isset($_POST['button'])) {   // Check if form is submitted

    if (isset($_FILES['file'])) {   // Check if file is selected

        $filename = $_FILES['file']['name'];
        $filesize = $_FILES['file']['size'];

        echo "Uploaded file name is: " . $filename . "<br>";
        echo "Uploaded file size is: " . $filesize . " bytes";

    } else {
        echo "No file selected.";
    }
}

?>
