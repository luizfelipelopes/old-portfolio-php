<?php

/**
 * Comentarios [ MODEL SYSTEM ]
 * Classse responsável por modelar os comentários enviados pelo site
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Comentarios {

    private $Comentario;
    private $Data;
    private $Result;
    private $Error;

    const Entity = COMENTARIOS;

    public function ExeCreate(array $array) {

        $this->Data = $array;

        if (in_array('', $this->Data)):
            $this->Error = ["Preencha todos os campos!", WS_ALERT];
            $this->Result = false;

        else:

            $this->tratarDados();
            $this->create();

        endif;
    }
    
    
    public function ExeUpdate($Id, array $array) {
        
        $this->Comentario = (int) $Id;
        $this->Data = $array;
        
        $this->tratarDados();
        $this->update();
        
    }
    
    
    public function ExeDelete($Id) {
        
        $this->Comentario = (int)$Id;
        
        $this->delete();
    }

    public function ExeStatusComentario($Id, $Status) {

        $this->Comentario = (int) $Id;
        $this->Data['comentario_status'] = $Status;

        $read = new Read();
        $read->ExeRead(self::Entity, "WHERE comentario_id = :comentarioid", "comentarioid={$Id}");
        if (!$read->getResult()) {
            $this->Error = ["Índice inválido! Favor tente novamente", WS_ALERT];
            $this->Result = false;
        } else {
            $update = new Update();
            $update->ExeUpdate(self::Entity, $this->Data, "WHERE comentario_id = :comentarioid", "comentarioid={$this->Comentario}");
            if (!$update->getResult()) {
                $this->Error = ["Não foi possível aprovar este comentário! Favor tente novamente.", WS_ALERT];
                $this->Result = false;
            } else {
                $this->Error = ["Comentário aprovado com sucesso!", WS_INFOR];
                $this->Result = true;
            }
        }
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function tratarDados() {

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['comentario_cliente'] = ucwords(strtolower($this->Data['comentario_cliente']));
        $this->Data['comentario_resposta'] = 0;
        $this->Data['comentario_data'] = date('Y-m-d H:i:s');
    }

    private function create() {
        
        $this->Data['comentario_status'] = "0";
        
        $create = new Create();
        
        $create->ExeCreate(self::Entity, $this->Data);
        
        if (!$create->getResult()):
            $this->Error = ["Erro ao salvar comentário! Por favor tente novamente!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Error = ["Obrigado! Sua Avaliação foi salva com sucesso!! Ela será postada após a análise da moderação.", WS_ACCEPT];
            $this->Result = $create->getResult();
        endif;
    }

    
    private function update() {
        
        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "WHERE comentario_id = :comentarioid", "comentarioid={$this->Comentario}");
        
        if(!$update->getResult()){
            $this->Error = ["Não foi possível atualizar comentário. Por favor, tente novamente.", WS_ALERT];
            $this->Result = false;
        }else{
            $this->Error = ["Comentário atualizado com sucesso!", WS_INFOR];
            $this->Result = true;
        }
        
        
    }
    
    
    private function delete() {
        
        $delete = new Delete();
        $delete ->ExeDelete(self::Entity, "WHERE comentario_id = :comentarioid", "comentarioid={$this->Comentario}");
        if(!$delete->getResult()){
            $this->Error = ["Não foi possível excluir comentário. POr favor, tente novamente.", WS_ALERT];
            $this->Result = false;
        }else{
            $this->Error = ["Comentário excluído com sucesso!", WS_INFOR];
            $this->Result = true;
        }
        
    }
    
}
