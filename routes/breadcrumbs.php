<?php

/**
 * Arquivo para setar os breadcrumbs corretamente
 */

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});


/** Rotas dos usuários */

//Usuário
Breadcrumbs::for('admin.usuario.index', function ($trail) {
    $trail->push('Usuários', route('admin.usuario.index'));
});

// Usuário > Novo
Breadcrumbs::for('admin.usuario.novo', function ($trail) {
    $trail->parent('admin.usuario.index');
    $trail->push('Novo', route('admin.usuario.novo'));
});

// Usuario > Novo > Salvar
Breadcrumbs::for('admin.usuario.salvar', function ($trail) {
    $trail->parent('admin.usuario.index');
    $trail->push('Salvar', route('admin.usuario.salvar'));
});

// Usuário > Alterar
Breadcrumbs::for('admin.usuario.alterar', function ($trail, $id) {
    $trail->parent('admin.usuario.index');
    $trail->push('Alterar', route('admin.usuario.alterar', $id));
});

// Usuário > Atualizar Dados
Breadcrumbs::for('admin.usuario.minha_conta.alterar', function ($trail) {
    $trail->parent('admin.usuario.index');
    $trail->push('Minha Conta', route('admin.usuario.minha_conta.alterar'));
});

// Usuario > Atualizar > Salvar
Breadcrumbs::for('admin.usuario.minha_conta.salvar', function ($trail) {
    $trail->parent('admin.usuario.index');
    $trail->push('Salvar', route('admin.usuario.minha_conta.salvar'));
});





/** Rotas das especificacões tecnicas */

//EspecificacaoTecnica
Breadcrumbs::for('admin.especificacao_tecnica.index', function ($trail) {
    $trail->push('Especificações Técnicas', route('admin.especificacao_tecnica.index'));
});

// EspecificacaoTecnica > Novo
Breadcrumbs::for('admin.especificacao_tecnica.novo', function ($trail) {
    $trail->parent('admin.especificacao_tecnica.index');
    $trail->push('Novo', route('admin.especificacao_tecnica.novo'));
});

//EspecificacaoTecnica > salvar
Breadcrumbs::for('admin.especificacao_tecnica.salvar', function ($trail) {
    $trail->parent('admin.especificacao_tecnica.salvar');
    $trail->push('Salvar', route('admin.especificacao_tecnica.salvar'));
});

// EspecificacaoTecnica > Alterar
Breadcrumbs::for('admin.especificacao_tecnica.alterar', function ($trail, $id) {
    $trail->parent('admin.especificacao_tecnica.index');
    $trail->push('Alterar', route('admin.especificacao_tecnica.alterar', $id));
});

// EspecificacaoTecnica > Alterar
Breadcrumbs::for('admin.especificacao_tecnica.importacao', function ($trail) {
    $trail->parent('admin.especificacao_tecnica.index');
    $trail->push('Importação', route('admin.especificacao_tecnica.importacao'));
});



/** Rotas das normas tecnicas */

//Norma Tecnica
Breadcrumbs::for('admin.norma_tecnica.index', function ($trail) {
    $trail->push('Normas Técnicas', route('admin.norma_tecnica.index'));
});

// Norma Tecnica > Novo
Breadcrumbs::for('admin.norma_tecnica.novo', function ($trail) {
    $trail->parent('admin.norma_tecnica.index');
    $trail->push('Novo', route('admin.norma_tecnica.novo'));
});

//Norma Tecnica > salvar
Breadcrumbs::for('admin.norma_tecnica.salvar', function ($trail) {
    $trail->parent('admin.norma_tecnica.salvar');
    $trail->push('Salvar', route('admin.norma_tecnica.salvar'));
});

// Norma Tecnica > Alterar
Breadcrumbs::for('admin.norma_tecnica.alterar', function ($trail, $id) {
    $trail->parent('admin.norma_tecnica.index');
    $trail->push('Alterar', route('admin.norma_tecnica.alterar', $id));
});
