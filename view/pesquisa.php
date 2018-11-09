<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/';
	require_once($diretorio.'controller/controllerProduto.php');
    require_once('arquivos/check_login.php');
    
    if(isset($_POST['txtpesquisa'])){
        $pesquisa = $_POST['txtpesquisa'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Brechó </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		
		<script>
			function filtrarClassificacao(classificacao){
                var pesquisa = $('#categoria').data('pesquisa');

				$.ajax({
					type: 'POST',
					url: 'arquivos/produtos.php',
					data: {tipoFiltro: 'classificacao', filtro: classificacao, termo:pesquisa},
					success: function(dados){
						$('#categoria').html(dados);
					}
				});
			}
			
			function filtrarTamanho(tamanho){
                var pesquisa = $('#categoria').data('pesquisa');

                $.ajax({
					type: 'POST',
					url: 'arquivos/produtos.php',
					data: {tipoFiltro: 'tamanho', filtro: tamanho, termo:pesquisa},
					success: function(dados){
						$('#categoria').html(dados);
					}
				});
			}
			
			$(document).ready(function(){
				$('.filtrar').click(function(){
					$('#categoria').children().empty();
				});
			});
		</script>
		
		<?php
			if(isset($_SESSION['sexo'])){
				require_once('tema.php');
			}
		?>
    </head>
    <body>
		<header>
            <?php
				require_once('arquivos/header.php');
			?>
        </header>
		
        <main id="categoria" data-pesquisa="<?php echo($pesquisa) ?>">
                <div class="caixa_categoria">
                    <div class="categoria_pesquisa">
                                <div class="categoria_pesquisa_centro">
                                   <input type="search" class="campo_pesquisa_categoria"> 
                                   <input type="submit" class="botao_pesquisa_categoria" value="Pesquisar"> 
                                </div>
                            </div>
                        <div class="categoria">
                            <div class="titulo_categoria_primeiro">
                                Classificação
                            </div>
                            <div class="categoria_linha filtrar" onClick="filtrarClassificacao('A')">
                                A
                            </div>
                            <div class="categoria_linha filtrar" onClick="filtrarClassificacao('B')">
                                B
                            </div>
                            <div class="categoria_linha filtrar" onClick="filtrarClassificacao('C')">
                                C
                            </div>
                            <div class="titulo_categoria">
                                Medidas
                            </div>
                            <div class="categoria_tamanhos container_tamanho">
								<?php
									$listMedidas = new controllerProduto();
									$rsMedidas = $listMedidas->listarMedidas();
									$cont = 0;
									while($cont < count($rsMedidas)){
								?>
								
                                <div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsMedidas[$cont]->getId()) ?>)">
									<?php echo($rsMedidas[$cont]->getTamanho()) ?>
								</div>
							<?php $cont++;
								} ?>
                            </div>
							
							<div class="titulo_categoria">
                                Números
                            </div>
                            <div class="categoria_tamanhos container_tamanho">
								<?php
									$listNumeros = new controllerProduto();
									$rsNumeros = $listNumeros->listarNumeros();
									$cont = 0;
									while($cont < count($rsNumeros)){
								?>
								
                                <div class="tamanhos" onClick="filtrarTamanho(<?php echo($rsNumeros[$cont]->getId()) ?>)">
									<?php echo($rsNumeros[$cont]->getTamanho()) ?>
								</div>
							<?php $cont++;
								} ?>
                            </div>
                        </div>
                                            
                        <div class="filtro_categoria">
                            <?php
                                $listProduto = new controllerProduto();
                                $rsProduto = $listProduto->pesquisarProduto($pesquisa);
                                
                                $cont = 0;

                                while($cont < count($rsProduto)){
                            ?>
                            <a href="visualizar_produto.php?id=<?php echo($rsProduto[$cont]->getId())?>">
                                <div class="produto">
                                    <div class="imagem_produto">
                                        <img  alt="#" src="../cms/view/arquivos/<?php echo($rsProduto[$cont]->getImagem())?>" alt="#">
                                    </div>
                                    <div class="descritivo_produto">
                                        <div class="titulo_produto">
                                            <?php echo($rsProduto[$cont]->getNome())?>
                                        </div>
                                        <div class="descricao">
                                            <?php echo($rsProduto[$cont]->getDescricao())?>
                                        </div>
                                        <div class="tamanho">
                                           <?php echo($rsProduto[$cont]->getTamanho())?>
                                        </div>
                                        <div class="preco">
                                            R$ <?php echo($rsProduto[$cont]->getPreco())?>
                                        </div>
                                        <div class="opcoes">
                                            <div class="comprar_produto">
                                                Conferir
                                            </div>
                                            <div class="carrinho_produto">
                                                <img  alt="#" src="icones/carrinho.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                                        $cont++;
                                        }
                                
                                ?>
                            </a>
                     </div>
					
					<div id="resultado">
					
					</div>
                        <div class="botao_categoria_responsivo"> 
                            <img src="icones/categoria.png">
                        </div>
                  </div>  
        </main>
        <footer>
            <div class="footer_centro">
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Mais Informações
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="fale_conosco.php"> Fale Conosco</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="nossas_lojas.php"> Nossas Lojas</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="sobre.php"> Sobre</a>
                    </div>
                    <div class="linha_rodape">
                       <a class="link_rodape" href="perfil.php"> Minha Conta</a>
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Sobre o Brechó
                    </div>
                    <div class="linha_rodape">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
                    </div>
                </div>
                <div class="caixa_rodape">
                    <div class="rodape_titulo">
                        Contatos
                    </div>
                    <div class="linha_rodape">
                        Endereço: Rua Lauro Linhares, 2123 – 202A
Florianópolis, SC, Brasil
                    </div>
                    <div class="linha_rodape">
                        Fone: (11)4002.8922 / Whatsapp: (11)99999.9999
                    </div>
                    <div class="linha_rodape">
                        E-mail: admin@brecho.com.br
                    </div>
                </div>
                <div class="rodape_final">
                    BERNADET Brechó Online. Todos os Direitos Reservados.
                </div>
            </div>
        </footer>
    </body>
</html>