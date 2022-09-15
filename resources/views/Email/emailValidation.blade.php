@component('mail::message')

# Confirmar Correo Electrónico

Bienvenido!<br>
Gracias por registrate en el sistema de Archivo de Casos de Ortodoncia y Ortopedia de la SBO.

Dale click al siguiente enlace para confirmar tu cuenta:
@component('mail::button', ['url' =>  $client_url . '#/user/email-validation?id=' . $id])
Validar Correo Electrónico.
@endcomponent

Si tienes problemas con el botón, copia el siguiente enlace en tu navegador: 
{{ $client_url }}#/user/email-validation?id={{ $id }}

Saludos,<br>
Centro de ayuda Archivo de casos - SBO

@endcomponent