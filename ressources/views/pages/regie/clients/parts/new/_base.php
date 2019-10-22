<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Informations de base</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="entname" class="mb-0">Dénomination&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="entname" id="entname" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("entname"); ?>" placeholder="Entrez le nom" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez le nom de l\'entreprise.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="interlocuteur" class="mb-0">Interlocuteur&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="interlocuteur" id="interlocuteur" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("interlocuteur"); ?>" placeholder="Entrez le nom de l'interlocuteur" required />

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">Entrez le nom complet de l\'interlocuteur.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="entmail" class="mb-0">Adresse E-mail&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="email" name="entmail" id="entmail" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("entmail"); ?>" placeholder="Entrez l'adresse e-mail de l'interlocuteur" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez l\'adesse e-mail de l\'interlocuteur.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

				<label for="entphone" class="mb-0">Téléphone&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="entphone" id="entphone" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("entphone"); ?>" placeholder="Entrez le numéro de téléphonique." required />

			<?= !empty($error[4]) 
				? '<span class="help-block mt-1">' . $error[4] . '</span>' 
				: '<small class="text-muted">Le format téléphonique réquis est sans espace.</small>'; 
			?>

			</div>
			

			<div class="form-group mb-3<?= !empty($error) && count($error[5]) != 0 ? ' has-error' : '';  ?>">

				<label for="type" class="mb-0">Type</label>

				<select name="type" class="form-control p-form-ctrl p-form-ctrl-sm">

                    <option value="RP">Régie Publicitaire</option>

                    <option value="AC">Agence en Communication</option>

                    <option value="IP">Institution Publique</option>

                    <option value="II">Institution Internationale</option>

                    <option value="AP">Autre / Personne</option>

				</select>

			<?= !empty($error[5]) 
				? '<span class="help-block mt-1">' . $error[5] . '</span>' 
				: '<small class="text-muted">Le format téléphonique réquis est sans espace.</small>'; 
			?>

			</div>


			<button type="submit" name="newsubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

		</form>

	</div>

</div>