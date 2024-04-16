
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

//Page Data From Controller
$view_data = $this->view_data;

$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;

$field_name = Router :: $field_name;
$field_value = Router :: $field_value;

$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;

include_once 'functions/controle_saida.php';


?>

<section class="page">
    
    <?php
    if(isset($_POST['saida']))
    {
        saida_caminhao_chorume($_POST['saida'],USER_ID,USER_NAME);



    }

    ?>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>

    <?php
    if( $show_header == true ){
        ?>
    
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            
            <div class="row ">
                
                <div class="col-sm-4 ">
                    <h3 class="record-title"><?php print_lang('Controle de acesso Caminhões Chorume'); ?></h3>
                    
                </div>
                
                <div class="col-sm-3 ">
                    
                    <?php if($can_add){ ?>
                    
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("controle_acesso_caminhoes_chorume/add") ?>">
                        <i class="material-icons">add</i>                               
                        <?php print_lang('adicionar_novo'); ?> 
                    </a>
                    
                    <?php } ?>
                    
                </div>
                
                <div class="col-sm-5 ">
                    
                    <form  class="search" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_query_str_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="<?php print_lang('pesquisa'); ?>" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-capitalize" href="<?php print_link('controle_acesso_caminhoes_chorume'); ?>">
                                            <i class="material-icons">arrow_back</i> <?php echo make_readable($field_name); ?>
                                        </a>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize"><?php echo make_readable(urldecode($field_value)); ?></li>
                                    <?php 
                                    }   
                                    ?>
                                    
                                    <?php
                                    if(!empty($_GET['search'])){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-capitalize" href="<?php print_link('controle_acesso_caminhoes_chorume') ?>"><?php print_lang('pesquisa'); ?></a>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize"> <strong><?php echo get_value('search'); ?></strong></li>
                                    <?php
                                    }
                                    ?>
                                    
                                </ul>
                            </nav>  
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php
        }
        ?>
        
        <div  class="">
            <div class="container-fluid">
                
                <div class="row ">
                    
                    <div class="col-md-12 comp-grid">
                        
                        <?php $this :: display_page_errors(); ?>
                        
                        <div  class=" animated fadeIn">
                            <div id="controle_acesso_caminhoes_chorume-list-records">
                                
                                <?php
                                if(!empty($records)){
                                ?>
                                <div class="page-records table-responsive">
                                    <table class="table  table-striped table-sm">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                
                                                <?php if($can_delete){ ?>
                                                
                                                <th class="td-sno td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                
                                                <?php } ?>
                                                
                                                <th class="td-sno">#</th>
                                                <th > <?php print_lang('motorista'); ?></th>
                                                <th > <?php print_lang('placa'); ?></th>
                                                <th > <?php print_lang('entrada'); ?></th>
                                                <th > <?php print_lang('sa_da'); ?></th>
                                                <th > <?php print_lang('id_porteiro_entrada'); ?></th>
                                                <th > <?php print_lang('porteiro_entrada'); ?></th>
                                                <th > <?php print_lang('id_porteiro_sa_da'); ?></th>
                                                <th > <?php print_lang('porteiro_sa_da'); ?></th>
                                                
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $counter = 0;
                                            
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            
                                            
                                            ?>
                                            <tr>
                                                
                                                <?php if($can_delete){ ?>
                                                
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    
                                                    <?php } ?>
                                                    
                                                    <th class="td-sno"><?php echo $counter; ?></th>

                                                    
                                                    
                                                    <td> <?php echo $data['motorista']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['placa']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['entrada']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['saida']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['users_id']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['nome_responsavel_entrada']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['users_id1']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <td> <?php echo $data['nome_responsavel_saida']; ?> </td>
                                                    
                                                    
                                                    
                                                    
                                                    <th class="td-btn">
                                                        
                                                        
                                                        <?php if($can_view){ ?>

                                                        <a class="btn btn-sm btn-success has-tooltip" title="<?php print_lang('ver_registro'); ?>" href="<?php print_link("controle_acesso_caminhoes_chorume/view/$rec_id"); ?>">
                                                            <i class="material-icons">visibility</i> <?php print_lang('vis_o'); ?>
                                                        </a>
                                                        
                                                        <?php } ?>


                                                        <?php if($can_view){ ?>




                                                                <a>
                                                                    <form method="post" style="display: inline" >
                                                                    <button class=" btn btn-sm btn-dark has-tooltip" title="<?php print_lang('Saída'); ?>" type="submit" name="saida" value="<?php  echo $rec_id ?>">
                                                                        <i class="material-icons">exit_to_app</i> <?php print_lang('Saída'); ?>
                                                                    </button>
                                                                    </form>
                                                                </a>









                                                        <?php } ?>
                                                        
                                                        
                                                        <?php if($can_edit){ ?>

                                                        <a class="btn btn-sm btn-info has-tooltip" title="<?php print_lang('editar_este_registro'); ?>" href="<?php print_link("controle_acesso_caminhoes_chorume/edit/$rec_id"); ?>">
                                                            <i class="material-icons">edit</i> <?php print_lang('editar'); ?>
                                                        </a>
                                                        
                                                        <?php } ?>
                                                        
                                                        
                                                        <?php if($can_delete){ ?>

                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="<?php print_lang('excluir_este_registro'); ?>" href="<?php print_link("controle_acesso_caminhoes_chorume/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Tem certeza de que deseja excluir este registro?" data-display-style="none">
                                                            <i class="material-icons">clear</i>
                                                            <?php print_lang('excluir'); ?>
                                                        </a>

                                                        <?php } ?>
                                                        
                                                        
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php
                                    if( $show_footer == true ){
                                    ?>
                                    <div class="">
                                        <div class="row">   
                                            <div class="col-sm-4">  
                                                <div class="py-2">  
                                                    
                                                    <?php if($can_delete){ ?>
                                                    
                                                    <button data-prompt-msg="<?php print_lang('tem_certeza_de_que_deseja_excluir_esses_registros_'); ?>" data-display-style="none" data-url="<?php print_link("controle_acesso_caminhoes_chorume/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="material-icons">clear</i> <?php print_lang('excluir_selecionado'); ?>
                                                    </button>
                                                    
                                                    <?php } ?>
                                                    
                                                    
                                                    <button class="btn btn-sm btn-primary export-btn"><i class="material-icons">save</i> <?php print_lang('exportar'); ?></button>
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="col">   
                                                
                                                <?php
                                                if( $show_pagination == true ){
                                                $pager = new Pagination($total_records,$record_count);
                                                $pager->page_name='controle_acesso_caminhoes_chorume';
                                                $pager->show_page_count=true;
                                                $pager->show_record_count=true;
                                                $pager->show_page_limit=true;
                                                $pager->show_page_number_list=true;
                                                $pager->pager_link_range=5;
                                                
                                                $pager->render();
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    }
                                    else{
                                    ?>
                                    <div class="text-muted animated bounce  p-3">
                                        <h4><i class="material-icons">block</i> <?php print_lang('nenhum_registro_encontrado'); ?></h4>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </section>
        