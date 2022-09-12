<?php
require_once("../Classes/crud.php");
$taches = new crud();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules//sweetalert2/dist/sweetalert2.min.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../node_modules/popper.js/dist/popper.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../font/font-awesome-4.7.0/css/font-awesome.min.css">

    <title>Gestion Ensiegnants</title>
    <?php require_once("../pages/Menus/Navbar.php") ?>
</head>

<body>


    <div class="d-flex" id="wrapper">
        <!-- sidebar -->
        <div class="bg-primary" style="z-index: 0;">
            <?php require_once("../pages/Menus/Sidebar.php") ?>
        </div>
        <!-- sidebar end -->
        <div class="container" style="z-index:0;">
            <!-- Debut card -->
            <div class="container-fluid px-4">
                <div class="row g-3 my-3">
                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h4 class="fs-2">234 .000</h4>
                                <p class="fs-5">Eleves</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h4 class="fs-2">234 .000</h4>
                                <p class="fs-5">Eleves</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h4 class="fs-2">234 .000</h4>
                                <p class="fs-5">Eleves</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h4 class="fs-2">234 .000</h4>
                                <p class="fs-5">Eleves</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin card -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-center text-danger">Tableau de Bord</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2 text-primary">Tout les enseignants</h5>
                    </div>

                    <div class="clog-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-right"><i class="fa fa-user-plus fa-lg" data-toggle="modal" data-target="#addModal"> Nouveau</i>
                        </button>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="btn btn-success m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                            Exporter</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="btn btn-danger m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                            Importer</a>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive" id="showUser">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour enregistrement -->
    <!-- The Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau Enseignant</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="form-data">
                        <div class="form-group">
                            <input type="text" name="noms" class="form-control" placeholder="noms complet" required>
                        </div>
                        <div class="form-group">
                            <select name="sexe" class="form-control" required>
                                <option value="Autres">Selectionner le sexe..</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="grade" class="form-control" required>
                                <option value="">Selectionner le grade..</option>
                                <option value="D6">Diplome d'Etat</option>
                                <option value="Licencie">Licencié</option>
                                <option value="Gradue">Gradué</option>
                                <option value="Master">Master</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="domaine" class="form-control" required>
                                <option value="">Selectionner Domaine..</option>
                                <label value="Anglais">Anglophne</label>
                                <option value="Pedagogie">Pedagogue</option>
                                <option value="Biologie">Biologiste</option>
                                <option value="Assistant Social">Assistant Social</option>
                                <option value="Français">Franciste</option>
                                <option value="Mathematique">Mathematicien</option>
                                <option value="Comptabilite">Comptable</option>
                                <option value="Chimie">Chimiste</option>
                                <option value="Informatique">Informaticien</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="adresse" class="form-control" placeholder="adresse" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="telephone" class="form-control" placeholder="+243 813678926" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" class="btn btn-primary btn-block" value="ENREGISTRER">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modification Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Modification Enseignant</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="edit-form-data">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <input type="text" name="noms" class="form-control" id="noms" required>
                        </div>
                        <div class="form-group">
                            <select name="sexe" class="form-control" id="sexe" required>
                                <option value="Autres">Selectionner le sexe..</option>
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="grade" class="form-control" id="grade" required>
                                <option value="">Selectionner le grade..</option>
                                <option value="D6">Diplome d'Etat</option>
                                <option value="Licencie">Licencié</option>
                                <option value="Gradue">Gradué</option>
                                <option value="Master">Master</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="domaine" class="form-control" id="domaine" required>
                                <option value="">Selectionner Domaine..</option>
                                <label value="Anglais">Anglophne</label>
                                <option value="Pedagogie">Pedagogue</option>
                                <option value="Biologie">Biologiste</option>
                                <option value="Assistant Social">Assistant Social</option>
                                <option value="Français">Franciste</option>
                                <option value="Mathematique">Mathematicien</option>
                                <option value="Comptabilite">Comptable</option>
                                <option value="Chimie">Chimiste</option>
                                <option value="Informatique">Informaticien</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="adresse" class="form-control" id="adresse" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="telephone" class="form-control" id="telephone" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="update" id="update" class="btn btn-danger btn-block" value="MODIFIER">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la fenetre modal Modification-->

<!-- Fin de la fenetre modal -->
    <!-- Les lebrairies Javascript -->
    <script>
        /** fonction pour Afficher les donnes avec ajax  */
        $(document).ready(() => {
            showAllUser()

            function showAllUser() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(reponse) {
                        // console.log(reponse);
                        $("#showUser").html(reponse);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }

            /** Fonction insert dans la bdd */
            $("#insert").click(function(e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url:"action.php",
                        type:"POST",
                        data: $("#form-data").serialize()+"&action=insert",
                        success: function(reponse) {
                        Swal.fire(
                            'Felicitation!',
                            'Enseignant Ajouté(e) avec success !',
                            'success'
                            )

                            $("#addModal").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUser();
                        }
                    });
                }
            })

            /** La fonction pour la modification  */
            $("body").on("click",".editBtn",function(e){
                e.preventDefault();
                edit_id=$(this).attr('id');

                $.ajax({
                    url:"action.php",
                    type:"POST",
                    data:{edit_id:edit_id},
                    success:function(reponse){
                       data=JSON.parse(reponse);
                        
                       $("#id").val(data.id);
                       $("#noms").val(data.noms);
                       $("#sexe").val(data.sexe);
                       $("#grade").val(data.grade);
                       $("#adresse").val(data.adresse)
                       $("#domaine").val(data.domaine);
                       $("#telephone").val(data.telephone);
                    }
                })
            });

            /** Modification des donnees */
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url:"action.php",
                        type:"POST",
                        data: $("#edit-form-data").serialize()+"&action=update",
                        success: function(reponse) {
                        Swal.fire(
                            'Felicitation!',
                            'Enseignant Modifier avec success !',
                            'success'
                            )

                            $("#editModal").modal('hide');
                            $("#edit-form-data")[0].reset();
                            showAllUser();
                        }
                    });
                }
            })

            /** Fonction Supprimer de la table */
            $("body").on('click','.deleteBtn',function(e){
                e.preventDefault();
                var td=$(this).closest('tr');
                del_id=$(this).attr('id');

                Swal.fire
                ({
                    title: 'Voulez-vous supprimer cette information ?',
                    text: "une fois supprimer vous ne l'aurez plus !!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes,Delete !!!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        url:"action.php",
                        type:"POST",
                        data: {del_id:del_id},
                        success: function(reponse) {
                            showAllUser();
                        }
                        
                    });
                    }
                })
            })
        });
    </script>
</body>

</html>