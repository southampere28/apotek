function refreshSummary() {

const subtotal = getRows().reduce(function (total, row) {
    const qty = Number(row.querySelector('[data-item-qty]').value || 0);
    const price = Number(row.querySelector('[data-item-price]').value || 0);
    return total + (qty * price);
}, 0);
const discount = Number(discountInput.value || 0);
const total = Math.max(0, subtotal - discount);

subtotalEl.textContent = formatCurrency(subtotal);
discountEl.textContent = formatCurrency(discount);
totalEl.textContent = formatCurrency(total);

}