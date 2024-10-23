<?php
if($_SESSION["role"] == 'Admin')
{
  header("Location: /private/view/admin/"); // If user type is "Admin", go to admin page
  exit(0);
}
elseif($_SESSION["role"] =='User')
{
  header("Location: /private/view/user/");  // If user type is "User", go to user page
  exit(0);
}
?>