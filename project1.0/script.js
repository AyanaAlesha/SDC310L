(function(){
  const table = document.getElementById('catalogTable');
  if (!table) return;

  table.addEventListener('submit', async function(e){
    const form = e.target.closest('.cart-form');
    if (!form) return;
    e.preventDefault();

    const fd = new FormData(form);
    fd.append('ajax','1'); // tells PHP to return JSON

    try {
      const res = await fetch('cart.php', {
        method: 'POST',
        headers: { 'X-Requested-With': 'fetch' },
        body: fd
      });
      const data = await res.json();
      if (!data || !data.success) throw new Error('Bad response');

      // Update global badge
      const badge = document.querySelector('.cart-badge');
      if (badge) badge.textContent = data.cartTotal;

      // Update row "In Cart"
      const row = form.closest('tr');
      const cell = row ? row.querySelector('.in-cart') : null;
      if (cell) cell.textContent = data.currentQty;
    } catch (err) {
      console.error(err);
      // Fallback: submit normally (will redirect and still update server-side)
      form.submit();
    }
  });
})();