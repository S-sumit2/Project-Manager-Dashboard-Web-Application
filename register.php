<?php 

include 'db.php';

if ($_SERVER["REQUEST_METHOD"]==="POST") {

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    $sql = $conn->prepare("insert into user(email, username, password) values(?,?,?)");
    $sql->bind_param("sss",$email,$username,$password);

    if ($sql->execute()) {
        header("Location:login.php");
    }
    else{
        echo"<script>alert('Failed to Register')</script>";
        exit();
    }

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Register</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             <h2 class="text-center p-3 text-success bg-dark">Register</h2>
        </header>
        <main>

            <div
                class="container text-center my-5 p-3 col-6 bg-light rounded"
            >

            <form action="" method="post">

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="fullname"
                    placeholder=""
                    required
                />
                <label for="fullname">Full Name</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder=""
                    required
                />
                <label for="email">Email</label>
            </div>
            
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder=""
                    required
                />
                <label for="username">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder=""
                    required
                />
                <label for="password">Password</label>
            </div>

            <button
                type="submit"
                class="btn btn-secondary"
            >
                Register
            </button>
            

            </form>

            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
