@component('mail::message')

# Restaurar contraseña

Hola,<br>
Recibimos tu solicitud, si no fuiste tu ignora este correo electrónico.

Dale click al siguiente enlace para proceder con la restauración:
@component('mail::button', ['url' => 'http://localhost:4200/#/user/reset-password?token='.$token.'&email='.$mail])
Restaurar contraseña
@endcomponent

<h3>Esta solicitud podrá ser usada una única vez y estará disponible durante 1 hora.</h3>

Si tienes problemas con el botón, copia el siguiente enlace en tu navegador: 
http://localhost:4200/#/user/reset-password?token={{ $token }}&email={{ $mail }}

Saludos,<br>
Centro de ayuda Archivo de casos - SBOLP

@endcomponent