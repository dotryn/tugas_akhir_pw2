<?php
ob_start();
session_start();

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('location: ./login.php?pesan=belum_login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/mylogo-128x128.png" type="image/x-icon" />
    <title>Users | Afriyanto</title>
    <?php
    include './component/css.php';
    ?>
    <link rel="stylesheet" href="./assets/css/dashboard.css">

</head>

<body>

    <!-- Header -->
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="dashboard.php">Afrian's Rent</a>

        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars">
                        <use xlink:href="#list" />
                    </i>
                </button>
            </li>
        </ul>
    </header>
    <!-- Header End -->

    <div class="container-fluid">
        <div class="row">

            <!-- SideBar -->
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-dark" data-bs-theme="dark">
                <div class="offcanvas-md offcanvas-end" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Afrian's Rent</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-lg-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="navbar-nav flex-column list-group rounded-0">
                            <li class="list-group-item list-group-item-action py-2 border-0">
                                <a class="nav-link" href="dashboard.php">
                                    <i class="fa-solid fa-gauge me-2" style="width:16px;"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="list-group-item list-group-item-action py-2 border-0">
                                <a class="nav-link" href="categories.php">
                                    <i class="fa-solid fa-list me-2" style="width:16px;"></i>
                                    Categories
                                </a>
                            </li>
                            <li class="list-group-item list-group-item-action py-2 border-0">
                                <a class="nav-link" href="cars.php">
                                    <i class="fa-solid fa-car me-2" style="width:16px;"></i>
                                    Cars
                                </a>
                            </li>
                            <li class="list-group-item list-group-item-action py-2 border-0">
                                <a class="nav-link" href="orders.php">
                                    <i class="fa-solid fa-clipboard me-2" style="width:16px;"></i>
                                    Orders
                                </a>
                            </li>
                            <li class="list-group-item py-2 border-0">
                                <hr class="my-3 ">
                            </li>
                            <li class="list-group-item list-group-item-action py-2 border-0 active" aria-current="true">
                                <a class="nav-link" href="users.php">
                                    <i class="fa-solid fa-user me-2" style="width:16px;"></i>
                                    Users
                                </a>
                            </li>
                            <li class="list-group-item list-group-item-action py-2 border-0">
                                <a class="nav-link" href="index.php" target="_blank">
                                    <i class="fa-solid fa-house me-2" style="width:16px;"></i>
                                    Website
                                </a>
                            </li>
                            <li class="list-group-item list-group-item-action py-2 border-0">
                                <a class="nav-link" href="./proses/proses_logout.php">
                                    <i class="fa-solid fa-arrow-right-from-bracket me-2" style="width:16px;"></i>
                                    Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- SideBar End -->

            <!-- Main Section -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2 class="pt-3 pb-2 mb-3 border-bottom">Users Data</h2>
                <div class="gap-2 mb-3 d-md-block">

                    <!-- Modal Insert-->
                    <button type="button" class="btn btn-primary btn-sm me-1 mb-1" style="width: 90px;" data-bs-toggle="modal" data-bs-target="#modalInsert">
                        <i class="fa-solid fa-plus"></i>
                        Insert
                    </button>
                    <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalInsertLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalInsertLabel">Insert Users</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="idUsers">ID Users</label>
                                            <?php
                                            include './proses/koneksi.php';
                                            $query = mysqli_query($con, "SELECT SUBSTRING(MAX(id_users), 8) as id FROM tbl_users");
                                            $data = mysqli_fetch_assoc($query);
                                            $kode = $data['id'];
                                            $urutan = (int) ($kode);
                                            $urutan++;

                                            $huruf = "ID-USE-";
                                            $kode = $huruf . sprintf("%03s", $urutan);

                                            mysqli_close($con);
                                            ?>
                                            <input type="text" class="form-control mb-2" name="idUsers" value="<?php echo $kode ?>" readonly required>
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control mb-2" name="username" placeholder="Username" required>
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control mb-2" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="save" value="Save">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['save'])) {
                        include './proses/koneksi.php';

                        $id = $_POST['idUsers'];
                        $nama = $_POST['username'];
                        $password = md5($_POST['password']);

                        $sql = "INSERT INTO tbl_users (id_users, username, password) VALUES ('$id','$nama','$password')";

                        if (!mysqli_query($con, $sql)) {
                            die('Error: ' . mysqli_error($con));
                        }

                        mysqli_close($con);
                    }
                    ?>
                    <!-- Modal Insert End -->

                    <!-- Refresh Button -->
                    <a href="users.php" class="btn btn-success btn-sm me-1 mb-1" style="width: 90px;">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        Refresh
                    </a>
                    <!-- Refresh Button End -->

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel">Edit Users</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="idUsers">ID Users</label>
                                            <input type="text" class="form-control mb-2" name="idUsers" id="idUsers" readonly required>
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control mb-2" name="username" id="username" placeholder="Username" required>
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control mb-2" name="password" id="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="edit" value="Save changes">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['edit'])) {
                        include './proses/koneksi.php';

                        $id = $_POST['idUsers'];
                        $username = $_POST['username'];
                        $password = md5($_POST['password']);

                        $sql = "UPDATE tbl_users SET username = '" . $username . "', password = '" . $password . "' WHERE id_users = '" . $id . "'";

                        if (!mysqli_query($con, $sql)) {
                            die('Error: ' . mysqli_error($con));
                        }

                        mysqli_close($con);
                    }
                    ?>
                    <!-- Modal Edit End -->

                    <!-- Modal Delete -->
                    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalHapusLabel">Delete Users</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="idUsers2" id="idUsers2">
                                        <input type="submit" class="btn btn-primary" name="delete" value="Delete">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['delete'])) {
                        include './proses/koneksi.php';

                        $id = $_POST['idUsers2'];

                        $sql = "DELETE FROM tbl_users WHERE id_users = '" . $id . "'";

                        if (!mysqli_query($con, $sql)) {
                            die('Error: ' . mysqli_error($con));
                        }

                        mysqli_close($con);
                    }
                    ?>
                    <!-- Modal Delete End -->

                </div>

                <!-- Data Tables -->
                <div class="table-responsive small mb-3">
                    <table id="data" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white">No.</th>
                                <th class="bg-primary text-white">ID</th>
                                <th class="bg-primary text-white">Username</th>
                                <!-- <th class="bg-primary text-white">Password</th> -->
                                <th class="bg-primary text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include './proses/koneksi.php';
                            $query = mysqli_query($con, "SELECT * FROM tbl_users");
                            $counter = 1;

                            while ($data = mysqli_fetch_assoc($query)) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $data['id_users'] . "</td>";
                                echo "<td>" . $data['username'] . "</td>";
                                // echo "<td>" . $data['password'] . "</td>";
                                echo "<td>";
                                echo '<button type="button" class="btn btn-primary btn-sm me-2 editBtn" data-bs-toggle="modal" data-bs-target="#modalEdit" 
                                data-idusers="' . $data['id_users'] . '" data-username="' . $data['username'] . '">
                                <i class="fa-solid fa-pen-to-square"></i>
                                </button>';
                                echo '<button type="button" class="btn btn-danger btn-sm me-2 deleteBtn" data-bs-toggle="modal" data-bs-target="#modalHapus" 
                                data-idusers="' . $data['id_users'] . '" >
                                <i class="fa-solid fa-trash"></i>
                                </button>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Data Tables End -->

            </main>
            <!-- Main Section End -->

        </div>
    </div>

    <!-- Footer -->
    <?php
    include './section/footer.php';
    ?>
    <!-- Footer End -->

    <!-- Script -->
    <?php
    include './component/js.php';
    ?>

    <script src="./assets/js/script.js"></script>

    <script>
        $(document).ready(function() {
            $("#data").DataTable();
        });

        $(document).ready(function() {
            $(".editBtn").click(function() {
                var idUsers = $(this).data("idusers");
                var username = $(this).data("username");
                var password = $(this).data("password");
                $("#idUsers").val(idUsers);
                $("#username").val(username);
                $("#password").val(password);
            });
        });

        $(document).ready(function() {
            $(".deleteBtn").click(function() {
                var idKategori = $(this).data("idusers");
                $("#idUsers2").val(idKategori);
            });
        });
    </script>
    <!-- Script End -->
</body>

</html>