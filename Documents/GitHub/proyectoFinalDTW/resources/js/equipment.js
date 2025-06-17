function showMessage(msg, type = 'success') {
  const alert = document.createElement('div');
  alert.className = `alert alert-${type}`;
  alert.innerText = msg;
  document.body.prepend(alert);
}

document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    if (!confirm("¿Seguro que deseas eliminar este equipo?")) {
      event.preventDefault();
    }
  });
});
