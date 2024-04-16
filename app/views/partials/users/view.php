
<?php 
//check if current user role is allowed access to the pages
$can_add = PageAccessManager::is_allowed('users/add');
$can_edit = PageAccessManager::is_allowed('users/edit');
$can_view = PageAccessManager::is_allowed('users/view');
$can_delete = PageAccessManager::is_allowed('users/delete');
?>

<?php
$comp_model = new SharedController;
$current_page = get_current_url();
$csrf_token = Csrf :: $token;

//Page Data Information from Controller
$data = $this->view_data;

//$rec_id = $data['__tableprimarykey'];
$page_id = Router::$page_id; //Page id from url

$view_title = $this->view_title;

$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;

?>

<section class="page">
    
    <?php
    if( $show_header == true ){
    ?>
    
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-12 ">
                    <h3 class="record-title"><?php print_lang('vis_o'); ?></h3>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    <?php
    }
    ?>
    
    <div  class="">
        <div class="container">
            
            <div class="row ">
                
                <div class="col-md-12 comp-grid">
                    
                    <?php $this :: display_page_errors(); ?>
                    
                    <div  class=" animated fadeIn">
                        <?php
                        
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        
                        
                        
                        $counter++;
                        ?>
                        <div class="profile-bg mb-2">
                            <div class="profile">
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="avatar"><img src="<?php print_link("assets/images/avatar.png") ?>" /> </div>
                                        <h2 class="title"><?php echo $data['username']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="page-records ">
                                <table class="table table-hover table-borderless table-striped">
                                    <tbody>
                                        
                                        <tr>
                                            <th class="title"> <?php print_lang('id'); ?> :</th>
                                            <td class="value"> <?php echo $data['id']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> <?php print_lang('username'); ?> :</th>
                                            <td class="value"> <?php echo $data['username']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> <?php print_lang('email'); ?> :</th>
                                            <td class="value"> <?php echo $data['email']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> <?php print_lang('role'); ?> :</th>
                                            <td class="value"> <?php echo $data['role']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> <?php print_lang('id_viasolo'); ?> :</th>
                                            <td class="value"> <?php echo $data['id_viasolo']; ?> </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <th class="title"> <?php print_lang('unidades_id'); ?> :</th>
                                            <td class="value">
                                                
                                                <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("unidades/view/" . urlencode($data['unidades_id'])) ?>">
                                                    <i class="material-icons">visibility</i> <?php echo $data['unidades_nomeunidade'] ?>
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        
                                    </tbody>    
                                </table>    
                            </div>  
                            <div class="mt-2">
                                
                                
                                <?php if($can_edit){ ?>
                                
                                <a class="btn btn-sm btn-info"  href="<?php print_link("users/edit/$rec_id"); ?>">
                                    <i class="material-icons">edit</i> <?php print_lang('editar'); ?>
                                </a>
                                
                                <?php } ?>
                                
                                
                                <?php if($can_delete){ ?>
                                
                                <a class="btn btn-sm btn-danger record-delete-btn"  href="<?php print_link("users/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="none">
                                    <i class="material-icons">clear</i> <?php print_lang('excluir'); ?>
                                </a>
                                
                                <?php } ?>
                                
                                
                                <button class="btn btn-sm btn-primary export-btn">
                                    <i class="material-icons">save</i> <?php print_lang('exportar'); ?>
                                </button>
                                
                                
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <!-- Empty Record Message -->
                            <div class="text-muted p-3">
                                <i class="material-icons">block</i> <?php print_lang('nenhum_registro_encontrado'); ?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
    