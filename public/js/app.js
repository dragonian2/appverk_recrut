const $ = (el) => {
    return document.querySelector(el)
}

// -> simple routing (on click)
const routes = {
    '#btasks': '/',
    '#bsignin': '/login',
    '#blogout': '/logout'
}

Object.entries(routes).forEach(el => {
    const element = $(el[0])
    if (element) {
        element.addEventListener('click', () => {
            window.location.href = el[1]
        });
    }
});
// <-

// -> login form - show/hide password
const toggle = $('.togglePasswLink')
if (toggle) {
    toggle.addEventListener('click', () => {
        const passwFieldIds = [
            'login_password'
        ]
        let passwField = null;
        passwFieldIds.forEach(el => {
            const field = $(`#${el}`);
            if (field) {
                passwField = field;
            }
        });

        if (!passwField) {
            return
        }

        let ftype = passwField.getAttribute('type') === 'password' ? 'text' : 'password'

        if (ftype === 'password') {
            $('#show-hide-p').textContent = 'Pokaż'
            $('#togglePassword').classList.remove('bi-eye-slash')
            $('#togglePassword').classList.add('bi-eye')
        } else {
            $('#show-hide-p').textContent = 'Ukryj'
            $('#togglePassword').classList.remove('bi-eye')
            $('#togglePassword').classList.add('bi-eye-slash')
        }

        passwField.setAttribute('type', ftype)
    });
}
// <-

// -> clearing flash msgs onclick (login form)
const loginBtn = $('#login');
if (loginBtn) {
    loginBtn.addEventListener('click', () => {
        const alertBox = $('.alert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    });
}
// <-