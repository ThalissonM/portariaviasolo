
<div id="topbar" class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
	<div class="container-fluid">
			
	<a class="navbar-brand" href="<?php print_link(HOME_PAGE) ?>">
		<img class="img-responsive" src="<?php print_link(SITE_LOGO); ?>" /> <?php echo SITE_NAME ?>
	</a>

		<?php 
			if(user_login_status() == true ){ 
		?>
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-responsive-collapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse navbar-responsive-collapse">
			<?php Html :: render_menu(Menu :: $navbartopleft  , 'navbar-nav mr-auto'); ?>
			
			
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
						<span class="avatar-icon"><i class="material-icons">account_box</i></span> 
						<span>Hi <?php echo ucwords(USER_NAME); ?> !</span>
					</a>
					<ul class="dropdown-menu">
						<a class="dropdown-item" href="<?php print_link('account') ?>"><i class="material-icons">account_box</i> <?php print_lang('minha_conta'); ?></a>
						<a class="dropdown-item" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="material-icons">exit_to_app</i> <?php print_lang('sair'); ?></a>
					</ul>
				</li>
			</ul>

		</div>
		<?php 
		} 
	?>

	</div>
</div>