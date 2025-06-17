function showMessage(msg, type = 'success') {
  const alert = document.createElement('div');
  alert.className = `alert alert-${type} mt-2`;  // añade margen superior
  alert.innerText = msg;
  document.body.prepend(alert);

  // Opcional: que desaparezca después de 3 segundos
  setTimeout(() => {
    alert.remove();
  }, 3000);
}

document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.addEventListener('click', event => {
    if (!confirm("¿Seguro que deseas eliminar este equipo?")) {
      event.preventDefault(); // evita que se envíe el formulario si cancela
    }
  });
});

