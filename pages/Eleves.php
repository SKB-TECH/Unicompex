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

    <title>Gestion eleves</title>
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
            <div class="container-fluid px-4" style="margin-top:70px;">
                <div class="row g-3 my-3">
                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php
                                    
                                    $homme=$taches->Total('eleves','sexe','M');
                                    $femme=$taches->Total('eleves','sexe','F');
                
                                ?>
                            <i class="fa fa-male" aria-hidden="true" style="font-size: 40px;"></i>
                                <h4 class="fs-2"><?php echo($homme)?></h4>
                                <p class="fs-5">Hommes</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                            <i class="fa fa-female" aria-hidden="true" style="font-size: 40px;"></i>
                                <h4 class="fs-2"><?php echo($femme)?></h4></h4>
                                <p class="fs-5">Femmes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php
                                    
                                    $ensei=$taches->Total('enseignants','domaine','Enseignant');
                
                                ?>
                            <i class="fa fa-male" aria-hidden="true" style="font-size: 40px;"></i>
                                <h4 class="fs-2"><?php echo($ensei)?></h4>
                                <p class="fs-5">Enseignants</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="p-3 bg-white  shadow-lg d-flex justify-content-around align-items-center rounded">
                            <div>
                            <i class="fa fa-users text-2xl" aria-hidden="true" style="font-size: 40px;"></i>
                                <h4 class="fs-2"><?php echo($homme+$femme)?></h4>
                                <p class="fs-5">Total </p>
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
                        <h5 class="mt-2 text-primary">Registre des ??l??ves</h5>
                    </div>

                    <div class="clog-lg-6">
                        <button type="button" class="btn btn-primary m-1 float-right"><i class="fa fa-user-plus fa-lg" data-toggle="modal" data-target="#addModal"> Nouveau</i>
                    </button>&nbsp;&nbsp;&nbsp;
                    <a href="actions/actionEleve.php?export=excel" class="btn btn-success m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                    Exporter</a>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger m-1 float-lg"><i class="fa fa-table fa-lg" data-toggle="modal" data-target="#importExcel"> Import</i>
                        <!-- <a href="#" class="btn btn-danger m-1 float-lg"><i class="fa fa-table fa-lg"></i>
                            Importer </a> -->
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
                    <h5 class="modal-title">Un ??l??ve: Ajout</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="form-data">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" class="form-control" placeholder="nom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                            <label for="nom">Postnom :</label>
                            <input type="text" name="postnom" class="form-control" placeholder="postnom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input type="text" name="prenom" class="form-control" placeholder="prenom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                        <label for="sexe">Sexe : </label>
                            <select name="sexe" class="form-control" required>
                                <option value="">Selectionner le sexe...</option>
                                <option value="M">Masculin</option>
                                <option value="F">Feminin</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="sexe">Classe :  </label>
                            <select name="classe" class="form-control" required>
                                <option value="">Selectionner ...</option>
                                <option value="7emeEB/A">7emeEB/A</option>
                                <option value="7emeEB/B">7emeEB/B</option>
                                <option value="7emeEB/C">7emeEB/C</option>
                                <option value="8emeEB/A">8emeEB/A</option>
                                <option value="8emeEB/B">8emeEB/B</option>
                                <option value="8emeEB/C">8emeEB/C</option>
                                <option value="IemeHP/A">IemeHP/A</option>
                                <option value="IemeHP/B">IemeHP/B</option>
                                <option value="IemeHTS">IemeHTS</option>
                                <option value="IIemeHP">IIemeHP</option>
                                <option value="IIemeHTS">IIemeHTS</option>
                                <option value="IIIemeHP">IIIemeHP</option>
                                <option value="IIIemeHTC">IIIemeHTS</option>
                                <option value="IVemeHP">IVemeHP</option>
                                <option value="IVemeHTC">IVemeHTS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance :</label>
                            <input type="date" name="date_naissance" class="form-control" placeholder="Date de naissance" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu de naissance :</label>
                            <input type="text" name="lieu_naissance" class="form-control"  placeholder="Lieu de naissance" required>
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
                    <h5 class="modal-title">Eleve: Modification </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="POST" id="edit-form-data">
                        <input type="hidden" id="id" name="id">
                    <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input  id="nom" type="text" name="nom" class="form-control" placeholder="nom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                            <label for="nom">Postnom :</label>
                            <input id="postnom" type="text" name="postnom" class="form-control" placeholder="postnom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input id="prenom" type="text" name="prenom" class="form-control" placeholder="prenom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                        <label for="sexe">Sexe : </label>
                            <select name="sexe" id="sexe" class="form-control" required>
                                <option value="">Selectionner le sexe...</option>
                                <option value="M">Masculin</option>
                                <option value="F">Feminin</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="sexe">Classe :  </label>
                            <select name="classe" id="classe" class="form-control" required>
                            <option value="">Selectionner ...</option>
                            <option value="">Selectionner ...</option>
                                <option value="7emeEB/A">7emeEB/A</option>
                                <option value="7emeEB/B">7emeEB/B</option>
                                <option value="7emeEB/C">7emeEB/C</option>
                                <option value="8emeEB/A">8emeEB/A</option>
                                <option value="8emeEB/B">8emeEB/B</option>
                                <option value="8emeEB/C">8emeEB/C</option>
                                <option value="IemeHP/A">IemeHP/A</option>
                                <option value="IemeHP/B">IemeHP/B</option>
                                <option value="IemeHTS">IemeHTS</option>
                                <option value="IIemeHP">IIemeHP</option>
                                <option value="IIemeHTS">IIemeHTS</option>
                                <option value="IIIemeHP">IIIemeHP</option>
                                <option value="IIIemeHTC">IIIemeHTS</option>
                                <option value="IVemeHP">IVemeHP</option>
                                <option value="IVemeHTC">IVemeHTS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance :</label>
                            <input id="date_naissance" type="date" name="date_naissance" class="form-control" placeholder="Date de naissance" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu de naissance :</label>
                            <input type="text" name="lieu_naissance" class="form-control" placeholder="Lieu de naissance" id="lieu_naissance" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" id="update" class="btn btn-danger btn-block"  value="MODIFIER">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la fenetre modal Modification-->

<!-- import excel -->
        <!-- Modification Modal -->
        <div class="modal fade" id="importExcel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Importer la liste des eleves</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form method="POST" id="edit-form-data" action="./actions/excelUpload.php" enctype="multipart/form-data" >
                      <div class="form-group">
                            <label for=""> Importez un fichier excel :</label>
                            <input type="file" name="file" class="form-control" placeholder="nom de l'??l??ve" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="Submit" id="import" class="btn btn-success btn-block" value="IMPORTER">
                        </div>
		                <p>Prendre un modele avant importation : <a href="../Classes/excel/demo/demoEleves.ods"><strong>Demo.ods</strong></a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de la fenetre modal import excel -->


    <!-- Les lebrairies Javascript -->
    <script>
        /** fonction pour Afficher les donnes avec ajax  */
        $(document).ready(() => {
            showAllUser()
            function showAllUser() {
                $.ajax({
                    url: "actions/actionEleve.php",
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
                        url:"actions/actionEleve.php",
                        type:"POST",
                        data: $("#form-data").serialize()+"&action=insert",
                        success: function(reponse) {
                        Swal.fire(
                            'Felicitation!',
                            'El??ve Ajout??(e) avec success !',
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
                    url:"actions/actionEleve.php",
                    type:"POST",
                    data:{edit_id:edit_id},
                    success:function(reponse){
                       data=JSON.parse(reponse);
                        console.log(data)
                       $("#id").val(data.id);
                       $("#nom").val(data.nom);
                       $("#postnom").val(data.postnom);
                       $("#prenom").val(data.prenom);
                       $("#sexe").val(data.sexe);
                       $("#date_naissance").val(data.date_naissance);
                       $("#lieu_naissance").val(data.lieu_naissance)
                       $("#classe").val(data.classe);
                    }
                })
            });
            /** Modification des donnees */
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url:"actions/actionEleve.php",
                        type:"POST",
                        data: $("#edit-form-data").serialize()+"&action=update",
                        success: function(reponse) {
                            console.log(reponse)
                        Swal.fire(
                            'Felicitation!',
                            ' modification reussi !',
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
                var tr=$(this).closest('tr');
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
                        url:"actions/actionEleve.php",
                        type:"POST",
                        data: {del_id:del_id},
                        success: function(reponse) {
                           tr.css('background-color','#ff6666')
                            Swal.fire(
                            'Felicitation!!!',
                            'Suppression effectu??e avec success !',
                            'success'
                            )
                            showAllUser();
                        }
                        
                    });
                    }
                })
            })


            /** Info plus */
            $("body").on("click",'.infoBtn',function(e)
            {
                e.preventDefault();
                info_id= $(this).attr('id');
                $.ajax({
                    url:"actions/actionEleve.php",
                    type:"POST",
                    data:{info_id:info_id},
                    success:function(reponse){
                        data=JSON.parse(reponse);
                        Swal.fire(
                            {
                                title:'<Strong class="text-left"> Code Eleve :'+data.id+'</Strong>',
                                type:"info",
                                html:'<b class="text-left">Noms:'+data.nom+" "+data.postnom+" "+data.prenom+
                                '</b></br><b class="text-left">Sexe:'+data.sexe+'</b></br><b class="text-left">Classe:'+data.classe+'</b>',
                                showCancelButton:true
                            }
                        )
                        showAllUser();
                    }
                })
                
                
            });
        });
    </script>
</body>

</html>