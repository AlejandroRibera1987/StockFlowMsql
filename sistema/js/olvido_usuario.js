
  // Selecciona el enlace por su ID
  const miEnlace = document.getElementById('miEnlace');

  // Agrega un evento de clic al enlace
  miEnlace.addEventListener('click', function(event) {
    // Evita el comportamiento predeterminado del enlace (navegación)
    event.preventDefault();

    // Muestra la alerta SweetAlert2
    Swal.fire('¡Haz clic!', '¡Este es un mensaje de SweetAlert2!', 'success');
  });

