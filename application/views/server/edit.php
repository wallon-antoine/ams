<h1><?php echo $server->nom; ?></h1>
  <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#detailserveur">Detail du serveur</a></li>
        <li><a data-toggle="tab" href="#referents">Réferents</a></li>
        <li><a data-toggle="tab" href="#divers">Divers</a></li>
    </ul>

<?php echo validation_errors(); ?>
  
<?php 
//Si admin ou referent de la fiche ou chef de service on peut editer la fiche 
if(is_admin() || $server->referent == $user || is_role() == 4):     
?> 
  <form id="ajaxform" action="<?php echo base_url("server/edit/".$ids); ?>" method="post" accept-charset="utf-8" role="form">
<?php endif; ?>

       
<div id="form-add" class="tab-content">
    <div id="detailserveur" class="tab-pane fade in active">
        <div class="form-group tab-content">

            <label class="control-label required">
                    Nom du serveur :
            </label>
                    <?php echo form_input('nom', $server->nom, "class='form-control' $readonly"); ?>
        </div>
        <div class="form-group">
            <label>
                    OS :
            </label>
                    <select name="os" class="form-control" <?php echo $disabled; ?>>
                        <option value="linux" <?php if($server->os=='linux'){ echo ' selected'; }?>>Linux</option>
                        <option value="unix" <?php if($server->os=='unix'){ echo ' selected'; }?>>Unix</option>
                        <option value="winwdows" <?php if($server->os=='windows'){ echo ' selected'; }?>>Windows</option>
                        <option value="mac" <?php if($server->os=='mac'){ echo ' selected'; }?>>Mac</option>
                    </select>                    
        </div>                
        <div class="form-group">
            <label class="control-label required">
                    Distribution :    
            </label>
                    <?php echo form_input('distrib', $server->distrib, 'class="form-control" id="getdistrib" '.$readonly.''); ?>
        </div>
        <div class="form-group required">
            <label >
                    IP :
            </label>
                    <?php echo form_input('ip', $server->ip, "class='form-control' $readonly"); ?>
        </div>
        <div class="form-group">
            <label class="control-label">
                    IP2 : <i class="glyphicon glyphicon-question-sign" rel="tooltip" title="Si il y a une seconde ip (ex: ip virtuelle) sur le serveur inscrivez là ici"></i>
            </label>
                    <?php echo form_input('ip2', set_value('ip2'), 'class="form-control" placeholder="0.0.0.0" '.$readonly.''); ?>
        </div>          
        <div class="form-group">
            <label class="control-label">
                    URL :
            </label>

            <?php echo form_input('url', $server->url, 'class="form-control" placeholder="http://" '.$readonly.''); ?>

        </div>
        <div class="form-group required">
            <label class="control-label">
                    Description du serveur :
            </label>
                    <?php echo form_textarea('description', $server->description, "class='form-control' $readonly"); ?>
        </div>
        <a class="btn btn-primary btnNext">Suivant</a>
    </div>
    <div id="referents" class="tab-pane fade">
        <div class="form-group required">
            <label class="control-label">
                    Nom du référent 1 :
            </label>
                    <?php echo form_input('referent', $server->referent, 'class="form-control getreferent" '.$readonly.' '); ?>
        </div>
        <div class="form-group">
            <label class="control-label">
                    Nom du référent 2 :
            </label>
                    <?php echo form_input('referent2', $server->referent2, 'class="form-control getreferent" '.$readonly.' '); ?>
        </div>
        <div class="form-group">
            <label class="control-label">
                    Nom du référent 3 :
            </label>
                    <?php echo form_input('referent3', $server->referent3, 'class="form-control getreferent" '.$readonly.'  '); ?>
        </div>
        <a class="btn btn-primary btnPrevious">Précédent</a>
        <a class="btn btn-primary btnNext">Suivant</a>
    </div>
    <div id="divers" class="tab-pane fade">
        <div class="form-group">
            <label class="control-label">
                    Serveur de base de données utilisé :
            </label>
                    <?php echo form_input('bdd', $server->bdd, 'class="form-control" '.$readonly.'  '); ?>
        </div>
        <div class="form-group">
            <label class="control-label required">
                    Type de machine :
            </label>
                    <select name="type_machine" class="form-control" <?php echo $disabled; ?>>

                        <?php
                        if($server->type_machine == "physique"){
                            $selected = " selected=selected ";
                        } else {
                        $selected = "";
                        }
                        ?>


                        <option value="virtuel">Virtuel</option>
                        <option <?php echo $selected; ?> value="physique">Physique</option>
                    </select>
        </div>
        <div class="form-group">
            <label class="control-label">
                    Nom du service qui gère le serveur :
            </label>
                    <select name="id_groupes" class="form-control" <?php echo $disabled; ?>>
                    <?php foreach ($liste_service->result_array() as $row) {

                        if($row['id_service'] == $server->id_groupes){
                            $selected = " selected=selected ";
                        } else {
                            $selected = "";
                        }
                    ?>

                        <option <?php echo $selected; ?> value="<?php echo $row['id_service']; ?>"><?php echo $row['service']; ?></option>
                    <?php } ?>

                    </select>
        </div>
        <div class="form-group">
            <label class="control-label">
                    Edité le :
            </label>
                   
            <input type="text" name="timestamp" value="<?php echo $server->timestamp; ?>" readonly="readonly" class="form-control"  />
        </div>        
    <?php if(is_admin()  || $server->referent == $user  || is_role() == 4) { echo form_submit('submit', 'Modifier la fiche','class="btn btn-primary"'); } ?>        
    </div>

</div>
  </form>