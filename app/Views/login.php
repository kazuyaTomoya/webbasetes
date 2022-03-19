<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/bootstrap.min.css'); ?>">
    <!-- Font CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/font-awesome.min.css'); ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/Fontawesome1.css'); ?>" media="all">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/style1.css'); ?>" media="all">

    <title>FORM LOGIN TES BIMA</title>
</head>
    <style type="text/css">
        body{
            background-image: url('<?= base_url('Assets/BG_Login.jpg');?>');
            background-size: cover;
            background-repeat: no-repeat;
            max-height: 100vh;
            overflow-y: hidden;
        }
        #layout-alert{
            position: absolute; top: 0; right: 0; margin: 2rem; z-index: 2;         
        }
    </style>
<body>
    <div id="layout-alert">
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
            <strong>Succesfully!</strong> Wait 3s Redirect to Dashboard!                   
        </div>

        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertFailed">
            <strong>Alert!</strong> Username & Password Wrong!                   
        </div>

        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertPasswordWrong">
            <strong>Alert!</strong> Password Wrong!                   
        </div>      
    </div>

    <div class="w3l-signinform">
        <!-- container -->        
        <div class="wrapper">
            <!-- main content -->            
            <div class="w3l-form-info">                            
                <div class="w3_info">
                    <h1>Welcome Back</h1>                    
                    <h2>Log In</h2>
                        <div class="input-group">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" placeholder="Username" name="username" id="username">
                        </div>
                        <div class="input-group two-groop">
                            <span><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="Password" placeholder="Password" name="password" id="password">
                        </div>
                        <button class="btn btn-primary btn-block" type="submit" id="btnLogin">Log In</button>
                </div>
            </div>
            <!-- //main content -->
        </div>
        <!-- //container -->
    </div>
     
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="<?= base_url('Assets/js/jquery.3.6.0.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">
      $(document).ready(function(){
        $("#alertFailed").hide();
        $("#alertSuccess").hide();
        $("#alertPasswordWrong").hide();

        $("#btnLogin").on('click',function(){                         
            let formData = new FormData();
            formData.append('username', $('#username').val());
            formData.append('password', $('#password').val());

            if(document.getElementById("username").value != "" && document.getElementById("password").value != ""){            
                $.ajax({
                    type: "POST", //Method pengiriman data
                    url: "<?= base_url('Home/login');?>",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response){
                        if(response.data === "Gagal"){
                            $("#alertFailed").show();
                            setTimeout('$("#alertFailed").hide()',3000);                            
                        }
                        
                        if(response.data === "Password Salah"){
                            $("#alertPasswordWrong").show();
                            setTimeout('$("#alertPasswordWrong").hide()',3000); 
                        }

                        if(response.data === "Sukses"){
                            $("#alertPasswordWrong").hide();
                            $("#alertFailed").hide();
                            $("#alertSuccess").show();
                            setTimeout('$("#alertSuccess").hide()',3000);                      
                            document.getElementById("username").value = "";
                            document.getElementById("password").value = "";
                            setTimeout('window.location.href = "<?= base_url('Home/dashboard')?>"',3000); 
                        }                                          
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });        

      });
  </script>
</html>