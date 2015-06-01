
	<?php include("../../header.php"); ?>


<body>
	<?php 
	include("../../menu.php"); 

	?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Joueurs</h1>
            </div>
        </div>
						
		<!--Search content -->
		<div class="row">
			<div class="col-md-9">
				<div class="search">
					<h4> Recherche d'un joueur par numéro de licence, nom, prenom, nom de club ou catégorie : </h4>
					<form action="../../controllers/joueur/" method="POST" class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Exemple : 100105"/>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info" name="search" id="search">Rechercher</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.search -->

		<!-- search results -->
		<div class="row">
			<div class="col-md-9">
				<div class="resultSeearch">
					<?php
						if(isset($search) && !empty($search_joueurs['search_joueur'])) //button "Rechercher"
						{
							?>
							<table class="table table-striped">
								<tr>
									<th>Licence</th>
									<th>Nom</th>
									<th>Prenom</th>
									<th>Date de naissance</th>
									<th>Date 1ere licence</th>
									<th>Club</th>
									<th>Categorie</th>
								</tr>
								<?php

								foreach ($search_joueurs['search_joueur'] as $search_joueur) {
									echo '<tr>' . '<td>' . "<a href='../../controllers/infosJoueurs/index.php?licence=" . $search_joueur['licence'] . "&nom_joueur=" . $search_joueur['nom_joueur'] . "&prenom_joueur=" . $search_joueur['prenom_joueur'] 
									. "&date_naissance=" . $search_joueur['date_naissance'] . "&date_premiere_inscription=" . $search_joueur['date_premiere_inscription'] . "&nom_club=" . $search_joueur['nom_club'] 
									. "&nom_categorie=" . $search_joueur['nom_categorie'] . "&img_src=" . $search_joueur['img_src'] . "'>" . $search_joueur['licence'] . "</a>" .
									'</td>'.'<td>' . $search_joueur['nom_joueur'] . 
									'</td>'.'<td>' . $search_joueur['prenom_joueur'] . '</td>'.'<td>' . $search_joueur['date_naissance'] .
									'</td>'.'<td>' . $search_joueur['date_premiere_inscription'] . '</td>'.'<td>' . $search_joueur['nom_club'] .
									'</td>'.'<td>' . $search_joueur['nom_categorie'] . '</td>'.'</tr>';
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
						<h4>Insertion d'un joueur</h4>
						<form action="../../controllers/joueur/" method="POST" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-group">
								<label for="nom_joueur" class="col-sm-2 control-label">Nom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom_joueur" id="nom_joueur" required />
								</div>
							</div>
							<div class="form-group">
								<label for="prenom_joueur" class="col-sm-2 control-label">Prenom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="prenom_joueur" id="prenom_joueur" required />
								</div>
							</div>
							<div class="form-group">
								<label for="date_naissance" class="col-sm-2 control-label">Date de naissance</label>
								<div class="col-sm-10">
									<input type="date" class="form-control" id="date_naissance" name="date_naissance" placeholder="Date de naissance" required />
								</div>
							</div>
							<div class="form-group">
								<label for="club_id" class="col-sm-2 control-label">Club</label>
								<div class="col-sm-10">
									<select class="form-control" name="club_id" id="club_id">
										<?php 
											foreach ($clubs['info_club'] as $info_club) {
												echo '<option>' . $info_club['club_id'] . ' - ' . $info_club['nom_club'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="img_src" class="col-sm-2 control-label">Image</label>
								<input type="file" name="img_src" id="img_src">
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
			</div>
			<!-- ./insert -->
			
			
			<!-- delete content -->
			<div class="row">
				<div class="col-md-9">
					<div class="deletion">
						<h4> Suppression d'un joueur</h4>
						<form action="../../controllers/joueur/" method="POST" class="form-inline">
							<div class="form-group">
								<select class="form-control" name="licence_del" id="licence_del">
									<?php 
										foreach ($joueurs['info_joueur'] as $info_joueur) {
											echo '<option>' . $info_joueur['licence'] . ' ' . $info_joueur['nom_joueur'] . ' ' . $info_joueur['prenom_joueur'] . '</option>';
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
			</div>
			<!-- ./delete -->


			<!-- update content -->
			<div class="row">
				<div class="col-md-9">
					<div class="update">
					<h4>Mise à jour d'un joueur</h4>
						<form action="../../controllers/joueur/" method="POST" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-group">
								<label for="licence_upd" class="col-sm-2 control-label" class="col-sm-2 control-label">Joueur</label>
								<div class="col-sm-10">
									<select class="form-control" name="licence_upd" id="licence_upd">
										<?php 
											foreach ($joueurs['info_joueur'] as $info_joueur) {
												echo '<option>' . $info_joueur['licence'] . ' ' . $info_joueur['nom_joueur'] . ' ' . $info_joueur['prenom_joueur'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="club_id_upd" class="col-sm-2 control-label">Nouveau club</label>
								<div class="col-sm-10">
									<select class="form-control" name="club_id_upd" id="club_id_upd">
										<?php 
											foreach ($clubs['info_club'] as $info_club) {
												echo '<option>' . $info_club['club_id'] . ' - ' . $info_club['nom_club'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="club_id_upd" class="col-sm-2 control-label">Nouvelle categorie</label>
								<div class="col-sm-10">
									<select class="form-control" name="categorie_id_upd" id="categorie_id_upd">
										<?php 
											foreach ($categories['info_categorie'] as $info_categorie) {
												echo '<option>' . $info_categorie['categorie_id'] .  ' - ' . $info_categorie['nom_categorie'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="img_src_upd" class="col-sm-2 control-label">Image</label>
								<input type="file" name="img_src_upd" id="img_src_upd">
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
			</div>
			<!-- ./update -->
		<?php
		}?>

		<?php include("../../footer.php"); ?>
    </div>
    <!-- /.container -->

</body>

</html>