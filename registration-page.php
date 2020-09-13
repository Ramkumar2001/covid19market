    <?php 

    include 'header.php';

    ?>
    <style>
 
     </style> 
    <div class="registration-form">
      <h1>Register Here</h1>
    <form class="regform" action="registration.php" method="post">
      <p><input type="text" name="username" placeholder="Username"></p> 
      <p><input type="text" name="email" placeholder="Email ID"></p> 
      <p>Role:<br>
      <input type="radio" name="role" value="Seller"> Seller <br> 
      <input type="radio" name="role" value="Customer" > Customer </p>
      <p><input type="password" name="password" placeholder="Password"><br><em>*Password should be at least 8 chracaters in length and should include at least one upper case letter, one number.</em></p> 
      <p><button type="submit" name="submit">Sign Up</button></p>
    </form>
     <div class='errormessages'>
      <?php
      
      if(isset($_GET['fields'])){
        if($_GET['fields']=='empty'){
          echo "<h3 class='error'> *Fields are empty </h3><br>";
        }
      }

      if(isset($_GET['email'])){
        if($_GET['email']=='incorrect'){
          echo "<h3 class='error'> *Invalid Email </h3><br>";
        }
      }

      if(isset($_GET['pw'])){
        if($_GET['pw']=='mismatch'){
          echo "<h3 class='error'> *Password did not meet the required conditions! </h3>";
        }
      }

      if(isset($_GET['username'])){
        if($_GET['username']=='exist'){
          echo "<h3 class='error'> *Username has been taken already!</h3>";
        }
      }

      if(isset($_GET['registration'])){
        if($_GET['registration']=='successful'){
          echo "<h3 class='success'> Registration successful </h3>";
        }
      }

      ?>
     </div>
    <div class="sign-in">
      <h4>Have an account already? Click <a href="login-page.php">here</a> to sign in!</h4>
    </div>
  </div>
  </body>

