<h1>Bienvenue dans l'application AMS</h1>
<div class="row">
    <div class="col-md-8">
        <?php if(is_groupe() == NULL): ?>
            <div class="alert alert-danger alert-error">


                <strong>Erreur: </strong> Vous avez actuellement les droits invité. Veuillez contacter votre administrateur pour qu'il vous positionne les droits.

            </div>
        <?php endif; ?>
                <?php if(is_groupe()): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Statistiques</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Nombre total de serveurs dans la base : <b><?php echo $nbserver; ?></b></li>
                        <li>Nombre total de serveurs dans le service : <b><?php echo $nbserver_service; ?></b></li>
                        <li>Nombre total de serveurs d'on vous êtes le référent  : <b><?php echo $nbserver_referent; ?></b></li>
                    </ul>
                </div>    
            </div>
    </div>
    <?php endif; ?>
    <div class="col-md-4">
        <?php if(is_groupe()): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Derniers serveurs ajoutés dans la base</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <?php foreach ($last_servers->result() as $server): ?>
                        <li><a href="<?php echo base_url('server/edit/'.$server->ids); ?>"><?php echo $server->nom; ?></a></li>   
                        <?php endforeach; ?>
                    </ul>
                </div>
        <?php endif; ?>
        </div>  
  
  
  
    </div>
</div>

