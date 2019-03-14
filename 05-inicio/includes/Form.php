<?php

/**
* Base class for the management of forms.
*
* In addition to the basic management of the forms.
 */
abstract class Form
{

    /**
     * @var string String used as the value of the "id" attribute of the & lt; form & gt; associated to the form and
      * as a parameter to check to verify that the user has sent the form.
     */
    private $formId;

    /**
     * @var string URL associated with the "action" attribute of the & lt; form & gt; of the form and that will process the
      * Form submission.
     */
    private $action;

    /**
     * Crea un nuevo formulario.
     *
     * Posibles opciones:
     * <table>
     *   <thead>
     *     <tr>
     *       <th>Opción</th>
     *       <th>Valor por defecto</th>
     *       <th>Descripción</th>
     *     </tr>
     *   </thead>
     *   <tbody>
     *     <tr>
     *       <td>action</td>
     *       <td><code>$_SERVER['PHP_SELF']</code></td>
     *       <td>URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará
                 el envío del formulario.</td>
     *     </tr>
     *   </tbody>
     * </table>

     * @param string $formId    String used as the value of the "id" attribute of the & lt; form & gt; associated with
     * form and as a parameter to check to verify that the user has sent the form.
     *
     * @param array $opciones (ver más arriba).
     */
    public function __construct($formId, $opciones = array() )
    {
        $this->formId = $formId;

        $opcionesPorDefecto = array( 'action' => null, );
        $opciones = array_merge($opcionesPorDefecto, $opciones);

        $this->action   = $opciones['action'];

        if ( !$this->action ) {
            $this->action = htmlentities($_SERVER['PHP_SELF']);
        }
    }

    /**
     * It is responsible for orchestrating the entire process of managing a form.
     */
    public function gestiona() //= template method
    {
        if ( ! $this->formularioEnviado($_POST) ) {
            echo $this->generaFormulario();
        } else {
            $result = $this->procesaFormulario($_POST);
            if ( is_array($result) ) {
                echo $this->generaFormulario($result, $_POST);
            } else {
                header('Location: '.$result);
                exit();
            }
        }
    }

    /**
     * Generate the necessary HTML to present the fields of the form.
     *
     * @param string[] $datosIniciales Initial data for the form fields (normalmente <code>$_POST</code>).
     *
     * @return string HTML associated with the form fields.
     */
    protected function generaCamposFormulario($datosIniciales)
    {
        return '';
    }

    /**
     * Procesa los datos del formulario.
     *
     * @param string[] $datos Datos enviado por el usuario (normalmente <code>$_POST</code>).
     *
     * @return string|string[] Returns the result of the form processing, usually a URL to which
     * you want to redirect the user, or an array with the errors that occurred during the processing of the form.
     *
     */
    protected function procesaFormulario($datos)
    {
        return array();
    }

    /**
     * Function that verifies if the user has sent the form.
     * Check if the <code> $ formId </ code> parameter exists in <code> $ params </ code>.
     *
     * @param string[] $params Array that contains the data received in the sending form.
     *
     * @return boolean Devuelve <code>true</code> si <code>$formId</code> existe como clave en <code>$params</code>
     */
    private function formularioEnviado(&$params)
    {
        return isset($params['action']) && $params['action'] == $this->formId;
    }

    /**
     * Función que genera el HTML necesario para el formulario.
     *
     * @param string[] $errores (opcional) Array with the error messages of validation and / or processing of the form.
     *
     * @param string[] $datos (opcional) Array with default values of form fields.
     *
     * @return string HTML asociado al formulario.
     */
    private function generaFormulario($errores = array(), &$datos = array())
    {

        $html= $this->generaListaErrores($errores);

        $html .= '<form method="POST" action="'.$this->action.'" id="'.$this->formId.'" >';
        $html .= '<input type="hidden" name="action" value="'.$this->formId.'" />';

        $html .= $this->generaCamposFormulario($datos);
        $html .= '</form>';
        return $html;
    }

    /**
     * Genera la lista de mensajes de error a incluir en el formulario.
     *
     * @param string[] $errores (opcional) Array con los mensajes de error de validación y/o procesamiento del formulario.
     *
     * @return string El HTML asociado a los mensajes de error.
     */
    private function generaListaErrores($errores)
    {
        $html='';
        $numErrores = count($errores);
        if (  $numErrores == 1 ) {
            $html .= "<ul><li>".$errores[0]."</li></ul>";
        } else if ( $numErrores > 1 ) {
            $html .= "<ul><li>";
            $html .= implode("</li><li>", $errores);
            $html .= "</li></ul>";
        }
        return $html;
    }
}
