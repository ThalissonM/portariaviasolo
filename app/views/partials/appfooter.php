<footer class="footer bg-light">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="copyright"><?php print_lang('todos_os_direitos_reservados'); ?> | &copy; <?php echo SITE_NAME ?> - <?php echo date('Y') ?></div>
			</div>
			<div class="col">
				<div class="footer-links text-right">
					<a href="<?php print_link('info/about'); ?>"><?php print_lang('sobre_n_s'); ?></a> | 
					<a href="<?php print_link('info/help'); ?>"><?php print_lang('ajuda_e_faq'); ?></a> |
					<a href="<?php print_link('info/contact'); ?>"><?php print_lang('contate_nos'); ?></a>  |
					<a href="<?php print_link('info/privacy_policy'); ?>"><?php print_lang('pol_tica_de_privacidade'); ?></a> |
					<a href="<?php print_link('info/terms_and_conditions'); ?>"><?php print_lang('termos_e_condi_es'); ?></a>
				</div>
			</div>
			
		<div class="col-sm-3">
			Language : <em><?php echo ucfirst(Lang :: get_user_language()) ?></em> <a href="<?php print_link("info/change_language") ?>" class="btn btn-secondary btn-sm">Change</a>
		</div>

		</div>
	</div>
</footer>