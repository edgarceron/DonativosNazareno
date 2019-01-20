<html>
	<head>
		<style>
		body {
			background-image: url("images/nazarenoMarca.png");
			background-repeat: repeat-y;
			font-family: sans-serif;
			margin-right: 15mm;
			margin-left: 15mm;
		}
		
		div{
			margin-right: 20mm;
			margin-left: 20mm;
			text-align: justify;
			text-justify: inter-word;
			font-weight: bold;
		}
		</style>
	</head>
		
	<body>
		<h3 style = "text-align:center"> CERTIFICADO DE DONACIÓN <br> AÑO GRAVABLE <?php echo $year; ?> </h3>

		<h3 style = "text-align:center"> IGLESIA CASA DE ORACIÓN DEL NAZARENO <br>NIT 900.228.452-0</h3>

		<h3 style = "text-align:center">CERTIFICA QUE:</h3>
		<br>
		<div>
			1.  Es  una  institución  sin  ánimo  de  lucro  con  Personería  Jurídica  Especial,  vigente  en  la  fecha,  
			otorgada mediante resolución No. 0168 del 22 de Enero del 2008 expedida por el ministerio del 
			interior.<br><br>
			2.  Ha  cumplido  oportunamente  y  en  forma  ininterrumpida  con  la  obligación  de  presentar    
			declaración  mensual  de  retención  en  la  fuente  y  declaración  de  ingresos  y  patrimonio  en  la  
			Administración de Impuestos y Aduanas Nacionales.<br><br>
			3. Está vigilada por el Estado Colombiano a través del MINISTERIO DEL INTERIOR Y DE JUSTICIA.<br><br>
			4.  Las  donaciones  (el  diezmo  y  la  ofrenda)  otorgados  son  invertidos  exclusivamente  en  
			Colombia  y  se  destinara  al  desarrollo  de  la  visión  de  la  Iglesia,  que  es  capacitar,  fortalecer  y  
			servir  en  la  restauración  de  personas,  familias  y  ministerios,  para  que  la  vida  de  las  personas  
			tenga un desarrollo integral.<br><br>
			5. Recibimos Donaciones (diezmos y ofrendas) de: 
			<?php echo $nombre; ?> 
			Identificado con <?php echo $tipo_documento; ?>: <?php echo $numero_documento; ?> por un valor de: <?php echo $valor_donaciones ?>. <br><br>
			
			En constancia, se firma en Santiago de Cali a los <?php echo $fecha_deletreada; ?>. <br><br>
			
			<?php echo $firma_contador; ?>
			
		</div>
	</body>
</html>