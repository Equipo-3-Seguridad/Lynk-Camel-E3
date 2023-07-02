//Comunicación Sincrona
//Accediendo a los elementos del formulario
let formulario = document.getElementById("formulario");
//Obtiene los inputs del formulario
let inputs = document.querySelectorAll("#formulario input");
//Obtiene el select de roles
let selects = document.querySelectorAll("#formulario select");

//Arreglo de las cadenas que evaluán el contenido de los inputs
let regex = {
    role: /^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,12}$/,
    email: /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/,
    password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20}$/,
};

//Por defecto están desactivados
let campos = {
    role: false,
    email: false,
    password: false,
};

//Validación del formulario en caso de haber activado algún event listener
let validarFormulario = (e) => {
    switch (e.target.name) {
        case "role":
            validarCampo(regex.role, e.target, "role");
            break;
        case "email":
            validarCampo(regex.email, e.target, "email");
            break;
        case "password":
            validarCampo(regex.password, e.target, "password");
            break;
    }
};

let validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document
            .getElementById(`grupo__${campo}`)
            .classList.remove("formulario__grupo-incorrecto");
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-correcto");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.remove("fa-times-circle");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.add("fa-check-circle");
        document
            .querySelector(`#grupo__${campo} .formulario__input-error`)
            .classList.remove("formulario__input-error-activo");
        //Guardando los valores del campo
        localStorage.setItem(`campo_${campo}`, input.value);
        campos[campo] = true;
    } else {
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-incorrecto");
        document
            .getElementById(`grupo__${campo}`)
            .classList.add("formulario__grupo-correcto");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.add("fa-times-circle");
        document
            .querySelector(`#grupo__${campo} i`)
            .classList.remove("fa-check-circle");
        document
            .querySelector(`#grupo__${campo} .formulario__input-error`)
            .classList.add("formulario__input-error-activo");
        //Guardando los valores del campo
        localStorage.setItem(`campo_${campo}`, input.value);
        campos[campo] = false;
    }
};

//Event listener de los campos del formulario
inputs.forEach((input) => {
    input.addEventListener("keyup", validarFormulario);
    input.addEventListener("blur", validarFormulario);
});

//Event listener del rol
selects.forEach((selectElement) => {
    selectElement.addEventListener("change", validarFormulario);
});

//Event listener al momento de realizar un submit
formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    if (campos.role && campos.email && campos.password) {
        document
            .getElementById("formulario__mensaje-exito")
            .classList.add("formulario__mensaje-exito-activo");
        document
            .getElementById("formulario__mensaje")
            .classList.remove("formulario__mensaje-activo");
        setTimeout(() => {
            document
                .getElementById("formulario__mensaje-exito")
                .classList.remove("formulario__mensaje-exito-activo");
        }, 2000);
        document
            .querySelectorAll(".formulario__grupo-correcto")
            .forEach((icono) => {
                icono.classList.remove("formulario__grupo-correcto");
            });
        formulario.submit();
    } else {
        document
            .getElementById("formulario__mensaje")
            .classList.add("formulario__mensaje-activo");
    }
});
