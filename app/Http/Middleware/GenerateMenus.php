<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use app\Http\Controllers\UsuarioController;


class GenerateMenus
{
    /**
     * Handle an incoming request.
     * Cria os menus
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('MenuPrincipal', function ($menu) {

            /* -------------------------------------------------------------------------- */

            //os cadastros só podem ser acessados por usuários autenticados
            if (Auth::check()) {
                //adiciona o menu de cadastros
                $menu->add('Cadastros', ['class' => 'nav-item dropdown'])
                ->prepend('<i class="fas fa-fw fa-database"> </i>  <span>')
                ->append('</span>')
                ->link->attr([
                    'class'=>'nav-link dropdown-toggle',
                    'id' => 'cadastrosDropdown',
                    'href' => '#',
                    'role'=>"button",
                    'data-toggle'=>"dropdown",
                    'aria-haspopup'=>"true",
                    'aria-expanded'=>"false",
                ]);

                //adiciona o cadastro de cargos
                $menu->cadastros->add('Especificações Técnicas', ['route' => 'admin.especificacao_tecnica.index', 'class' => 'dropdown-item'])
                ->prepend('<span>')
                ->append('</span>');

                //adiciona o cadastro de cargos
                $menu->cadastros->add('Normas Técnicas', ['route' => 'admin.norma_tecnica.index', 'class' => 'dropdown-item'])
                ->prepend('<span>')
                ->append('</span>');


                //adiciona o cadastro de usuários
                $menu->cadastros->add('Usuários', ['route' => 'admin.usuario.index', 'class' => 'dropdown-item'])
                ->prepend('<span>')
                ->append('</span>');
            }


            /* -------------------------------------------------------------------------- */

            //os dados da conta só podem ser acessados por usuários autenticados
            if (Auth::check()) {
                //adiciona o menu de minha conta
                $menu->add('Minha Conta', ['class' => 'nav-item dropdown'])
                ->prepend('<i class="fas fa-fw fa-user-circle"> </i>  <span>')
                ->append('</span>')
                ->link->attr([
                    'class'=>'nav-link dropdown-toggle',
                    'id' => 'contaDropdown',
                    'href' => '#',
                    'role'=>"button",
                    'data-toggle'=>"dropdown",
                    'aria-haspopup'=>"true",
                    'aria-expanded'=>"false",
                ]);

                $menu->item('minhaConta')->add('Atualizar Dados', ['route' => 'admin.usuario.minha_conta.alterar', 'class' => 'dropdown-item'])
                ->prepend('<span>')
                ->append('</span>');

            }

        });

        return $next($request);
    }
}
