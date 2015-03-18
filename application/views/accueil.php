<h1>Bienvenue dans l'application AMS</h1>
<div class="row">
    <div class="col-md-8">
        <?php if(is_groupe() == NULL): ?>
            <div class="alert alert-danger alert-error">


                <strong>Erreur: </strong> Vous avez actuellement les droits invité. Veuillez contacter votre administrateur pour qu'il vous positionne les droits.

            </div>
        <?php endif; ?>
        <p>Cette application permet d'avoir la liste des serveurs du CRI ainsi que leurs descriptions</p>        
    </div>
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

