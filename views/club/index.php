
	<?php include("../../header.php"); ?>


<body>
	<?php 
	include("../../menu.php"); 
	?>
    <!-- Page Content -->
    <div class="container">

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clubs</h1>
            </div>
        </div>

		<!--Search content -->
		<div class="row">
			<div class="col-md-9">
				<div class="search">
					<h4> Recherche d'un club par numéro de club, nom ou ville :</h4>
					<form action="../../controllers/club/" method="POST" class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Exemple : MBC"/>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info" name="search" id="search" >Rechercher</button>
						</div>
					</form>
				</div>
			</div>
			<!-- ./search -->
		</div>
		<!-- ./row -->
		

		<!-- search results -->
		<div class="row">
			<div class="col-md-9">
				<div class="resultSeearch">
					<?php
						if(isset($search) && !empty($search_clubs['search_club'])) //button "Rechercher"
						{
							?>
							<table class="table table-striped">
								<tr>
									<th>N° club</th>
									<th>Nom club</th>
									<th>Ville</th>
									<th>Nombre de joueurs</th>
								</tr>
								<?php
								$i = 0;
								foreach ($search_clubs['search_club'] as $search_club) {
									echo '<tr>' . '<td>' . "<a href='../../controllers/infosClubs/index.php?club_id=" . $search_club['club_id'] . "&nom_club=" . $search_club['nom_club'] . "&nom_ville=" . $search_club['nom_ville'] 
									. "&nb_joueurs=" . $nb_joueur[$i]['nombre'] . "'>" . $search_club['club_id'] . "</a>" .
									'</td>'.'<td>' . $search_club['nom_club'] .
									'</td>'.'<td>' . $search_club['nom_ville'] . 
									'</td>'.'<td>' . $nb_joueur[$i]['nombre'] . '</td>'.'</tr>';
									$i++;
								}
								?>
							</table>
						<?php 
						} 
					?>
				</div>
			</div>
		</div>
		<!-- ./results -->
		
		<?php 
		if(isset($_COOKIE["token"]) && ($_COOKIE["token"] == $users['User'][0][0]))
		{?>
			<!-- insertion content -->
			<div class="row">
				<div class="col-md-9">
					<div class="insertion">
						<h4>Insertion d'un club</h4>
						<form action="../../controllers/club/" method="POST" class="form-horizontal">
							<div class="form-group">
								<label for="nom_club" class="col-sm-2 control-label">Nom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom_club" id="nom_club"/>
								</div>
							</div>
							<div class="form-group">
								<label for="ville_id" class="col-sm-2 control-label" class="col-sm-2 control-label">Ville</label>
								<div class="col-sm-10">
									<select class="form-control"  name="ville_id" id="ville_id">
										<?php 
											foreach ($villes['info_ville'] as $info_ville) {
												echo '<option>' . $info_ville['ville_id'] . ' - ' . $info_ville['nom_ville'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success" name="insert" id="insert">Insérer</button>		
								</div>
							</div>
						</form>
						<div class="res_insertion">
							<?php echo $ins ?>
						</div>
					</div>
				</div>
				<!-- ./insert -->
			</div>
			<!-- ./row -->
			


			<!-- deletion content -->
			<div class="row">
				<div class="col-md-9">
					<div class="deletion">
						<h4>Suppression d'un club</h4>
						<form action="../../controllers/club/" method="POST" class="form-inline">
							<div class="form-group">
								<select class="form-control" name="club_id_del" id="club_id_del">
									<?php 
										foreach ($clubs['info_club'] as $info_club) {
											echo '<option>' . $info_club['club_id'] . ' - ' . $info_club['nom_club'] . '</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-danger" name="delete" id="delete">Supprimer</button>
							</div>
						</form>
						<div class="res_suppression">
							<?php echo $del ?>
						</div>
					</div>
				</div>
				<!-- ./delete -->
			</div>
			<!-- ./row -->
			

			<!-- update content -->
			<div class="row">
				<div class="col-md-9">
					<div class="update">
					<h4>Mise à jour d'un club</h4>
						<form action="../../controllers/club/" method="POST" class="form-horizontal">
							<div class="form-group">
								<label for="club_id_upd" class="col-sm-2 control-label" class="col-sm-2 control-label">Club</label>
								<div class="col-sm-10">
									<select class="form-control" name="club_id_upd" id="club_id_upd">
										<?php 
											foreach ($clubs['info_club'] as $info_club) {
												echo '<option>' . $info_club['club_id'] .  ' - ' . $info_club['nom_club'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nom_club_upd" class="col-sm-2 control-label">Nouveau nom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom_club_upd" id="nom_club_upd" />
								</div>
							</div>
							<div class="form-group">
								<label for="ville_id_upd" class="col-sm-2 control-label" class="col-sm-2 control-label">Nouvelle ville</label>
								<div class="col-sm-10">
									<select class="form-control"  name="ville_id_upd" id="ville_id_upd">
										<?php 
											foreach ($villes['info_ville'] as $info_ville) {
												echo '<option>' . $info_ville['ville_id'] . ' - ' . $info_ville['nom_ville'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-warning" name="update" id="update">Mettre à jour</button>		
								</div>
							</div>
						</form>
						<div class="res_update">
							<?php echo $upd ?>
						</div>
					</div>
				</div>
				<!-- ./update -->
			</div>
			<!-- ./row -->
		<?php
		}?>

		<?php include("../../footer.php"); ?>
    </div>
    <!-- /.container -->

</body>

</html>