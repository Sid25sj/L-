<?php 

Route::post("AddUser", "UserController@AddUser");     // file name can be api.php if they want API else web.php .

Route::get("UserDeatils", "UserController@UserDetails");

?>

