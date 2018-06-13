<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            let step = 1;
            let size = $("[data-wizard]").each(function () {
                if ($(this).attr("data-wizard") != step) {
                    $(this).closest(".form-group").hide();
                }
            })
        });
    </script>
    <style>
        fieldset {
            padding: 15px;
            margin: 15px;
            border: 1px solid gray;
        }

        button {
            width: 80%;
            border-radius: 50px !important;
            -webkit-border-radius: 50px !important;
            -moz-border-radius: 50px !important;
        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* unvisited link */

        a:link {
            color: blueviolet;

        }

        /* visited link */

        a:visited {
            color: blue;
        }

        /* mouse over link */

        a:hover {
            color: #FF00FF;
            text-decoration: none;
        }

        /* selected link */

        a:active {
            color: #0000FF;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <fieldset class="col-12 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4 align-items-center">
                <a href="#">
                    <img class="center-block" src="https://www.chances.com.br/chances/_cliente/chances/resources/images/chancesSign.png" alt="Chances">
                </a>
                <form action="" method="post" class="row">

                    <h5 class="col-12">Acesse seu cadastro de usuário</h5>
                    <div id="email-group" class="form-group col-sm-12">
                        <label class="control-label" for="email">Email:</label>
                        <input type="email" class="form-control" id="email" data-wizard="1">
                        </div>
                    <div id="password-group" class="form-group col-sm-12">
                        <label class="control-label" for="password">Senha:</label>
                        <input type="password" name="password" class="form-control" id="password" data-wizard="2">
                    </div>
                    <div class="form-group col-sm-12 text-center">
                        <button class="btn btn-secondary" id="submit">continuar</button>
                    </div>
                    <div class="form-group col-sm-12 text-center">
                        <a href="#">Não lembro meu E-mail</a>
                    </div>
                    <div class="form-group col-sm-12 text-center">
                        <a href="#">Ainda não possuo Cadastro</a>
                    </div>
                    <div class="form-group col-12 text-center">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">Privacidade</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Cookies</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Quem Somos</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Suporte</a>
                            </li>
                        </ul>
                    </div>

                </form>
            </fieldset>
        </div>
    </div>
    <script>

        $("#submit").click(function (event) {
            event.preventDefault();
            $('.form-group').removeClass('has-error'); // remove the error class
            $('.help-block').remove();
            let input = $('input');
            let data = input.val();
            let step = input.attr('data-wizard');
            let formData = {
                'step': step,
                'data': data
            };
            validation(formData, step);
            
            
        })
        
        function removeStep(step){
            $('input[data-wizard="'+step+'"]').closest('.form-group').remove();
        }

        function nextStep(step){
            $("[data-wizard]").each(function () {
                if ($(this).attr("data-wizard") != step) {
                    $(this).closest(".form-group").hide();
                } else {
                    $(this).closest(".form-group").show();
                }
            })
        }

        function validation(formData, step){
            $.ajax({
                type: 'POST',
                url: 'process.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data){
                if(!data.success){
                    console.log(data.errors);
                    if(data.errors.email){
                        $('#email-group').addClass('has-error');
                        $('#email-group').append('<div class="help-block">' + data.errors.email + '</div>');
                    } else if(data.errors.password) {
                        $('#password-group').addClass('has-error');
                        $('#password-group').append('<div class="help-block">' + data.errors.password + '</div>');
                    } else if(data.errors.default) {
                        alert(data.errors.default);
                    }
                } else {
                    removeStep(step);
                    step++;
                    nextStep(step);
                }
            });
        }
    </script>
</body>

</html>