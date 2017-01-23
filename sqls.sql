

CREATE TABLE public.classificacao (
  idclassificacao INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT classificacao_pkey PRIMARY KEY(idclassificacao)
) 

INSERT INTO public.classificacao ("idclassificacao", "descricao")
VALUES 
  (1, E'Manutenção Adaptativa'),
  (2, E'Manutenção Evolutiva'),
  (3, E'Novo Sistema');
  
  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  
CREATE TABLE public.conhecimento (
  idconhecimento INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT conhecimento_pkey PRIMARY KEY(idconhecimento)
) 

INSERT INTO public.conhecimento ("idconhecimento", "descricao")
VALUES 
  (1, E'Totalmente dominado'),
  (2, E'Conhecido mas necessário desenvolvimento'),
  (3, E'Novo e desenvolvimento interno'),
  (4, E'Novo e busca de conhecimento externo'),
  (5, E'Realizado externamente');
  
  ------------------------------------------------------------------------------------------

CREATE TABLE public.estabilidade (
  idestabilidade INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT estabilidade_pkey PRIMARY KEY(idestabilidade)
) 

INSERT INTO public.estabilidade ("idestabilidade", "descricao")
VALUES 
  (1, E'Remota a probabilidade de mudanças no escopo'),
  (2, E'Pouca probabilidade de mudanças no escopo'),
  (3, E'Alta probabilidade de mudanças no escopo');
  
  ------------------------------------------------------------------------------------------

CREATE TABLE public.nivelabrangencia (
  idnivel INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT nivelabrangencia_pkey PRIMARY KEY(idnivel)
) 

INSERT INTO public.nivelabrangencia ("idnivel", "descricao")
VALUES 
  (1, E'Estratégico'),
  (2, E'Matriz'),
  (3, E'Mais de uma unidade de negócio'),
  (4, E'Toda unidade de negócio solicitante'),
  (5, E'Multidepartamentos'),
  (6, E'Somente em um departamento');
  
  ------------------------------------------------------------------------------------------

CREATE TABLE public.quantidadehoras (
  idhora INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT quantidadehoras_pkey PRIMARY KEY(idhora)
) 

INSERT INTO public.quantidadehoras ("idhora", "descricao")
VALUES 
  (1, E'Até 8 hr'),
  (2, E'De 8 a 24 hr'),
  (3, E'De 24 a 44 hr'),
  (4, E'De 44 a 132 hr'),
  (5, E'De 132 a 220 hr'),
  (6, E'De 220 a 660 hr'),
  (7, E'Acima de 660 hr');
  
  ------------------------------------------------------------------------------------------

CREATE TABLE public.quantidadesistemasexternos (
  idquantidadesistema INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT quantidadesistemasexternos_pkey PRIMARY KEY(idquantidadesistema)
) 

INSERT INTO public.quantidadesistemasexternos ("idquantidadesistema", "descricao")
VALUES 
  (1, E'Nenhum'),
  (2, E'Apenas 1 sistema externo'),
  (3, E'2 ou 3 sistemas externo'),
  (4, E'Acima de 3 sistemas externo');
  
  ------------------------------------------------------------------------------------------

CREATE TABLE public.quantidadesistemasinternos (
  idquantidadesistema INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT quantidadesistemas_pkey PRIMARY KEY(idquantidadesistema)
) 

INSERT INTO public.quantidadesistemasinternos ("idquantidadesistema", "descricao")
VALUES 
  (1, E'Apenas 1 sistema interno'),
  (2, E'2 ou 3 sistemas interno'),
  (3, E'Acima de 3 sistemas interno');
  
  ------------------------------------------------------------------------------------------

CREATE TABLE public.sistemas (
  idsistema INTEGER NOT NULL,
  descricao VARCHAR(80),
  CONSTRAINT sistemas_pkey PRIMARY KEY(idsistema)
) 

INSERT INTO public.sistemas ("idsistema", "descricao")
VALUES 
  (1, E'Admin'),
  (2, E'CCG'),
  (3, E'Tiger'),
  (4, E'Siga'),
  (5, E'Sênior'),
  (6, E'Área do cliente'),
  (7, E'Área do funcionário'),
  (8, E'Arkivus'),
  (9, E'Central Gazin'),
  (10, E'Conciliação Bancária'),
  (11, E'Coletor'),
  (12, E'PWG'),
  (13, E'Sabium'),
  (14, E'Telefonia'),
  (15, E'Conciliação Cartão'),
  (16, E'SG');
  
  ------------------------------------------------------------------------------------------

  