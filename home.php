<?php 
SESSION_START();
include 'db.php';
$u_name = $_SESSION["username"];
$user_id = $_SESSION["u_id"];

$stmt = $conn->prepare("select p_id, project_name, project_desc, status, start_date, end_date from projects where u_id = ?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result = $stmt->get_result();


if ($_SERVER["REQUEST_METHOD"]==="POST") {
    
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $status = $_POST["status"];
    $s_date = $_POST["s_date"];
    $e_date = $_POST["e_date"];

    $sql = $conn->prepare("insert into projects(u_id ,project_name, project_desc, status, start_date, end_date) values(?,?,?,?,?,?)");
    $sql->bind_param("isssss",$user_id ,$name, $desc, $status, $s_date, $e_date);
    
    if ($sql->execute()) {        
        header("Location:home.php");
    }else{
        echo "<script>alert('Failed To Insert Data')</script>";
        exit();
    }

}


?>

<!doctype html>
<html lang="en">
    <head>
        <title>Home</title>
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
             <nav
                class="navbar navbar-expand-sm navbar-light bg-dark"
             >
                <div class="container">
                    <a class="navbar-brand text-primary" href="home.php">Project Manager</a>
                            <a
                                name=""
                                id=""
                                class="btn btn-outline-primary"
                                href="logout.php"
                                role="button"
                                >logout</a
                            >
                        </form>
                    </div>
                </div>
             </nav>
             
        </header>
        <main>

        <div
            class="container p-3 my-2"
        >
            <h3 class="text-center">Welcome <?php echo $u_name ; ?></h3>
        </div>
        
        <div
            class="container p-3 col-6 bg-light rounded"
        >

        <h3 class="text-center">Add Project</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"    
                        placeholder=""
                        required
                    />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Descriptiom</label>
                    <textarea class="form-control" name="desc"  rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <select
                        class="form-select form-select-md"
                        name="status"
                    >
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Start Date</label>
                    <input
                        type="date"
                        class="form-control"
                        name="s_date"
                        placeholder=""
                        required
                    />
                    
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">End Date</label>
                    <input
                        type="date"
                        class="form-control"
                        name="e_date"
                        placeholder=""
                        required
                    />
                    
                </div>

                <div
                    class="container text-center"
                >
                    <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Submit
                </button>
                </div>
                
            </form>
        </div>
        
        <div
            class="container my-3"
        >
        
        <div
            class="table-responsive"
        >
            <table
                class="table table-light"
            >
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <td scope="row"><?= $row['p_id'] ?></td>
                        <td><?= $row['project_name'] ?></td>
                        <td><?= $row['project_desc'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td><?= $row['start_date'] ?></td>
                        <td><?= $row['end_date'] ?></td>
                        <td>
                            <a
                                name=""
                                id=""
                                class="btn btn-success"
                                href="update.php?id=<?=$row['p_id']?>"
                                role="button"
                                >Update</a
                            >
                            
                        </td>
                        <td>
                            <a
                                name=""
                                id=""
                                class="btn btn-danger"
                                href="delete.php?id=<?=$row['p_id']?>"
                                role="button"
                                >Delete</a
                            >
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        

        </div>
        


        </main>
        <footer>
            <!-- place footer here -->
            
            <footer class="bg-light text-center text-lg-start mt-4">
  
            <div class="text-center text-success p-3">
                © 2025 Copyright:
            <a class="text-body " href="https://github.com/S-sumit2">Sumit Sharma</a>
            </div>
  
</footer>
            
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
