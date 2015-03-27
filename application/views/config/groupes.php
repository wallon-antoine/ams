<h1>Edition des groupes</h1>
            <div class="alert alert-info">

                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <strong>Information</strong> Cette page permet d'ajouter ou modifier un groupe administratif au sein de votre université (ex: réseau, système, dévellopement ...)

            </div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#liste">Liste des groupes</a></li>
        <li><a data-toggle="tab" href="#addgroupe">Création d'un groupe</a></li>
    </ul>
    <div id="form-add" class="tab-content">
        <div id="liste" class="tab-pane fade in active">

            <table class="table table-hover table-condensed">
                <thead>
                    <th>
                        Nom du service :
                    </th>                  
                </thead>
                <tbody>
                    <?php foreach ($services->result_array() as $service): ?>
                          <tr>
                            <td>
                                <input type="text" onchange="ConfigGroupe('<?php echo $service['id_service']; ?>',this.value)" class="form-control" value="<?php echo $service['service']; ?>"  />
                            </td>
                            <td>
                                <td class="center"><a href="?delete=<?php echo $service['id_service']; ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));"><span class="glyphicon  glyphicon-trash" aria-hidden="true"></span></a></td>
                            </td>                              
                          </tr>
                    <?php endforeach; ?>
                </tbody>    
            </table>
        </div>
            <div id="addgroupe" class="tab-pane fade">
                <div class="col-md-8">
                    <div class="form-group tab-content">
                        <form class="form-inline" action="<?php echo base_url("config/groupes"); ?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputName2">Nom du groupe</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="ex: Réseau">
                            </div>
                            <button type="submit" name="addgroup" class="btn btn-default">Créer</button>
                        </form>    
                    </div>  
                </div>
          
            </div>
    </div>
