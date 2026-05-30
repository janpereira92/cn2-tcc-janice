<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes – EcoJac
|--------------------------------------------------------------------------
|
| Rotas públicas da API do projeto EcoJac.
| Tema: Descarte correto do lixo seletivo.
|
*/

// ──────────────────────────────────────────────
// 1. Status da API
// ──────────────────────────────────────────────
Route::get('/status', function () {
    return response()->json([
        'status'  => 'online',
        'projeto' => 'EcoJac – Descarte Correto do Lixo Seletivo',
        'versao'  => '1.0.0',
        'mensagem' => 'API funcionando corretamente. Bem-vindo ao EcoJac!',
    ]);
});

// ──────────────────────────────────────────────
// 2. Pontos de coleta seletiva
// ──────────────────────────────────────────────
Route::get('/pontos-de-coleta', function () {
    return response()->json([
        'recurso'   => 'pontos-de-coleta',
        'descricao' => 'Lista de ecopontos para descarte seletivo na sua região.',
        'dados'     => [
            [
                'id'        => 1,
                'nome'      => 'Ecoponto Central – Jacareí',
                'endereco'  => 'Rua Barão de Jacareí, 450 – Centro',
                'latitude'  => -23.3050,
                'longitude' => -45.9660,
                'materiais_aceitos' => ['papel', 'plástico', 'vidro', 'metal'],
                'horario'   => 'Seg a Sáb, 07h às 17h',
            ],
            [
                'id'        => 2,
                'nome'      => 'Cooperativa ReciclaVale',
                'endereco'  => 'Av. dos Trabalhadores, 1200 – Jardim Paraíso',
                'latitude'  => -23.2980,
                'longitude' => -45.9720,
                'materiais_aceitos' => ['papel', 'papelão', 'plástico', 'metal'],
                'horario'   => 'Seg a Sex, 08h às 16h',
            ],
            [
                'id'        => 3,
                'nome'      => 'PEV Parque dos Lagos',
                'endereco'  => 'Rua das Acácias, 80 – Parque dos Lagos',
                'latitude'  => -23.3120,
                'longitude' => -45.9580,
                'materiais_aceitos' => ['vidro', 'óleo de cozinha', 'eletrônicos'],
                'horario'   => 'Seg a Sex, 09h às 15h',
            ],
        ],
    ]);
});

// ──────────────────────────────────────────────
// 3. Dicas de higienização de embalagens
// ──────────────────────────────────────────────
Route::get('/dicas-higienizacao', function () {
    return response()->json([
        'recurso'   => 'dicas-higienizacao',
        'descricao' => 'Saiba como higienizar embalagens antes do descarte seletivo.',
        'dicas'     => [
            [
                'id'       => 1,
                'titulo'   => 'Enxágue rápido',
                'conteudo' => 'Lave a embalagem rapidamente com água já usada (da louça, por exemplo). Não é necessário usar sabão – o objetivo é apenas remover resíduos orgânicos.',
            ],
            [
                'id'       => 2,
                'titulo'   => 'Deixe secar',
                'conteudo' => 'Após enxaguar, deixe a embalagem secar naturalmente antes de colocá-la na lixeira seletiva. Embalagens molhadas podem contaminar outros recicláveis.',
            ],
            [
                'id'       => 3,
                'titulo'   => 'Amasse para reduzir volume',
                'conteudo' => 'Latas de alumínio e garrafas PET podem ser amassadas para ocupar menos espaço. Isso facilita o transporte e a triagem nas cooperativas.',
            ],
            [
                'id'       => 4,
                'titulo'   => 'Separe tampas e rótulos quando possível',
                'conteudo' => 'Tampas de plástico e metal muitas vezes são de materiais diferentes do corpo da embalagem. Separar facilita a reciclagem de cada componente.',
            ],
        ],
    ]);
});

// ──────────────────────────────────────────────
// 4. Materiais recicláveis e suas cores
// ──────────────────────────────────────────────
Route::get('/materiais-reciclaveis', function () {
    return response()->json([
        'recurso'   => 'materiais-reciclaveis',
        'descricao' => 'Guia das cores da coleta seletiva e exemplos de materiais aceitos.',
        'materiais' => [
            [
                'id'       => 1,
                'tipo'     => 'Papel / Papelão',
                'cor_lixeira' => 'Azul',
                'hex_cor'  => '#0055BF',
                'exemplos' => ['jornais', 'revistas', 'caixas de papelão', 'cadernos'],
                'dica'     => 'Não recicle papel higiênico, guardanapos usados ou papel plastificado.',
            ],
            [
                'id'       => 2,
                'tipo'     => 'Plástico',
                'cor_lixeira' => 'Vermelho',
                'hex_cor'  => '#D32F2F',
                'exemplos' => ['garrafas PET', 'potes de margarina', 'sacolas plásticas', 'embalagens de shampoo'],
                'dica'     => 'Enxágue as embalagens antes de descartar. Isopor é reciclável, mas nem todos os ecopontos aceitam.',
            ],
            [
                'id'       => 3,
                'tipo'     => 'Vidro',
                'cor_lixeira' => 'Verde',
                'hex_cor'  => '#388E3C',
                'exemplos' => ['garrafas', 'potes de conserva', 'frascos de perfume'],
                'dica'     => 'Embale vidros quebrados em jornal para evitar acidentes com coletores.',
            ],
            [
                'id'       => 4,
                'tipo'     => 'Metal',
                'cor_lixeira' => 'Amarelo',
                'hex_cor'  => '#FBC02D',
                'exemplos' => ['latas de alumínio', 'latas de conserva', 'tampas de garrafa', 'papel alumínio'],
                'dica'     => 'Latinhas de alumínio são 100% recicláveis e podem ser recicladas infinitas vezes!',
            ],
            [
                'id'       => 5,
                'tipo'     => 'Orgânico',
                'cor_lixeira' => 'Marrom',
                'hex_cor'  => '#5D4037',
                'exemplos' => ['restos de comida', 'cascas de frutas', 'borra de café', 'folhas secas'],
                'dica'     => 'Resíduos orgânicos podem ser compostados e virar adubo para hortas e jardins.',
            ],
        ],
    ]);
});
