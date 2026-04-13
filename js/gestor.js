$(document).ready(function () {
    cargarCategorias();

    // 1. Mostrar/Ocultar contraseña en el modal
    $('#togglePass').on('click', function () {
        const input = $('#inputPass');
        const icon = $(this).find('i');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });

    
    $('#formRegistro').on('submit', function (e) {
        e.preventDefault(); 
        const formData = $(this).serialize() + '&case=guardarCredenciales';

        $.ajax({
            url: 'Gestor/guardarCredenciales',
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('.btn-add').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
            },
            success: function (json) {
                if (json.success) {
                    toastr.success('¡Contraseña guardada con éxito!', 'Éxito!');
                    $('#formRegistro')[0].reset();
                    $('#modalNueva').modal('hide');
                } else {
                    toastr.error('¡Erorr al intentar guardar el registro!', 'Error!');
                }
                // refrescar la lista de tarjetas
                // cargarContrasenas(); 
            },
            complete: function () {
                $('.btn-add').prop('disabled', false).html('<i class="bi bi-plus-lg me-2"></i> Nuevo Elemento');
            }
        });
    });
});

function cargarCategorias() {
    $.ajax({
        url: 'Gestor/listarCategorias',
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            const select = $('select[name="categoria"]');
            select.empty();
            select.append('<option value="">Seleccione una categoría...</option>');

            if (json.data.length > 0) {
                $.each(json.data, function (index, cat) {
                    select.append(`<option value="${cat.id_categoria}">${cat.categoria}</option>`);
                });
            } else {
                select.append('<option value="Otros">Otros</option>');
            }
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar categorías:", error);
        }
    });
}

function cargarContrasenas(){
    $.ajax({
        url: 'Gestor/listarCredenciales',
        type: 'GET',
        data: {case:'listarCredenciales'},
        dataType: 'json',
        success: function(res){

            let html = '';

            res.data.forEach(item => {

                html += `
                <div class="col-md-4">
                    <div class="vault-card">
                        
                        <h6>${item.sitio}</h6>
                        <small>${item.categoria}</small>

                        <p>${item.usuario_sitio}</p>

                        <input type="password" 
                               value="${item.contrasena}" 
                               class="form-control pass-field mb-2">

                        <button class="btn btn-sm btn-outline-info btn-ver">
                            <i class="bi bi-eye"></i>
                        </button>

                    </div>
                </div>`;
            });

            $('#vaultContainer').html(html);
        }
    });
}

