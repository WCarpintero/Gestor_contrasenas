$(document).ready(function () {

    $('#formRegistro').on('submit', function (e) {
        e.preventDefault();

        // Limpiar mensajes
        $('#errorMessage').hide();
        $('#successMessage').hide();

        // Obtener valores (puedes usar serialize() para ahorrar código)
        let formData = {
            nombre: $('input[name="nombre"]').val().trim(),
            apellido: $('input[name="apellido"]').val().trim(),
            correo: $('input[name="correo"]').val().trim(),
            telefono: $('input[name="telefono"]').val().trim(),
            master_key: $('input[name="master_key"]').val().trim(),
            confirm_key: $('input[name="confirm_key"]').val().trim()
        };

        // VALIDACIONES
        if (!formData.nombre) {
            mostrarError("El nombre es obligatorio");
            return;
        }

        if (!formData.apellido) {
            mostrarError("El apellido es obligatorio");
            return;
        }

        if (!formData.correo) {
            mostrarError("El correo es obligatorio");
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.correo)) {
            mostrarError("El correo no es válido");
            return;
        }

        if (!formData.telefono) {
            mostrarError("El teléfono es obligatorio");
            return;
        }

        const phoneRegex = /^[0-9+\s()-]{7,}$/;
        if (!phoneRegex.test(formData.telefono)) {
            mostrarError("El teléfono no es válido");
            return;
        }

        if (!formData.master_key) {
            mostrarError("La contraseña es obligatoria");
            return;
        }

        if (formData.master_key.length < 6) {
            mostrarError("La contraseña debe tener al menos 6 caracteres");
            return;
        }

        if (!formData.confirm_key) {
            mostrarError("Debes confirmar la contraseña");
            return;
        }

        if (formData.master_key !== formData.confirm_key) {
            mostrarError("Las contraseñas no coinciden");
            return;
        }

        $.ajax({
            url: 'Usuarios/registrar',
            type: 'POST',
            data: formData,
            success: function (response) {

                if (response.success) {
                    mostrarExito("Cuenta creada correctamente. Redirigiendo...");
                    // Reset formulario
                    $('#formRegistro')[0].reset();
                    // Redirección
                    setTimeout(function () {
                        window.location.href = "inicio";
                    }, 2000);

                } else {
                    mostrarError(data.mensaje || "Error en el registro");
                }
            },
            error: function () {
                mostrarError("Error de conexión con el servidor");
            }
        });

    });

    // FUNCIONES
    function mostrarError(msg) {
        $('#errorMessage').text(msg).fadeIn();
    }

    function mostrarExito(msg) {
        $('#successMessage').text(msg).fadeIn();
    }

}); 