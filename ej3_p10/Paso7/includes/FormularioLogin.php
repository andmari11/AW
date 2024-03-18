<?php
namespace es\ucm\fdi\aw;


class FormularioLogin extends Formulario
{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = $this->generaListaErroresGlobales($this->errores); 
        $erroresCampos = $this->generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', ['class' => 'error']); 

        // Se genera el HTML 
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Usuario y contraseña</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" />
                {$erroresCampos['nombreUsuario']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div>
                <button type="submit" name="login">Entrar</button>
            </div>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        if (empty($nombreUsuario)) { 
            $this->errores['nombreUsuario'] = 'El nombre de usuario no puede estar vacío';
        }
        
        $password = $datos['password'] ?? '';

        if (empty($password)) { 
            $this->errores['password'] = 'El password no puede estar vacío.';
        }
        
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
        
            if (!$usuario) {
                $this->errores[] = "No ha sido posible iniciar sesión"; 
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['esAdmin'] = $usuario->tieneRol(Usuario::ADMIN_ROLE);
            }
        }
    }
}
?>
