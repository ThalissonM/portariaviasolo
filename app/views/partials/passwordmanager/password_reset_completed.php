<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card card-body">
				<h2><?php print_lang('gerenciador_de_redefini_o_de_senha'); ?></h2>
				<hr />	
				<h4 class="animated bounce text-success">
					<i class="material-icons">check_circle</i> <?php print_lang('sua_senha_foi_alterada'); ?>
				</h4>
				<hr />
			</div>
			<br />
			<a href="<?php print_link(""); ?>" class="btn btn-info"><?php print_lang('clique_aqui_para_logar'); ?></a>
			<?php 
				if(DEVELOPMENT_MODE){ 
			?>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_completed.php</i></div>
			<?php 
				} 
			?>
		</div>
	</div>
</div>
	