<?php

return [
    'name' => [
        'log' => [
            'index' => 'Auditoria.listar',
        ],
        'student' => [
            'index'     => 'Estudante.listar',
            'create'    => 'Estudante.criar',
            'edit'      => 'Estudante.editar',
            'destroy'   => 'Estudante.excluir',
        ],
        'metting_plan' => [
            'index'     => 'PlanoDeEncontro.listar',
            'create'    => 'PlanoDeEncontro.criar',
            'edit'      => 'PlanoDeEncontro.editar',
            'destroy'   => 'PlanoDeEncontro.excluir',
            'schedule'  => 'Gerenciar.Horários',
        ],
        'course_type' => [
            'index'     => 'Tipo_Curso.listar',
            'create'    => 'Tipo_Curso.criar',
            'edit'      => 'Tipo_Curso.editar',
            'destroy'   => 'Tipo_Curso.excluir',
        ],
        'role' => [
            'index'     => 'Perfil.listar',
            'create'    => 'Perfil.criar',
            'edit'      => 'Perfil.editar',
            'destroy'   => 'Perfil.excluir',
        ],
        'user' => [
            'index'     => 'Usuário.listar',
            'create'    => 'Usuário.criar',
            'edit'      => 'Usuário.editar',
            'destroy'   => 'Usuário.excluir',
        ],
        'course' => [
            'index'     => 'Curso.listar',
            'create'    => 'Curso.criar',
            'edit'      => 'Curso.editar',
            'destroy'   => 'Curso.excluir',
        ],
        'group' => [
            'index'         => 'Grupo.listar',
            'create'        => 'Grupo.criar',
            'edit'          => 'Grupo.editar',
            'destroy'       => 'Grupo.excluir',
            'facilitator'   => 'Grupo.facilitadores',
            'student'       => 'Grupo.estudantes',
        ],
        'select_formation' => [
            'index'     => 'SelecionaFormacao.listar',
            'create'    => 'SelecionaFormacao.criar',
            'edit'      => 'SelecionaFormacao.editar',
            'destroy'   => 'SelecionaFormacao.excluir',
        ],
        'frequência' => [
            'index'     => 'Frequencia.listar',
            'create'    => 'Frequencia.criar',
            'edit'      => 'Frequencia.editar',
            'destroy'   => 'Frequencia.excluir',
        ],
        'schedule' => [
            'index'     => 'Turnos.listar',
            'create'    => 'Turnos.criar',
            'edit'      => 'Turnos.editar',
            'destroy'   => 'Turnos.excluir',
        ],
        'permission_user' => [
            'link' => 'Permissão_em_usuário.link',
        ],
    ],
    'readable_name' => [
        'log' => [
            'title' => 'Auditoria',
            'index' => 'Listar Logs',
        ],
        'student' => [
            'title'     => 'Estudantes',
            'index'     => 'Listar Estudantes',
            'create'    => 'Criar Estudantes',
            'edit'      => 'Editar Estudantes',
            'destroy'   => 'Excluir Estudantes',
        ],
        'metting_plan'  => [
            'title'     => 'Planos de Encontro',
            'index'     => 'Listar Plano de Encontro',
            'create'    => 'Criar Plano de Encontro',
            'edit'      => 'Editar Plano de Encontro',
            'destroy'   => 'Excluir Plano de Encontro',
            'schedule'  => 'Gerenciar Horários',
            'frequency' => 'Gerenciar Frequências',
        ],
        'course_type'   => [
            'title'     => 'Tipos de Cursos',
            'index'     => 'Listar Tipos de Cursos',
            'create'    => 'Criar Tipos de Cursos',
            'edit'      => 'Editar Tipos de Cursos',
            'destroy'   => 'Excluir Tipos de Cursos',
        ],
        'role' => [
            'title'     => 'Perfis',
            'index'     => 'Listar Perfis',
            'create'    => 'Criar Perfil',
            'edit'      => 'Editar Perfil',
            'destroy'   => 'Excluir Perfil',
        ],
        'user' => [
            'title'     => 'Usuários',
            'index'     => 'Listar Usuários',
            'create'    => 'Criar Usuários',
            'edit'      => 'Editar Usuários',
            'destroy'   => 'Excluir Usuários',
        ],
        'course' => [
            'title'     => 'Cursos',
            'index'     => 'Listar Cursos',
            'create'    => 'Criar Cursos',
            'edit'      => 'Editar Curso',
            'destroy'   => 'Excluir Curso',
        ],
        'group' => [
            'title'         => 'Grupos',
            'index'         => 'Listar Grupos',
            'create'        => 'Criar Grupos',
            'edit'          => 'Editar Grupos',
            'destroy'       => 'Excluir Grupos',
            'facilitator'   => 'Gerenciar Facilitadores',
            'student'       => 'Gerenciar Estudantes',
        ],
        'select_formation'  => [
            'title'         => 'Selecionar Formação',
            'index'         => 'Listar Formação',
            'create'        => 'Criar Formação',
            'edit'          => 'Editar Formação',
            'destroy'       => 'Excluir Formação',
        ],
        'frequency'     => [
            'title'     => 'Frequência',
            'index'     => 'Listar Frequência',
            'create'    => 'Criar Frequência',
            'edit'      => 'Editar Frequência',
            'destroy'   => 'Excluir Frequência',
        ],
        'schedule'      => [
            'title'     => 'Turnos',
            'index'     => 'Listar Turnos',
            'create'    => 'Criar Turnos',
            'edit'      => 'Editar Turnos',
            'destroy'   => 'Excluir Turnos',
        ],
        'permission_user' => [
            'title' => 'Permissões em Usuário',
            'link'  => 'Lista de Permissões de Usuário',
        ],
    ]
];
