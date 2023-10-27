<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// CASO EXISTA MATERIAL DO ID ELE É RETIRADO POIS ELE VEM COMO ARRAY E strip_tags SÒ ACEITA STRINGS
if (isset($getPost['material_id'])):
    $material_id = $getPost['material_id'];
    unset($getPost['material_id']);
endif;

//ELIMINA INPUT DE ARQUIVOS PARA PODER PASSAR PELO STRIP TAGS(O $_FILES VAI ESTAR COM OS ARQUIVOS)
unset($getPost['material_aula']);

$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
unset($Post['action']);

$jSon = array();

session_start();

//sleep(1);

if ($Action):
    require '../../_app/Config.inc.php';
    spl_autoload_register('carregarClasses');
//    require '../../_models/adminCategoria.class.php';
//    require '../_models/adminPost.class.php';
//    require '../_models/adminCurso.class.php';
//    require '../_models/adminModulo.class.php';
//    require '../_models/adminMaterial.class.php';
    require '../../admin/_models/adminComentario.class.php';
    require '../../admin/_models/AdminCliente.php';
    require '../../admin/_models/adminAndamento.class.php';
endif;

switch ($Action) {

    case 'create_andamento':

//        $readAndamento = new Read;
//        $readAndamento->ExeRead("cetrhema_aulas_andamentos", "WHERE andamento_aula = :aula AND andamento_aluno = :aluno", "aula={$_SESSION['clientelogin']['cliente_andamento']}&aluno={$_SESSION['clientelogin']['cliente_id']}");
//        if (!$readAndamento->getResult()):
//            $adminAndmaneto = new adminAndamento;
//            $adminAndmaneto->ExeCreate($_SESSION['clientelogin']['cliente_id'], $_SESSION['clientelogin']['cliente_andamento']);
//            var_dump($adminAndmaneto);
//        endif;





        break;


    case 'update_aluno':

        $Perfil = null;


        $id = $Post['cliente_id'];
        unset($Post['cliente_id']);
        $jSon['id'] = $id;

//        if (isset($Post['perfil'])):
//            $Perfil = $Post['perfil'];
//            unset($Post['perfil']);
//        endif;
//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

        if (isset($_FILES['cliente_cover']) && $_FILES['cliente_cover']['tmp_name']):
            $Post['cliente_cover'] = $_FILES['cliente_cover'];
        else:
            $read = new Read;
            $read->ExeRead("cetrhema_clientes", "WHERE cliente_id = :id", "id={$id}");
            if ($read->getResult()):
                if (isset($read->getResult()[0]['cliente_cover'])):
                    $Post['cliente_cover'] = $read->getResult()[0]['cliente_cover'];
                else:
                    unset($Post['cliente_cover']);
                endif;

            else:
                unset($Post['cliente_cover']);
            endif;
        endif;

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;


//        var_dump($meuArray);

        $adminCliente = new AdminCliente;
        $adminCliente->ExeUpdate($id, $meuArray);
//        var_dump($adminCliente);

        if (isset($_SESSION['clientelogin'])):

            if (isset($meuArray['cliente_name'])):
                $_SESSION['clientelogin']['cliente_name'] = $meuArray['cliente_name'];
            endif;

            if (isset($meuArray['cliente_lastname'])):
                $_SESSION['clientelogin']['cliente_lastname'] = $meuArray['cliente_lastname'];
            endif;

            if (isset($meuArray['cliente_rg'])):
                $_SESSION['clientelogin']['cliente_rg'] = $meuArray['cliente_rg'];
            endif;

            if (isset($meuArray['cliente_cpf'])):
                $_SESSION['clientelogin']['cliente_cpf'] = $meuArray['cliente_cpf'];
            endif;

            if (isset($meuArray['cliente_estado_civil'])):
                $_SESSION['clientelogin']['cliente_estado_civil'] = $meuArray['cliente_estado_civil'];
            endif;

            if (isset($meuArray['cliente_telefone'])):
                $_SESSION['clientelogin']['cliente_telefone'] = $meuArray['cliente_telefone'];
            endif;

            if (isset($meuArray['cliente_endereco'])):
                $_SESSION['clientelogin']['cliente_endereco'] = $meuArray['cliente_endereco'];
            endif;

            if (isset($meuArray['cliente_numero'])):
                $_SESSION['clientelogin']['cliente_numero'] = $meuArray['cliente_numero'];
            endif;

            if (isset($meuArray['cliente_bairro'])):
                $_SESSION['clientelogin']['cliente_bairro'] = $meuArray['cliente_bairro'];
            endif;

            if (isset($meuArray['cliente_cidade'])):
                $_SESSION['clientelogin']['cliente_cidade'] = $meuArray['cliente_cidade'];
            endif;

            if (isset($meuArray['cliente_uf'])):
                $_SESSION['clientelogin']['cliente_uf'] = $meuArray['cliente_uf'];
            endif;

            if (isset($meuArray['cliente_cep'])):
                $_SESSION['clientelogin']['cliente_cep'] = $meuArray['cliente_cep'];
            endif;

            if (isset($meuArray['cliente_email'])):
                $_SESSION['clientelogin']['cliente_email'] = $meuArray['cliente_email'];
            endif;


            if (isset($meuArray['cliente_senha'])):
                $_SESSION['clientelogin']['cliente_senha'] = $meuArray['cliente_senha'];
            endif;

            if (isset($meuArray['cliente_level'])):
                $_SESSION['clientelogin']['cliente_level'] = $meuArray['cliente_level'];
            endif;


            $readFoto = new Read;
            $readFoto->ExeRead("cetrhema_clientes", "WHERE cliente_id = :id", "id={$id}");
            if ($readFoto->getResult()):
                $_SESSION['clientelogin']['cliente_cover'] = $readFoto->getResult()[0]['cliente_cover'];
            endif;

        endif;


        $jSon['error'] = $adminCliente->getError();

//        var_dump($adminPost);

        break;

    case 'create_comentario':


//        $Aula = $Post['comentario_aula']; 
//        unset($Post['aula']);

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $adminComentario = new adminComentario;
        $adminComentario->ExeCreate($meuArray);
//        var_dump($adminComentario);

        $readRecado = new Read();
        $readRecado->ExeRead("cetrhema_comentarios", "WHERE comentario_status = 1 AND (comentario_type = :type OR comentario_type = :resposta) AND comentario_aula = :aula", "type=tickets&resposta=tickets(resposta)&aula={$meuArray['comentario_aula']}");
        if ($readRecado->getResult()):
            $jSon['total'] = $readRecado->getRowCount();
            $jSon['result'] = array();
            $i = 0;

            $View = new View;
            $tpl_comentario = $View->Load('comentario');

            foreach ($readRecado->getResult() as $recado):
//                                extract($recado);

                $recado['comentario_date'] = date('d/m/Y H\hi', strtotime($recado['comentario_date']));
                $recado['comentario_menor'] = Check::Words($recado['comentario_content'], 10);
                $recado['comentario_condicional'] = (Check::countWords($recado['comentario_content']) > 10 ? "<span class=\"container comentarios-conteudo m-top1 j_parcial ds-none\">" . Check::Words($recado['comentario_content'], 10) . "<a href=\"#\" class=\"j_mais\">mais</a> </span><span class=\"container comentarios-conteudo m-top1 j_completo\">" . $recado['comentario_content'] . " <a href=\"#\" class=\"j_menos ds-none\">ocultar</a></span>" : "<span class=\"container comentarios-conteudo m-top1\">" . $recado['comentario_content'] . "</span>");

                $jSon['result'] += [$i => $View->returnView($recado, $tpl_comentario)];
                $i++;
                
            endforeach;

//            var_dump($jSon['result']);

        endif;

        $jSon['error'] = $adminComentario->getError();
        break;

    case 'create_resposta':

//        unset($Post['modulo_id']);
//        $Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $readType = new Read;
        $readType->ExeRead(COMENTARIOS, "WHERE comentario_id = :id", "id={$meuArray['comentario_resposta']}");
        if ($readType->getResult()):
            $meuArray +=["comentario_type" => $readType->getResult()[0]['comentario_type']];
        endif;

        $meuArray +=["comentario_author" => (isset($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_name'] . " - (Tutor)" : $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'])];
        $meuArray +=["comentario_user" => (isset($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_id'] : null)];
        $meuArray +=["comentario_cliente" => (isset($_SESSION['clientelogin']['cliente_id']) ? $_SESSION['clientelogin']['cliente_id'] : null)];
        $meuArray +=["comentario_email" => (isset($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_email'] : $_SESSION['clientelogin']['cliente_email'])];
        $meuArray +=["comentario_cover" => null];
        $meuArray +=["comentario_status" => '1'];
        $meuArray +=["comentario_date" => date('Y-m-d H:i:s')];
//        $meuArray +=["comentario_estado" => null];
//        var_dump($meuArray);
        $adminComentario = new adminComentario;
        $adminComentario->ExeCreate($meuArray);

        $comentarioResposta = new Read;
        $comentarioResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :comentario_id ORDER BY comentario_date ASC", "comentario_id={$meuArray['comentario_resposta']}");
        $View = new View;
        $tpl_resposta = $View->Load('comentario-resposta');

        if (!$comentarioResposta->getResult()):
//            WSErro("Nenhum Comentário!", WS_INFOR);
        else:
            $jSon['comentario_pai'] = $meuArray['comentario_resposta'];
            $jSon['total_resposta'] = $comentarioResposta->getRowCount();
            $jSon['result_comentarios'] = array();
            $i = 0;

            foreach ($comentarioResposta->getResult() as $resposta):

                $resposta['comentario_pai'] = $resposta['comentario_id'];

                if (isset($resposta['comentario_user'])):
                    $readUser = new Read;
                    $readUser->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$resposta['comentario_user']}");
                    if ($readUser->getResult()):
                        $resposta['comentario_cover'] = $readUser->getResult()[0]['user_foto'];
                    endif;
                elseif (isset($resposta['comentario_cliente'])):
                    $readCliente = new Read;
                    $readCliente->ExeRead(CLIENTES, "WHERE cliente_id = :id", "id={$resposta['comentario_cliente']}");
                    if ($readCliente->getResult()):
                        $resposta['comentario_cover'] = $readCliente->getResult()[0]['cliente_cover'];
                    endif;
                else:
                    $resposta['comentario_cover'] = '/usuarios/perfil-user.png';
                endif;

                $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . $resposta['comentario_cover'];
                $resposta['comentario_date'] = date('d/m/Y H\hi', strtotime($resposta['comentario_date']));

                if (Check::countWords($resposta['comentario_content']) > 10):
                    $resposta['comentario_content'] = '<span class="comentarios-conteudo m-top1 j_parcial_resposta">' . Check::Words($resposta['comentario_content'], 10) . '<a href="#" class="j_mais_resposta">mais</a> </span> <span class="comentarios-conteudo m-top1 j_completo_resposta">' . $resposta['comentario_content'] . '<a href="#" class="j_menos_resposta">ocultar</a></span>';
                else:
                    $resposta['comentario_content'] = '<span class="comentarios-conteudo m-top1">' . $resposta['comentario_content'] . '</span>';
                endif;

                if ($resposta['comentario_status'] == '1'):
                    $resposta['botao_status'] = '<a title="Aprovado" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>';
                else:
                    $resposta['botao_status'] = '<a title="Pendente" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>';
                endif;

                $jSon['result_comentarios'] += [$i => $View->returnView($resposta, $tpl_resposta)];

                $i++;

            endforeach;
        endif;



        $jSon['error'] = $adminComentario->getError();



        break;



    default:
        $jSon['error'] = "Erro ao selecionar ação!";
        break;
}

echo json_encode($jSon);
