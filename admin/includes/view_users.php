<div>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Image</th>
      <th>Role</th>
      <th>Admin</th>
      <th>Subscriber</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $query="SELECT * FROM users";
      $users=mysqli_query($connection,$query);
      while($row=mysqli_fetch_assoc($users)){
          $user_id=$row['user_id'];
          $username=$row['username'];
          $user_firstname=$row['user_firstname'];
          $user_lastname=$row['user_lastname'];
          $user_email=$row['user_email'];
          $user_image=$row['user_image'];
          $user_role=$row['user_role'];
          echo "<tr>";
          echo "<td>$user_id</td>";
          echo "<td>$username</td>";
        //   echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
        //   $query="SELECT * FROM categories WHERE cat_id={$post_category_id}";
        //   $categories_admin=mysqli_query($connection,$query);
        //   while($row=mysqli_fetch_assoc($categories_admin)){
        //       $cat_id=$row['cat_id'];
        //       $cat_title=$row['cat_title'];
        //   echo "<td>$cat_title</td>";
        // }
          echo "<td>$user_firstname</td>";
          echo "<td>$user_lastname</td>";
          echo "<td>$user_email</td>";
          echo "<td><img width=100 src='../images/$user_image' alt='900x300'></td>";
          echo "<td>$user_role</td>";
          // echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
          echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
          echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
          echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete')\" href='users.php?delete={$user_id}'>Delete</a></td>";
          echo "</tr>";
        }?>
  </tbody>



</table>
</div>
<?php
if(isset($_GET['delete'])){
      if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){
  $the_user_id=$_GET['delete'];
  $query="DELETE FROM users WHERE user_id={$the_user_id}";
  $delete_query=mysqli_query($connection,$query);
  redirect("users.php");
}
}
if(isset($_GET['change_to_admin'])){
  if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){
  $user_id=$_GET['change_to_admin'];
  $query="UPDATE users SET user_role='admin' WHERE user_id={$user_id}";
  $admin_query=mysqli_query($connection, $query);
  redirect("users.php");
}
}
if(isset($_GET['change_to_sub'])){
    if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){
  $user_id=$_GET['change_to_sub'];
  $query="UPDATE users SET user_role='subscribe' WHERE user_id={$user_id}";
  $sub_query=mysqli_query($connection, $query);
  redirect("users.php");
}
}
 ?>
