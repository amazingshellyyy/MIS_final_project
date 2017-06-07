<?php
include_once 'dbconnect.php';
if(isset($_FILES['files'])){
  $errors= array();
  foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
  {
    $file_name = $_FILES['files']['name'][$key];
    $file_size = $_FILES['files']['size'][$key];
    $file_tmp = $_FILES['files']['tmp_name'][$key];
    $file_type = $_FILES['files']['type'][$key];
    $file_userId = $_POST['user_Id'];
    $sepext = explode('.', strtolower($_FILES['files']['name'][$key]));
    $type = end($sepext);       // gets extension

    if($file_size > 2097152)
    {
      $errors[]='檔案大小必須小於 2 MB';
    }

    // new file size in KB
    $new_size = $file_size/1024;

    $desired_dir="uploads";
    if(empty($errors)==true)
    {
      if(is_dir($desired_dir)==false)
      {
        // Create directory if it does not exist
        mkdir("$desired_dir", 0700);
      }
      // if the uploaded file does not exist
      if(file_exists("$desired_dir/".$file_name)==false)
      {
        // move file to folder
        move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
      } else
      {
        // rename the file if another one exist
        $count = 0;
        list($name, $ext) = explode('.', $file_name);
        while(file_exists("$desired_dir/".$file_name))
        {
          $count++;
          $file_name = $name. $count . '.' . $ext;
        }
        move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
      }
      $query="INSERT INTO tbl_uploads(file,type,size,projectId,userId)
              VALUES('$file_name','$type','$new_size','$file_projectId','$file_userId')";
      mysqli_query($db, $query);
    } else
    {

      echo "<script>
      alert('error while uploading file');
      window.location.href='file_manager.php';
      </script>";
      //header("Location: project_file.php?id=$file_projectId");
    }
  }
  if(empty($error))
  {
    echo "<script>
    alert('successfully uploaded');
    window.location.href='file_manager.php';
    </script>";
    //header("Location: project_file_view.php?id=$file_projectId");
  }
}
?>
