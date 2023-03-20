<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['razao_social','nome_fantasia','cnpj', 'telefone', 'email'];
    protected $guarded = ['id', 'created_at', 'update_at'];

    public function endereco() {
        return $this->belongsTo(Endereco::class)->first();
    }
   
    public function contabilidade() {
        return $this->belongsTo(Contabilidade::class)->first();
    }

    public function responsavel() {
        return $this->belongsTo(Responsavel::class)->first();
    }

    public function boletos(){
        return $this->hasMany(Boleto::class);
    }   

    public function trabalhadores() {
        return $this->hasMany(Trabalhador::class)->get();
    }

    public function gerarPagador($empresa_id){
        $empresa = $this->find($empresa_id);

        $pagador = new \Eduardokum\LaravelBoleto\Pessoa([
            'documento' => mask('##.###.###/####-##',$empresa->cnpj),
            'nome'      => $empresa->nome_fantasia,
            'cep'       => $empresa->endereco()->cep,
            'endereco'  => $empresa->endereco()->rua,
            'bairro'    => $empresa->endereco()->bairro,
            'uf'        => $empresa->endereco()->uf,
            'cidade'    => $empresa->endereco()->cidade,
        ]);

        return $pagador;
    }

    public function gerarBeneficiario(){
        $beneficiario = new \Eduardokum\LaravelBoleto\Pessoa([
            'documento' => '005.904.702/0001-13',
            'nome'      => 'SERBEN SOCIAL',
            'cep'       => '01017-020',
            'endereco'  => 'Rua Roberto Simonsen, 78',
            'bairro'    => 'Centro',
            'uf'        => 'SP',
            'cidade'    => 'Sao Paulo',
        ]);

        return $beneficiario;
        }

    public function sindicatos() {
        return $this->belongsToMany(Sindicato::class);
    }

    public function categoriaSindicatos() {
        return $this->belongsToMany(CategoriaSindicato::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'cnpj' => $this->cnpj,
            'razao_social' => $this->razao_social
        ];
    }
}
