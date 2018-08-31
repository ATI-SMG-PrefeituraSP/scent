#  SCENT - Sistema de Cadastro de Especificações e Normas Técnicas

Sistema criado utilizando o framework Laravel e PHP7.2

<h2> Como installar</h2>
<ol>
<li>Clonar ou fazer download do projeto</li>
<li>Entrar na pasta do projeto através de um terminal e rodar <code>composer install</code></li>
<li>Copiar o arquivo .env_example para um novo arquivo chamado .env</li>
<li>Setar as informações do banco de dados corretamente</li>
<li>Rodar o comando <code>php artisan migrate</code> para gerar as tabelas do banco de dados</li>
<li>Rodar o comando <code>php artisan db:seed</code> para fazer uma carga inicial de registros no banco</li>
<li>Logar no sistema com o usuário "admin" e senha "admin"</li>
<li>Trocar a senha do usuário administrador</li>
</ol>

<h2>Informações importantes</h2>
<ul>
<li>Todas as alterações no banco de dados feitas pelos usuários serão guardadas na tabela audits do banco de dados</li>
<li>Apenas o usuário com id=1 é capaz de ver e alterar os outros usuários</li>
</ul>
