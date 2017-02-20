CREATE TABLE public.projeto (
  idprojeto SERIAL,
  numero INTEGER,
  dataprojeto DATE,
  titulo VARCHAR(80) NOT NULL,
  autordocumento VARCHAR(80) NOT NULL,
  negocio VARCHAR(80),
  solicitante VARCHAR(80),
  processo VARCHAR(80),
  centrodecusto VARCHAR(80),
  alinhamentoestrategico VARCHAR(80),
  contratosolicitante VARCHAR(80),
  objetivo VARCHAR(255),
  entendimentodasolicitacao VARCHAR(255),
  cenarioatual VARCHAR(255) NOT NULL,
  solucaoproposta VARCHAR(255) NOT NULL,
  idclassificacao INTEGER NOT NULL,
  idpergunta INTEGER,
  datavigor DATE,
  idprevisaoresolucao INTEGER NOT NULL,
  idprevisaofalhas INTEGER,
  idquantidadesistemasinternos INTEGER,
  idsistema VARCHAR(80),
  idquantidadesistemasexternos INTEGER,
  sistemasexternos VARCHAR(80),
  idnivelabrangencia INTEGER,
  idestabilidade INTEGER,
  idconhecimento INTEGER,
  custohomemhorades VARCHAR(40),
  custohomemhoraman VARCHAR(40),
  investimentoprevisto NUMERIC(10,2),
  ganhoanual NUMERIC(10,2),
  roi NUMERIC(10,2),
  premissas VARCHAR(255),
  CONSTRAINT projeto_pkey PRIMARY KEY(idprojeto),
  CONSTRAINT projeto_fk FOREIGN KEY (idclassificacao)
    REFERENCES public.classificacao(idclassificacao)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk1 FOREIGN KEY (idprevisaoresolucao)
    REFERENCES public.quantidadehoras(idhora)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk2 FOREIGN KEY (idprevisaofalhas)
    REFERENCES public.quantidadehoras(idhora)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk3 FOREIGN KEY (idquantidadesistemasinternos)
    REFERENCES public.quantidadesistemasinternos(idquantidadesistema)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk4 FOREIGN KEY (idquantidadesistemasexternos)
    REFERENCES public.quantidadesistemasexternos(idquantidadesistema)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk5 FOREIGN KEY (idnivelabrangencia)
    REFERENCES public.nivelabrangencia(idnivel)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk6 FOREIGN KEY (idestabilidade)
    REFERENCES public.estabilidade(idestabilidade)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projeto_fk7 FOREIGN KEY (idconhecimento)
    REFERENCES public.conhecimento(idconhecimento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE
) 
WITH (oids = false);

COMMENT ON COLUMN public.projeto.idpergunta
IS '1 - sim 
0 - não';


----------------------------------------------------------------------------------------------------

CREATE TABLE public.projetoriscos (
  idrisco SERIAL,
  idprojeto INTEGER,
  descricaorisco VARCHAR(80),
  descricao VARCHAR(80),
  idnivelprobabilidade INTEGER,
  idnivelimpacto INTEGER,
  idnivelrisco INTEGER,
  contramedida VARCHAR(80),
  CONSTRAINT projetoriscos_pkey PRIMARY KEY(idrisco),
  CONSTRAINT projetoriscos_fk FOREIGN KEY (idprojeto)
    REFERENCES public.projeto(idprojeto)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projetoriscos_fk1 FOREIGN KEY (idnivelprobabilidade)
    REFERENCES public.nivelderisco(idnivel)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projetoriscos_fk2 FOREIGN KEY (idnivelimpacto)
    REFERENCES public.nivelderisco(idnivel)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT projetoriscos_fk3 FOREIGN KEY (idnivelrisco)
    REFERENCES public.nivelderisco(idnivel)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE
) 
WITH (oids = false);

----------------------------------------------------------------------------------------------------

CREATE TABLE public.projetosolicitantes (
  idsolicitante SERIAL,
  idprojeto INTEGER NOT NULL,
  nome VARCHAR(80),
  responsabilidade VARCHAR(80),
  data DATE,
  contato INTEGER,
  CONSTRAINT projetosolicitantes_pkey PRIMARY KEY(idsolicitante),
  CONSTRAINT projetosolicitantes_fk FOREIGN KEY (idprojeto)
    REFERENCES public.projeto(idprojeto)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE
) 
WITH (oids = false);