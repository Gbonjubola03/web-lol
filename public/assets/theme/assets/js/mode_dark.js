document.addEventListener('DOMContentLoaded', function () {
    var checkbox = document.getElementById('darkModeCheckbox');

    // Verifica o cookie ao carregar a página
    if (getCookie('darkMode') === 'true') {
        document.documentElement.classList.add('dark-mode');
        checkbox.checked = true;
    }

    // Adiciona o evento de mudança para o checkbox
    checkbox.addEventListener('change', function () {
        if (this.checked) {
            document.documentElement.classList.add('dark-mode');
            setCookie('darkMode', true, 365);
        } else {
            document.documentElement.classList.remove('dark-mode');
            setCookie('darkMode', false, 365);
        }
    });

    // Funções para lidar com cookies
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
});
