<?php

namespace App\Http\Middleware;

use Closure;

class MenssagesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($request->session()->get('op'));
        $menssages = [
            'logged' => 'Bienvenido',
            'verified' => 'Usuario verificado, ya puedes iniciar sesión',
            'registered' => 'Registrado, ver correo',
            'passwordreset' => 'Clave de acceso reseteada',
            'reverification' => 'Se te ha enviado un correo de verificación',
            'createCongress' => 'Se ha creado el congreso',
            'errorCreateCongress' => 'Ha fallado la creación del congreso',
            'createPresentation' => 'Se ha creado la ponencia',
            'errorCreatePresentation' => 'Ha fallado la creación de la ponencia',
            'createOrganizator' => 'Ha sido dado de alta el organizador',
            'errorCreateOrganizator' => 'Ha fallado el dado de alta del organizador',
            'createSpeaker' => 'Ha sido dado de alta el ponente',
            'errorCreateSpeaker' => 'Ha fallado el dado de alta del ponente',
            'passwordok' => 'Clave de acceso modificada correctamente',
            'passwordko' => 'No se ha podido modificar la clave de acceso',
            'useredit'  => 'Usuario editado',
            'emailExists'  => 'Ya existe esa dirección de correo',
            'paidok' => 'El pago se ha realizado correctamente',
        ];
        $opSession = $request->session()->get('op');
        $alertMessage = null;
        if (isset($menssages[$opSession])) {
            $alertMessage = $menssages[$opSession];
        }
        $request['alertMessage'] = $alertMessage;
        return $next($request);
    }
}
