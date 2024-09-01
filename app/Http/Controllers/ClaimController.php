<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use App\Models\Producto;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ClaimController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo reclamo.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        // Obtén todos los productos para mostrarlos en el formulario
        $productos = Producto::all();
        return view('welcome', compact('productos'));
    }

    /**
     * Almacena un nuevo reclamo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'tipo_reclamo' => 'required|string',
            'cliente' => 'required|string',
            'correo_cliente' => 'required|email',
            'telefono_cliente' => 'nullable|string',
            'dni_cliente' => 'nullable|string',
            'producto' => 'required|integer|exists:productos,productoID', // Asegúrate de usar el ID correcto
            'fecha_reclamo' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        // Buscar el producto basado en su ID
        $producto = Producto::find($validatedData['producto']);
        if (!$producto) {
            return redirect()->route('reclamos.form')->with('error', 'Producto no encontrado.');
        }

        // Crear un nuevo reclamo en la base de datos
        $reclamo = Reclamo::create([
            'tipo_reclamo' => $validatedData['tipo_reclamo'],
            'nombre_cliente' => $validatedData['cliente'],
            'correo_cliente' => $validatedData['correo_cliente'],
            'telefono_cliente' => $validatedData['telefono_cliente'],
            'dni_cliente' => $validatedData['dni_cliente'],
            'productoID' => $producto->productoID,
            'fecha_reclamo' => $validatedData['fecha_reclamo'],
            'descripcion' => $validatedData['descripcion'],
        ]);

        // Enviar el correo electrónico usando PHPMailer
        try {
            $this->sendMail($reclamo, $validatedData, $producto);
            return redirect()->route('reclamos.form')->with('success', 'Reclamo enviado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('reclamos.form')->with('error', 'El reclamo no pudo ser enviado.')->withInput();
        }
    }

    /**
     * Envía un correo electrónico con el reclamo.
     *
     * @param  \App\Models\Reclamo  $reclamo
     * @param  array  $validatedData
     * @param  \App\Models\Producto  $producto
     * @return void
     */
    protected function sendMail($reclamo, $validatedData, $producto)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'giancarlo.silva550@gmail.com'; // Usa una contraseña de aplicación segura
            $mail->Password = 'exhveejndgwvlbvq'; // Asegúrate de usar una contraseña de aplicación segura
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo
            $mail->setFrom('giancarlo.silva550@gmail.com', 'Veterinaria');
            $mail->addAddress('giancarlosilvagutierrez55@gmail.com');

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Nuevo Reclamo de Cliente';
            $mail->Body = "
                <h1>Nuevo Reclamo</h1>
                <p><strong>Cliente:</strong> {$validatedData['cliente']}</p>
                <p><strong>Correo:</strong> {$validatedData['correo_cliente']}</p>
                <p><strong>Teléfono:</strong> {$validatedData['telefono_cliente']}</p>
                <p><strong>DNI:</strong> {$validatedData['dni_cliente']}</p>
                <p><strong>Producto:</strong> {$producto->nombre}</p>
                <p><strong>Fecha de Reclamo:</strong> {$validatedData['fecha_reclamo']}</p>
                <p><strong>Descripción:</strong> {$validatedData['descripcion']}</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            // Maneja los errores de envío de correo aquí
            throw $e;
        }
    }
}
