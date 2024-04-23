<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {
			echo '<script>

			fncMatPreloader("on");
			fncSweetAlert("loading", "", "");

		</script>';

			if (
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
			) {

				$tabla = "admins";
				$item = "user_admin";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
			
				// echo '<pre>';
				// print_r($respuesta);
				// echo '</pre>';

				if (is_array($respuesta) && isset($respuesta["user_admin"]) && isset($respuesta["password_admin"])) {
					if ($respuesta["user_admin"] == $_POST["ingUsuario"] && $respuesta["password_admin"] == $_POST["ingPassword"]) {
						$_SESSION["users"] = "users";
						echo '<script>
									window.location = "inicio";
							</script>';
					} else {

						echo '<div class="alert alert-danger mt-3">Usuario y contraseña incorrecta</div>
						<script>
								fncToastr("error","error");
								fncMatPreloader("off");
								fncFormatInputs();
						</script>';

					}
				} else {
					echo '<div class="alert alert-danger mt-3">Usuario y contraseña incorrecta"</div>
					<script>
							fncToastr("Usuario y contraseña incorrecta","error");
							fncMatPreloader("off");
							fncFormatInputs();
					</script>';
				}
			}
		}


	}


}