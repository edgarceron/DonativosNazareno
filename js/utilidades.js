function formatoMoneda(valor_text){
	var valor = valor_text.value;
	valor = valor.replace(/[\D\s\._\-]+/g, "");
	valor = valor ? parseInt( valor, 10 ) : 0;
	valor_text.value =  valor.toLocaleString( "es-CO" );
}