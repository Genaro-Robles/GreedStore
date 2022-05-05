<?php

require_once 'app/models/mdlUsuarios.php';
$user = new mdlUsuarios();
if ($user::auth()) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Core theme CSS login-register-->
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
    <link href="<?= URL_MAIN ?>assets/css/normalize.css" rel="stylesheet" />
    <link href="<?= URL_MAIN ?>assets/css/login-register.css" rel="stylesheet" />

    <!-- MATERIAL ICONS FULL -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
</head>

<body>
    <main class="content-body">
        <!-- form login -->
        <div class="form-container">
            <div class="login-container">
                <h2>Register</h2>
                <form action="" id="form-register">
                    <p class="my-4">
                    <div class="input-group my-2">
                        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-100">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Tu nombre</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <input class="mdc-text-field__input p-0" type="text" name="name" aria-labelledby="my-label-id" id="nombre" required>
                            <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                face
                            </span>
                        </label>
                        <p class="message_error-custom name m-0 p-0"></p>
                    </div>
                    </p>
                    <p class="my-4">
                    <div class="input-group my-2">
                        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-100">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Tu correo electronico</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <input class="mdc-text-field__input p-0" type="email" name="email" aria-labelledby="my-label-id" id="correo" required>
                            <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                mail
                            </span>
                        </label>
                        <p class="message_error-custom email m-0 p-0"></p>
                    </div>
                    </p>
                    <p class="my-4">
                    <div class="input-group my-2">
                        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-100">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Tu celular</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <input class="mdc-text-field__input p-0" type="tel" name="phone" aria-labelledby="my-label-id" id="celular" required>
                            <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                phone_android
                            </span>
                        </label>
                        <p class="message_error-custom phone m-0 p-0"></p>
                    </div>
                    </p>
                    <p class="my-4">
                    <div class="input-group my-2">
                        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-100">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Tu edad</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <input class="mdc-text-field__input p-0" type="number" name="age" aria-labelledby="my-label-id" id="edad" required>
                            <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing">
                                calendar_month
                            </span>
                        </label>
                        <p class="message_error-custom age m-0 p-0"></p>
                    </div>
                    </p>
                    <p class="my-4">
                    <div class="input-group my-2">
                        <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon w-100">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Tu contraseña</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <input class="mdc-text-field__input p-0" type="password" name="password" aria-labelledby="my-label-id" id="pass" required>
                            <span class="material-icons-outlined mdc-text-field__icon mdc-text-field__icon--trailing visibility-password" style="user-select: none;" tabindex="0" role="button">
                                visibility_off
                            </span>
                        </label>
                        <p class="message_error-custom password m-0 p-0"></p>
                    </div>
                    </p>
                    <p class="mt-4">
                        <button type="submit" class="btn btn-login">Register</button>
                    </p>
                    <!--  <div class="providers my-4">
                    <span>Otros métodos de autentificación</span>
                    <button class="btn btn-google d-flex justify-content-center gap-4"><i class="bi bi-google"></i> Google</button>
                    <button class="btn btn-facebook d-flex justify-content-center gap-4"><i class="bi bi-facebook"></i> Facebook</button>
                    <button class="btn btn-github d-flex justify-content-center gap-4"><i class="bi bi-github"></i> Github</button>
                </div> -->
                    <p class="m-0">
                        <a href="<?= URL_MAIN ?>login/iniciar-session" class="btn">Ya tienes cuenta? Ingresa</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
    <!-- Required Material Web JavaScript library -->
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <!-- Instantiate single textfield component rendered in the document -->
    <script src="<?= URL_MAIN ?>assets/js/material-desing.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery validate-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <!-- form validation -->
    <script src="<?= URL_MAIN ?>assets/js/form-validation.js"></script>
</body>

</html>