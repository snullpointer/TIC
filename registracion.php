<?php
			
		
		include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/PersonaDao.php');
		include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/InteresDao.php');
		include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/PersonaInteresDao.php');
		include_once ($_SERVER["DOCUMENT_ROOT"] . '/preguntados/dao/dbconfig.php');
		
		$Nombre =  isset($_POST["txtNombre"]) ? $_POST["txtNombre"] : '';
		$Apellido =  isset($_POST["txtApellido"]) ? $_POST["txtApellido"] : '';
		$Contrasena =  isset ( $_POST["txtContrasena"]) ?$_POST["txtContrasena"] : "" ;
		$RepContrasena =  isset ( $_POST["txtRepContrasena"]) ?$_POST["txtRepContrasena"] : "" ;
		$Mail =  isset($_POST["txtMail"]) ? $_POST["txtMail"] : "";
		$Dia =  isset($_POST["Dia"]) ? $_POST["Dia"] : "" ;
		$Mes =  isset($_POST["Mes"]) ? $_POST["Mes"] : "";
		$Año =   isset($_POST["Año"]) ? $_POST["Año"] : "" ;		
		$intereses= isset($_POST["intereses"]) ? $_POST["intereses"] : array();
		$Sexo= isset($_POST["Sexo"]) ? $_POST["Sexo"] : "";
		$AceptarBC= isset($_POST ["terminos"]) ? $_POST ["terminos"] : "";
		$errores = "";

		
		if(isset($_POST["submit"]))
		{
			if ($AceptarBC == true)
			{
				$caracteres= strlen($Nombre);
				if ($Nombre == "")
				{
					$errores .= "Ingrese un nombre". "<br>";
				}
				else
				{
				if($caracteres > 30)
				{
					$errores .= "Numero max de caracteres en el nombre es 30" . "<br>" ;
				}
				
				}
				
				$caracteres= strlen($Apellido);
				
				if($caracteres > 50)
				{
					$errores .= "Numero max de caracteres en el apellido es 30" . "<br>" ;
				}
				if ($Apellido == "")
				{
					$errores .= "Ingrese un apellido" . "<br>";
				}
				
				
				if($Contrasena == "")
				{
					$errores .= "Ingrese una Contraseña"."<br>";
				}
				else{
					$caracteres = strlen($Contrasena); 
					if($caracteres < 6 )
					{
						$errores .= "Numero minimo de caracteres en Contraseña 6: ingrese otra " . "<br>" ;
					}
					else
					{
						$i = 0;
						$encontre = false;
						while ($i < strlen($Contrasena) and !$encontre) 
						{
							if(is_numeric($Contrasena[$i]))
							{
								$encontre = true;
							}							
							$i++;
						}
						if($encontre == true)
						{
							$pos= strpos($Contrasena, ".");

							if($pos == false)
							{
								$pos= strpos($Contrasena, "*");
								
								if ($pos== false)
								{
									$pos= strpos($Contrasena, ",");
									if($pos == false)
									{
										$errores.= "La contraseña debe tener un caracter especial" . "<br>";
									}
								}
								
							}
						}
						else
						{
							$errores.= "La contraseña debe tener un caracter numerico"."<br>";
						} 
					
						
					}
				
				}
				
				if($RepContrasena == "")
				{
					$errores .= "Repita su Contraseña" . "<br>" ;
				}
				else 
				{
					if($RepContrasena != $Contrasena)
					{
						$errores .= "Las contraseñas no coinciden" . "<br>";
					}
				}

				$interesese =count($intereses);
				if ($interesese<2)
				{
					$errores .= "Minimo de intereses 2". "<br>";
				}
								
				if ($Sexo == 0)
				{
					$errores .= "Seleccione un sexo" . "<br>";
				}
				
					
				$ValidarF = checkdate($Mes, $Dia , $Año);				 
						
				if($ValidarF == false)
				{
					$errores .= "Ingrese una fecha valida" . "<br>";
				}
				$AñoActual = date("Y");
				$resul = $AñoActual - $Año;
				if($resul <18)
				{
					$errores .= "Debe ser mayor de edad". "<br>";
				}
				else{
					
					$fech= $Año . "-" . $Mes . "-" . $Dia;
				}
				
				
				if($Mail == "")
				{
					$errores.= "Ingrese un mail";
				}
				else
				{
					$pos= strpos($Mail, "@");

					if($pos === false){
					$errores.= "Mail erroneo";
					}
					else
					{
						$domain = strstr($Mail, "@");
						$pos2= strpos($domain, ".");
						if($pos2===false)
						{
							$errores.= "Mail erroneo";
						}
					
					}
				
				}
			}
			
			else
			{
				$errores .= "Debe aceptar las bases y condiciones";
			}
			
			

		
			
			if($errores == "")
			{ //guardo el usuario en la base de datos
				$persona = new Persona();
				$persona->nombre= $Nombre;
				$persona->apellido= $Apellido;
				$persona->email= $Mail;
				$persona->contraseña= $Contrasena;
				$persona->nacimiento= $fech;
				$persona->sexo=$Sexo;
					
				$idUsuario= PersonaDao::Insertar($persona);			
				

				//inserto en intereses usuario
				//hacer foreach
				
				foreach($intereses as $interes){
					$personaInteres = new personaInteres();
					$personaInteres->idUsuario = $idUsuario;
					$personaInteres->idInteres = $interes;
					PersonaInteresDao::Insertar($personaInteres);	
				}
				
				echo "Registracion completada";
				$Nombre = "";
				$Apellido= "";
				$Mail= "";
						
			}
			
			
		}
				 
	?>

<!doctype html>
<html>
	<head>
		<title> Preguntados </title>
	</head>	
		
	<body>
		<h1> Registracion </h1>
		
		
		<form method= "post">
		
			<label> Nombre </label>
			<input type= "text" name= "txtNombre" id= "txtNombre" value = "<?php echo $Nombre;?>" /> <br>
			
			<label> Apellido </label>
			<input type= "text" name= "txtApellido" id= "txtApellido" value = "<?php echo $Apellido;?>" /> <br>
			
			<label> Contraseña </label>
			<input type= "password" name= "txtContrasena" id= "txtContrasena" value = "" />	<br>
			
			<label> Repetir Contraseña </label>
			<input type= "password" name= "txtRepContrasena" id= "txtRepContrasena" value = "" /> <br>	 
			
			<label> Mail </label>
			<input type= "text" name= "txtMail" id= "txtMail" value = "<?php echo $Mail;?>" />	<br>	
			
			<label> Fecha de nacimiento </label> 
			<select name="Dia">
			
				<?php for ($i = 1; $i<=31; $i++){ ?>
				  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>	
			
			<select name = "Mes">
				<?php for ($i = 1; $i<=12; $i++){ ?>
				  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			
			<select name = "Año">
				<?php for ($i = 1950; $i<=2016; $i++){ ?>
				  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?> 
			</select>		
			<br><br>
			

            <label> Intereses:  </label>  <br> 
			<?php 
			
			$intereses = InteresDao::ObtenerTodos();
			
		
			foreach($intereses as $int){ ?>
				<input type="checkbox" name="intereses[]" value= "<?php echo $int->id; ?>"> <?php echo $int->nombre;?> </input>;
			<?php } ?>
			
			<br> <br>
				 
			<label> Sexo </label> <br>
				<input type="radio" name="Sexo" value="1"> Masculino <br>
				<input type="radio" name="Sexo" value="2"> Femenino<br> <br>
			
			<input type="checkbox" name="terminos" value="Acepto los terminos y condiciones" /> Acepto los terminos y condiciones <br> <br>
			
			<input type="submit"  value = "Registrarse" name = "submit" /> <br> <br> 
			
			
		</form>
		
		
		
		<?php				
			echo $errores;			
		?>
		
	</body>

	
</html>