<?php
	if(isset($_POST['id'])){
		$id = $_POST['id'];
	}else{
		$id = null;
	}
?>

<script>
	var url = '../../'
	
	//função para exibir os dados
	function exibirDados(id, idioma){
		$.ajax({
			type: 'POST', //tipo de requisição
			url: url+'/router.php', //url onde será enviada a requisição
			data:{id:id, idioma:idioma, modo: 'buscar', controller: 'sobre'}, //parâmetros enviados
			success: function(dados){
				json = JSON.parse(dados); //convertendo os dados para json
				$('.form').attr('data-lang', idioma);

				//colocando os valores nas caixas de texto
				$('.txttitulo').val(json.titulo); 
				$('.txtdesc').val(json.descricao);
				
				//checando se a imagem está vazia, se não, preencher a div de visualizar
				if(json.imagem != null){
					$('#imgSobre').attr('src', '../arquivos/'+json.imagem);
					$('#frm_sobreLayout1').attr('data-imagem', json.imagem);
				}
			}
		})
	}
	
	function mostrarPrevia(input){
		if(input.files && input.files[0]){
			var leitor = new FileReader();
			
			leitor.onload = function(event){
				$('#imgSobre').attr('src', event.target.result);
			}
			
			leitor.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		mudarModal('600', '400');
		$('#tabs').tabs();
		$('#tabs').tabs('disable', 1);
		
		$('#imagem').live('change', function(){
			mostrarPrevia(this);
		});
		
		
		$('#frm_sobreLayout1').submit(function(e){
			//desabilitando o submit do botão
			e.preventDefault();

			//armazenando o formulario em uma variável
			var formulario =  new FormData($('#frm_sobreLayout1')[0]);
			
			//armazenando o tipo de layout numa variável
			var layout = $('#frm_sobreLayout1').attr('data-layout');

			//atribuindo ao formulário o parâmetro layout
			formulario.set('layout', layout);
			
			//armazenando o modo em uma variável
			var modo = $('#frm_sobreLayout1').attr('data-modo');

			//atribuindo ao formulário o parâmetro modo
			formulario.set('modo', modo);

			//armazenando o idioma em uma variável
			var idioma = $('#frm_sobreLayout1').attr('data-lang');

			//atribuindo ao formulário o idioma
			formulario.set('idioma', idioma);

			//armazenando o ID em uma variável
			var id = $('#frm_sobreLayout1').attr('data-id');

			//atribuindo ao formulário o ID
			formulario.set('id', id);

			//atribuindo ao formulário o parâmetro controller
			formulario.set('controller', 'sobre');
			
			//armazenando a imagem em uma variável
			var imagem = $('#frm_sobreLayout1').attr('data-imagem');
			
			//atribuindo ao formulário o parâmetro imagem
			formulario.set('imagem', imagem);
			
			
			//chamando o ajax
			$.ajax({
				type: 'POST', //tipo de requisição
				url: url+'/router.php', //url onde será enviada a requisição
				data: formulario, //dados enviados
				cache: false,
                contentType: false,
                processData: false,
                async: true,
				success: function(dados){
					//conversão dos dados para JSON
					json = JSON.parse(dados);

					//verificando o modo
					if(modo == 'inserirLayout'){
						//se for inserirido, troca de aba e atualiza as informações do form
						if(json.retorno == 'inserido'){
							$('#frm_sobreLayout1').attr('data-submit', true);
							$('#frm_sobreLayout1').attr('data-id', json.id);
							$('#frm_sobreLayout1').attr('data-lang', 'en');

							verificarSubmit();
						}else if(json.retorno == 'traduzido'){
							//se for traduzido, mostra uma msg de sucesso e fecha o form
							alert('Layout inserido com sucesso!!');
							
							listar();

							$('.container_modal').fadeOut(400);
						}
					}else{
						if(json.retorno == 'atualizado'){
							alert('Layout atualizado com sucesso!!');
							listar();
							$('.container_modal').fadeOut(400);
						}
					}
				}
			});
		});
	});
</script>

<div class="frm_container">
	<form method="POST" data-id="<?php echo($id) ?>" data-layout="1" data-lang="pt" enctype="multipart/form-data" class="form" name="frmSobre" id="frm_sobreLayout1">
		<div id="tabs">
			<ul>
				<li>
					<a href="frm_layout1_pt.php">PT</a>
				</li>

				<li>
					<a href="frm_layout1_en.php">EN</a>
				</li>

				<img class="fechar" src="../imagens/fechar.png" onclick="fecharModal()">
			</ul>
		</div>
	</form>
</div>