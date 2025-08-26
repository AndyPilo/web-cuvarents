<!-- Sidebar with contact form that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
<aside class="col-lg-4 offset-xl-1">
    <div class="d-none d-lg-block" style="margin-top: -105px"></div>
    <div class="sticky-lg-top">
        <div class="d-none d-lg-block" style="height: 105px"></div>
        <div class="card shadow rounded-5 rounded p-4">
            <div class="p-sm-2 p-lg-0 p-xl-2">

                <!-- Botón para abrir el modal -->
                <button type="button" class="btn btn-lg btn-info w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#addGestorModal">
                    Reservar
                </button>




                <div class="fs-xs text-center pt-1 pb-2 my-2">Esta reserva se enviaría a nuestros gestores</div>
                <div class="d-flex align-items-center mb-3">
                    <hr class="w-100 m-0">
                    <div class="mt-n1 px-3">o</div>
                    <hr class="w-100 m-0">
                </div>
                <!-- Botón para enviar mensaje a WhatsApp -->
                <button type="button" class="btn btn-lg btn-outline-dark w-100 rounded-pill" id="contactBtn">Envíanos un mensaje</button>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('contactBtn').addEventListener('click', function() {
                            fetch('php-get-gestor-activo.php')
                                .then(response => response.json())
                                .then(data => {
                                    if (data.telefono) {
                                        const telefono = data.telefono;
                                        const mensaje = encodeURIComponent("Hola, vengo de su sitio web cuvarents");
                                        const whatsappUrl = `https://wa.me/${telefono}?text=${mensaje}`;
                                        console.log('WhatsApp URL:', whatsappUrl);
                                        window.location.href = whatsappUrl; // Usar window.location.href en lugar de window.open
                                    } else {
                                        alert('No hay gestores activos disponibles.');
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</aside>