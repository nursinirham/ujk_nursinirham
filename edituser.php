<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Edit User-Sistem Management Surat</title>

        <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">

    <link href="css/docs.css" rel="stylesheet">

    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>
    <script src="js/prettify/run_prettify.js"></script>
    <script src="js/ga.js"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
            background-color: #F0F0F0;
        }

        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }
        @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
        
        #tableuser{
            font-size: 14px;
            background-color: white;
            padding-bottom: 50px;
        }
        #miniform{
            width: 525px;
        }
    </style>

    <script>



        function pushMessage(t){
            var mes = 'Info|Implement independently';
            $.Notify({
                caption: mes.split("|")[0],
                content: mes.split("|")[1],
                type: t
            });
        }

        $(function(){
            $('.sidebar').on('click', 'li', function(){
                if (!$(this).hasClass('active')) {
                    $('.sidebar li').removeClass('active');
                    $(this).addClass('active');
                }
            });
        });

        function showDialog(id){
            var dialog = $("#"+id).data('dialog');
            if (!dialog.element.data('opened')) {
                dialog.open();
            } else {
                dialog.close();
            }
        }
        $(function(){
            $('#example_table').dataTable();
        });

    </script>
</head>
<body>
<?php
                         $x = $_REQUEST['id'];
                            require_once('koneksi.php');

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                              $no_id = test_input($_POST['no_id']);
                              $fullnama = test_input($_POST['first']);
                              $user1 = test_input($_POST["username1"]);
                              $password1 = test_input($_POST["user_password"]);
                              $level1 = test_input($_POST["level1"]);
                              $jabatan = test_input($_POST["jabatan"]);

                                $sql = "UPDATE user SET username='$user1',  password='$password1', fullname='$fullnama', level='$level1', jabatan='$jabatan' WHERE id='$no_id'";

                                if ($conn->query($sql) == TRUE) {
                                    header("location:user.php"); 
                                } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                }
                            }

                            function test_input($data) {
                              $data = trim($data);
                              $data = stripslashes($data);
                              $data = htmlspecialchars($data);
                              return $data;
                            }
                            session_start();
if(!isset($_SESSION['username'])) {
header("location:login.php"); }
else{
    $username = $_SESSION['username'];
}
$sql = "SELECT id, fullname, level, picture FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $fullname = $row["fullname"];
        $level = $row["level"];
        $picture = $row["picture"];
        $user_id =  $row["id"];
    }
}
                        ?>

<div data-role="dialog" id="dialog" class="padding20" data-close-button="true">
    
</div>

    <?php
    require_once("judul.php");
    ?>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1">
                     <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-users"></span></span>
                                <span class="window-caption-title">Edit User</span>
                                <a href="user.php"><span class="btn-close bg-grayDark fg-white"></span></a>
                            </div>

                            <?php
                           $sql = "SELECT id,username, fullname, level, password, jabatan FROM user WHERE id='$x'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 while($row = $result->fetch_assoc()) {
                            ?>
                            <div class="window-content bg-white padding20" style="height: auto;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000">
        
            <div class="input-control text full-size" data-role="input">
                <label for="first">Full Name:</label>
                <input   data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="first" id="first" value="<?php echo $row["fullname"]?>">
                <span class="input-state-error mif-warning"></span>
                <span class="input-state-success mif-checkmark"></span>
            </div>
            <input type="hidden" name="no_id" value="<?php echo $row["id"] ?>">
            <br />
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user">Username:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="username1" id="user" value="<?php echo $row["username"]?>">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">User password:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="password" name="user_password" id="user_password" value="<?php echo $row["password"]?>">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control select full-size">
                <label for="class">Class:</label>
                <select id="class" name="level1">
                    <option value="<?php echo $row["level"]?>"><?php echo $row["level"]?></option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                    <option value="pimpinan">Pimpinan</option>
                </select>
            </div>
            <br />
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="jabatan">Jabatan:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="jabatan" id="jabatan" value="<?php echo $row["jabatan"]?>">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Edit</button>
                <a href=""><button type="button" class="button link">Cancel</button></a>
            </div>
        </form>
        <?php
        }
    }
            ?>
                                    <br />
                                    <br />
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
