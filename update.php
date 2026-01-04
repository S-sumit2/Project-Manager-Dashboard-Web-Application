<?php 

SESSION_START();
include 'db.php';

if (isset($_GET['id'])) {
    $t_id = $_GET["id"];
    
    $stmt = $conn->prepare("select project_name, project_desc, start_date, end_date from projects where p_id = ?");
    $stmt->bind_param("i",$t_id);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_assoc();

}

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $status = $_POST["status"];
    $s_date = $_POST["s_date"];
    $e_date = $_POST["e_date"];

    $sql = $conn->prepare("update projects set project_name = ?, project_desc = ?, status = ?, start_date = ?, end_date = ? where p_id = ?");
    $sql->bind_param("sssssi",$name, $desc, $status, $s_date, $e_date, $t_id);

    if ($sql->execute()) {
        header("Location:home.php");
    }else{
        echo "<script>alert('Failed To Update Data')</script>";
        exit();
    }

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Update</title>
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
             <h2 class="text-center p-3 text-success bg-dark">Update </h2>
        </header>
        <main>

        <div
            class="container p-3 my-3 col-6 bg-light rounded"
        >

        <h3 class="text-center">Update Project</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"    
                        value = "<?=$results['project_name']?>"
                        placeholder=""
                    />
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea class="form-control" name="desc" rows="3"  ><?=$results['project_desc']?></textarea>
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
                        value = "<?=$results['start_date']?>"
                        placeholder=""
                        
                    />
                    
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">End Date</label>
                    <input
                        type="date"
                        class="form-control"
                        name="e_date"
                        value = "<?=$results['end_date']?>"
                        placeholder=""
                        
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
