<?php

namespace App\Services\ConsultaCEP;

interface ConsultaCEPInterface
{
    /**
     * Define o padrão para busca de endereço a partir do Cep
     *
     * @param string $cep
     * @return false|EnderecoResponse
     */
    public function buscar(string $cep): false|EnderecoResponse;
}
