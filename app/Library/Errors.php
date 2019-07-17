<?php

namespace App\Library;

class Errors {


	public static function getErrors($error_ID) {
		
		$return = array(	"title"		=> "Error de base de datos.",
							"message"	=> "Existe un problema de base de datos, pongase en contacto con el administrador del sistema. Error No. " . $error_ID);
		switch($error_ID) {
			case '23000':
				$return = array(	"title"		=> "Error de registro duplicado.",
									"message"	=> "El registro o la clave que intenta ingresar ya se encuentra en la base de datos.");
			break;
		}

		return $return;
	}

	//LOGIN
	const LOGIN_01_ID = "1_0001";
	const LOGIN_01_TITLE = "Acceso restringido."; 
	const LOGIN_01_MESSAGE = "Correo o password incorrectos. Verifique su información.";

	//SESSIONS
	const SESION_01_ID = "2_0001";
	const SESION_01_TITLE = "La sesión ha expirado."; 
	const SESION_01_MESSAGE = "La sesión del usuario ha finalizado, debe iniciar sesión nuevamente.";


	/* *********************************************************************
	 * *************	ERRORES DE LA INTERFAZ DEL PANEL ************
	 * ****************************************************************** */		


	//USUARIOS
	const USUARIOS_CREATE_01_ID = "3_0001";
	const USUARIOS_CREATE_01_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_01_MESSAGE = "No se ingresó el nombre completo del usuario.";

	const USUARIOS_CREATE_02_ID = "3_0002";
	const USUARIOS_CREATE_02_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_02_MESSAGE = "La fecha ingresada no se encuentra en un formato admitido.";

	const USUARIOS_CREATE_03_ID = "3_0003";
	const USUARIOS_CREATE_03_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_03_MESSAGE = "Los datos del nuevo usuario no pudieron registrarse. Verifique la información.";

	const USUARIOS_CREATE_04_ID = "3_0004";
	const USUARIOS_CREATE_04_TITLE = "Error de nuevo registro.";
	const USUARIOS_CREATE_04_MESSAGE = "Las contraseñas no coinciden. Verifique la información.";

	const USUARIOS_EDIT_01_ID = "3_0005";
	const USUARIOS_EDIT_01_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_01_MESSAGE = "No se ingresó el nombre completo del usuario.";

	const USUARIOS_EDIT_02_ID = "3_0006";
	const USUARIOS_EDIT_02_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_02_MESSAGE = "La fecha ingresada no se encuentra en un formato admitido.";

	const USUARIOS_EDIT_03_ID = "3_0007";
	const USUARIOS_EDIT_03_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_03_MESSAGE = "Los datos del usuario no pudieron modificarse. Verifique la información.";

	const USUARIOS_EDIT_04_ID = "3_0008";
	const USUARIOS_EDIT_04_TITLE = "Error de modificación.";
	const USUARIOS_EDIT_04_MESSAGE = "Las contraseñas no coinciden. Verifique la información.";
	
}

?>