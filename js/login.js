$(document).ready(function () {
    // Insertar contenedores de alerta dinámicamente arriba del título "Identificación"
    $('.login-right .mb-4').first().prepend(`
        <div id="errorMessage" class="alert alert-danger p-2 small" style="display:none; border-radius:8px;"></div>
        <div id="successMessage" class="alert alert-success p-2 small" style="display:none; border-radius:8px;"></div>
    `);

    $('#formLogin').on('submit', function (e) {
        e.preventDefault();
        // Limpiar estados
        $('#errorMessage, #successMessage').hide();
        const btn = $(this).find('.btn-login');
        const originalText = btn.text();

        let correo = $("#correo").val().trim();
        let contrasena = $("#contrasena").val().trim();
        
        // Validaciones rápidas
        if (!correo || !contrasena) {
            mostrarError("Por favor, completa todos los campos.");
            return;
        }

        btn.prop('disabled', true).text('Verificando identidad...');

        $.ajax({
            url: 'Login/iniciarSesion', // Ajusta a tu ruta real
            type: 'POST',
            data: {
                'correo': correo,
                'password': contrasena
            },
            success: function (response) {
            
                if (response.success) {
                    mostrarExito(response.mensaje || "Bóveda descifrada. Redirigiendo...");
                    setTimeout(() => {
                        window.location.href = "dashboard"; // Tu página de inicio tras login
                    }, 1500);
                } else {
                    mostrarError(response.mensaje || "Llave maestra o correo incorrectos.");
                    btn.prop('disabled', false).text(originalText);
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                mostrarError("Error de comunicación con el servidor.");
                btn.prop('disabled', false).text(originalText);
            }
        });
    });

    function mostrarError(msg) {
        $('#errorMessage').text(msg).stop().fadeIn();
    }

    function mostrarExito(msg) {
        $('#successMessage').text(msg).stop().fadeIn();
    }

    $(document).on('click', '.btn-ver', function(){

    let input = $(this).closest('.vault-card').find('.pass-field');

    if(input.attr('type') === 'password'){
        input.attr('type','text');
    }else{
        input.attr('type','password');
    }
});
});