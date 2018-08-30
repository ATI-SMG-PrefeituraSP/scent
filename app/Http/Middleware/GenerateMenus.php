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

                //adiciona o cadastro de cargos
                $menu->add('Especificações Técnicas', ['route' => 'admin.especificacao_tecnica.index', 'class' => 'nav-item'])
                ->prepend('<i class="fas fa-fw fa-tasks"> </i>  <span>')
                ->append('</span>')
                ->link->attr([
                    'class'=>'nav-link',
                    'id' => 'cadastrosDropdown',
                ]);

                //adiciona o cadastro de cargos
                $menu->add('Normas Técnicas', ['route' => 'admin.norma_tecnica.index', 'class' => 'nav-item'])
                ->prepend('<i class="fas fa-fw fa-pen-alt"> </i>  <span>')
                ->append('</span>')
                ->link->attr([
                    'class'=>'nav-link',
                    'id' => 'cadastrosDropdown',
                ]);

                //só vai exibir cadastro de usuários para o usuário admin
                if (Auth::id() == 1) {
                    //adiciona o cadastro de usuários
                    $menu->add('Usuários', ['route' => 'admin.usuario.index', 'class' => 'nav-item'])
                    ->prepend('<i class="fas fa-fw fa-users"> </i>  <span>')
                    ->append('</span>')
                    ->link->attr([
                        'class'=>'nav-link',
                        'id' => 'cadastrosDropdown',
                    ]);
                }
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
