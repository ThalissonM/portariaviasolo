
<?php 
//check if current user role is allowed access to the pages
$can_add = PageAccessManager::is_allowed('controle_acesso_caminhoes_chorume/add');
$can_edit = PageAccessManager::is_allowed('controle_acesso_caminhoes_chorume/edit');
$can_view = PageAccessManager::is_allowed('controle_acesso_caminhoes_chorume/view');
$can_delete = PageAccessManager::is_allowed('controle_acesso_caminhoes_chorume/delete');
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
                        <div class="page-records ">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody>
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('id'); ?> :</th>
                                        <td class="value"> <?php echo $data['id']; ?> </td>
                                    </tr>
                                    

                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('placa'); ?> :</th>
                                        <td class="value"> <?php echo $data['placa']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('entrada'); ?> :</th>
                                        <td class="value"> <?php echo $data['entrada']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('saida'); ?> :</th>
                                        <td class="value"> <?php echo $data['saida']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('motorista'); ?> :</th>
                                        <td class="value"> <?php echo $data['motorista']; ?> </td>
                                    </tr>

                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('id_viasolo_porteiro_entrada'); ?> :</th>
                                        <td class="value"> <?php echo $data['users_id']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('porteiro_entrada'); ?> :</th>
                                        <td class="value"> <?php echo $data['nome_responsavel_entrada']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('id_viasolo_porteiro_sa_da'); ?> :</th>
                                        <td class="value"> <?php echo $data['users_id1']; ?> </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <th class="title"> <?php print_lang('porteiro_sa_da'); ?> :</th>
                                        <td class="value"> <?php echo $data['nome_responsavel_saida']; ?> </td>
                                    </tr>
                                    
                                    
                                </tbody>
                                <!-- Table Body End -->
                                <tfoot>
                                    <tr>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="p-3">
                            
                            
                            <?php if($can_edit){ ?>
                            
                            <a class="btn btn-sm btn-info"  href="<?php print_link("controle_acesso_caminhoes_chorume/edit/$rec_id"); ?>">
                                <i class="material-icons">edit</i> <?php print_lang('editar'); ?>
                            </a>
                            
                            <?php } ?>
                            
                            
                            <?php if($can_delete){ ?>
                            
                            <a class="btn btn-sm btn-danger record-delete-btn"  href="<?php print_link("controle_acesso_caminhoes_chorume/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="none">
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
