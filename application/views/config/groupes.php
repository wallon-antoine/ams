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
                        Id du service
                    </th>
                    <th>
                        Nom du service :
                    </th>
                </thead>
                <tbody>
                    <?php foreach ($services->result_array() as $service): ?>
                          <tr>
                            <td>
                                <?php echo $service['id_service']; ?>
                            </td>
                            <td>
                                <input type="text" class="form-control" value="<?php echo $service['service']; ?>" />
                            </td>                  
                          </tr>
                    <?php endforeach; ?>
<!--                          <tr>
                              <td>
                                  
                                  <button class="add_field_button btn btn-default">Ajouter un nouveau groupe</button>
                              </td>
                              <td>
                                    <span class="input_fields_wrap"> </span>
                              </td>
                          </tr>-->
                </tbody>    
            </table>
        </div>
            <div id="addgroupe" class="tab-pane fade">
                <div class="col-md-8">
                    <div class="form-group tab-content">
                        <form class="form-inline" name="addGroup" action="<?php echo base_url("config/groupes"); ?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputName2">Nom du groupe</label>
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="ex: Réseau">
                            </div>
                            <button type="submit" class="btn btn-default">Créer</button>
                        </form>    
                    </div>  
                </div>
          
            </div>
    </div>
