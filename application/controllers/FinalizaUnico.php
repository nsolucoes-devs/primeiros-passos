<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FinalizaUnico extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('formaspagamento');
    $this->load->model('correiosmodel');
    $this->load->model('carrinhomodel');
    $this->load->model('departamentos');
    $this->load->model('produtos');
    $this->load->model('promocoes');
    $this->load->model('clientes');
    $this->load->model('configs');
    date_default_timezone_set('America/Sao_Paulo');
  }

  public function produtoPromocao($produto)
  {
    $valor          = null;
    $porcentagem    = null;

    $promocoes = $this->promocoes->getAllAtivos();

    foreach ($promocoes as $promo) {
      $aux_produtos = explode('¬', $promo['promocao_produtos']);
      foreach ($aux_produtos as $a) {
        if ($a == $produto['produto_id']) {

          if ($promo['promocao_cupom_ativo'] == 0) {
            if ($promo['promocao_preco_ativo'] == 1) {
              $valor = $promo['promocao_preco'];
              $porcentagem = 100 - (($promo['promocao_preco'] * 100) / $produto['produto_valor']);
            } else if ($promo['promocao_desconto_ativo'] == 1) {
              $porcentagem = $promo['promocao_desconto'];
              $valor = $produto['produto_valor'] - (($promo['promocao_desconto'] / 100) * $produto['produto_valor']);
            }
          }
        }
      }
    }

    if ($valor == null) {
      if ($produto['produto_cupom_ativo'] == 0) {
        if ($produto['produto_preco_promocao_ativo'] == 1) {
          $valor = $produto['produto_preco_promocao'];
          $porcentagem = 100 - (($produto['produto_preco_promocao'] * 100) / $produto['produto_valor']);
        } else if ($produto['produto_desconto_ativo'] == 1) {
          $desconto = $produto['produto_desconto'];
          $porcentagem = $produto['produto_desconto'];
          $valor = $produto['produto_valor'] - (($produto['produto_desconto'] / 100) * $produto['produto_valor']);
        }
      }
    }

    $array = array(
      'valor'         => $valor,
      'porcentagem'   => $porcentagem,
    );

    return $array;
  }

  public function telaUnica2()
  {
    $this->session->unset_userdata('logado_cart', true);
    $this->session->unset_userdata('finalizado_cart', true);

    if ($this->session->userdata('cadastro_erro')) {
      $data['cadastro_erro'] = $this->session->userdata('cadastro_erro');
      $this->session->unset_userdata('cadastro_erro');
    } else {
      $data['cadastro_erro'] = null;
    }

    if ($this->session->userdata('login_erro')) {
      $data['login_erro'] = $this->session->userdata('login_erro');
      $this->session->unset_userdata('login_erro');
    } else {
      $data['login_erro'] = null;
    }

    $dados = $this->compra3();

    if (isset($dados['frete'])) {
      if ($dados['frete']) {
        $data['frete']         = $dados['frete'];
      } else {
        $data['frete']         = null;
      }
    }

    if (isset($dados['vazio'])) {
      if ($dados['vazio']) {
        $data['vazio']         = $dados['vazio'];
      } else {
        $data['vazio']         = null;
      }
    }

    $produtos_array  = $this->produtos->getAllAleatorio();
    $cont            = 0;
    $produtos        = [];

    foreach ($produtos_array as $p) {
      $valor_promocao         = null;
      $porcentagem_promocao   = null;
      $nome_departamento      = null;

      if ($p['produto_departamentos']) {
        $aux_departamentos = explode('¬', $p['produto_departamentos']);
        $departamento = $this->departamentos->get($aux_departamentos[0]);
        if ($departamento) {
          $nome_departamento = $departamento['departamento_nome'];
        }
      }

      $produto_promocao       = $this->produtoPromocao($p);
      $valor_promocao         = $produto_promocao['valor'];
      $porcentagem_promocao   = $produto_promocao['porcentagem'];

      if ($p) {
        $produtos[$cont] = array(
          'produto_id'            => $p['produto_id'],
          'produto_nome'          => $p['produto_nome'],
          'produto_valor'         => $p['produto_valor'],
          'produto_promocao'      => $valor_promocao,
          'produto_porcentagem'   => $porcentagem_promocao,
          'produto_departamento'  => $nome_departamento,
        );
        $cont++;
      }
    }

    $data['desconto']      = $dados['desconto'];
    $data['valorTotal']    = $dados['valorTotal'];
    $data['carrinho']      = $dados['carrinho'];
    $data['chave']         = $dados['chave'];
    $data['cliente']       = $this->login();
    $data['produtos']      = $produtos;
    $data['formacartao']   = $this->formaspagamento->get('cartao');
    $data['formaboleto']   = $this->formaspagamento->get('boleto');
    $data['formatransfer'] = $this->formaspagamento->get('transferencia');

    $this->acessoVenda();

    $this->header();
    $this->load->view('compraUnica2', $data);
    $this->footer();
  }

  public function esquecerSenha()
  {


    $cpf    = $this->limpa($this->input->post('cpf-esquecer'));
    $email  = mb_strtoupper($this->input->post('email-esquecer'));

    $cliente = $this->clientes->getCPF($cpf);
    if ($cliente) {
      if ($cliente['cliente_email'] == $email) {
        $this->session->set_userdata('msg', 5);
        $dados = array(
          'nome'          => $cliente['cliente_nome'],
          'senha'         => $cliente['cliente_cpf'],
          'email'         => $cliente['cliente_email'],
        );

        $cliente_novo = array(
          'cliente_senha' =>    md5($cliente['cliente_cpf']),
        );

        $this->clientes->update($cliente['cliente_id'], $cliente_novo);
        $this->enviaEsqueceuEmail($dados);
      } else {
        $this->session->set_userdata('msg', 6);
      }
    } else {
      $this->session->set_userdata('msg', 4);
    }

    $this->login2();
  }

  public function finaliza2()
  {
    $this->session->unset_userdata('correio');
    if ($this->input->post('idProduto') !== null) {
      if ($this->session->userdata('carrinho')) {
        $produto = $this->produtos->get($this->input->post('idProduto'));

        if ($this->input->post('cor')) {
          $aux_cor            = explode('_', $this->input->post('cor'));
          $estoque_permitido  = $aux_cor[0];
        } else if ($this->input->post('tamanho')) {
          $aux_tamanho        = explode('_', $this->input->post('tamanho'));
          $estoque_permitido  = $aux_tamanho[0];
        } else {
          $estoque_permitido = $produto['produto_quantidade'];
        }

        $carrinho   = $this->carrinhomodel->getCarrinhoMininum($this->session->userdata('carrinho'));
        $aux_ids    = explode('¬', $carrinho['listProdutosId']);
        $aux_qtd    = explode('¬', $carrinho['qtdProdutos']);
        $cont       = 0;
        $calculo    = 0;

        foreach ($aux_ids as $ids) {
          if ($ids == $this->input->post('idProduto')) {
            $calculo = intval($this->input->post('quantidade')) + $aux_qtd[$cont];
          }
          $cont++;
        }

        if ($estoque_permitido < $calculo) {
          $this->session->set_userdata('maximo_estoque', $estoque_permitido);
          redirect(base_url('71b141ddd8292dea8bb362092fd5661f/' . $this->input->post('idProduto')));
        } else {
          $this->carrinho($this->input->post('idProduto'), $this->input->post('quantidade'), $this->input->post('cor'), $this->input->post('tamanho'));

          // Feito por Gui - Calcular a quantidade de produtos no carrinho para exibir no header
          $contcarrinho =  $this->carrinhomodel->contcarrinho($this->session->userdata('carrinho'));
          $this->session->set_userdata('quantidade_carrinho', $contcarrinho);
          //
        }
      } else {
        $this->carrinho($this->input->post('idProduto'), $this->input->post('quantidade'), $this->input->post('cor'), $this->input->post('tamanho'));

        // Feito por Gui - Calcular a quantidade de produtos no carrinho para exibir no header
        $contcarrinho =  $this->carrinhomodel->contcarrinho($this->session->userdata('carrinho'));
        $this->session->set_userdata('quantidade_carrinho', $contcarrinho);
        //
      }
    }
    redirect(base_url('b920e92e9e4616300f9b7e6f3fd78635'));
  }

  public function cupom()
  {
    $this->load->model('produtos');
    $this->load->model('promocoes');

    $id_cupom = $this->input->post('cupom');
    $id_cart = $this->session->userdata('carrinho');
    $promocoes = $this->promocoes->getAllAtivos();
    $carrinho = $this->carrinhomodel->getCarrinho($id_cart);
    $valor = null;
    if ($carrinho) {
      $aux_produtos = explode('¬', $carrinho['listProdutosId']);

      foreach ($promocoes as $promo) {
        if ($promo['promocao_cupom_ativo'] == 1) {
          if ($promo['promocao_cupom'] == $id_cupom) {
            $aux_promo_produtos = explode('¬', $promo['promocao_produtos']);
            foreach ($aux_produtos as $aux_carrinho) {
              foreach ($aux_promo_produtos as $aux_promo) {
                $produto = $this->produtos->getAtivo($aux_promo);
                $produto_carrinho = $this->produtos->getAtivo($aux_carrinho);
                if ($produto && $produto_carrinho) {
                  if ($produto_carrinho['produto_id'] == $produto['produto_id']) {
                    if ($promo['promocao_preco_ativo'] == 1) {
                      $valor = $promo['promocao_preco'];
                    } else if ($promo['promocao_desconto_ativo'] == 1) {
                      $valor = $valor + ($promo['promocao_desconto'] / 100) * $produto['produto_valor'];
                    }
                  }
                }
              }
            }
          }
        }
      }


      if ($valor == null) {
        foreach ($aux_produtos as $aux) {
          $produto = $this->produtos->getAtivo($aux);
          $boolean = true;
          if ($produto) {
            if ($produto['produto_datainicial_promocao'] > date('Y-m-d')) {
              $boolean = false;
            }
            if ($produto['produto_datafinal_promocao_ativo'] == 1) {
              if ($produto['produto_datafinal_promocao'] < date('Y-m-d')) {
                $boolean = false;
              }
            }

            if ($boolean == true) {
              if ($produto['produto_cupom_ativo'] == 1) {
                if ($produto['produto_cupom'] == $id_cupom) {
                  if ($produto['produto_preco_promocao_ativo'] == 1) {
                    $valor = $produto['produto_preco_promocao'];
                  } else if ($produto['produto_desconto_ativo'] == 1) {
                    $valor = $produto['produto_desconto'] / 100 * $produto['produto_valor'];
                  }
                }
              }
            }
          }
        }
      }
    }
    $carrinho['desconto'] = $valor;

    $this->carrinhomodel->updateCartUnico($carrinho);

    $this->telaUnica2();
  }

  public function login()
  {
    $cliente = null;
    if ($this->session->userdata('login_erro')) {
      $data['login_erro'] = $this->session->userdata('login_erro');
      $this->session->unset_userdata('login_erro');
    }
    if ($this->session->userdata('cliente_logado')) {

      $cliente = $this->clientes->get($this->session->userdata('cliente_user_id'));
      $cliente['cliente_cpf'] = $this->mask($cliente['cliente_cpf'], '###.###.###-##');
      $cliente['cliente_cep'] = $this->mask($cliente['cliente_cep'], '#####-###');

      if ($cliente['cliente_endereco'] !== null) {
        if ($cliente['cliente_numero'] !== null) {
          if ($cliente['cliente_cidade'] !== null) {
            if ($cliente['cliente_bairro'] !== null) {
              if ($cliente['cliente_estado'] !== null) {
                $cliente['check'] = true;
              }
            }
          }
        }
      }
    }

    return $cliente;
  }

  public function compra3()
  {

    if ($this->session->userdata('cliente_cep') && $this->session->userdata('carrinho')) {
      $dados['frete'] = $this->correiosmodel->frete($this->session->userdata('carrinho'));
    }

    if ($this->session->userdata('finalcompra')) {
      $aux = $this->carrinhomodel->rescueCompra($this->session->userdata('finalcompra'));
      if ($aux) {
        if (is_array($aux)) {
          $pdt    = explode("¬", $aux['listProdutosId']);
          $qtd    = explode("¬", $aux['qtdProdutos']);
        } else {
          $pdt    = number_format($aux['listProdutosId'], 2, ",", ".");
          $qtd    = number_format($aux['qtdProdutos'], 2, ",", ".");
        }

        for ($i = 0; $i < count($pdt); $i++) {

          //$a = $this->carrinhomodel->rescueProduct($pdt[$i]);
          $a = $this->carrinhomodel->getProdutoSite($pdt[$i]);
          $b = $this->carrinhomodel->getValorSite($pdt[$i]);
          $c = $this->carrinhomodel->getPromocaoSite($pdt[$i], $b);
          $maximo = $a['produto_quantidade'];
          $opcao  = "padrão";
          $aux_op = explode('¬', $aux['opProdutos']);

          if ($aux_op[$i] == 'padrão') {
            if ($a['produto_quantidade'] > 50) {
              $maximo = 50;
            }
          } else {
            $aux_op2 = explode('&', $aux_op[$i]);
            $opcao = $aux_op2[0] . ': ' . $aux_op2[1];
            if ($aux_op2[0] == 'tamanho') {
              $aux_tamanhos = explode('¬', $a['produto_tamanhos']);
              foreach ($aux_tamanhos as $t) {
                $aux_estoque = explode('&', $t);
                if ($aux_estoque[0] == $aux_op2[1]) {
                  $maximo = $aux_estoque[1];
                }
              }
            } else if ($aux_op2[0] == 'cor') {
              $aux_cores = explode('¬', $a['produto_cores']);
              foreach ($aux_cores as $c) {
                $aux_estoque = explode('&', $c);
                if ($aux_estoque[0] == $aux_op2[1]) {
                  $maximo = $aux_estoque[1];
                }
              }
            }
          }

          $carrinho[$i] = array(
            'idProduto'   => $pdt[$i],
            'produto'     => $a['produto_nome'],
            'modelo'      => $a['produto_modelo'],
            'valor'       => $c['precoNovo'],
            'opcao'       => $opcao,
            'maximo'      => $maximo,
            'quantidade'  => $qtd[$i],
          );
        }
      } else {
        $carrinho = array();
        $aux['valorTotal'] = "";
        $aux['desconto'] = "";
        $dados['vazio'] = 1;
      }
    } elseif ($this->session->userdata('carrinho')) {
      $aux = $this->carrinhomodel->carrinho($this->session->userdata('carrinho'));

      if (is_array($aux)) {
        $pdt    = explode("¬", $aux['listProdutosId']);
        $qtd    = explode("¬", $aux['qtdProdutos']);
      } else {
        $pdt = number_format($aux['listProdutosId'], 2, ",", ".");
        $qtd = number_format($aux['qtdProdutos'], 2, ",", ".");
      }

      for ($i = 0; $i < count($pdt); $i++) {


        //$a = $this->carrinhomodel->rescueProduct($pdt[$i]);
        $a = $this->carrinhomodel->getProdutoSite($pdt[$i]);
        $b = $this->carrinhomodel->getValorSite($pdt[$i]);
        $c = $this->carrinhomodel->getPromocaoSite($pdt[$i], $b);
        $maximo = $a['produto_quantidade'];
        $opcao  = "padrão";
        $aux_op = explode('¬', $aux['opProdutos']);

        if ($aux_op[$i] == 'padrão') {
          if ($a['produto_quantidade'] > 50) {
            $maximo = 50;
          }
        } else {
          $aux_op2 = explode('&', $aux_op[$i]);
          $opcao = $aux_op2[0] . ': ' . $aux_op2[1];
          if ($aux_op2[0] == 'tamanho') {
            $aux_tamanhos = explode('¬', $a['produto_tamanhos']);
            foreach ($aux_tamanhos as $t) {
              $aux_estoque = explode('&', $t);
              if ($aux_estoque[0] == $aux_op2[1]) {
                $maximo = $aux_estoque[1];
              }
            }
          } else {
            $aux_cores = explode('¬', $a['produto_cores']);
            foreach ($aux_cores as $c) {
              $aux_estoque = explode('&', $c);
              if ($aux_estoque[0] == $aux_op2[1]) {
                $maximo = $aux_estoque[1];
              }
            }
          }
        }

        $carrinho[$i] = array(
          'idProduto'   => $pdt[$i],
          'produto'     => $a['produto_nome'],
          'modelo'      => $a['produto_modelo'],
          'opcao'       => $opcao,
          'valor'       => $c['precoNovo'],
          'maximo'      => $maximo,
          'quantidade'  => $qtd[$i],
        );
      }
    } else {
      $carrinho = array();
      $aux['valorTotal'] = "";
      $aux['desconto'] = "";
      $dados['vazio'] = 1;
    }

    $dados['desconto']      = $aux['desconto'];
    $dados['valorTotal']    = $aux['valorTotal'];
    $dados['carrinho']      = $carrinho;
    $dados['chave']         = $this->configs->getChave(1);

    return $dados;
  }

  public function calcDesconto($desconto, $compra, $forma)
  {
    if ($forma == 'cartao') {
      $formapag = $this->formaspagamento->get('cartao');
    } else if ($forma == 'boleto') {
      $formapag = $this->formaspagamento->get('boleto');
    } else if ($forma == 'transferência') {
      $formapag = $this->formaspagamento->get('transferencia');
    } else {
      return $desconto;
    }

    if ($formapag['ativo_forma'] == 1 && $formapag['desconto_ativo_forma'] == 1) {
      $desconto   = (($formapag['desconto_forma'] / 100) * $compra) + $desconto;
    }

    return $desconto;
  }

  public function encerra2()
  {
    $this->session->set_userdata('compra', true);
    $aux        = $this->carrinhomodel->carrinho($this->session->userdata('carrinho'));
    $cliente    = $this->clientes->get($this->session->userdata('cliente_user_id'));

    if ($aux['desconto'] == null) {
      $desconto = 0;
    } else {
      $desconto = $aux['desconto'];
    }

    $desconto = $this->calcDesconto($desconto, $aux['valorTotal'], $this->input->post('pagamento'));

    $enderecocompleto = mb_strtoupper($cliente['cliente_endereco']) . '¬' . mb_strtoupper($cliente['cliente_complemento']) . '¬' . mb_strtoupper($cliente['cliente_bairro']) . '¬' . mb_strtoupper($cliente['cliente_cidade']) . '¬' . mb_strtoupper($cliente['cliente_estado']);

    $dados = array(
      'idClient'          => $this->session->userdata('cliente_user_id'),
      'cepCompra'         => str_replace("-", "", $this->session->userdata('cliente_cep')),
      'idCarrinho'        => $this->session->userdata('carrinho'),
      'numeroEndereco'    => $cliente['cliente_numero'],
      'formaEnvio'        => $this->input->post('correio'),
      'formaPagamento'    => $this->input->post('pagamento'),
      'dataCompra'        => date('Y-m-d H:i:s'),
      'listProdutosId'    => $aux['listProdutosId'],
      'qtdProdutos'       => $aux['qtdProdutos'],
      'vlrProdutos'       => $aux['vlrProdutos'],
      'opProdutos'        => $aux['opProdutos'],
      'valorCompra'       => $aux['valorTotal'],
      'valorFrete'        => $this->input->post('valorfrete'),
      'statusCompra'      => 1,
      'statusEnvio'       => 0,
      'statusPagamento'   => 16,
      'codTransacao'      => "",
      'dataAlteracao'     => date('Y-m-d H:i:s'),
      'desconto'          => $desconto,
      'enderecoCompra'    => $enderecocompleto,
    );

    $id = $this->carrinhomodel->compra($dados, $this->session->userdata('carrinho'));

    $this->session->set_userdata('frete_valor', $this->input->post('valorfrete'));
    $this->session->set_userdata('frete_tipo', $this->input->post('correio'));
    $this->session->set_userdata('forma_pag', $this->input->post('pagamento'));
    $this->session->set_userdata('finalizado_cart', true);


    $this->session->unset_userdata('frete_valor');
    $this->session->unset_userdata('frete_tipo');
    $this->session->unset_userdata('forma_pag');
    $this->session->unset_userdata('finalizado_cart');
    $this->session->unset_userdata('quantidade_carrinho');
    redirect(base_url('pagamentoTFN/pedido/' . $id));
  }

  public function retornarCompra()
  {
    $pedido = $this->carrinhomodel->getPedido($this->session->userdata('finalcompra'));

    if ($pedido) {
      $this->carrinhomodel->deletePedido($this->session->userdata('finalcompra'));

      $this->session->unset_userdata('finalcompra');
      $this->session->unset_userdata('compra');
      $this->session->unset_userdata('forma_pag');
      $this->session->unset_userdata('finalizado_cart');

      $aux_produto    = explode('¬', $pedido['listProdutosId']);
      $aux_quantidade = explode('¬', $pedido['qtdProdutos']);
      $cont = 0;


      foreach ($aux_produto as $p) {
        if ($cont == 0) {
          $this->carrinhomodel->cartunico($p, $aux_quantidade[$cont], 0);
        } else {
          $this->carrinhomodel->cartunico($p, $aux_quantidade[$cont], $this->session->userdata('carrinho'));
        }

        $cont++;
      }
    }


    $this->telaUnica2();
  }

  private function limpa($val)
  {
    $helper = array(",", ".", "(", ")", "+", "-", " ", "/");
    return str_replace($helper, "", $val);
  }

  private function mask($val, $mask)
  {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {

      if ($mask[$i] == '#') {
        if (isset($val[$k]))
          $maskared .= $val[$k++];
      } else {
        if (isset($mask[$i]))
          $maskared .= $mask[$i];
      }
    }

    return $maskared;
  }

  public function logar()
  {
    $this->load->model('clientes');

    $login = $this->limpa($this->input->post('login'));
    $senha = $this->input->post('pass');

    $aux = 0;
    if ($this->clientes->getSenhaLogin($login, md5($senha))) {
      $cliente = $this->clientes->getCPF($login);

      if ($cliente['cliente_ativo'] == 0) {
        $this->session->set_userdata('login_erro', 2);
        redirect(base_url('3cac916df58bfeb8d10bcb667c55d50a'));
      } else {
        $this->session->set_userdata('cliente_user_id', $cliente['cliente_id']);
        $this->session->set_userdata('cliente_nome', $cliente['cliente_nome']);
        if ($cliente['cliente_cep'] != null) {
          $this->session->set_userdata('cliente_cep', $cliente['cliente_cep']);
        } else {
          $this->session->set_userdata('cliente_cep', '00000000');
        }


        if ($cliente['cliente_cep'] == null || $cliente['cliente_cep'] == "") {
          $aux++;
        } else if ($cliente['cliente_endereco'] == null || $cliente['cliente_endereco'] == "") {
          $aux++;
        } else if ($cliente['cliente_numero'] == null || $cliente['cliente_numero'] == "") {
          $aux++;
        } else if ($cliente['cliente_bairro'] == null || $cliente['cliente_bairro'] == "") {
          $aux++;
        } else if ($cliente['cliente_cidade'] == null || $cliente['cliente_cidade'] == "") {
          $aux++;
        } else if ($cliente['cliente_estado'] == null || $cliente['cliente_estado'] == "") {
          $aux++;
        } else if ($cliente['cliente_email'] == null || $cliente['cliente_email'] == "") {
          $aux++;
        } else if ($cliente['cliente_nascimento'] == null || $cliente['cliente_nascimento'] == "") {
          $aux++;
        }

        if ($aux > 0) {
          $this->session->set_userdata('cliente_sem_endereco', 1);
        } else {
          $this->session->set_userdata('cliente_sem_endereco', 0);
        }

        $this->session->set_userdata('cliente_logado', 1);
        $this->session->set_userdata('logado_cart', true);

        $this->session->set_userdata('login_erro', 0);
        redirect(base_url('b920e92e9e4616300f9b7e6f3fd78635'));
      }
    } else {
      $this->session->set_userdata('login_erro', 1);
      redirect(base_url('b920e92e9e4616300f9b7e6f3fd78635'));
    }
  }

  public function cadastrar()
  {

    $this->load->database();
    $this->load->model('clientes');
    $cliente = $this->clientes->getCPF($this->limpa($this->input->post('cpf')));
    $nome = $this->input->post('name');
    $senha = $this->input->post('pass');

    if ($nome != null || $nome != "") {
      if ($cliente) {
        $this->session->set_userdata('login_erro', 2);
      } else {
        if (strlen($senha) < 6) {
          $this->session->set_userdata('login_erro', 4);
        } else {
          $dados = array(
            'cliente_nome'          => mb_strtoupper($this->input->post('name')),
            'cliente_cpf'           => $this->limpa($this->input->post('cpf')),
            'cliente_senha'         => md5($this->input->post('pass')),
            'cliente_ativo'         => 1,
            'cliente_datacadastro'  => date('Y-m-d'),
          );
          $id = $this->clientes->insert($dados);
          $this->session->set_userdata('cliente_user_id', $id);
          $this->session->set_userdata('cliente_nome', $this->input->post('name'));
          $this->session->set_userdata('cliente_logado', 1);
          $this->session->set_userdata('logado_cart', true);
          $this->session->set_userdata('cliente_sem_endereco', 1);
        }
      }
    } else {
      $this->session->set_userdata('login_erro', 3);
    }

    redirect(base_url('3cac916df58bfeb8d10bcb667c55d50a'));
  }

  public function cadastrarCompleto()
  {

    $this->load->database();
    $this->load->model('clientes');
    $cliente = $this->clientes->getCPF($this->limpa($this->input->post('cpf_cadastro')));
    $nome = $this->input->post('nome_cadastro');
    $senha = $this->input->post('senha_cadastro');

    if ($nome != null || $nome != "") {
      if ($cliente) {
        $this->session->set_userdata('login_erro', 2);
      } else {
        if (strlen($senha) < 6) {
          $this->session->set_userdata('login_erro', 4);
        } else {
          $data = explode('/', $this->input->post('nascimento_cadastro'));
          $date = $data[2] . '-' . $data[1] . '-' . $data[0];

          $dados = array(
            'cliente_nome'          => mb_strtoupper($this->input->post('nome_cadastro')),
            'cliente_cpf'           => $this->limpa($this->input->post('cpf_cadastro')),
            'cliente_senha'         => md5($this->input->post('senha_cadastro')),
            'cliente_ativo'         => 1,
            'cliente_datacadastro'  => date('Y-m-d'),
            'cliente_telefone'      => $this->limpa($this->input->post('telefone_cadastro')),
            'cliente_email'         => mb_strtoupper($this->input->post('email_cadastro')),
            'cliente_nascimento'    => $date,
            'cliente_cep'           => $this->limpa($this->input->post('cep_cadastro')),
            'cliente_endereco'      => mb_strtoupper($this->input->post('rua_cadastro')),
            'cliente_numero'        => $this->input->post('numero_cadastro'),
            'cliente_cidade'        => mb_strtoupper($this->input->post('cidade_cadastro')),
            'cliente_bairro'        => mb_strtoupper($this->input->post('bairro_cadastro')),
            'cliente_estado'        => mb_strtoupper($this->input->post('estado_cadastro')),
            'cliente_complemento'   => $this->input->post('complemento_cadastro'),
          );
          $id = $this->clientes->insert($dados);
          $this->session->set_userdata('login_erro', 5);
          $this->session->set_userdata('cliente_user_id', $id);
          $this->session->set_userdata('cliente_nome', $this->input->post('nome_cadastro'));
          $this->session->set_userdata('cliente_logado', 1);
          $this->session->set_userdata('logado_cart', true);
          $this->session->set_userdata('cliente_sem_endereco', 0);
          $this->session->set_userdata('cliente_cep', $this->limpa($this->input->post('cep_cadastro')));
        }
      }
    } else {
      $this->session->set_userdata('login_erro', 3);
    }

    redirect(base_url('b920e92e9e4616300f9b7e6f3fd78635'));
  }

  function carrinho($produto, $quantidade, $cor, $tamanho)
  {

    if ($this->session->userdata('carrinho')) {
      $id = $this->session->userdata('carrinho');
    } else {
      $id = 0;
    }
    $aux = $this->carrinhomodel->cartunico($produto, $quantidade, $id, $cor, $tamanho);
  }

  function atualiza2()
  {
    $idTemp = $this->session->userdata('carrinho');
    $carrinho = $this->carrinhomodel->getCarrinho($idTemp);

    $qtdProdutos = $listProdutos = $valorTotal = $pesoTotal = $alturaTotal = $comprimentoTotal = $larguraTotal = $vlrProdutos = $opProdutos = null;
    for ($i = 1; $i < $this->input->post('itens'); $i++) {
      $helper = $this->carrinhomodel->rescueProduct2($this->input->post('produtoId_' . $i));

      $aux_op = explode('¬', $carrinho['opProdutos']);

      $qtdProdutos  .= $this->input->post('qtd_' . $i);
      $listProdutos .= $this->input->post('produtoId_' . $i);
      $vlrProdutos  .= $helper['produto_valor'];
      $opProdutos   .= $aux_op[$i - 1];

      if ($i + 1 < $this->input->post('itens')) {
        $qtdProdutos  .= "¬";
        $listProdutos .= "¬";
        $vlrProdutos  .= "¬";
        $opProdutos   .= "¬";
      }


      $valorTotal         += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_valor']);
      $pesoTotal          += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_peso']);
      $alturaTotal        += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_altura']);
      $comprimentoTotal   += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_comprimento']);
      $larguraTotal       += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_largura']);
    }



    $carrinho = array(
      'idTemp'            => $idTemp,
      'listProdutosId'    => $listProdutos,
      'qtdProdutos'       => $qtdProdutos,
      'vlrProdutos'       => $vlrProdutos,
      'valorTotal'        => $valorTotal,
      'opProdutos'        => $opProdutos,
      'pesoTotal'         => $pesoTotal,
      'alturaTotal'       => $alturaTotal,
      'comprimentoTotal'  => $comprimentoTotal,
      'larguraTotal'      => $larguraTotal,
      'desconto'          => null,
    );

    $this->carrinhomodel->updateCartUnico($carrinho);
    $this->telaUnica2();
  }

  function remove2()
  {
    //Array ( [id_remove] => 3 [produtoId_1] => 4 [value_1] => 45.50 [qtd_1] => 2 [produtoId_2] => 3 [value_2] => 58.50 [qtd_2] => 2 [produtoId_3] => 2 [value_3] => 54.60 [qtd_3] => 2 [itens] => 4 )
    $idTemp = $this->session->userdata('carrinho');
    $carrinho = $this->carrinhomodel->getCarrinho($idTemp);

    $cont = 0;
    if ($this->input->post('itens') != 2) {

      $qtdProdutos = $listProdutos = $valorTotal = $pesoTotal = $alturaTotal = $comprimentoTotal = $larguraTotal = $vlrProdutos = $opProdutos = null;
      for ($i = 1; $i < $this->input->post('itens'); $i++) {
        if ($this->input->post('produtoId_' . $i) != $this->input->post('id_remove')) {
          $helper = $this->carrinhomodel->rescueProduct2($this->input->post('produtoId_' . $i));

          $aux_op = explode('¬', $carrinho['opProdutos']);

          if ($cont == 0) {
            $qtdProdutos  .= $this->input->post('qtd_' . $i);
            $listProdutos .= $this->input->post('produtoId_' . $i);
            $vlrProdutos  .= $helper['produto_valor'];
            $opProdutos   .= $aux_op[$i - 1];
          } else {
            $qtdProdutos  .= "¬";
            $listProdutos .= "¬";
            $vlrProdutos  .= "¬";
            $opProdutos  .= "¬";
            $qtdProdutos  .= $this->input->post('qtd_' . $i);
            $listProdutos .= $this->input->post('produtoId_' . $i);
            $vlrProdutos  .= $helper['produto_valor'];
            $opProdutos   .= $aux_op[$i];
          }

          $cont++;

          $valorTotal         += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_valor']);
          $pesoTotal          += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_peso']);
          $alturaTotal        += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_altura']);
          $comprimentoTotal   += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_comprimento']);
          $larguraTotal       += ((int)$this->input->post('qtd_' . $i) * (float)$helper['produto_largura']);
        }
      }

      $carrinho = array(
        'idTemp'            => $idTemp,
        'listProdutosId'    => $listProdutos,
        'qtdProdutos'       => $qtdProdutos,
        'vlrProdutos'       => $vlrProdutos,
        'opProdutos'        => $opProdutos,
        'valorTotal'        => $valorTotal,
        'pesoTotal'         => $pesoTotal,
        'alturaTotal'       => $alturaTotal,
        'comprimentoTotal'  => $comprimentoTotal,
        'larguraTotal'      => $larguraTotal,
        'desconto'          => null,
      );

      $this->carrinhomodel->updateCartUnico($carrinho);
    } else {
      $this->carrinhomodel->clearCartUnico($idTemp);
    }

    // Feito por Gui - Calcular a quantidade de produtos no carrinho para exibir no header
    $contcarrinho =  $this->carrinhomodel->contcarrinho($this->session->userdata('carrinho'));
    $this->session->set_userdata('quantidade_carrinho', $contcarrinho);
    //


    $this->telaUnica2();
  }

  function frete()
  {
    if ($this->session->userdata('cliente_cep') != "" && $this->session->userdata('cliente_cep') != $this->input->post('cep')) {
      $this->session->set_userdata('cliente_cep', $this->limpa($this->input->post('cep')));
    } elseif ($this->session->userdata('cliente_cep') == "") {
      $this->session->set_userdata('cliente_cep', $this->limpa($this->input->post('cep')));
    }
    $this->compra();
  }

  function frete2()
  {
    if ($this->session->userdata('cliente_cep') != "" && $this->session->userdata('cliente_cep') != $this->input->post('cep')) {
      $this->session->set_userdata('cliente_cep', $this->limpa($this->input->post('cep')));
    } elseif ($this->session->userdata('cliente_cep') == "") {
      $this->session->set_userdata('cliente_cep', $this->limpa($this->input->post('cep')));
    }

    $this->telaUnica2();
  }

  function variaveis()
  {
    $data = array(
      'rua'        => "Avenida Profª Maria da Paz Barcelos de Almeida",
      'numero'     => "100",
      'bairro'     => "Elza Amui I1",
      'cep'        => "38082230",
      'cidade'     => "Uberaba",
      'uf'         => "MG",
      'pais'       => "Brasil",
      //'tokenPS'    => "38D76B013B1E42ED9C0DAA6F92A9FEE0",
      'tokenPS'    => "da4fd358-f1d9-4106-8977-cb62961ced5f8f56994a4a20a56ce88f580b8a7716e9b28b-f409-4515-ad34-bac7ca845ffe", //Produção
      'emailPS'    => "excalibur.personalizacoes@gmail.com",
    );
    return $data;
  }

  public function updateClienteEndereco()
  {
    $this->load->database();
    $this->load->model('clientes');

    $id = $this->input->post('cliente_id');

    $cliente = array(
      'cliente_telefone'    => $this->limpa($this->input->post('telefone-modal')),
      'cliente_email'       => mb_strtoupper($this->input->post('email-modal')),
      'cliente_nascimento'  => $this->input->post('nascimento-modal'),
      'cliente_cep'         => $this->limpa($this->input->post('cep-modal')),
      'cliente_endereco'    => mb_strtoupper($this->input->post('rua-modal')),
      'cliente_numero'      => $this->input->post('numero-modal'),
      'cliente_cidade'      => mb_strtoupper($this->input->post('cidade-modal')),
      'cliente_bairro'      => mb_strtoupper($this->input->post('bairro-modal')),
      'cliente_estado'      => mb_strtoupper($this->input->post('estado-modal')),
      'cliente_complemento' => $this->input->post('complemento-modal'),
    );

    $this->clientes->update($id, $cliente);

    $aux = 0;

    if ($this->input->post('cep-modal') == null || $this->input->post('cep-modal') == "") {
      $aux++;
    } else if ($this->input->post('rua-modal') == null || $this->input->post('rua-modal') == "") {
      $aux++;
    } else if ($this->input->post('numero-modal') == null || $this->input->post('numero-modal') == "") {
      $aux++;
    } else if ($this->input->post('cidade-modal') == null || $this->input->post('cidade-modal') == "") {
      $aux++;
    } else if ($this->input->post('bairro-modal') == null || $this->input->post('bairro-modal') == "") {
      $aux++;
    } else if ($this->input->post('estado-modal') == null || $this->input->post('estado-modal') == "") {
      $aux++;
    } else if ($this->input->post('email-modal') == null || $this->input->post('email-modal') == "") {
      $aux++;
    }

    if ($aux > 0) {
      $this->session->set_userdata('cliente_sem_endereco', 1);
    } else {
      $this->session->set_userdata('cliente_sem_endereco', 0);
    }

    $this->session->set_userdata('cliente_cep', $this->limpa($this->input->post('cep-modal')));
    $this->session->set_userdata('finalizado_cart', true);

    redirect(base_url('432b311230a5e558d6dfdd37aa7cb986'));
  }

  public function acessoVenda()
  {
    $this->load->database();
    $this->load->model('acessomodel');

    date_default_timezone_set('America/Sao_Paulo');

    $ano    =   date('Y');
    $mes    =   date('m');
    $dia    =   date('d');
    $hora   =   date('H');
    $min    =   date('i');

    $id = $ano . $mes . $dia . $hora;

    $acesso = $this->acessomodel->getVenda($id);

    if ($acesso != null) {
      if ($acesso['min_' . $min] == null) {
        $acesso['min_' . $min] = 1;
      } else {
        $acesso['min_' . $min]    =  $acesso['min_' . $min] + 1;
      }
      $acesso['dia']          = $acesso['dia'] + 1;
      $acesso['hora']         = $acesso['hora'] + 1;

      $this->acessomodel->updateVenda($id, $acesso);
    } else {
      $acesso = array(
        'acesso_venda_id' => $id,
        'dia'       => 1,
        'hora'      => 1,
        'min_' . $min => 1,
      );
      $this->acessomodel->insertVenda($acesso);
    }
  }

  function enviaEmail($dados)
  {
    $this->load->database();
    $this->load->model('configs');

    $site = $this->configs->getSite();
    $gestoremail = $this->configs->getEmail(1);

    $cliente = $this->clientes->getClienteById($dados['idClient']);
    if ($cliente['cliente_email']) {

      $produtos = [];
      $cont = 0;
      $aux_produtos   = explode('¬', $dados['listProdutosId']);
      $aux_quantidade = explode('¬', $dados['qtdProdutos']);
      $subtotal = 0;

      foreach ($aux_produtos as $p) {
        $produto = $this->produtos->get($p);

        $produtos[$cont] = array(
          'produto_nome'          => $produto['produto_nome'],
          'produto_modelo'        => $produto['produto_modelo'],
          'produto_quantidade'    => $aux_quantidade[$cont],
          'produto_valor'         => number_format($produto['produto_valor'], 2, ',', '.'),
          'produto_total'         => number_format($aux_quantidade[$cont] * $produto['produto_valor'], 2, ',', '.'),
        );
        $cont++;
      }


      $status = $this->carrinhomodel->getStatus($dados['statusCompra']);
      if ($status) {
        $status = $status['nomeStatusCompra'];
      } else {
        $status = 'Status não encontrado';
      }

      $cep = $this->carrinhomodel->getByCep($dados['cepCompra']);
      $aux_cep = explode('/', $cep['cep_cidadeuf']);

      if ($cliente['cliente_telefone']) {
        if (strlen($cliente['cliente_telefone']) == 11) {
          $fone = $this->mask($cliente['cliente_telefone'], '(##) #####-####');
        } else if (strlen($cliente['cliente_telefone'] == 10)) {
          $fone = $this->mask($cliente['cliente_telefone'], '(##) ####-####');
        }
      } else {
        $fone = 'Telefone não cadastrado';
      }


      $data = array(
        'numero_pedido'         => $dados['numero_pedido'],
        'data'                  => date('d/m/Y H:i', strtotime($dados['dataCompra'])),
        'pagamento'             => $dados['formaPagamento'],
        'entrega'               => $dados['formaEnvio'],
        'nome'                  => $cliente['cliente_nome'],
        'cpf'                   => $this->mask($cliente['cliente_cpf'], '###.###.###-##'),
        'fone'                  => $fone,
        'status'                => $status,
        'endereco'              => $cep['cep_rua'] . ', ' . $dados['numeroEndereco'] . ', ' . $cep['cep_bairro'] . ', ' . $aux_cep[0] . ', ' . $aux_cep[1] . ', ' . $this->mask($dados['cepCompra'], '#####-###'),
        'produtos'              => $produtos,
        'subtotal'              => number_format($dados['valorCompra'], 2, ',', '.'),
        'frete'                 => number_format($dados['valorFrete'], 2, ',', '.'),
        'desconto'              => number_format($dados['desconto'], 2, ',', '.'),
        'total'                 => number_format($dados['valorFrete'] + $dados['valorCompra'] - $dados['desconto'], 2, ',', '.'),
        'detalhes'              => $dados['detalhes'],
        'nome_empresa'          => $site['nome_empresa'],
      );


      $config = array(
        'protocol'      => $gestoremail['email_protocol'],
        'smtp_host'     => $gestoremail['email_host'],
        'smtp_port'     => $gestoremail['email_port'],
        'smtp_timeout'  => $gestoremail['email_timeout'],
        'smtp_user'     => $gestoremail['email_user'],
        'smtp_pass'     => $gestoremail['email_pass'],
        'charset'       => $gestoremail['email_charset'],
        'newline'       => "\r\n",
        'mailtype'      => 'html',
        'validation'    => TRUE,
      );

      $assunto = $site['nome_empresa'];

      /*
            $config = array(
                'protocol'  => 'smtp',
                //'smtp_host' => 'smtp-relay.gmail.com',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_timeout' => '10',
                'smtp_user' => 'contato@showdasorte.com',
                //'smtp_user' => 'suporte@showdasorte.com',
                'smtp_pass' => 'dev#admin@2021',
                'charset'   => 'iso-8859-1',
                'newline'   => "\r\n",  
                'mailtype'  => 'html',    
                'validate'  => TRUE,
            );
            */

      $email = $cliente['cliente_email'];

      $this->load->library('email');
      $this->load->model("sendemail");
      $mailbody = $this->sendemail->mailbody($data);

      $this->email->initialize($config);

      $this->email->from($gestoremail['email_user'], 'Email Nsolucoes');
      $this->email->to($email);
      $this->email->subject($assunto);
      $this->email->message($mailbody);

      $this->email->send();
      $this->email->print_debugger();
    }
  }
}
