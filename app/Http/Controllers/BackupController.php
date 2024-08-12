<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{

    public function show(){

        return view('avanzadas');
    }

    public function create()
    {
        Artisan::call('backup:run');
        return redirect()->back()->with(['message' => 'Respaldo creado con éxito.']);
    }

    public function clean()
    {
        Artisan::call('backup:clean');
        return redirect()->back()->with(['message' => 'Respaldos eliminados satisfactoriamente']);
    }

    public function restore()
    {
        try {
            $connection = env('DB_CONNECTION');
            Artisan::call("backup:restore --disk=local --backup=latest --connection=$connection --no-interaction");

            return redirect()->back()->with(['message' => 'Base de datos restaurada con éxito.']);
        } catch (Exception $e) {
            // Registrar el error en el log de Laravel
            // Log::error('Database restore failed: ' . $e->getMessage());

            // Retornar una respuesta JSON indicando que ocurrió un error
            return redirect()->back()->with(['error' => 'Error al restaurar la base de datos.', 'details' => $e->getMessage()]);
        }
    }

    public function restore2($backupPath)
    {
        try {
            // Verificar si el archivo de respaldo existe
            if (!file_exists($backupPath)) {
                return redirect()->back()->with(['error' => 'Archivo de respaldo no encontrado.']);
            }

            // Obtener la configuración de la base de datos desde el archivo config/database.php
            $dbConfig = config('database.connections.mysql');

            // Crear una instancia de MySql y configurar los detalles de la base de datos
            MySql::create()
                ->setDbName($dbConfig['database']) // Configurar el nombre de la base de datos
                ->setUserName($dbConfig['username']) // Configurar el nombre de usuario
                ->setPassword($dbConfig['password']) // Configurar la contraseña
                ->setHost($dbConfig['host']) // Configurar el host (servidor)
                ->importFromFile($backupPath); // Restaurar desde el archivo de respaldo

            // Retornar una respuesta JSON indicando que la restauración fue exitosa
            return redirect()->back()->with(['message' => 'Base de datos restaurada con éxito.']);

        } catch (Exception $e) {
            // Registrar el error en el log de Laravel
            Log::error('Database restore failed: ' . $e->getMessage());

            // Retornar una respuesta JSON indicando que ocurrió un error
            return redirect()->back()->with(['error' => 'Error al restaurar la base de datos.', 'details' => $e->getMessage()]);
        }
    }
}
