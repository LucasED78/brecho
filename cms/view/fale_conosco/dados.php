<script>
	$(document).ready(function(){
		$('.visualizar').click(function(){
			$.ajax({
			type: 'POST',
			url: 'modal.php',
			success: function(dados){
				$('.container_modal').fadeIn(400);
			}
		});
		});
	});
</script>

<?php
	$diretorio = $_SERVER['DOCUMENT_ROOT'].'/brecho/cms/';
	require_once($diretorio.'controller/controllerFaleConosco.php');

	$listFeedback = new controllerFaleConosco();
	$rsFaleConosco = $listFeedback->listarFeedback();

	$cont = 0;
	while($cont < count($rsFaleConosco)){
?>
<div class="users_view_list">
	<div class="users_view_itens"><?php echo($rsFaleConosco[$cont]->getId()) ?></div>
	<div class="users_view_itens"><?php echo($rsFaleConosco[$cont]->getNome()) ?></div>
	<div class="users_view_itens"><?php echo($rsFaleConosco[$cont]->getAssunto()) ?></div>
	<div class="users_view_itens">
		<span class="visualizar" onClick="visualizar(<?php echo($rsFaleConosco[$cont]->getId()) ?>)">
			<img src="../imagens/visualizar.png">
		</span>

		<span onclick="excluir(<?php echo($rsFaleConosco[$cont]->getId()) ?>)">
			<img src="../imagens/delete16.png">
		</span>
	</div>
</div>

<div class="erro_tabela" data-erro="<?php echo($cont) ?>">
	<h1>Desculpe, não há registros em nosso banco de dados!!</h1>

	<img src="../imagens/sad.png">
</div>
<?php $cont ++;
} ?>