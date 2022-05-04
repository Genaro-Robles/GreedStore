const form_login = document.getElementById('form-login');
const form_register = document.getElementById('form-register');
const inputsLogin = document.querySelectorAll('#form-login input');
const inputsRegister = document.querySelectorAll('#form-register input');

$("p.password").hide();
$("p.email").hide();
const expresiones = {
    password: /^.{8,12}$/, // 8 a 16 digitos.
    email: /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i,
    phone: /^\d{9,9}$/,
    name: /^[ÁÉÍÓÚA-Z][a-záéíóú]+(\s+[ÁÉÍÓÚA-Z]?[a-záéíóú]+)*$/
}
const fields = {
    password: false,
    email: false,
    name: false,
    phone: false,
    age: false
}
const validateForm = (e) => {

    switch (e.target.name) {
        case 'password':
            validar(expresiones.password, e.target.value, e.target, 'password', "La contraseña debe tener entre 8 y 16 caracteres");
            break;
        case 'email':
            validar(expresiones.email, e.target.value, e.target, 'email', "El email no es valido");
            break;
        case 'name':
            validar(expresiones.name, e.target.value, e.target, 'name', "El nombre no es valido");
            break;
        case 'phone':
            validar(expresiones.phone, e.target.value, e.target, 'phone', "El número de celular no es valido");
            break;
        case 'age':
            validar(expresiones.age, e.target.value, e.target, 'age', "Debes ser mayor de edad");
            break;
    }
}

const validar = (expresion, val, input, field, message) => {
    if (field != "age") {
        if (expresion.test(val)) {
            $(input.parentNode).removeClass("mdc-text-field--invalid")
            $(`p.${field}`).hide();
            fields[field] = true;
        } else {
            $(input.parentNode).addClass("mdc-text-field--invalid")
            $(`p.${field}`).html(message)
            $(`p.${field}`).show();
            fields[field] = false;
        }
    } else {
        if (val >= 18) {
            $(input.parentNode).removeClass("mdc-text-field--invalid")
            $(`p.${field}`).hide();
            fields[field] = true;
        } else {
            $(input.parentNode).addClass("mdc-text-field--invalid")
            $(`p.${field}`).html(message)
            $(`p.${field}`).show();
            fields[field] = false;
        }
    }
}

if (form_login) {
    inputsLogin.forEach(input => {
        input.addEventListener('keyup', validateForm);
        input.addEventListener('blur', validateForm);
    })

    form_login.addEventListener('submit', function (e) {
        e.preventDefault();

        if (fields.password && fields.email) {

            let correo = $("[name=email]").val();
            let pass = $("[name=password]").val();

            $.post("http://localhost/GreedStore/app/controllers/ctrAutenticacion.php?action=login", { correo, pass }, function (data) {

                if (data == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Verifique sus credenciales'
                    })
                } else {

                    window.location.href = "http://localhost/GreedStore";
                }
            })

            //form_register.reset();

        } else {
            alert("Por favor completa todos los campos");
        }

    });
} else {
    inputsRegister.forEach(input => {
        input.addEventListener('keyup', validateForm);
        input.addEventListener('blur', validateForm);
    })

    form_register.addEventListener('submit', function (e) {
        e.preventDefault();
        if (fields.name && fields.email && fields.password && fields.phone && fields.age) {

            let nombre = $("[name=name]").val();
            let correo = $("[name=email]").val();
            let pass = $("[name=password]").val();
            let celular = $("[name=phone]").val();
            let edad = $("[name=age]").val();


            $.post("http://localhost/GreedStore/app/controllers/ctrAutenticacion.php?action=register", { nombre, correo, pass, celular, edad }, function (data) {

                if (data == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El correo ya se encuentra registrado'
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        window.location.href = "http://localhost/GreedStore/login/iniciar-session";
                    })
                }
            })

            form_register.reset();

        } else {
            alert("Por favor completa todos los campos");
        }
    });
}

function mostrarPassword() {
    let field = document.getElementById("pass");
    if (field.type == "password") {
        field.type = "text";
        $(".visibility-password").each(function () {
            $(this).html("visibility");
            $(this).prop('title', 'Mostrar')
        })
    } else {
        field.type = "password";
        $(".visibility-password").each(function () {
            $(this).html("visibility_off");
            $(this).prop('title', 'Ocultar')
        })
    }
}

$(".visibility-password").each(function () {
    $(this).click(function () {
        mostrarPassword()
    });
});

