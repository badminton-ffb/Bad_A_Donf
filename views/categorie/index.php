
	<?php include("../../header.php"); ?>


<body>
	<?php 
	include("../../menu.php"); 

	?>
    <!-- Page Content -->
    <div class="container">

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Categories</h1>
            </div>
        </div>
		
		
		<!--Search content -->
		<div class="row">
			<div class="col-md-9">
				<div class="search">
					<h4> Recherche d'une categorie par numéro, nom, age de début ou age de fin : </h4>
					<form class="form-inline" action="../../controllers/categorie/index.php" method="post">
						<div class="form-group">
							<input type="text" class="form-control" name="search_text" placeholder="Exemple : Poussin" />
						</div>	
						<div class="form-group">
							<button type="submit" class="btn btn-info" name="search" id="search" >Rechercher</button>
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
						if(isset($search) && !empty($search_categories['search_categorie'])) //button "Rechercher"
						{
							?>
							<table class="table table-striped">
								<tr>
									<th>N° categorie</th>
									<th>Nom categorie</th>
									<th>Age debut</th>
									<th>Age fin</th>
								</tr>
								<?php
								foreach ($search_categories['search_categorie'] as $search_categorie) {
									echo '<tr>' . '<td>' . "<a href='../../controllers/infosCategories/index.php?categorie_id=" . $search_categorie['categorie_id'] . "&nom_categorie=" . $search_categorie['nom_categorie'] . "&age_debut=" . $search_categorie['age_debut'] 
									. "&age_fin=" . $search_categorie['age_fin'] . "'>" . $search_categorie['categorie_id'] . "</a>" .
									 '</td>'.'<td>' . $search_categorie['nom_categorie'] .
									 '</td>'.'<td>' . $search_categorie['age_debut'] .
									 '</td>' . '<td>' . $search_categorie['age_fin'] . '</td>'.'</tr>';
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
					<h4>Insertion d'une categorie</h4>
					<form action="../../controllers/categorie/index.php" method="POST" class="form-horizontal">
						<div class="form-group">
							<label for="nom_categorie" class="col-sm-2 control-label">Nom</label>
							<div class="col-sm-10">
								<input type="text" name="nom_categorie" id="nom_categorie" class="form-control" required />
							</div>
						</div>
						<div class="form-group">
							<label for="age_debut" class="col-sm-2 control-label">Age de début</label>
							<div class="col-sm-10">
								<input type="text" name="age_debut" id="age_debut" class="form-control" required />
							</div>
						</div>
						<div class="form-group">
							<label for="age_fin" class="col-sm-2 control-label">Age de fin</label>
							<div class="col-sm-10">
								<input type="text" name="age_fin" id="age_fin" class="form-control" required />
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
		</div>
		<!-- ./insert -->
		
		<!-- deletion content -->
		<div class="row">
			<div class="col-md-9">
				<div class="deletion">
					<h4>Suppression d'une categorie</h4>
					<form action="../../controllers/categorie/index.php" method="POST" class="form-inline">
						<div class="form-group">
							<select class="form-control" name="categorie_id_del" id="categorie_id_del">
								<?php 
									foreach ($categories['info_categorie'] as $info_categorie) {
										echo '<option>' . $info_categorie['categorie_id'] . ' - ' . $info_categorie['nom_categorie'] . '</option>';
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
				<h4>Mise à jour d'une catégorie</h4>
					<form action="../../controllers/categorie/" method="POST" class="form-horizontal">
						<div class="form-group">
							<label for="categorie_id_upd" class="col-sm-2 control-label" class="col-sm-2 control-label">Categorie</label>
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
							<label for="nom_categorie_upd" class="col-sm-2 control-label">Nouveau nom</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nom_categorie_upd" id="nom_categorie_upd" />
							</div>
						</div>
						<div class="form-group">
							<label for="age_debut_upd" class="col-sm-2 control-label">Nouvel age de debut</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="age_debut_upd" id="age_debut_upd" required />
							</div>
						</div>
						<div class="form-group">
							<label for="age_fin_upd" class="col-sm-2 control-label">Nouvel age de fin</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="age_fin_upd" id="age_fin_upd" required />
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
		</div>
		<!-- ./update -->
		<?php
		}
		?>
		<?php include("../../footer.php"); ?>
    </div>
    <!-- /.container -->

</body>

</html>