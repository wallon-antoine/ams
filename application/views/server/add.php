<h1>Ajout d'un nouveau serveur dans la base d'inventaire</h1>

  <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#detailserveur">Detail du serveur</a></li>
        <li><a data-toggle="tab" href="#referents">Réferents</a></li>
        <li><a data-toggle="tab" href="#divers">Divers</a></li>
    </ul>



<?php echo validation_errors(); ?>

<form action="<?php echo base_url("server/add"); ?>" method="post" accept-charset="utf-8" name="ajout_form">   
    <div id="form-add" class="tab-content">
        <div id="detailserveur" class="tab-pane fade in active">

            <div class="form-group required">
                <label class="control-label">
                        Nom du serveur :
                </label>
                        <?php echo form_input('nom', set_value('nom'), 'class=form-control'); ?>
            </div>
            <div class="form-group">
                <label>
                        OS :
                </label>
                        <select name="os" class="form-control">
                            <option value="linux">Linux</option>
                            <option value="unix">Unix</option>
                            <option value="Winwdows">Windows</option>
                            <option value="mac">Mac</option>
                        </select>                    
            </div>        
            <div class="form-group required">
                <label class="control-label">
                        Distribution :    
                </label>
                        <?php echo form_input('distrib', set_value('distrib'), 'class="form-control" id="getdistrib"'); ?>
            </div>
            <div class="form-group">
                <label>
                        Dépent de  : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="De quelle autre(s) serveur(s) a t'il besoin pour fonctionner"></i>    
                </label>
                        <?php echo form_input('dependance', set_value('dependance'), 'class="form-control" id="getservername"'); ?>
            </div>
            <div class="form-group required">
                <label class="control-label">
                        IP :
                </label>
                        <?php echo form_input('ip', set_value('ip'), 'class=form-control placeholder="0.0.0.0"'); ?>
            </div>
            <div class="form-group">
                <label class="control-label">
                        IP2 : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="Si il y a une seconde ip (ex: ip virtuelle) sur le serveur inscrivez là ici"></i>
                </label>
                        <?php echo form_input('ip2', set_value('ip2'), 'class=form-control placeholder="0.0.0.0"'); ?>
            </div>            
            <div class="form-group">
                <label class="control-label">
                        URL :
                </label>
                <?php echo form_input('url', set_value('url'), 'class=form-control placeholder="http://"'); ?>
            </div>
            <div class="form-group required">
                <label class="control-label">
                        Description du serveur : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="Décrivez ici à quoi sert le serveur"></i>
                </label>
                        <?php echo form_textarea('description', set_value('description'), 'class=form-control'); ?>
            </div>
            <a class="btn btn-primary btnNext">Suivant</a>
        </div>

        <div id="referents" class="tab-pane fade">
            <div class="form-group required">
                <label class="control-label">
                        Nom du référent 1 : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="Donnez le nom de l'administrateur du serveur"></i>
                </label>
                        <?php echo form_input('referent', set_value('referent'), 'class="form-control getreferent"'); ?>
            </div>
            <div class="form-group">
                <label>
                        Nom du référent 2 : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="Donnez le nom de la personne qui remplace l'administrateur lors de son absence"></i>
                </label>
                        <?php echo form_input('referent2', set_value('referent2'), 'class="form-control getreferent"'); ?>
            </div>
            <div class="form-group">
                <label class="control-label">
                        Nom du référent 3 : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="Donnez le nom de l'administrateur secondaire"></i>
                </label>
                        <?php echo form_input('referent3', set_value('referent3'), 'class="form-control getreferent"'); ?>
            </div>
            <a class="btn btn-primary btnPrevious">Précédent</a>
            <a class="btn btn-primary btnNext">Suivant</a>
        </div>

        <div id="divers" class="tab-pane fade">
            <div class="form-group">
                <label class="control-label">
                        Serveur de base de données utilisé :
                </label>
                        <?php echo form_input('bdd', set_value('bdd'), 'class=form-control'); ?>
            </div>
            <div class="form-group required">
                <label class="control-label">
                        Type de machine :
                </label>
                            <?php
                            if(set_value('type_machine') == "physique"){
                                $selected = " selected=selected ";
                            } else {
                            $selected = "";
                            }
                            ?>
                        <select name="type_machine" class="form-control">
                            <option value="virtuel">Virtuel</option>
                            <option <?php echo $selected; ?> value="physique">Physique</option>
                        </select>
            </div>
            <div class="form-group">
                <label class="control-label">
                        Quel service utilise ce serveur :
                </label>
                <select name="id_groupes" class="form-control">
                    <?php foreach ($liste_service->result_array() as $row): ?>

                <option <?php echo $selected; ?> value="<?php echo $row['id_service']; ?>"><?php echo $row['service']; ?></option>
                <?php endforeach; ?>

                        </select><br />

                <?php echo form_submit('submit', 'Créer','class="btn btn-primary"'); ?> 
            </div>

        </div>

    </div>
</form>