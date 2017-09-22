--------------------------------------------------------------------------------
=================================== MPOSRVR ====================================
--------------------------------------------------------------------------------
Desenvolvido por: THIAGO A PINELLI
                  MAPIO GEOTECH ENGENHARIA
--------------------------------------------------------------------------------
Data       | Versão                                                  | Resp
22/08/2017 | 0.1 - Documentação Inicial                              | THP
--------------------------------------------------------------------------------
TECH: - PHP70 wFPM
      - HTML 5.0, BOOTSTRAP, FONT-AWESOME
      - POSTGRESQL + POSTGIS
      - NGINX
--------------------------------------------------------------------------------

MVC
----
MODEL: INC/database.php
   - foram criadas funções genéricas de INCLUSÃO, UPDATE, DELETE e SELECT;
   - foram criadas funções específicas para os casos onde o genérico não bastou.

CONTROLLER: function.php em cada pasta de dados
   - em cada pasta de arquivos foi criada um arquivo function.php para ser uti-
     lizado como controller;
   - cada function tem as funções relacionadas à pasta em questão. Em sua maio-
     ria utiliza nomenclatura padrão (add, edit, view, delete).

VIEW: arquivos .php em cada pasta de dados
   - Dentro das pastas, além dos arquivos function, existem os arquivos de vi-
     sualização dos dados.


ESTRUTURA DE ARQUIVOS
---------------------
FONTS: arquivos de fontes truetype utilizadas pelo site
IMAGENS: pasta de imagens (logotipos) utilizados no site

CSS: arquivos de estilo utilizados no site:
     ** são todos carregados no arquivo INC/header.php e INC/header-full.php **
      - BOOTSTRAP: foi utilizado o toolkit do BOOTSTRAP para o desenvolvimento
      - FONT-AWESOME: utilizado para os �cones
      - LAYOUT: customizações de layout gen�ricas
      - OL: folha de estilos do openlayers
      - CUSTOM: customizações do bootstrap ==== mexer somente aqui <======

JS: arquivos de funções genéricas em JavaScript
    ** são todos carregados no arquivo INC/footer.php **
     - BOOTSTRAP: arquivos JS do toolkit do BOOTSTRAP
     - OL, NPM, VIEW: arquivos de JS do OpenLayers
     - MAIN: arquivos de JS do MAPSRV ==== mexer somente aqui <======

INC: arquivos base utilizados em todas as chamadas
     - database.php: todas as funções de acesso ao banco de dados;
     - footer.php: rodapé dos sites. Carrega os arquivos .js
     - header.php: cabeçalho de todas as páginas. Carrega as folhas de estilo
     - header-full.php: cabeçalho com o container-fluid. Carrega os CSS tb
     - modal.php: modal de confirmação de exclusões

CAMPRJ: arquivos relativos ao CRUD de Camadas x Projetos
CLIENTES: arquivos relativos ao CRUD de Clientes
MAPSERVER: arquivos relativos à visualização dos mapas
PROJETOS: arquivos relativos ao CRUD de projetos

No ROOT, temos:
     - Index.php: arquivo inicial do servidor
     - Phpteste.php: arquivo com PHPINFO
     - Config.php: variáveis de configuração do sistema. Este arquivo é chamado
       no header e no header-full.
