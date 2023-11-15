<?php
    class EmbarcacaoClinetes{
        private $query_consulta;
        private $conexao;
        private $id_emcarcacao;
        private $fabricante;
        private $modelo;
        private $tipo;
        private $horas;
        private $potencia;
        private $quant_motor;
        private $modelo_motor;
        private $ano;
        private $combustivel;
        private $caminho_imagem;
        private $descricao;
        private $vendido;
        private $offmarket;
        private $captador;
        private $propietario;
        private $src = '../assets/embarcacoes/';
        private $tamanho;
        private $preco;
        function __construct(Conexao $conexao){
            $this->conexao = $conexao->conectar();
            
        }
        public function __set($name, $value)
        {
            $this->$name = $value; 
        }
        public function __get($name)
        {
            return $this->$name;
        }
        public function consultarBarcos ($fabricante, $tipo, $combustivel, $ano, $tamanho, $potencia, $horas, $offmarket, $situacao, $captador, $propulsor, $modelo, $valor) {
            //RETORNA QUERY DE TAMANHO
            function retornaTamanho($tamanho) {
                switch ($tamanho) {
                    case -1:
                        return '';
                        break;
                    case 20:
                         return 'and (tamanho >= 20 and tamanho <=31)';
                        break;
                    case 31:
                        return 'and (tamanho >= 31 and tamanho <= 38)';
                        break;
                    case 38:
                        return 'and (tamanho >= 38 and tamanho <= 60)';
                        break;
                    case 60:
                        return 'and (tamanho >= 60 and tamanho <= 70)';
                        break;
                    case 70:
                        return 'and (tamanho >= 70 and tamanho <= 83)';
                        break;
                    case 83:
                        return 'and (tamanho >= 83 and tamanho <= 100)';
                        break;
                    case 90:
                        return 'and tamanho >=100';
                        break;
                        
                } 
            }
            //RETORNA QUERY DE POTENCIA
            function retornaPotencia($potencia) {
                switch ($potencia) {
                    case -1:
                        return '';
                        break;
                    case 100:
                         return 'and potencia <= 100';
                        break;
                    case 200:
                        return 'and potencia <= 200';
                        break;
                    case 300:
                        return 'and potencia <=300';
                        break;
                    case 400:
                        return 'and potencia <= 400';
                        break;
                    case 500:
                        return 'and potencia <= 500';
                        break;
                    case 600:
                        return 'and potencia <= 600';
                        break;
                    case 700:
                        return 'and potencia <= 700';
                        break;
                    case 800:
                        return 'and potencia <= 800';
                        break;
                    case 900:
                        return 'and potencia <= 900';
                        break;
                    case 1000:
                        return 'and potencia <= 1000';
                        break;
                    case 1500:
                        return 'and potencia <= 1500';
                        break;
                    case '>1500':
                        return 'and tamanho >=1500';
                        break;
                } 
            }
            //RETORNA QUERY DE HORAS
            function retornaValor($valor) {
                switch ($valor) {
                    case 5000:
                    return'AND 0 = 0';
                        break;
                    case 1000000:
                        return'AND (valor <= 1000000.00)';
                        break;
                    case 2000000:
                        return'AND (valor >= 1000000.00) AND valor <= 2000000.00';
                        break;
                    case 4000000:
                        return'AND (valor >= 2000000.00) AND valor <= 4000000.00';
                        break;
                    case 6000000:
                        return 'AND (valor >= 4000000.00) AND valor <= 6000000.00';
                        break;
                    case 10000000:
                        return 'AND (valor >= 6000000.00) AND valor <= 10000000.00';
                        break;
                    case 20000000:
                        return 'AND (valor >= 10000000.00) AND valor <= 20000000.00';
                        break;
                    case 6000:
                        return'AND (valor >= 20000000.00)';
                        break;
                } 
            }
            //RETORNA QUERY DE HORAS
            function retornaHoras($horas) {
                switch ($horas) {
                    case -1:
                        return '';
                        break;
                    case 0:
                         return 'and horas = 0';
                        break;
                    case 200:
                        return 'and horas <= 200';
                        break;
                    case 400:
                        return 'and horas <= 400';
                        break;
                    case 600:
                        return 'and horas <= 600';
                        break;
                    case 800:
                        return 'and horas <= 800';
                        break;
                    case 1000:
                        return 'and horas <= 1000';
                        break;
                    case 1200:
                        return 'and horas <= 1200';
                        break;
                    case 1400:
                        return 'and horas <= 1400';
                        break;
                    case 1600:
                        return 'and horas <= 1600';
                        break;
                    case '>1600':
                        return 'and potencia >= 1600';
                        break;
                } 
            }
            function retornaFabricante($fabricante){
                if($fabricante == -1){
                    return '0=0';
                }
                else{
                    return 'Fabricantes_id_fabricantes = '.$fabricante;
                }
                }

            function retornaQuery($tipo, $campo){
                    if($tipo == -1){
                        return 'AND 0 = 0';
                    }
                   
                    else{
                        return 'and '.$campo.' >= '.$tipo;
                    }
                    }

            
      
            $query =
            "
                SELECT 
                    *
                FROM
                embarcacao emb
                    INNER JOIN fabricantes fab ON (emb.Fabricantes_id_fabricantes = fab.id_fabricantes)
                    INNER JOIN tipo tip ON (emb.Tipo_id_tipo = tip.id_tipo)
                    INNER JOIN combustivel comb ON (emb.Combustivel_id_combustivel = comb.id_combustivel)
                    INNER JOIN clientes cli ON (emb.Clientes_id_clientes = cli.id_clientes)
                    INNER JOIN propulsor pro ON (emb.propulsor = pro.id_propulsor)
                WHERE
                ".retornaFabricante($fabricante)." ".retornaQuery($tipo, 'Tipo_id_tipo')." ".retornaQuery($ano, 'ano')." ".retornaQuery($combustivel, 'Combustivel_id_combustivel')." ".retornaTamanho($tamanho)." ".retornaHoras($horas)." ".retornaPotencia($potencia)." and offmarket = 0 and vendido = 0 ".retornaQuery($propulsor, 'propulsor')." ".retornaValor($valor)." "."
                ORDER BY horaLancamento DESC
                ";
            
            if ($modelo != ''){
                $query =
                "
                    SELECT 
                        *
                    FROM
                        embarcacao emb
                            INNER JOIN fabricantes fab ON (emb.Fabricantes_id_fabricantes = fab.id_fabricantes)
                            INNER JOIN tipo tip ON (emb.Tipo_id_tipo = tip.id_tipo)
                            INNER JOIN combustivel comb ON (emb.Combustivel_id_combustivel = comb.id_combustivel)
                            INNER JOIN clientes cli ON (emb.Clientes_id_clientes = cli.id_clientes)
                            INNER JOIN propulsor pro ON (emb.propulsor = pro.id_propulsor)
                    WHERE
                        offmarket = 0 and modelo LIKE '%".strval($modelo)."%'
                    ORDER BY horaLancamento ASC
                        
                        ";
            }

            $stmt= $this->conexao->prepare($query);
            if($stmt->execute()){
                $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
                if(empty($dados)){
                    echo '<center><p>Nehuma embarcação encontrada... Consulte nossas embarcações <b>Off-Market</b>, entre em contato pelo botão <b>Whatsapp ao lado</b>.</p></center>';
                }

                foreach ($dados as $indice => $valor) {
                    $img = glob("../gestao/assets/embarcacoes/$valor->id_embarcacao/PRINCIPAL.*",  GLOB_BRACE);
                    if(count($img) == 0){
                        $source = "assets/ENTRE-EM-CONTATO.png";
                    }
                    else{
                        
                        $source = $img[0];
                    }


                   
                    echo '
                    <!-- Preview Barco -->
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
                        <div class="portfolio-wrap">
                            <figure>
                                <img src="'.$source.'" style="width:100%" class="img-fluid" alt="">
                            </figure>

                            <div class="portfolio-info">
                                <h4><a href="embarcacao.php?if_hKai='.$valor->id_embarcacao.'&raster='.md5($valor->id_embarcacao).'" target="_blank">'.$valor->modelo.'</a></h4>
                                <p><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> '.$valor->ano.' 
                                | <i class="fa fa-clock-o" aria-hidden="true"></i> '.$valor->horas.' HORAS
                                | <i class="fa fa-tachometer" aria-hidden="true"></i> '.$valor->quant_motor.'x '.$valor->modelo_motor.'
                                | <i class="fa fa-money" aria-hidden="true"></i> R$ <span class="preco">'.number_format($valor->valor, 2, ',', '').' </span></p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- Preview Barco -->
                   ';
                }
            }    
            
        }
        public function recentesBarcos(){
            $query =
            "
                SELECT 
                    *
                FROM
                    embarcacao
                WHERE
                    offmarket = 0
                ORDER BY 
                    horaLancamento DESC
                LIMIT 6
                
                    ";
                $stmt= $this->conexao->prepare($query);
                if($stmt->execute()){
                    $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
                    foreach ($dados as $indice => $valor) {
                        $img = glob("gestao/assets/embarcacoes/$valor->id_embarcacao/PRINCIPAL.*",  GLOB_BRACE);
                        if(count($img) == 0){
                            $source = "assets/ENTRE-EM-CONTATO.png";
                        }
                        else{
                            
                            $source = $img[0];
                        }


                    
                        echo '
                        <!-- Start testimonial item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="'.$source.'" style="style="height: 100%; width: 100%; object-fit: cover;" class="img-fluid" alt="" />
                                <h3>'.$valor->modelo.'</h3><BR>
                                <a href="embarcacao.php?if_hKai='.$valor->id_embarcacao.'&raster='.md5($valor->id_embarcacao).'" target="_blank"><button type="button" class="btn btn-secondary btn-lg">Mais informações</button></a>
                            </div>
                        </div>
                        <!-- End testimonial item -->
                    ';
                    }
            }    

        }
        public function recentesBarcos2(){
            $query =
            "
                SELECT 
                    *
                FROM
                    embarcacao
                WHERE
                    offmarket = 0
                ORDER BY 
                    horaLancamento DESC
                
                    ";
                $stmt= $this->conexao->prepare($query);
                if($stmt->execute()){
                    $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
                    foreach ($dados as $indice => $valor) {
                        $img = glob("../gestao/assets/embarcacoes/$valor->id_embarcacao/PRINCIPAL.*",  GLOB_BRACE);
                        if(count($img) == 0){
                            $source = "assets/ENTRE-EM-CONTATO.png";
                        }
                        else{
                            
                            $source = $img[0];
                        }

                        echo '
                        <!-- Preview Barco -->
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
                            <div class="portfolio-wrap">
                                <figure>
                                    <img src="'.$source.'" style="height: 100%; width: 100%; object-fit: cover;" class="img-fluid" alt="">
                                </figure>
    
                                <div class="portfolio-info">
                                    <h4><a href="embarcacao.php?if_hKai='.$valor->id_embarcacao.'&raster='.md5($valor->id_embarcacao).'" target="_blank">'.$valor->modelo.'</a></h4>
                                    <p><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> '.$valor->ano.' 
                                    | <i class="fa fa-clock-o" aria-hidden="true"></i> '.$valor->horas.' HORAS
                                    | <i class="fa fa-tachometer" aria-hidden="true"></i> '.$valor->quant_motor.'x '.$valor->modelo_motor.'
                                    | <i class="fa fa-money" aria-hidden="true"></i> R$ <span class="preco">'.number_format($valor->valor, 2, ',', '').' </span></p>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <!-- Preview Barco -->
                       ';
                    }
            }    

        }

    }

?>