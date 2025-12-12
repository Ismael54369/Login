document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    if(form) {
        form.addEventListener('submit', function(e) {
            if (!validar()) e.preventDefault();
        });
    }

    document.getElementById('userInput').addEventListener('input', () => limpiar('user'));
    document.getElementById('passInput').addEventListener('input', () => limpiar('pass'));
});

function validar() {
    let user = document.getElementById('userInput').value.trim();
    let pass = document.getElementById('passInput').value.trim();
    let ok = true;

    // Usuario 8-15 caracteres
    if (user.length < 8 || user.length > 15) {
        mostrarError('user', 'Usuario: entre 8 y 15 caracteres.');
        ok = false;
    }

    // Contraseña segura (Regex Whitelist)
    const regex = /^[a-zA-Z0-9@#$%*!_\-]{8,15}$/;
    if (!regex.test(pass)) {
        mostrarError('pass', 'Contraseña inválida o caracteres no permitidos.');
        ok = false;
    }

    // Obligatorio Mayús y Minús
    if (!/[A-Z]/.test(pass) || !/[a-z]/.test(pass)) {
        mostrarError('pass', 'Falta mayúscula o minúscula.');
        ok = false;
    }

    return ok;
}

function mostrarError(id, msg) {
    document.getElementById(id + 'Error').innerText = msg;
    document.getElementById(id + 'Error').style.display = 'block';
    document.getElementById(id + 'Input').classList.add('is-invalid');
}

function limpiar(id) {
    document.getElementById(id + 'Error').style.display = 'none';
    document.getElementById(id + 'Input').classList.remove('is-invalid');
}