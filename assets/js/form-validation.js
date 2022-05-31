$(document).ready(function () {

    const form_login = document.getElementById('form-login');
    const form_register = document.getElementById('form-register');
    const inputsLogin = document.querySelectorAll('#form-login input');
    const inputsRegister = document.querySelectorAll('#form-register input');
    const gmailLogin = document.getElementById('btn_login--gmail');
    const gmailRegister = document.getElementById('btn_register--gmail');

    var urlLocation = 'http://localhost/GreedStore/'

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyA7GnZxiDLIp9cpfaqWkg_VHP8c1yB4uks",
        authDomain: "loginsocialmedia-ba0ac.firebaseapp.com",
        projectId: "loginsocialmedia-ba0ac",
        storageBucket: "loginsocialmedia-ba0ac.appspot.com",
        messagingSenderId: "858825923667",
        appId: "1:858825923667:web:1196773667441c02d2faa6",
        measurementId: "G-FWNTQF50C5"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();

    let auth = firebase.auth();

    if (gmailLogin) {
        gmailLogin.addEventListener('click', (e) => {
            e.preventDefault();
            const provider = new firebase.auth.GoogleAuthProvider();
            auth.signInWithPopup(provider)
                .then(result => {
                    let user = result.user.providerData[0];

                    // fields to be filled

                    let email = user.email;
                    let perfil = user.photoURL;
                    let name = user.displayName;
                    let metodo = user.providerId.split('.')[0];

                    const data = new FormData();

                    data.append("email", email);
                    data.append("perfil", perfil);
                    data.append("name", name);
                    data.append("metodo", metodo);

                    $.ajax({
                        type: "POST",
                        url: urlLocation + "?ruta=Usuarios/LoginUsuario",
                        dataType: "JSON",
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: data,
                        success: function (res) {
                            if (res.status == 200) {
                                $("#form-login").waitMe();
                                window.location.href = "http://localhost/GreedStore";
                            } else {
                                Swal.fire(
                                    'Algo salio mal!',
                                    res.msg,
                                    'error'
                                )
                            }
                        }
                    });

                }).catch(error => {
                    console.log(error);
                })
        })
    }


    if (gmailRegister) {
        gmailRegister.addEventListener('click', (e) => {
            e.preventDefault();
            const provider = new firebase.auth.GoogleAuthProvider();
            auth.signInWithPopup(provider)
                .then(result => {
                    let user = result.user.providerData[0];

                    // fields to be filled

                    let email = user.email;
                    let perfil = user.photoURL;
                    let name = user.displayName;
                    let metodo = user.providerId.split('.')[0];

                    const data = new FormData();

                    data.append("email", email);
                    data.append("perfil", perfil);
                    data.append("name", name);
                    data.append("metodo", metodo);

                    $.ajax({
                        type: "POST",
                        url: urlLocation + "?ruta=Usuarios/RegistrarUsuario",
                        dataType: "JSON",
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: data,
                        success: function (res) {
                            if (res.status == 201) {
                                $("#form-login").waitMe();
                                Swal.fire({
                                    title: 'Cuenta registrada exitosamente!',
                                    text: "Ya puedes iniciar sesión",
                                    icon: 'success',
                                    showCancelButton: false,
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Iniciar sesión'
                                }).then((result) => {
                                    $("#form-login").waitMe('hide');
                                    window.location.href = "http://localhost/GreedStore/login/iniciar-session";
                                })
                            } else {
                                Swal.fire(
                                    'Algo salio mal!',
                                    res.msg,
                                    'error'
                                )
                            }
                        }
                    });
                    form_register.reset();
                }).catch(error => {
                    console.log(error);
                })
        })
    }



    $("p.password").hide();
    $("p.email").hide();
    const expresiones = {
        password: /^.{8,12}$/, // 8 a 16 digitos.
        email: /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i,
        phone: /^\d{9,9}$/,
        name: /^[ÁÉÍÓÚA-Z][a-záéíóú]+(\s+[ÁÉÍÓÚA-Z]?[a-záéíóú]+)*$/
    }
    const fields = {
        password: { estado: false, message: "La contraseña debe tener entre 8 y 16 caracteres" },
        email: { estado: false, message: "El email no es valido" },
        name: { estado: false, message: "El nombre no es valido" },
        phone: { estado: false, message: "El número de celular no es valido" },
        /*         age: { estado: false, message: "Debes ser mayor de edad" } */
    }
    const validateForm = (e) => {

        switch (e.target.name) {
            case 'password':
                validar(expresiones.password, e.target.value, e.target, e.target.name, fields[e.target.name].message);
                break;
            case 'email':
                validar(expresiones.email, e.target.value, e.target, e.target.name, fields[e.target.name].message);
                break;
            case 'name':
                validar(expresiones.name, e.target.value, e.target, e.target.name, fields[e.target.name].message);
                break;
            case 'phone':
                validar(expresiones.phone, e.target.value, e.target, e.target.name, fields[e.target.name].message);
                break;
            /*             case 'age':
                            validar(expresiones.age, e.target.value, e.target, e.target.name, fields[e.target.name].message);
                            break; */
        }
    }

    const validar = (expresion, val, input, field, message) => {
        /* if (field != "age") {
            if (expresion.test(val)) {
                $(input.parentNode).removeClass("mdc-text-field--invalid")
                $(`p.${field}`).hide();
                fields[field].estado = true;
            } else {
                $(input.parentNode).addClass("mdc-text-field--invalid")
                $(`p.${field}`).html(message)
                $(`p.${field}`).show();
                fields[field].estado = false;
            }
        } else {
            if (val >= 18) {
                $(input.parentNode).removeClass("mdc-text-field--invalid")
                $(`p.${field}`).hide();
                fields[field].estado = true;
            } else {
                $(input.parentNode).addClass("mdc-text-field--invalid")
                $(`p.${field}`).html(message)
                $(`p.${field}`).show();
                fields[field].estado = false;
            }
        } */
        if (expresion.test(val)) {
            $(input.parentNode).removeClass("mdc-text-field--invalid")
            $(`p.${field}`).hide();
            fields[field].estado = true;
        } else {
            $(input.parentNode).addClass("mdc-text-field--invalid")
            $(`p.${field}`).html(message)
            $(`p.${field}`).show();
            fields[field].estado = false;
        }
    }

    if (form_login) {
        inputsLogin.forEach(input => {
            input.addEventListener('keyup', validateForm);
            input.addEventListener('blur', validateForm);
        })

        form_login.addEventListener('submit', function (e) {
            e.preventDefault();

            if (fields.password.estado && fields.email.estado) {

                const data = new FormData($("#form-login").get(0));

                $.ajax({
                    type: "POST",
                    url: urlLocation + "?ruta=Usuarios/LoginUsuario",
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: data,
                    success: function (res) {
                        if (res.status == 200) {
                            $("#form-login").waitMe();
                            window.location.href = "http://localhost/GreedStore";
                        } else {
                            Swal.fire(
                                'Algo salio mal!',
                                res.msg,
                                'error'
                            )
                        }
                    }
                });

                form_login.reset();
            } else {
                inputsLogin.forEach(input => {
                    validar(expresiones[input.name], input.value, input, input.name, fields[input.name].message);
                })
            }

        });
    } else {
        inputsRegister.forEach(input => {
            input.addEventListener('keyup', validateForm);
            input.addEventListener('blur', validateForm);
        })

        form_register.addEventListener('submit', function (e) {
            e.preventDefault();
            if (fields.name && fields.email.estado && fields.password.estado && fields.phone/*  && fields.age */) {

                const data = new FormData($("#form-register").get(0));

                $.ajax({
                    type: "POST",
                    url: urlLocation + "?ruta=Usuarios/RegistrarUsuario",
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: data,
                    success: function (res) {
                        if (res.status == 201) {
                            $("#form-login").waitMe();
                            Swal.fire({
                                title: 'Cuenta registrada exitosamente!',
                                text: "Ya puedes iniciar sesión",
                                icon: 'success',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Iniciar sesión'
                            }).then((result) => {
                                $("#form-login").waitMe('hide');
                                window.location.href = "http://localhost/GreedStore/login/iniciar-session";
                            })
                        } else {
                            Swal.fire(
                                'Algo salio mal!',
                                res.msg,
                                'error'
                            )
                        }
                    }
                });
                form_register.reset();

            } else {
                inputsRegister.forEach(input => {
                    validar(expresiones[input.name], input.value, input, input.name, fields[input.name].message);
                })
            }
        });
    }

    function mostrarPassword() {
        let field = document.getElementById("pass");
        if (field.type == "password") {
            field.type = "text";
            $(".visibility-password").each(function () {
                $(this).html("visibility_off");
                $(this).prop('title', 'Mostrar')
            })
        } else {
            field.type = "password";
            $(".visibility-password").each(function () {
                $(this).html("visibility");
                $(this).prop('title', 'Ocultar')
            })
        }
    }

    $(".visibility-password").each(function () {
        $(this).click(function () {
            mostrarPassword()
        });
    });
})