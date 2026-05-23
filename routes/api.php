<?php

use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'servico' => 'API do TCC',
        'versao' => '1.0.0',
    ]);
});

Route::get('/projetos', function () {
    return response()->json([
        [
            'id' => 1,
            'titulo' => 'Plataforma de Acompanhamento de TCC',
            'area' => 'Educacao',
            'status' => 'em_desenvolvimento',
        ],
        [
            'id' => 2,
            'titulo' => 'Painel de Indicadores de Orientacao',
            'area' => 'Gestao Academica',
            'status' => 'planejado',
        ],
    ]);
});

Route::get('/orientadores', function () {
    return response()->json([
        [
            'id' => 1,
            'nome' => 'Prof. Ana Beatriz',
            'especialidade' => 'Engenharia de Software',
            'vagas_disponiveis' => 3,
        ],
        [
            'id' => 2,
            'nome' => 'Prof. Carlos Menezes',
            'especialidade' => 'Ciencia de Dados',
            'vagas_disponiveis' => 2,
        ],
    ]);
});

Route::get('/entregas', function () {
    return response()->json([
        [
            'id' => 1,
            'projeto_id' => 1,
            'etapa' => 'Tema e problema',
            'prazo' => '2026-06-15',
            'status' => 'entregue',
        ],
        [
            'id' => 2,
            'projeto_id' => 1,
            'etapa' => 'Prototipo inicial',
            'prazo' => '2026-07-10',
            'status' => 'pendente',
        ],
    ]);
});
