<?php
// requirement files
require_once '../init.php';

session_destroy();
$_SESSION['user_role'] = '';

require_once 'assets/common/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !(empty($_POST['email']) && empty($_POST['password']))) {

    $email = $_POST['email'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checker = makeDBQuery("SELECT * FROM users WHERE username = 'admin'");

    // makeDBQuery("INSERT INTO users (`email`, `password`, `username`) VALUES ('" . $email . "', '" . $hashed_password . "', 'admin');");
    
    if (!empty($checker)) {
        foreach($checker as $data) {
            
            if ($email == $data['email'] && password_verify($_POST['password'], $data['password'])) {
                $session_id = session_create_id();
                session_id($session_id);
                session_start();
                $_SESSION['user_role'] = 'admin';
                $_SESSION['session_id'] = session_id();
                header("LOCATION: index.php");
            }
        }
    }

}

?>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <form action="" method="POST">
                <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                <div class="form-outline form-white mb-4">
                    <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" />
                    <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" />
                    <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->

                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                </div>
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
require_once 'assets/common/footer.php';
?>