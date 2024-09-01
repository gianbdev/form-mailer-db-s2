<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria - Reclamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Header Section -->
    <header class="bg-primary text-white text-center py-5">
        <h1>Bienvenido a nuestra Veterinaria</h1>
        <p>Comprometidos con el cuidado y bienestar de tus mascotas</p>
    </header>

    <!-- Main Content Section -->
    <main class="container my-5">
        <section class="mb-5">
            <h2>Sobre Nosotros</h2>
            <p>Ofrecemos los mejores servicios veterinarios para que tus mascotas se mantengan saludables y felices. Nuestro equipo está compuesto por profesionales dedicados y apasionados por los animales.</p>
        </section>

        <section class="mb-5">
            <h2>Nuestros Servicios</h2>
            <ul>
                <li>Consultas veterinarias</li>
                <li>Vacunación y desparasitación</li>
                <li>Cirugías</li>
                <li>Estética y peluquería para mascotas</li>
                <li>Venta de productos especializados</li>
            </ul>
        </section>

        <section>
            <h2>Formulario de Reclamo</h2>
            <p>Si tienes algún inconveniente con nuestros servicios o productos, por favor llena el siguiente formulario:</p>

            @if (session('success'))
                <div id="success-message" class="alert alert-success">
                    {{ session('success') }}
                    <button id="close-success" class="close-button" aria-label="Close">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div id="error-message" class="alert alert-danger">
                    {{ session('error') }}
                    <button id="close-error" class="close-button" aria-label="Close">&times;</button>
                </div>
            @endif

            <form action="{{ route('reclamos.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="tipo_reclamo" class="form-label">Tipo de Reclamo</label>
                    <select class="form-select" id="tipo_reclamo" name="tipo_reclamo" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="servicio">Servicio</option>
                        <option value="producto">Producto</option>
                        <option value="otros">Otros</option>
                    </select>
                    <div class="invalid-feedback">Por favor, selecciona un tipo de reclamo.</div>
                </div>

                <div class="mb-3">
                    <label for="cliente" class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Ingresa tu nombre" required>
                    <div class="invalid-feedback">Por favor, ingresa tu nombre.</div>
                </div>

                <div class="mb-3">
                    <label for="correo_cliente" class="form-label">Correo del Cliente</label>
                    <input type="email" class="form-control" id="correo_cliente" name="correo_cliente" placeholder="Ingresa tu correo" required>
                    <div class="invalid-feedback">Por favor, ingresa un correo válido.</div>
                </div>

                <div class="mb-3">
                    <label for="telefono_cliente" class="form-label">Teléfono del Cliente</label>
                    <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder="Ingresa tu teléfono (opcional)">
                </div>

                <div class="mb-3">
                    <label for="dni_cliente" class="form-label">DNI del Cliente</label>
                    <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" placeholder="Ingresa tu DNI (opcional)">
                </div>

                <div class="mb-3">
                    <label for="producto" class="form-label">Producto</label>
                    <select class="form-select" id="producto" name="producto" required>
                        <option value="" disabled selected>Selecciona un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->productoID }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, selecciona un producto.</div>
                </div>

                <div class="mb-3">
                    <label for="fecha_reclamo" class="form-label">Fecha de Reclamo</label>
                    <input type="date" class="form-control" id="fecha_reclamo" name="fecha_reclamo" required>
                    <div class="invalid-feedback">Por favor, selecciona una fecha.</div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción del Reclamo</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Describe tu reclamo aquí" required></textarea>
                    <div class="invalid-feedback">Por favor, ingresa una descripción.</div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar Reclamo</button>
            </form>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-light text-center py-4">
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Script para habilitar validación de formularios Bootstrap
        (() => {
            'use strict';

            const forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms).forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Script para cerrar mensajes de éxito y error
        document.addEventListener('DOMContentLoaded', function () {
            const closeSuccessButton = document.getElementById('close-success');
            const successMessage = document.getElementById('success-message');
            const closeErrorButton = document.getElementById('close-error');
            const errorMessage = document.getElementById('error-message');

            if (closeSuccessButton && successMessage) {
                closeSuccessButton.addEventListener('click', function () {
                    successMessage.style.display = 'none';
                });
            }

            if (closeErrorButton && errorMessage) {
                closeErrorButton.addEventListener('click', function () {
                    errorMessage.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
