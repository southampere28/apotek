@php
    $pageTitle = $pageTitle ?? 'Form Transaksi';
    $pageDescription = $pageDescription ?? '';
    $backRoute = $backRoute ?? '#';
    $storeRoute = $storeRoute ?? '#';
    $referenceLabel = $referenceLabel ?? 'Nota';
    $referenceCode = $referenceCode ?? '';
    $partyLabel = $partyLabel ?? 'Pihak';
    $partyFieldName = $partyFieldName ?? 'party_id';
    $partyCodeKey = $partyCodeKey ?? 'kode';
    $partyOptions = $partyOptions ?? collect();
    $partyPlaceholder = $partyPlaceholder ?? 'Pilih data';
    $itemLabel = $itemLabel ?? 'Item';
    $itemOptions = $itemOptions ?? collect();
    $defaultPriceKey = $defaultPriceKey ?? 'harga';
    $priceLabel = $priceLabel ?? 'Harga';
    $restrictItemOptions = $restrictItemOptions ?? true;
    $submitLabel = $submitLabel ?? 'Simpan';
    $oldItems = old('items', []);
    $rows = count($oldItems) > 0 ? $oldItems : [[]];
@endphp

<div class="alert alert-info border-0 shadow-sm rounded-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4" role="alert">
    <div>
        <div class="fw-bold text-primary-emphasis mb-1">{{ $pageTitle }}</div>
        <div class="text-primary-emphasis">{{ $pageDescription }}</div>
    </div>
    <a href="{{ $backRoute }}" class="btn btn-outline-primary fw-semibold px-4 rounded-pill">Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
        <div class="fw-bold mb-2">Periksa input berikut:</div>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4">
        <h2 class="h4 fw-bold mb-1 text-primary-emphasis">{{ $pageTitle }}</h2>
        <p class="mb-0 text-secondary">{{ $pageDescription }}</p>
    </div>

    <div class="card-body p-4">
        <form action="{{ $storeRoute }}" method="POST" id="transaction-form">
            @csrf

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <label for="nota" class="form-label fw-semibold">{{ $referenceLabel }}</label>
                    <input type="text" id="nota" name="nota" class="form-control form-control-lg @error('nota') is-invalid @enderror" value="{{ old('nota', $referenceCode) }}" readonly>
                    <div class="form-text">{{ $referenceLabel }} dibuat otomatis dari helper dan dikunci agar tidak diedit manual.</div>
                    @error('nota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="diskon" class="form-label fw-semibold">Diskon (Rp)</label>
                    <input type="number" id="diskon" name="diskon" class="form-control form-control-lg @error('diskon') is-invalid @enderror" value="{{ old('diskon', 0) }}" min="0" step="1" placeholder="0">
                    <div class="form-text">Masukkan nominal rupiah, bukan persentase.</div>
                    @error('diskon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="{{ $partyFieldName }}" class="form-label fw-semibold">{{ $partyLabel }}</label>
                    <select id="{{ $partyFieldName }}" name="{{ $partyFieldName }}" class="form-select form-select-lg @error($partyFieldName) is-invalid @enderror">
                        <option value="">{{ $partyPlaceholder }}</option>
                        @foreach ($partyOptions as $party)
                            <option value="{{ $party->id }}" @selected(old($partyFieldName) == $party->id)>
                                {{ $party->nama }} - {{ $party->{$partyCodeKey} }}
                            </option>
                        @endforeach
                    </select>
                    @error($partyFieldName)<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="tanggal_nota" class="form-label fw-semibold">Tanggal Nota</label>
                    <input type="datetime-local" id="tanggal_nota" name="tanggal_nota" class="form-control form-control-lg @error('tanggal_nota') is-invalid @enderror" value="{{ old('tanggal_nota') }}">
                    @error('tanggal_nota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                            <div>
                                <h3 class="h5 fw-bold mb-1 text-primary-emphasis">Daftar {{ $itemLabel }}</h3>
                                <p class="mb-0 text-secondary">
                                    @if ($restrictItemOptions)
                                        Tambah baris item seperti di kasir. Setelah supplier dipilih, hanya obat dari supplier itu yang bisa dipilih.
                                    @else
                                        Tambah baris item seperti di kasir. Semua obat yang tersedia bisa dipilih.
                                    @endif
                                </p>
                            </div>
                            <button type="button" class="btn btn-outline-primary fw-semibold px-4 rounded-pill" id="add-row-btn">Tambah Baris</button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" id="items-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-4 py-3">{{ $itemLabel }}</th>
                                            <th class="px-4 py-3" style="width: 120px;">Jumlah</th>
                                            <th class="px-4 py-3" style="width: 180px;">{{ $priceLabel }}</th>
                                            <th class="px-4 py-3" style="width: 180px;">Subtotal</th>
                                            <th class="px-4 py-3 text-end" style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-body">
                                        @foreach ($rows as $index => $oldItem)
                                            <tr class="transaction-row" data-row>
                                                <td class="px-4 py-3">
                                                    <select name="items[{{ $index }}][obat_id]" class="form-select @error('items.' . $index . '.obat_id') is-invalid @enderror" data-item-select>
                                                        <option value="">Pilih {{ $itemLabel }}</option>
                                                        @foreach ($itemOptions as $item)
                                                            <option value="{{ $item->id }}" data-default-price="{{ $item->{$defaultPriceKey} }}" data-supplier-id="{{ $item->supplier_id }}" @selected((string)($oldItem['obat_id'] ?? '') === (string) $item->id)>
                                                                {{ $item->kode_obat }} - {{ $item->nama_obat }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="number" name="items[{{ $index }}][jumlah]" class="form-control @error('items.' . $index . '.jumlah') is-invalid @enderror" value="{{ old('items.' . $index . '.jumlah', $oldItem['jumlah'] ?? 1) }}" min="1" step="1" data-item-qty>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="number" name="items[{{ $index }}][harga_satuan]" class="form-control @error('items.' . $index . '.harga_satuan') is-invalid @enderror" value="{{ old('items.' . $index . '.harga_satuan', $oldItem['harga_satuan'] ?? '') }}" min="0" step="1" data-item-price>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="text" class="form-control" value="Rp 0" data-item-subtotal readonly>
                                                </td>
                                                <td class="px-4 py-3 text-end">
                                                    <button type="button" class="btn btn-outline-danger rounded-pill" data-remove-row>Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @error('items')
                                <div class="px-4 py-3 text-danger fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white border-0 rounded-top-4 py-3 px-4">
                            <h3 class="h5 fw-bold mb-1 text-primary-emphasis">Ringkasan</h3>
                            <p class="mb-0 text-secondary">Total dihitung otomatis dari baris item.</p>
                        </div>

                        <div class="card-body p-4 d-grid gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary">Subtotal</span>
                                <strong id="summary-subtotal">Rp 0</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary">Diskon (Rp)</span>
                                <strong id="summary-discount">Rp 0</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center fs-5 pt-2 border-top">
                                <span class="fw-bold">Total</span>
                                <strong id="summary-total">Rp 0</strong>
                            </div>

                            <div class="alert alert-light border rounded-4 mb-0">
                                <div class="fw-semibold mb-1">Catatan transaksi</div>
                                <div class="small text-secondary">Pastikan supplier dan item sudah benar sebelum disimpan. Stok obat akan bertambah otomatis setelah transaksi berhasil.</div>
                            </div>

                            <div class="d-flex flex-column gap-3 mt-2">
                                <a href="{{ $backRoute }}" class="btn btn-outline-secondary btn-lg rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-success btn-lg rounded-pill fw-semibold">{{ $submitLabel }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<template id="transaction-row-template">
    <tr class="transaction-row" data-row>
        <td class="px-4 py-3">
            <select name="items[__INDEX__][obat_id]" class="form-select" data-item-select>
                <option value="">Pilih {{ $itemLabel }}</option>
                @foreach ($itemOptions as $item)
                    <option value="{{ $item->id }}" data-default-price="{{ $item->{$defaultPriceKey} }}" data-supplier-id="{{ $item->supplier_id }}">
                        {{ $item->kode_obat }} - {{ $item->nama_obat }}
                    </option>
                @endforeach
            </select>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[__INDEX__][jumlah]" class="form-control" value="1" min="1" step="1" data-item-qty>
        </td>
        <td class="px-4 py-3">
            <input type="number" name="items[__INDEX__][harga_satuan]" class="form-control" value="" min="0" step="1" data-item-price>
        </td>
        <td class="px-4 py-3">
            <input type="text" class="form-control" value="Rp 0" data-item-subtotal readonly>
        </td>
        <td class="px-4 py-3 text-end">
            <button type="button" class="btn btn-outline-danger rounded-pill" data-remove-row>Hapus</button>
        </td>
    </tr>
</template>

<script>
    (function () {
        const form = document.getElementById('transaction-form');
        const tbody = document.getElementById('items-body');
        const template = document.getElementById('transaction-row-template');
        const addRowBtn = document.getElementById('add-row-btn');
        const supplierSelect = document.getElementById('{{ $partyFieldName }}');
        const discountInput = document.getElementById('diskon');
        const subtotalEl = document.getElementById('summary-subtotal');
        const discountEl = document.getElementById('summary-discount');
        const totalEl = document.getElementById('summary-total');

        function formatCurrency(value) {
            return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
        }

        function getRows() {
            return Array.from(tbody.querySelectorAll('[data-row]'));
        }

        const restrictItemOptions = @json($restrictItemOptions);

        function getSelectedSupplierId() {
            return supplierSelect ? String(supplierSelect.value || '') : '';
        }

        function filterItemOptions(select) {
            if (!restrictItemOptions) {
                return;
            }

            const supplierId = getSelectedSupplierId();
            const options = Array.from(select.options);
            const currentValue = String(select.value || '');
            let currentOptionAllowed = false;

            options.forEach(function (option, index) {
                if (index === 0) {
                    option.disabled = false;
                    option.hidden = false;
                    return;
                }

                const matchesSupplier = !supplierId || String(option.dataset.supplierId || '') === supplierId;
                option.disabled = !matchesSupplier;
                option.hidden = !matchesSupplier;

                if (matchesSupplier && String(option.value) === currentValue) {
                    currentOptionAllowed = true;
                }
            });

            if (!currentOptionAllowed) {
                select.value = '';
                select.dataset.autofill = '0';
            }
        }

        function syncAllItemOptions() {
            if (!restrictItemOptions) {
                refreshSummary();
                return;
            }

            getRows().forEach(function (row) {
                const select = row.querySelector('[data-item-select]');
                const priceInput = row.querySelector('[data-item-price]');

                filterItemOptions(select);

                if (!select.value) {
                    priceInput.value = '';
                    priceInput.dataset.autofill = '0';
                }
            });

            refreshSummary();
        }

        function refreshRowNames() {
            getRows().forEach(function (row, index) {
                row.querySelectorAll('input, select').forEach(function (field) {
                    if (field.name) {
                        field.name = field.name.replace(/items\[\d+\]/, 'items[' + index + ']');
                    }
                });
            });
        }

        function updateRow(row) {
            const select = row.querySelector('[data-item-select]');
            const qtyInput = row.querySelector('[data-item-qty]');
            const priceInput = row.querySelector('[data-item-price]');
            const subtotalInput = row.querySelector('[data-item-subtotal]');

            filterItemOptions(select);

            const selectedOption = select.options[select.selectedIndex];

            if (selectedOption && !selectedOption.disabled && selectedOption.dataset.defaultPrice && (!priceInput.value || priceInput.dataset.autofill === '1')) {
                priceInput.value = selectedOption.dataset.defaultPrice;
                priceInput.dataset.autofill = '1';
            }

            const qty = Number(qtyInput.value || 0);
            const price = Number(priceInput.value || 0);
            const subtotal = qty * price;

            subtotalInput.value = formatCurrency(subtotal);
            refreshSummary();
        }

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

        function bindRow(row) {
            row.querySelector('[data-item-select]').addEventListener('change', function () {
                const priceInput = row.querySelector('[data-item-price]');
                priceInput.dataset.autofill = '1';
                updateRow(row);
            });

            row.querySelector('[data-item-qty]').addEventListener('input', function () {
                updateRow(row);
            });

            row.querySelector('[data-item-price]').addEventListener('input', function () {
                this.dataset.autofill = '0';
                updateRow(row);
            });

            row.querySelector('[data-remove-row]').addEventListener('click', function () {
                if (getRows().length === 1) {
                    row.querySelectorAll('input, select').forEach(function (field) {
                        if (field.tagName === 'SELECT') {
                            field.selectedIndex = 0;
                        } else {
                            field.value = field.type === 'number' && field.name.includes('jumlah') ? 1 : '';
                        }
                    });
                    updateRow(row);
                    return;
                }

                row.remove();
                refreshRowNames();
                refreshSummary();
            });

            updateRow(row);
        }

        function addRow() {
            const index = getRows().length;
            const rowHtml = template.innerHTML.replaceAll('__INDEX__', index);
            const wrapper = document.createElement('tbody');
            wrapper.innerHTML = rowHtml.trim();
            const row = wrapper.firstElementChild;
            tbody.appendChild(row);
            bindRow(row);
            refreshRowNames();
        }

        getRows().forEach(bindRow);

        if (addRowBtn) {
            addRowBtn.addEventListener('click', addRow);
        }

        if (discountInput) {
            discountInput.addEventListener('input', refreshSummary);
        }

        if (restrictItemOptions && supplierSelect) {
            supplierSelect.addEventListener('change', syncAllItemOptions);
        }

        refreshRowNames();
        syncAllItemOptions();
        refreshSummary();
    })();
</script>