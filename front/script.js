$(document).ready(function(){

    var dataTable = $('#datos-aleatorios').DataTable({
        "order": [],
        "columns": [
            { data: "nombre" },
            { data: "apellido" },
            { data: "edad" }
        ]
    });

    var dataUsers = $('#datos-usuarios').DataTable({
        "order": [],
        "columns": [
            { data: "us_nombre" },
            { data: "us_apellido" },
            { data: "edad" },
            { data: "edit" },
            { data: "delete" }
        ]
    });
    

    $('#botonGenerar').click(function(){
        $.ajax({
            url: "back/api.php",
            type: "GET",
            success: function(response){
                dataTable.clear();
                dataTable.rows.add(response);
                dataTable.draw();
            }
        });
    });

    $('#botonGuardar').click(function(){
        var dataToSave = dataTable.data().toArray();
        $.ajax({
            url: "back/crud.php?f=createUser",
            type: "POST",
            data: { data: dataToSave },
            success: function(data){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Tu registro ha sido completado',
                    showConfirmButton: false,
                    timer: 1500
                });
                dataUsers.clear();
                dataUsers.rows.add(data);
                dataUsers.draw();
            }
        });
    });

    $.ajax({
        url: "back/crud.php?f=getUsers",
        type: "GET",
        success: function(response){
            dataUsers.clear().rows.add(response).draw();
            dataUsers.columns.adjust().draw();
        }
    });

    var id_usuario ;
    $(document).on('click', '.editar', function() {
         id_usuario = $(this).attr("id");
        $.ajax({
            url: "back/crud.php?f=getUser",
            method: "POST",
            data: {id_usuario:id_usuario},
            dataType: "json",
            success: function(data){
                $('#modalUsuario').modal('show');
                $('#nombre').val(data.nombre);
                $('#apellido').val(data.apellido);
                $('#edad').val(data.edad);
                $('#operacion').val("Editar");
            },
            error: function(jqXHR, textStatus, error){
                console.log(error);
            }
        });
    });


    $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        $('#id_usuario').val(id_usuario);
        let form_data = $(this).serialize();
        $.ajax({
            url: "back/crud.php?f=editUser",
            method: "POST",
            data: form_data,
            success: function(data){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Tu registro ha sido completado',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalUsuario').modal("hide");
                dataUsers.clear();
                dataUsers.rows.add(data);
                dataUsers.draw();
            },
            error: function(jqXHR, textStatus, error){
                console.log(error);
            }
        });
    });

    $(document).on('click', '.borrar', function(){
        id_usuario = $(this).attr('id');
        if (confirm("estar seguro de borrar el registro " + id_usuario)) {
            $.ajax({
                url: "back/crud.php?f=deleteUser",
                method: "POST",
                data: {id_usuario:id_usuario},
                success: function(data){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Tu registro ha sido eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    dataUsers.clear();
                    dataUsers.rows.add(data);
                    dataUsers.draw();
                }
            });
        }else{
            return false;
        }
    });
    
    // $(document).on('DOMContentLoaded', '#datos-usuarios', function(){

    // });

});