<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'inicio';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "inicio" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'inicio';
//$route['default_controller'] = 'inicio/errorPage';
$route['404_override'] = 'inicio/errorPage';
$route['translate_uri_dashes'] = FALSE;

//  ╔═══════════════════════════════════════════════════════════════════════════════╗
//  ║ ╔═══════════════════════════════════════════════════════════════════════════╗ ║
//  ║ ║                                Rotas Públicas                             ║ ║
//  ║ ╚═══════════════════════════════════════════════════════════════════════════╝ ║
//  ╚═══════════════════════════════════════════════════════════════════════════════╝
/*
$route['home']                                      = 'inicio/errorPage';
$route['termos']                                    = 'inicio/errorPage';
$route['regulamentos']                              = 'inicio/errorPage';
$route['resultados']                                = 'inicio/errorPage';
$route['titulos']                                   = 'inicio/errorPage';
$route['contato']                                   = 'inicio/errorPage';
$route['sorteio/(:num)']                            = "inicio/errorPage";
$route['enviacontato']                              = 'inicio/errorPage';
$route['numeros/(:num)']                            = 'inicio/errorPage';
$route['verBilhete/(:num)']                         = 'inicio/errorPage';
*/
$route['home']                                      = 'inicio/index';
$route['termos']                                    = 'inicio/termos';
$route['regulamentos']                              = 'inicio/regulamentos';
$route['resultados']                                = 'inicio/resultados';
$route['titulos']                                   = 'inicio/meusbilhetes';
$route['contato']                                   = 'inicio/contato';
$route['sorteio/(:num)']                            = "inicio/sorteioUnico2/$1";
$route['enviacontato']                              = 'inicio/enviacontato';
$route['numeros/(:num)']                            = 'inicio/verNumeros';
$route['verBilhete/(:num)']                         = 'inicio/verBilhete';
$route['entrar']                                    = 'areauser/entrar';
$route['conta']                                     = 'areauser/principal';
$route['atualizarconta']                            = 'areauser/updateCliente';
$route['login']                                     = 'areauser/login';
$route['cadastroconta']                             = 'areauser/insertCliente';

//  ╔═══════════════════════════════════════════════════════════════════════════════╗
//  ║ ╔═══════════════════════════════════════════════════════════════════════════╗ ║
//  ║ ║                                Rotas Restrito                             ║ ║
//  ║ ╚═══════════════════════════════════════════════════════════════════════════╝ ║
//  ╚═══════════════════════════════════════════════════════════════════════════════╝

//$route['login']                                   = 'logincontroller/telaLogin';
$route['nsgestst']                                  = 'logincontroller/telaLogin';              //NO NEED
$route['nspartnerst']                               = 'logincontroller/telaLogin';              //NO NEED

//$route['validar']                                 = 'logincontroller/validar';
$route['2802a69d3ecca828c74a75fcfeab3200']          = 'logincontroller/validar';                //SOON

//$route['sair']                                    = 'logincontroller/sair';
$route['215521f1d88d23d4411a877b4d4a0d87']          = 'logincontroller/sair';                   //OK

//$route['home']                                    = 'restrito/indexAdmin';
$route['106a6c241b8797f52e1e77317b96a201']          = 'restrito/indexAdmin';                    //OK

//Produtos
$route['391a027a8fef2eba4487a00156901156']                  = 'admin/adminprodutos/produtos';
$route['391a027a8fef2eba4487a00156901156/n/(:num)']         = "admin/adminprodutos/produtos/n/$1";
$route['391a027a8fef2eba4487a00156901156/n']                = 'admin/adminprodutos/produtos/n';
$route['391a027a8fef2eba4487a00156901156/f/(:any)/(:num)']  = "admin/adminprodutos/produtos/f/$1/$1";
$route['391a027a8fef2eba4487a00156901156/f/(:any)']         = "admin/adminprodutos/produtos/f/$1";

$route['ef0baa3c473197057bfddb0e9b0d6169']                  = 'admin/adminprodutos/cadastrarProduto';
$route['42f4c8bb0611326498144132e81203e5/(:num)']           = "admin/adminprodutos/verProduto/$1";
$route['ba641dd761d2b77e2dd91ebff5201646/(:num)']           = "admin/adminprodutos/editaProduto/$1";
$route['121d7b72ae628db44c38825f876e9875']                  = 'admin/adminprodutos/excluirProduto';
$route['a1f2a0b814a1fecd227400e2b74fb25f']                  = 'admin/adminprodutos/novoProduto';
$route['ffc0caeb59f53fc0c9e40e7d17cf3195']                  = 'admin/adminprodutos/updateProduto';
$route['80b17ffc2444700fd3e88e2a9977f363']                  = 'adminprodutos/updateAndamento';
$route['f0b3583ebed98fb4200fc356cd2521ee']                  = 'adminprodutos/deleteAndamento';

//Departamentos
$route['48b6bbfcf12b55d9b0e4c2ded7384bff']                  = 'admin/admindepartamentos/departamentos';
$route['48b6bbfcf12b55d9b0e4c2ded7384bff/n/(:num)']         = "admin/admindepartamentos/departamentos/n/$1";
$route['48b6bbfcf12b55d9b0e4c2ded7384bff/n']                = 'admin/admindepartamentos/departamentos/n';
$route['48b6bbfcf12b55d9b0e4c2ded7384bff/f/(:any)/(:num)']  = "admin/admindepartamentos/departamentos/f/$1/$1";
$route['48b6bbfcf12b55d9b0e4c2ded7384bff/f/(:any)']         = "admin/admindepartamentos/departamentos/f/$1";

$route['f0231933a4d275da05d89ed935d5d9f3']                  = 'admin/admindepartamentos/insert';
$route['75ae48afcf4a597e73a524605603211b']                  = 'admin/admindepartamentos/update';
$route['4e54b724389db47bc1f3a97881abf180']                  = 'admin/admindepartamentos/caddepartamento';
$route['5a8ec7a88f44e3ad4fb71e79c2b7523d/(:num)']           = "admin/admindepartamentos/departamento/$1";
$route['0665a012413c78b2017cf726f29d22fd/(:num)']           = "admin/admindepartamentos/editadepartamento/$1";
$route['dc0f5568b07c25b9f38e1b459f13cb3e']                  = 'admin/admindepartamentos/delete';

//Promoções
$route['0216886b85e598a495cf53b303ec5b54']                  = 'admin/adminpromocoes/promocoes';
$route['0216886b85e598a495cf53b303ec5b54/n/(:num)']         = "admin/adminpromocoes/promocoes/n/$1";
$route['0216886b85e598a495cf53b303ec5b54/n']                = 'admin/adminpromocoes/promocoes/n';
$route['0216886b85e598a495cf53b303ec5b54/f/(:any)/(:num)']  = "admin/adminpromocoes/promocoes/f/$1/$1";
$route['0216886b85e598a495cf53b303ec5b54/f/(:any)']         = "admin/adminpromocoes/promocoes/f/$1";

$route['b872450700345874a5dcb4d7544ce1f8']                  = 'admin/adminpromocoes/insert';
$route['ff373680f0bbc748feed9641bc8f972b']                  = 'admin/adminpromocoes/update';
$route['145a0c89d550bcc27a88e1e4936643f0']                  = 'admin/adminpromocoes/cadastro';
$route['92e663417c2391cb8a2f5e5404c844c2/(:num)']           = "admin/adminpromocoes/ver/$1";
$route['4f86debc5509c7e3eaf5098120ce00b7/(:num)']           = "admin/adminpromocoes/edita/$1";
$route['ea4a2bfdbaf337bd327dec1c477b9e02']                  = 'admin/adminpromocoes/delete';

//Marcas
$route['edb728d5b2d758ff44b1b0e9f991ead9']                  = 'admin/adminmarcas/marcas';
$route['edb728d5b2d758ff44b1b0e9f991ead9/n/(:num)']         = "admin/adminmarcas/marcas/n/$1";
$route['edb728d5b2d758ff44b1b0e9f991ead9/n']                = 'admin/adminmarcas/marcas/n';
$route['edb728d5b2d758ff44b1b0e9f991ead9/f/(:any)/(:num)']  = "admin/adminmarcas/marcas/f/$1/$1";
$route['edb728d5b2d758ff44b1b0e9f991ead9/f/(:any)']         = "admin/adminmarcas/marcas/f/$1";

$route['60bc50a31cf5ef5e4837884a774f1a91']                  = 'admin/adminmarcas/excluirMarca';
$route['d0dd4c29ef31ad2e1bb9f1592fc5c832']                  = 'admin/adminmarcas/insertMarca';
$route['0981d247abe57675f6a0d59eca98c7c3']                  = 'admin/adminmarcas/updateMarca';
$route['bff5d96a6b38ee4527917f7183915405']                  = 'admin/adminmarcas/verMarca';

//Clientes
$route['d2fb359e7478da4e7ec01ef527bdeb53']                  = 'admin/adminclientes/clientes';
$route['d2fb359e7478da4e7ec01ef527bdeb53/n/(:num)']         = "admin/adminclientes/clientes/n/$1";
$route['d2fb359e7478da4e7ec01ef527bdeb53/n']                = 'admin/adminclientes/clientes/n';
$route['d2fb359e7478da4e7ec01ef527bdeb53/f/(:any)/(:num)']  = "admin/adminclientes/clientes/f/$1/$1";
$route['d2fb359e7478da4e7ec01ef527bdeb53/f/(:any)']         = "admin/adminclientes/clientes/f/$1";
$route['f1cab9b535228cff5608d7773ea6ca8a']                  = 'admin/adminclientes/updateCliente';
$route['ea0459301822166845dd9ff3084e3cdd/(:num)']           = "admin/adminclientes/editaCliente/$1";

$route['50d849c4ab008a40ab39cdaf352f35f5/(:num)']           = "admin/adminclientes/vercliente/$1";
$route['0f4b06e032b8ccfed4a548b426e71aaf']                  = 'admin/adminclientes/bloquearCliente';
$route['4318d7cd597c024f9c4cf0fa90add474']                  = 'admin/adminclientes/desbloquearCliente';

//Usuários
$route['0d658457c62859e2c93026f9f70ce219']                  = 'admin/adminusuarios/usuarios';
$route['0d658457c62859e2c93026f9f70ce219/n/(:num)']         = "admin/adminusuarios/usuarios/n/$1";
$route['0d658457c62859e2c93026f9f70ce219/n']                = 'admin/adminusuarios/usuarios/n';
$route['0d658457c62859e2c93026f9f70ce219/f/(:any)/(:num)']  = "admin/adminusuarios/usuarios/f/$1/$1";
$route['0d658457c62859e2c93026f9f70ce219/f/(:any)']         = "admin/adminusuarios/usuarios/f/$1";

$route['9feade5f45917720705df9de942cd1b6']                  = 'admin/adminusuarios/excluirAdmin';
$route['f83c23c38cfd9fc25218e3d2195bbd0e']                  = 'admin/adminusuarios/desbloquearAdmin';
$route['150b6112888b83d7a9302cf9acb20acc']                  = 'admin/adminusuarios/adicionarAdmin';
$route['aa02d8496732341ab22f2eb20ac3154a']                  = 'admin/adminusuarios/getUserData';
$route['92743ff90fb535c63c3bb36ef5901695']                  = 'admin/adminusuarios/editAdmin';
$route['4dce70e680b6ad3d06178477db973ea7']                  = 'admin/adminusuarios/alterarSenha';

//Tipo Usuários
$route['13858aeb4c9a5807927c7b952dace1fb']                  = 'admin/admintipousuarios/tipousuarios';
$route['13858aeb4c9a5807927c7b952dace1fb/n/(:num)']         = "admin/admintipousuarios/tipousuarios/n/$1";
$route['13858aeb4c9a5807927c7b952dace1fb/n']                = 'admin/admintipousuarios/tipousuarios/n';
$route['13858aeb4c9a5807927c7b952dace1fb/f/(:any)/(:num)']  = "admin/admintipousuarios/tipousuarios/f/$1/$1";
$route['13858aeb4c9a5807927c7b952dace1fb/f/(:any)']         = "admin/admintipousuarios/tipousuarios/f/$1";

$route['14267d773d7f7f555f32bea51aedd010']                  = 'admin/admintipousuarios/cadastroTipoUsuario';
$route['a72c7f98d8a3989a1d47a96909cc6504']                  = 'admin/admintipousuarios/atualizarTipoUsuario';
$route['4b4ae94607ae4c22535f161790adb4ef']                  = 'admin/admintipousuarios/salvaTipoUsuario';
$route['89c668a56667d167778b11b98d4e7796/(:num)']           = "admin/admintipousuarios/verTipoUsuario/$1";
$route['166437d3eb8ee7c6f43322b8b71e9ea8/(:num)']           = "admin/admintipousuarios/telaEditaTipoUsuario/$1";
$route['7e6d218f033995cb0d4539f77bd6dc3c']                  = 'admin/admintipousuarios/excluirTipoUsuario';

//Pedidos
$route['954d03a8bbb7febfcd39f9e071407b4b']                  = 'admin/adminpedidos/pedidos';
$route['954d03a8bbb7febfcd39f9e071407b4b/(:num)']           = 'admin/adminpedidos/pedidos/$1';


$route['aeb6ca97f00431672db51d34b87c4a50']                  = 'admin/adminpedidos/pedido';
$route['aeb6ca97f00431672db51d34b87c4a50/(:num)']           = "admin/adminpedidos/pedido/$1";

$route['aeb6ca97f00431672db51d34b87c4a50/(:num)']           = "admin/adminpedidos/pedido/$1";
$route['4daaa9654962f18e7c9df5cb1b2ecdee/(:num)']           = "admin/adminpedidos/editaPedido/$1";
$route['fbdc26200e4306f37a0fb4bd88637744']                  = 'admin/adminpedidos/alterarHistorico';

$route['1c9b9070a498070d09390e4f8a41327f']                  = "admin/Adminpedidos/updateEnderecoEntrega";
$route['01eb143ebb19582034a24d525a9a4c02']                  = "admin/Adminpedidos/updateProdutosEntrega";
$route['32df3fe06d9c44ba678962b454312f86']                  = "admin/Adminpedidos/removeProdutosPedido";
$route['927cc2912712ab7328f82558a15d2b6a']                  = "admin/Adminpedidos/updateFreteEntrega";

//Solicitações
$route['4f713efdd5a702bb7c0bf2608f3a6a72']                  = 'admin/adminprodutos/solicitacoes';
$route['4f713efdd5a702bb7c0bf2608f3a6a72/n/(:num)']         = "admin/adminprodutos/solicitacoes/n/$1";
$route['4f713efdd5a702bb7c0bf2608f3a6a72/n']                = 'admin/adminprodutos/solicitacoes/n';
$route['4f713efdd5a702bb7c0bf2608f3a6a72/f/(:any)/(:num)']  = "admin/adminprodutos/solicitacoes/f/$1/$1";
$route['4f713efdd5a702bb7c0bf2608f3a6a72/f/(:any)']         = "admin/adminprodutos/solicitacoes/f/$1";

$route['fa1771910ec4230a88dcdcc0dee9d913/(:num)']           = "admin/adminprodutos/verSolicitacao/$1";
$route['6edd34b83db678aa99c4e312f70ee82d']                  = 'admin/adminprodutos/updateStatus';

//Devoluções
$route['aec5e956c610cf9b6445c40befc0e850']                  = 'admin/admindevolucoes/devolucoes';
$route['aec5e956c610cf9b6445c40befc0e850/n/(:num)']         = "admin/admindevolucoes/devolucoes/n/$1";
$route['aec5e956c610cf9b6445c40befc0e850/n']                = 'admin/admindevolucoes/devolucoes/n';
$route['aec5e956c610cf9b6445c40befc0e850/f/(:any)/(:num)']  = "admin/admindevolucoes/devolucoes/f/$1/$1";
$route['aec5e956c610cf9b6445c40befc0e850/f/(:any)']         = "admin/admindevolucoes/devolucoes/f/$1";

$route['a727108ec64c324b8beac74027fc06b2']                  = 'admin/admindevolucoes/alterarStatus';
$route['4eeaa8fe234a5a517458f7d141118777']                  = 'admin/admindevolucoes/adicionarStatus';
$route['a1a14cc2bb19ab7fe7d49bfbc0a0e3c6']                  = 'admin/admindevolucoes/getReembolso';

//Relatórios
$route['e12424b582344b74d442de7107c91fd9']                  = 'admin/adminrelatorios/relatorios';
$route['admin/relatoriosloja']                              = 'admin/adminrelatorios/relatoriosloja';
$route['e12424b582344b74d442de7107c91fd9/n/(:num)']         = "admin/admindevolucoes/devolucoes/n/$1";
$route['e12424b582344b74d442de7107c91fd9/n']                = 'admin/admindevolucoes/devolucoes/n';
$route['e12424b582344b74d442de7107c91fd9/f/(:any)/(:num)']  = "admin/admindevolucoes/devolucoes/f/$1/$1";
$route['e12424b582344b74d442de7107c91fd9/f/(:any)']         = "admin/admindevolucoes/devolucoes/f/$1";

$route['3b4dd596fc64a3b4d3f26554558a74ec']                  = 'admin/adminrelatorios/gerarRelatorioPedidos';
$route['27849c9ae97d4b36accc8e5b12e45b77']                  = 'admin/adminrelatorios/gerarRelatorioPedidosSintetico';
$route['c42fa213564a7eb1cb6c02444a1d01c8']                  = 'admin/adminrelatorios/gerarRelatorioProdutos';

//Campanhas
$route['ac644a9504a310c06568e9b1c77c2032']                  = 'admin/admincampanhas/sms';

//Ajustes
$route['8fb192af45f75504361d0011c1677415']                  = 'admin/adminajustes/pagamentos';
$route['4534e545773fbcd02083f3380519437e']                  = 'admin/adminajustes/gestorPG';
$route['ab8a2766f50ffb443958ea946a9ba731']                  = 'admin/adminajustes/atualizarCorreios';
$route['7da8089498f0ac8e05a26d6a0f535403']                  = 'admin/adminajustes/chaves';
$route['1b447af94eb10e8831c155c01be26599']                  = 'admin/adminajustes/insertEmail';

//Perfil
$route['1113c334193562fcb49c6557f14671f9']                  = 'admin/adminperfil/perfil';
$route['79d99ec07624519b935dc0989b93b169']                  = 'admin/adminperfil/atualizarPerfil';

//Site
$route['af8889282b50f9030f8cc7a19b3f706d']                  = 'admin/adminsite/site';
$route['589f4ef9553ca0b67ad8f1d6c02d8eef']                  = 'admin/adminsite/atualizarSite';

//nsgestst
$route['dc28f82848daefd26e2f0f38094d5818']                  = 'nsgestst';
$route['90617da22f81b0d789597a2d88d6cc9d']                  = 'admin/adminpedidos/trocas';
$route['90617da22f81b0d789597a2d88d6cc9d/(:num)']           = "admin/adminpedidos/trocas/$1";


//AJAX

$route['addFuncionario']                            = "admin/adminfuncionarios/addFuncionario";
$route['editFuncionario']                           = "admin/adminfuncionarios/editFuncionario";
$route['seeFuncionario']                            = "admin/adminfuncionarios/seeFuncionario";
$route['delFuncionario']                            = "admin/adminfuncionarios/delFuncionario";
$route['appendFuncionarios']                        = "admin/adminfuncionarios/appendFuncionario";
$route['updateSenha']                               = "admin/adminfuncionarios/newSenha";
$route['moveEstoque']                               = "admin/adminestoque/movimentaEstoque";
$route['addMovimentoEstoque']                       = "admin/adminestoque/addMovimentoEstoque";
$route['validarLogin']                              = "logincontroller/validaCredencial";
$route['updEstoque']                                = "admin/adminestoque/updateEstoque";


//$route['versenha']                                = 'sorteio/versenha';
$route['444b70aa51ba969ce31c8fc0e2d4066a']          = "sorteio/versenha";                       //OK
$route['c40f6c78b146e2076bfbc7ed93be9506']          = "sorteio/linksorteio";                    //OK

//$route['configuracao']                            = 'configuracoes/pagamentos';
$route['d969bcbee24a8b06fb0453da855c768a']          = "configuracoes/pagamentos";               //SOON

//$route['gerenciarpagamentos']                     = 'configuracoes/gestorPG';
$route['92761362f4c44ed342587bbc8befa986']          = "configuracoes/gestorPG";                 //SOON

$route['7353df2c4374b05e205fa76aeb593a7b']          = 'restrito/getDiasInfo';
$route['get-ultimos-pedidos']          = 'restrito/getUltimosPedidos';

/*
*   Rotas GetNet
*/
$route['getcredito']    = 'pagamento2/creditoreturn';
$route['getdebito']     = 'pagamento2/debitoreturn';
$route['getboleto']     = 'pagamento2/boletoreturn';

/*
*   Rotas publicas 
*/

$route['2b1e190210df261675c4b801bc6e8989']          = 'areauser/entrar'; //carrinho
$route['3ac186ea673c6560fd6756a7c3796794']          = 'correios/frete';

$route['f188220c570e7b56040941a83fdaf2bf']          = 'Mercapag/recebePagamento'; //compraMP
$route['b5f06e72d6d5104bdae7736fd0786d9c']          = 'contato';

$route['2ed7ae53dde60f945ba3dc6a00d2365b']          = 'FinalizaUnico/updateClienteEndereco'; //compraUnica
$route['3cac916df58bfeb8d10bcb667c55d50a']          = 'FinalizaUnico/login';
$route['723d1cbbf8cd8390aa123698762b1129']          = 'FinalizaUnico/compra';
$route['3a7ba319e0cf0fdffd39e64934e4c54a']          = 'FinalizaUnico/pagamento';
$route['00af9148767db1213585b339276df4e6']          = 'inicio/resgataCEP';

$route['f3d93e09df4ae8d436c1d1aa8d6e08cf']          = 'contato/enviacontato'; //contato

$route['ca64a968b4507c33a7c38a4d93c715b5']          = 'FinalizaUnico/frete2'; //iframe_cart
$route['afa44bc5ac8580b2cdd34d9e50e80db0']          = 'FinalizaUnico/atualiza2';
$route['4de7d7673b8085024253a2236b14442b']          = 'FinalizaUnico/remove2';
$route['c381f5b941991b232b548dc6110b2c54']          = 'FinalizaUnico/encerra';
// $route['b920e92e9e4616300f9b7e6f3fd78635']          = 'FinalizaUnico/telaUnica2';
$route['92e97566397e7d998f610c34726e7a20']          = 'areauser/Principal';

$route['93516455561e3a5a18a837062e89eda3']          = 'PagamentosPS/boleto'; //iframe_final
$route['d06c138197af9ef4eb637c1a544fd50a']          = 'PagamentosPS/cartaoCredito';

$route['d41d8cd98f00b204e9800998ecf8427e']          = 'FinalizaUnico/logar'; //iframe_login
$route['f0d521cc04be1fc17dd0e4a3eaa9416f']          = 'FinalizaUnico/cadastrar';
$route['20f78cc3d3cba8f46f596c481357096d']          = 'FinalizaUnico/cadastrarCompleto';

$route['406e133b78aebb38adf22fea8cf10a70']          = 'inicio/inserirSolicitacao';
$route['71b141ddd8292dea8bb362092fd5661f/(:num)']   = "produto/verproduto/$1";

$route['2cbb8dbaacfbc463addd849f7c5ece4a']          = 'areauser/login'; //login
$route['43a87db0555f4890c47e68401601be3e']          = 'areauser/insertCliente';

$route['93516455561e3a5a18a837062e89eda3']          = 'PagamentosPS/boleto'; //pagsegboleto

$route['d06c138197af9ef4eb637c1a544fd50a']          = 'PagamentosPS/cartaoCredito'; //pagsegcredito

$route['e308dd18f514e5db6400b6cfcc82a2df']          = 'conta#pedidos'; //pedido
$route['f8dee182f9bb056fcecdeb3c150721dd']          = 'inicio/solicitaReembolso';

$route['c8b39540f80ad8d4952cf79d651aec77']          = 'areauser/deslogar'; //principaluser
$route['518244d885f7954e658e58590b55f00e']          = 'areauser/updateClienteDados';
$route['c7a0f86bd55fc21784a214275d528b2c']          = 'areauser/updateClienteEndereco';
$route['2d7fdaba4614564489b1c83981f92672']          = 'areauser/redefinirSenha';
$route['f2a65f4a9e58f011ea41f053ea58053d']          = 'areauser/verPedido';

$route['432b311230a5e558d6dfdd37aa7cb986']          = 'FinalizaUnico/finaliza2'; //produto

$route['36d2a623d4b5878db84e0032b88bcabc/(:num)']   = 'PagamentoSTN/pedido/$1';

$route['pdv']                                       = 'pdv/index';
$route['caixa']                                     = 'caixa/index';

$route['teste']                                     = 'teste/testeBD';
