<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" language="javascript" ></script>
    <head profile="http://www.w3.org/2005/10/profile">
        <link rel="icon" type="image/png" href="<?php echo base_url() . "assets/Images/caffeBavliLogo.jpg"; ?>" />
        <script src="js/appParse.js" type="text/javascript" language="javascript" ></script>
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="css/style.css" type="text/css" rel="stylesheet" />
    </head>
    <body onload="startTime()">
        <div class="tablet">
            <header>
                <span id="datetime"></span>

                <a href="<?php echo site_url(); ?>/Pages_controller/HomePage"><img id="caffeBavliImg" class="center" src='<?php echo base_url() . "assets/Images/caffeBavliLogo.jpg"; ?>'></a>

                <nav class="navbar navbar-expand">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            <li class="nav-item" id="goBack">
                                <a class="nav-link" href="#" onclick="goBack()"><i class="fa fa-hand-o-right"></i><b>חזור </b></a>
                            </li>
                            <li class="nav-item" id="home">
                                <a class="active nav-link" href="<?php echo site_url(); ?>/Pages_controller/HomePage"><b>דף הבית</b></a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item navbar-left" id="logout">
                                <a class="nav-link" href="<?php echo site_url(); ?>/Login_controller/logout"><i class="fa fa-sign-out"></i><b>התנתק</b></a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <p id="hello"> <?php
                    if (isset($_SESSION['id'])) {
                        if (isset($user)) {
                            echo "שלום, " . $user['user'][0]['first_name'];
                        }
                    }
                    ?> </p>
                <hr class="line">

            </header>


            <script>
                function goBack() {
                    window.history.back();
                }
            </script>

            <script>
<?php
$userCheck = isset($user);
if ($userCheck == null) {
    $val = 0;
} else {
    $val = 1;
}
?>
                var user = "<?= $val ?>";
                user = parseInt(user);

                if (user === 0) {
                    document.getElementById('hello').style.display = 'none';
                    document.getElementById('logout').style.display = 'none';
                    document.getElementById('home').style.display = 'none';
                    document.getElementById('goBack').style.display = 'none';

                }
                else
                {
                    document.getElementById('hello').style.display = 'inline-block';
                    document.getElementById('logout').style.display = 'inline-block';
                    document.getElementById('home').style.display = 'inline-block';
                    document.getElementById('goBack').style.display = 'inline-block';


                }

            </script>
            <script>


                function startTime() {
                    var dt = new Date();

                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    m = checkTime(m);
                    s = checkTime(s);
                    document.getElementById('datetime').innerHTML =
                            h + ":" + m + ":" + s + " " + (("0" + dt.getDate()).slice(-2)) + "." + (("0" + (dt.getMonth() + 1)).slice(-2)) + "." + (dt.getFullYear());
                    var t = setTimeout(startTime, 500);
                }
                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i
                    }
                    ;  // add zero in front of numbers < 10
                    return i;
                }
            </script>