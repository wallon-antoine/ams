<h1>Gestion des droits utilisateurs</h1>
    <div class="alert alert-info">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Information</strong> Cette page permet d'associer un utilisateur à un service au sein de votre université.<br />Pour en savoir plus  sur la gestion des rôles <a href="https://projets-webent.univ-lille1.fr/projects/administrative-management-server/wiki/Gestion_des_roles">cliquez ici</a>

    </div>

<table class="table table-hover table-condensed">
    <thead>
        <th>
            identifiant utilisateur :
        </th>
        <th>
            Appartient au service :
        </th>
        <th>
            Rôle :
        </th>        
    </thead>
    <tbody>
        <?php foreach($users as $username): ?>

        <tr>
            <td>
                <?php echo $username->unom; ?>
            </td>
            <td>

                <select onchange="ConfigUser('<?php echo $username->id; ?>',this.value)" name="id_groupes_<?php echo $username->id; ?>" class="form-control">
                    <?php foreach ($services->result_array() as $row) {
                            if($row['id_service'] == $username->id_groupe){
                            $selected = " selected=selected ";
                        } else {
                            $selected = "";
                        }
                    ?>
                        <option value="<?php echo $row['id_service']; ?>" <?php echo $selected; ?> ><?php echo $row['service']; ?></option>
                    <?php } ?>
        
                    </select>                
            </td>
            <td>
                <select onchange="ConfigRole('<?php echo $username->id; ?>',this.value)" name="id_roles_<?php echo $username->id; ?>" class="form-control">
                    <?php foreach ($roles->result_array() as $role) {
                            if($role['nom'] == $username->rnom){
                            $selected = " selected=selected ";
                        } else {
                            $selected = "";
                        }
                    ?>
                        <option value="<?php echo $role['idr']; ?>" <?php echo $selected; ?> ><?php echo $role['nom']; ?></option>
                    <?php } ?>
        
                    </select>                    
                
            </td>            
        </tr>
      
        <?php endforeach; ?>
    </tbody>
</table>