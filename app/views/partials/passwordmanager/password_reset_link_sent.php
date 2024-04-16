<div class="container">
	<h3><?php print_lang('gerenciador_de_redefini_o_de_senha'); ?></h3>
	<hr />
	<div class="">
		<h4 class="text-info bold">
			<i class="material-icons">email</i> <?php print_lang('uma_mensagem_foi_enviada_para_o_seu_email_por_favor_siga_o_link_para_redefinir_sua_senha'); ?>
		</h4>
		<?php
		if (DEVELOPMENT_MODE) {
			?>
			<div class="text-muted">
				To edit this file, browse to :- <i>app/view/partials/passwordmanager/password_reset_link_sent.php</i>
			</div>
		<?php
		}
		?>
	</div>
	<hr />
	<a href="<?php print_link(""); ?>" class="btn btn-info"><?php print_lang('clique_aqui_para_logar'); ?></a>
	<?php
	if (DEVELOPMENT_MODE) {
		$mailbody = $this->view_data;
		?>
		<hr />
		<div class="bg-light p-4 border">
			<div class="text-danger">
				<h3>
					<b>Disclaimer:</b> You are seeing this because you published under development mode.
					<br />We understand that sending email in localhost might be problematic.
				</h3>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_email_template.html</i></div>
			</div>
			<hr />
			<?php echo $mailbody; ?>
		</div>
	<?php
	}
	?>
</div>