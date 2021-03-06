-- SQL Manager for PostgreSQL 5.4.0.42613
-- ---------------------------------------
-- Host      : localhost
-- Database  : trend_project
-- Version   : PostgreSQL 9.6.1, compiled by Visual C++ build 1800, 64-bit



SET check_function_bodies = false;
--
-- Structure for table usuario (OID = 16396) : 
--
SET search_path = public, pg_catalog;
CREATE TABLE public.usuario (
    idusuario serial NOT NULL,
    nomeusuario varchar(80) NOT NULL,
    emailusuario varchar(80),
    loginusuario varchar(80) NOT NULL,
    senhausuario varchar(80) NOT NULL,
    idsituacao integer NOT NULL,
    datacadastro date DEFAULT now()
)
WITH (oids = false);
ALTER TABLE ONLY public.usuario ALTER COLUMN nomeusuario SET STATISTICS 0;
--
-- Structure for table programadores (OID = 16405) : 
--
CREATE TABLE public.programadores (
    idprogramador serial NOT NULL,
    nomeprogramador varchar(80) NOT NULL,
    emailprogramador varchar(80),
    idsituacao integer NOT NULL,
    datacadastro date DEFAULT now()
)
WITH (oids = false);
--
-- Structure for table sistemas (OID = 16412) : 
--
CREATE TABLE public.sistemas (
    idsistema integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table classificacao (OID = 16417) : 
--
CREATE TABLE public.classificacao (
    idclassificacao integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table conhecimento (OID = 16422) : 
--
CREATE TABLE public.conhecimento (
    idconhecimento integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table estabilidade (OID = 16427) : 
--
CREATE TABLE public.estabilidade (
    idestabilidade integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table nivelabrangencia (OID = 16432) : 
--
CREATE TABLE public.nivelabrangencia (
    idnivel integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table quantidadehoras (OID = 16437) : 
--
CREATE TABLE public.quantidadehoras (
    idhora integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table quantidadesistemasexternos (OID = 16442) : 
--
CREATE TABLE public.quantidadesistemasexternos (
    idquantidadesistema integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table quantidadesistemasinternos (OID = 16447) : 
--
CREATE TABLE public.quantidadesistemasinternos (
    idquantidadesistema integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table nivelderisco (OID = 16452) : 
--
CREATE TABLE public.nivelderisco (
    idnivel integer NOT NULL,
    descricao varchar(80)
)
WITH (oids = false);
--
-- Structure for table projeto (OID = 16459) : 
--
CREATE TABLE public.projeto (
    idprojeto serial NOT NULL,
    numero integer,
    dataprojeto date,
    titulo varchar(80) NOT NULL,
    autordocumento varchar(80) NOT NULL,
    negocio varchar(80),
    solicitante varchar(80),
    processo varchar(80),
    centrodecusto varchar(80),
    alinhamentoestrategico varchar(80),
    contratosolicitante varchar(80),
    objetivo varchar(255),
    entendimentodasolicitacao varchar(255),
    cenarioatual varchar(255) NOT NULL,
    solucaoproposta varchar(255) NOT NULL,
    idclassificacao integer NOT NULL,
    idpergunta integer,
    datavigor date,
    idprevisaoresolucao integer NOT NULL,
    idprevisaofalhas integer,
    idquantidadesistemasinternos integer,
    idsistema varchar(80),
    idquantidadesistemasexternos integer,
    sistemasexternos varchar(80),
    idnivelabrangencia integer,
    idestabilidade integer,
    idconhecimento integer,
    custohomemhorades varchar(40),
    custohomemhoraman varchar(40),
    investimentoprevisto numeric(10,2),
    ganhoanual numeric(10,2),
    roi numeric(10,2),
    premissas varchar(255),
    idsituacao integer
)
WITH (oids = false);
--
-- Structure for table projetosolicitantes (OID = 16470) : 
--
CREATE TABLE public.projetosolicitantes (
    idsolicitante serial NOT NULL,
    idprojeto integer NOT NULL,
    nome varchar(80),
    responsabilidade varchar(80),
    data date,
    contato integer
)
WITH (oids = false);
--
-- Structure for table projetoriscos (OID = 16496) : 
--
CREATE TABLE public.projetoriscos (
    idrisco serial NOT NULL,
    idprojeto integer,
    risco varchar(80),
    descricaorisco varchar(80),
    idnivelprobabilidade integer,
    idnivelimpacto integer,
    idnivelrisco integer,
    contramedida varchar(80)
)
WITH (oids = false);
--
-- Structure for table projetosituacao (OID = 16563) : 
--
CREATE TABLE public.projetosituacao (
    idsituacao integer NOT NULL,
    descricao varchar(40)
)
WITH (oids = false);
--
-- Structure for table sprint (OID = 16602) : 
--
CREATE TABLE public.sprint (
    idsprint serial NOT NULL,
    idprojeto integer NOT NULL,
    titulosprint varchar(150),
    datasprint date
)
WITH (oids = false);
--
-- Structure for table sprinttarefa (OID = 16643) : 
--
CREATE TABLE public.sprinttarefa (
    idtarefa serial NOT NULL,
    idsprint integer NOT NULL,
    idprogramador integer,
    detalhe varchar(255) NOT NULL,
    datainicio date,
    horasalmoco integer,
    horas integer,
    datainiciocalculada date,
    datafinalcalculada date
)
WITH (oids = false);
--
-- Data for table public.usuario (OID = 16396) (LIMIT 0,5)
--
BEGIN;

INSERT INTO usuario (idusuario, nomeusuario, emailusuario, loginusuario, senhausuario, idsituacao, datacadastro)
VALUES (1, 'Fabio Gomes', 'fabio.gomes@gazin.com.br', 'fabio', 'fabio', 1, '2017-01-11');

INSERT INTO usuario (idusuario, nomeusuario, emailusuario, loginusuario, senhausuario, idsituacao, datacadastro)
VALUES (2, 'renan', NULL, 'renan', 'renan', 1, '2017-01-11');

INSERT INTO usuario (idusuario, nomeusuario, emailusuario, loginusuario, senhausuario, idsituacao, datacadastro)
VALUES (3, 'Edson Macoto', 'edson.macoto@gazin.com.br', 'edson', 'macoto', 1, '2017-01-11');

INSERT INTO usuario (idusuario, nomeusuario, emailusuario, loginusuario, senhausuario, idsituacao, datacadastro)
VALUES (4, 'Marcos', NULL, 'marcos', 'aranha', 1, '2017-01-11');

INSERT INTO usuario (idusuario, nomeusuario, emailusuario, loginusuario, senhausuario, idsituacao, datacadastro)
VALUES (5, 'joao', NULL, 'jo', 'jo', 1, '2017-01-11');

COMMIT;
--
-- Data for table public.programadores (OID = 16405) (LIMIT 0,11)
--
BEGIN;

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (2, 'FABIO GOMES', 'fabio.gomes@gazin.com', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (3, 'JOSE ADRIANO ALVES', 'alves.jadriano@gmail.com', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (4, 'MAURO HENRIQUE PEREIRA DOS SANTOS', 'mauro.henrique@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (5, 'JOAO HENRIQUE BARBI', 'joao.barbi@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (6, 'MARCOS JERONIMO CESTARI SILVA', 'marcos.cestari@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (7, 'EDSON MACOTO TAMURA JUNIOR', 'edson.junior@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (8, 'FABIO RODRIGO BIANCHINI', 'fabio.bianchini@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (9, 'EDUARDO KAWASSAKI FERREIRA', 'eduardo.kawassaki@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (10, 'ANA CAROLINA URIAS MACHADO', 'ana.machado@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (11, 'RODRIGO CEZAR PETENO ', 'rodrigo.peteno@gazin.com.br', 1, '2017-01-16');

INSERT INTO programadores (idprogramador, nomeprogramador, emailprogramador, idsituacao, datacadastro)
VALUES (12, 'RENAN HENRIQUE DELMONICO', 'renan.delmonico@gazin.com.br', 1, '2017-01-16');

COMMIT;
--
-- Data for table public.sistemas (OID = 16412) (LIMIT 0,16)
--
BEGIN;

INSERT INTO sistemas (idsistema, descricao)
VALUES (1, 'Admin');

INSERT INTO sistemas (idsistema, descricao)
VALUES (2, 'CCG');

INSERT INTO sistemas (idsistema, descricao)
VALUES (3, 'Tiger');

INSERT INTO sistemas (idsistema, descricao)
VALUES (4, 'Siga');

INSERT INTO sistemas (idsistema, descricao)
VALUES (5, 'Sênior');

INSERT INTO sistemas (idsistema, descricao)
VALUES (6, 'Área do cliente');

INSERT INTO sistemas (idsistema, descricao)
VALUES (7, 'Área do funcionário');

INSERT INTO sistemas (idsistema, descricao)
VALUES (8, 'Arkivus');

INSERT INTO sistemas (idsistema, descricao)
VALUES (9, 'Central Gazin');

INSERT INTO sistemas (idsistema, descricao)
VALUES (10, 'Conciliação Bancária');

INSERT INTO sistemas (idsistema, descricao)
VALUES (11, 'Coletor');

INSERT INTO sistemas (idsistema, descricao)
VALUES (12, 'PWG');

INSERT INTO sistemas (idsistema, descricao)
VALUES (13, 'Sabium');

INSERT INTO sistemas (idsistema, descricao)
VALUES (14, 'Telefonia');

INSERT INTO sistemas (idsistema, descricao)
VALUES (15, 'Conciliação Cartão');

INSERT INTO sistemas (idsistema, descricao)
VALUES (16, 'SG');

COMMIT;
--
-- Data for table public.classificacao (OID = 16417) (LIMIT 0,3)
--
BEGIN;

INSERT INTO classificacao (idclassificacao, descricao)
VALUES (1, 'Manutenção Adaptativa');

INSERT INTO classificacao (idclassificacao, descricao)
VALUES (2, 'Manutenção Evolutiva');

INSERT INTO classificacao (idclassificacao, descricao)
VALUES (3, 'Novo Sistema');

COMMIT;
--
-- Data for table public.conhecimento (OID = 16422) (LIMIT 0,5)
--
BEGIN;

INSERT INTO conhecimento (idconhecimento, descricao)
VALUES (1, 'Totalmente dominado');

INSERT INTO conhecimento (idconhecimento, descricao)
VALUES (2, 'Conhecido mas necessário desenvolvimento');

INSERT INTO conhecimento (idconhecimento, descricao)
VALUES (3, 'Novo e desenvolvimento interno');

INSERT INTO conhecimento (idconhecimento, descricao)
VALUES (4, 'Novo e busca de conhecimento externo');

INSERT INTO conhecimento (idconhecimento, descricao)
VALUES (5, 'Realizado externamente');

COMMIT;
--
-- Data for table public.estabilidade (OID = 16427) (LIMIT 0,3)
--
BEGIN;

INSERT INTO estabilidade (idestabilidade, descricao)
VALUES (1, 'Remota a probabilidade de mudanças no escopo');

INSERT INTO estabilidade (idestabilidade, descricao)
VALUES (2, 'Pouca probabilidade de mudanças no escopo');

INSERT INTO estabilidade (idestabilidade, descricao)
VALUES (3, 'Alta probabilidade de mudanças no escopo');

COMMIT;
--
-- Data for table public.nivelabrangencia (OID = 16432) (LIMIT 0,6)
--
BEGIN;

INSERT INTO nivelabrangencia (idnivel, descricao)
VALUES (1, 'Estratégico');

INSERT INTO nivelabrangencia (idnivel, descricao)
VALUES (2, 'Matriz');

INSERT INTO nivelabrangencia (idnivel, descricao)
VALUES (3, 'Mais de uma unidade de negócio');

INSERT INTO nivelabrangencia (idnivel, descricao)
VALUES (4, 'Toda unidade de negócio solicitante');

INSERT INTO nivelabrangencia (idnivel, descricao)
VALUES (5, 'Multidepartamentos');

INSERT INTO nivelabrangencia (idnivel, descricao)
VALUES (6, 'Somente em um departamento');

COMMIT;
--
-- Data for table public.quantidadehoras (OID = 16437) (LIMIT 0,7)
--
BEGIN;

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (1, 'Até 8 hr');

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (2, 'De 8 a 24 hr');

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (3, 'De 24 a 44 hr');

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (4, 'De 44 a 132 hr');

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (5, 'De 132 a 220 hr');

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (6, 'De 220 a 660 hr');

INSERT INTO quantidadehoras (idhora, descricao)
VALUES (7, 'Acima de 660 hr');

COMMIT;
--
-- Data for table public.quantidadesistemasexternos (OID = 16442) (LIMIT 0,4)
--
BEGIN;

INSERT INTO quantidadesistemasexternos (idquantidadesistema, descricao)
VALUES (1, 'Nenhum');

INSERT INTO quantidadesistemasexternos (idquantidadesistema, descricao)
VALUES (2, 'Apenas 1 sistema externo');

INSERT INTO quantidadesistemasexternos (idquantidadesistema, descricao)
VALUES (3, '2 ou 3 sistemas externo');

INSERT INTO quantidadesistemasexternos (idquantidadesistema, descricao)
VALUES (4, 'Acima de 3 sistemas externo');

COMMIT;
--
-- Data for table public.quantidadesistemasinternos (OID = 16447) (LIMIT 0,3)
--
BEGIN;

INSERT INTO quantidadesistemasinternos (idquantidadesistema, descricao)
VALUES (1, 'Apenas 1 sistema interno');

INSERT INTO quantidadesistemasinternos (idquantidadesistema, descricao)
VALUES (2, '2 ou 3 sistemas interno');

INSERT INTO quantidadesistemasinternos (idquantidadesistema, descricao)
VALUES (3, 'Acima de 3 sistemas interno');

COMMIT;
--
-- Data for table public.nivelderisco (OID = 16452) (LIMIT 0,3)
--
BEGIN;

INSERT INTO nivelderisco (idnivel, descricao)
VALUES (1, 'Baixo');

INSERT INTO nivelderisco (idnivel, descricao)
VALUES (2, 'Médio');

INSERT INTO nivelderisco (idnivel, descricao)
VALUES (3, 'Alto');

COMMIT;
--
-- Data for table public.projeto (OID = 16459) (LIMIT 0,3)
--
BEGIN;

INSERT INTO projeto (idprojeto, numero, dataprojeto, titulo, autordocumento, negocio, solicitante, processo, centrodecusto, alinhamentoestrategico, contratosolicitante, objetivo, entendimentodasolicitacao, cenarioatual, solucaoproposta, idclassificacao, idpergunta, datavigor, idprevisaoresolucao, idprevisaofalhas, idquantidadesistemasinternos, idsistema, idquantidadesistemasexternos, sistemasexternos, idnivelabrangencia, idestabilidade, idconhecimento, custohomemhorades, custohomemhoraman, investimentoprevisto, ganhoanual, roi, premissas, idsituacao)
VALUES (13, 120, '2017-02-22', 'Área do Funcionário', 'Estevan', 'Departamento Pessoal', 'Milene', 'Holerite', '9002', 'Inovação e simplicidade na gestão	', '2566', 'Este documento tem por objetivo transformar o entendimento das necessidades do solicitante em critérios de avaliações de projetos, considerando seu tamanho, retorno financeiro e riscos.', 'Exigência do Governo em receber em guias separadas.					', 'Não separa.					', 'Desenvolver um sistema onde mostre os holerites e pontos dos funcionários', 3, NULL, '2017-02-22', 2, 3, 1, '1', 1, NULL, 2, 1, 1, NULL, NULL, 515.00, 250.00, NULL, 'Investimento (anual):
    - Inicial: 
    - Ao longo do ano: 

Retorno (ganho anual): 
    - Receita: 
    - Gastos: 
    - Riscos: 

Outras observações:', 1);

INSERT INTO projeto (idprojeto, numero, dataprojeto, titulo, autordocumento, negocio, solicitante, processo, centrodecusto, alinhamentoestrategico, contratosolicitante, objetivo, entendimentodasolicitacao, cenarioatual, solucaoproposta, idclassificacao, idpergunta, datavigor, idprevisaoresolucao, idprevisaofalhas, idquantidadesistemasinternos, idsistema, idquantidadesistemasexternos, sistemasexternos, idnivelabrangencia, idestabilidade, idconhecimento, custohomemhorades, custohomemhoraman, investimentoprevisto, ganhoanual, roi, premissas, idsituacao)
VALUES (14, 122, '2017-02-22', 'GNRE', 'Estevan', 'Cartão', 'Angela', 'Controladoria', '8099', 'Inovação e simplicidade na gestão	', '4552', 'Este documento tem por objetivo transformar o entendimento das necessidades do solicitante em critérios de avaliações de projetos, considerando seu tamanho, retorno financeiro e riscos.', 'Exigência do Governo em receber em guias separadas.					', 'não existe', 'Gerar notas GNRE', 1, NULL, '2017-02-22', 1, 2, 1, '1', 1, NULL, 1, 2, 1, NULL, NULL, 260.00, 560.00, NULL, 'Investimento (anual):
    - Inicial: 
    - Ao longo do ano: 

Retorno (ganho anual): 
    - Receita: 
    - Gastos: 
    - Riscos: 

Outras observações:', 1);

INSERT INTO projeto (idprojeto, numero, dataprojeto, titulo, autordocumento, negocio, solicitante, processo, centrodecusto, alinhamentoestrategico, contratosolicitante, objetivo, entendimentodasolicitacao, cenarioatual, solucaoproposta, idclassificacao, idpergunta, datavigor, idprevisaoresolucao, idprevisaofalhas, idquantidadesistemasinternos, idsistema, idquantidadesistemasexternos, sistemasexternos, idnivelabrangencia, idestabilidade, idconhecimento, custohomemhorades, custohomemhoraman, investimentoprevisto, ganhoanual, roi, premissas, idsituacao)
VALUES (8, 1, '2017-02-16', 'Integração GKO', 'Estevan', 'Transporte', 'Celson junior', 'tributos', '09001', 'Inovação e simplicidade na gestão	', '2409', 'Este documento tem por objetivo transformar o entendimento das necessidades do solicitante em critérios de avaliações de projetos, considerando seu tamanho, retorno financeiro e riscos.', 'Exigência do Governo em receber em guias separadas.', 'não separa a empresa', 'Alterar geração de guias para que emite separadamente guia com o valor do FEM.
Fazer de forma semelhante a DIFAL e FCP.
Informação encontra-se em rst.notaauxiliar ( valorfem) .', 1, NULL, '2017-02-16', 2, 1, 1, '1', 1, NULL, 6, 1, 1, NULL, NULL, 290.00, 280.00, NULL, 'Investimento (anual):
    - Inicial: 
    - Ao longo do ano: 

Retorno (ganho anual): 
    - Receita: 
    - Gastos: 
    - Riscos: 

Outras observações:', 1);

COMMIT;
--
-- Data for table public.projetosolicitantes (OID = 16470) (LIMIT 0,7)
--
BEGIN;

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (21, 8, 'fabio gomes', 'programador', '2017-02-21', 2700);

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (22, 13, 'Milene', 'Solicitante', '2017-02-23', 2556);

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (23, 13, 'Estevan', 'Analista', '2017-02-23', 4588);

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (24, 13, 'Renan', 'Programador', '2017-02-23', 2709);

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (25, 14, 'Estevan', 'Analista', '2017-02-23', 5566);

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (26, 14, 'Renan', 'Programador', '2017-02-23', 2898);

INSERT INTO projetosolicitantes (idsolicitante, idprojeto, nome, responsabilidade, data, contato)
VALUES (27, 14, 'Angela', 'Solicitante', '2017-02-23', 6556);

COMMIT;
--
-- Data for table public.projetoriscos (OID = 16496) (LIMIT 0,15)
--
BEGIN;

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (18, 8, 'Descrição do Risco <b>Ganho</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (19, 8, 'Descrição do Risco <b>Prazo</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (17, 8, 'Descrição do Risco <b>Investimento</b>', NULL, 2, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (20, 8, 'Descrição do Risco <b>Outros</b>', 'outros mais', 2, 3, 3, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (16, 8, 'Descrição do Risco <b>Escopo</b>', 'Risco escopo', 2, 3, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (36, 13, 'Descrição do Risco <b>Escopo</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (37, 13, 'Descrição do Risco <b>Investimento</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (38, 13, 'Descrição do Risco <b>Ganho</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (39, 13, 'Descrição do Risco <b>Prazo</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (40, 13, 'Descrição do Risco <b>Outros</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (41, 14, 'Descrição do Risco <b>Escopo</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (42, 14, 'Descrição do Risco <b>Investimento</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (43, 14, 'Descrição do Risco <b>Ganho</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (44, 14, 'Descrição do Risco <b>Prazo</b>', NULL, 1, 1, 1, NULL);

INSERT INTO projetoriscos (idrisco, idprojeto, risco, descricaorisco, idnivelprobabilidade, idnivelimpacto, idnivelrisco, contramedida)
VALUES (45, 14, 'Descrição do Risco <b>Outros</b>', NULL, 1, 1, 1, NULL);

COMMIT;
--
-- Data for table public.projetosituacao (OID = 16563) (LIMIT 0,3)
--
BEGIN;

INSERT INTO projetosituacao (idsituacao, descricao)
VALUES (1, 'Em Desenvolvimento');

INSERT INTO projetosituacao (idsituacao, descricao)
VALUES (2, 'Finalizado');

INSERT INTO projetosituacao (idsituacao, descricao)
VALUES (3, 'Stand by');

COMMIT;
--
-- Data for table public.sprint (OID = 16602) (LIMIT 0,5)
--
BEGIN;

INSERT INTO sprint (idsprint, idprojeto, titulosprint, datasprint)
VALUES (13, 13, 'Relatório do admin', '2017-02-28');

INSERT INTO sprint (idsprint, idprojeto, titulosprint, datasprint)
VALUES (24, 13, 'Importação Sênior', '2017-03-07');

INSERT INTO sprint (idsprint, idprojeto, titulosprint, datasprint)
VALUES (17, 14, 'Cadastro GNRE', '2017-02-22');

INSERT INTO sprint (idsprint, idprojeto, titulosprint, datasprint)
VALUES (14, 8, 'tela de romaneio', '2017-02-27');

INSERT INTO sprint (idsprint, idprojeto, titulosprint, datasprint)
VALUES (12, 13, 'Solicitação UNIMED', '2017-02-24');

COMMIT;
--
-- Data for table public.sprinttarefa (OID = 16643) (LIMIT 0,10)
--
BEGIN;

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (7, 13, 9, 'criar relatorio no admin', '2017-02-28', 1, 1, '2017-02-28', '2017-02-28');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (24, 24, 8, 'fazer layout', '2017-03-07', 2, 8, '2017-03-07', '2017-03-08');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (14, 17, 10, 'rotina para importar sabium', '2017-02-14', 2, 6, '2017-02-15', '2017-02-16');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (15, 17, 12, 'fazer tela de cadastro GNRE', '2017-02-16', 2, 8, '2017-02-17', '2017-02-18');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (16, 17, 12, 'editar GNRE', '2017-02-20', 1, 8, '2017-02-21', '2017-02-22');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (9, 14, 10, 'editar romaneio conforme documentação', '2017-02-28', 2, 8, '2017-02-28', '2017-02-28');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (8, 14, 10, 'fazer tela de romaneio', '2017-02-27', 3, 8, '2017-02-27', '2017-02-28');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (4, 12, 2, 'fazer layout junto a senior. 
configurar ftp para importar automaticamento os arquivos.', '2017-02-24', 1, 8, '2017-02-27', '2017-02-28');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (5, 12, 2, 'Fazer formulario de cadastro', '2017-02-28', 2, 8, '2017-02-28', '2017-03-01');

INSERT INTO sprinttarefa (idtarefa, idsprint, idprogramador, detalhe, datainicio, horasalmoco, horas, datainiciocalculada, datafinalcalculada)
VALUES (6, 12, 2, 'importar para senior', '2017-03-01', 1, 8, '2017-03-01', '2017-03-02');

COMMIT;
--
-- Definition for index usuario_pkey (OID = 16401) : 
--
ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey
    PRIMARY KEY (idusuario);
--
-- Definition for index programadores_pkey (OID = 16410) : 
--
ALTER TABLE ONLY programadores
    ADD CONSTRAINT programadores_pkey
    PRIMARY KEY (idprogramador);
--
-- Definition for index sistemas_pkey (OID = 16415) : 
--
ALTER TABLE ONLY sistemas
    ADD CONSTRAINT sistemas_pkey
    PRIMARY KEY (idsistema);
--
-- Definition for index classificacao_pkey (OID = 16420) : 
--
ALTER TABLE ONLY classificacao
    ADD CONSTRAINT classificacao_pkey
    PRIMARY KEY (idclassificacao);
--
-- Definition for index conhecimento_pkey (OID = 16425) : 
--
ALTER TABLE ONLY conhecimento
    ADD CONSTRAINT conhecimento_pkey
    PRIMARY KEY (idconhecimento);
--
-- Definition for index estabilidade_pkey (OID = 16430) : 
--
ALTER TABLE ONLY estabilidade
    ADD CONSTRAINT estabilidade_pkey
    PRIMARY KEY (idestabilidade);
--
-- Definition for index nivelabrangencia_pkey (OID = 16435) : 
--
ALTER TABLE ONLY nivelabrangencia
    ADD CONSTRAINT nivelabrangencia_pkey
    PRIMARY KEY (idnivel);
--
-- Definition for index quantidadehoras_pkey (OID = 16440) : 
--
ALTER TABLE ONLY quantidadehoras
    ADD CONSTRAINT quantidadehoras_pkey
    PRIMARY KEY (idhora);
--
-- Definition for index quantidadesistemasexternos_pkey (OID = 16445) : 
--
ALTER TABLE ONLY quantidadesistemasexternos
    ADD CONSTRAINT quantidadesistemasexternos_pkey
    PRIMARY KEY (idquantidadesistema);
--
-- Definition for index quantidadesistemas_pkey (OID = 16450) : 
--
ALTER TABLE ONLY quantidadesistemasinternos
    ADD CONSTRAINT quantidadesistemas_pkey
    PRIMARY KEY (idquantidadesistema);
--
-- Definition for index nivelderisco_pkey (OID = 16455) : 
--
ALTER TABLE ONLY nivelderisco
    ADD CONSTRAINT nivelderisco_pkey
    PRIMARY KEY (idnivel);
--
-- Definition for index projeto_pkey (OID = 16466) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_pkey
    PRIMARY KEY (idprojeto);
--
-- Definition for index projetosolicitantes_pkey (OID = 16474) : 
--
ALTER TABLE ONLY projetosolicitantes
    ADD CONSTRAINT projetosolicitantes_pkey
    PRIMARY KEY (idsolicitante);
--
-- Definition for index projetoriscos_pkey (OID = 16500) : 
--
ALTER TABLE ONLY projetoriscos
    ADD CONSTRAINT projetoriscos_pkey
    PRIMARY KEY (idrisco);
--
-- Definition for index projetoriscos_fk1 (OID = 16508) : 
--
ALTER TABLE ONLY projetoriscos
    ADD CONSTRAINT projetoriscos_fk1
    FOREIGN KEY (idnivelprobabilidade) REFERENCES nivelderisco(idnivel);
--
-- Definition for index projetoriscos_fk2 (OID = 16513) : 
--
ALTER TABLE ONLY projetoriscos
    ADD CONSTRAINT projetoriscos_fk2
    FOREIGN KEY (idnivelimpacto) REFERENCES nivelderisco(idnivel);
--
-- Definition for index projetoriscos_fk3 (OID = 16518) : 
--
ALTER TABLE ONLY projetoriscos
    ADD CONSTRAINT projetoriscos_fk3
    FOREIGN KEY (idnivelrisco) REFERENCES nivelderisco(idnivel);
--
-- Definition for index projeto_fk (OID = 16523) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk
    FOREIGN KEY (idclassificacao) REFERENCES classificacao(idclassificacao);
--
-- Definition for index projeto_fk1 (OID = 16528) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk1
    FOREIGN KEY (idprevisaoresolucao) REFERENCES quantidadehoras(idhora);
--
-- Definition for index projeto_fk2 (OID = 16533) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk2
    FOREIGN KEY (idprevisaofalhas) REFERENCES quantidadehoras(idhora);
--
-- Definition for index projeto_fk3 (OID = 16538) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk3
    FOREIGN KEY (idquantidadesistemasinternos) REFERENCES quantidadesistemasinternos(idquantidadesistema);
--
-- Definition for index projeto_fk4 (OID = 16543) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk4
    FOREIGN KEY (idquantidadesistemasexternos) REFERENCES quantidadesistemasexternos(idquantidadesistema);
--
-- Definition for index projeto_fk5 (OID = 16548) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk5
    FOREIGN KEY (idnivelabrangencia) REFERENCES nivelabrangencia(idnivel);
--
-- Definition for index projeto_fk6 (OID = 16553) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk6
    FOREIGN KEY (idestabilidade) REFERENCES estabilidade(idestabilidade);
--
-- Definition for index projeto_fk7 (OID = 16558) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk7
    FOREIGN KEY (idconhecimento) REFERENCES conhecimento(idconhecimento);
--
-- Definition for index projetosituacao_pkey (OID = 16566) : 
--
ALTER TABLE ONLY projetosituacao
    ADD CONSTRAINT projetosituacao_pkey
    PRIMARY KEY (idsituacao);
--
-- Definition for index projeto_fk8 (OID = 16568) : 
--
ALTER TABLE ONLY projeto
    ADD CONSTRAINT projeto_fk8
    FOREIGN KEY (idsituacao) REFERENCES projetosituacao(idsituacao);
--
-- Definition for index projetosolicitantes_fk (OID = 16573) : 
--
ALTER TABLE ONLY projetosolicitantes
    ADD CONSTRAINT projetosolicitantes_fk
    FOREIGN KEY (idprojeto) REFERENCES projeto(idprojeto) ON DELETE CASCADE;
--
-- Definition for index projetoriscos_fk (OID = 16578) : 
--
ALTER TABLE ONLY projetoriscos
    ADD CONSTRAINT projetoriscos_fk
    FOREIGN KEY (idprojeto) REFERENCES projeto(idprojeto) ON DELETE CASCADE;
--
-- Definition for index sprint_pkey (OID = 16607) : 
--
ALTER TABLE ONLY sprint
    ADD CONSTRAINT sprint_pkey
    PRIMARY KEY (idsprint);
--
-- Definition for index sprint_fk (OID = 16609) : 
--
ALTER TABLE ONLY sprint
    ADD CONSTRAINT sprint_fk
    FOREIGN KEY (idprojeto) REFERENCES projeto(idprojeto);
--
-- Definition for index sprinttarefa_pkey (OID = 16647) : 
--
ALTER TABLE ONLY sprinttarefa
    ADD CONSTRAINT sprinttarefa_pkey
    PRIMARY KEY (idtarefa);
--
-- Definition for index sprinttarefa_fk (OID = 16649) : 
--
ALTER TABLE ONLY sprinttarefa
    ADD CONSTRAINT sprinttarefa_fk
    FOREIGN KEY (idsprint) REFERENCES sprint(idsprint) ON DELETE CASCADE;
--
-- Definition for index sprinttarefa_fk1 (OID = 16654) : 
--
ALTER TABLE ONLY sprinttarefa
    ADD CONSTRAINT sprinttarefa_fk1
    FOREIGN KEY (idprogramador) REFERENCES programadores(idprogramador);
--
-- Data for sequence public.usuario_idusuario_seq (OID = 16394)
--
SELECT pg_catalog.setval('usuario_idusuario_seq', 6, true);
--
-- Data for sequence public.programadores_idprogramador_seq (OID = 16403)
--
SELECT pg_catalog.setval('programadores_idprogramador_seq', 1, false);
--
-- Data for sequence public.projeto_idprojeto_seq (OID = 16457)
--
SELECT pg_catalog.setval('projeto_idprojeto_seq', 14, true);
--
-- Data for sequence public.projetosolicitantes_idsolicitante_seq (OID = 16468)
--
SELECT pg_catalog.setval('projetosolicitantes_idsolicitante_seq', 27, true);
--
-- Data for sequence public.projetoriscos_idrisco_seq (OID = 16494)
--
SELECT pg_catalog.setval('projetoriscos_idrisco_seq', 45, true);
--
-- Data for sequence public.sprint_idsprint_seq (OID = 16600)
--
SELECT pg_catalog.setval('sprint_idsprint_seq', 24, true);
--
-- Data for sequence public.sprinttarefa_idtarefa_seq (OID = 16641)
--
SELECT pg_catalog.setval('sprinttarefa_idtarefa_seq', 25, false);
--
-- Comments
--
COMMENT ON SCHEMA public IS 'standard public schema';
COMMENT ON COLUMN public.usuario.idsituacao IS '0 - inativo
1 - ativo';
COMMENT ON COLUMN public.programadores.idsituacao IS '0 - inativo
1 - ativo';
COMMENT ON COLUMN public.projeto.idpergunta IS '1 - sim 
0 - não';
