@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Tambah Penjualan</h1>

        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul>
                    @if (session('error'))
                        <li>{{ session('error') }}</li>
                    @endif
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <!-- Customer and Date Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="customer_name">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name"
                                value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="transaction_date">Tanggal</label>
                            <input type="date" class="form-control" id="transaction_date" name="transaction_date"
                                value="{{ old('transaction_date') ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    {{-- Add Note --}}
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="description">Catatan</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Catatan (opsional)">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Product, Quantity, Price, Note, and Add Button -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="product">Sepatu</label>
                            <select class="form-control" id="product" name="product">
                                <option value="">Pilih sepatu</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->code }} - {{ $product->name }} -
                                        {{ $product->color }}; Ukuran:{{ $product->size }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="quantity">Jumlah</label>
                            <input type="number" class="form-control" id="quantity" min="1" value="1">
                        </div>
                        <div class="col-md-2">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control" id="price" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="note">Catatan</label>
                            <input type="text" class="form-control" id="note" name="note"
                                placeholder="Catatan (opsional)">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="button" class="btn btn-primary btn-block" id="add-item">Tambah</button>
                        </div>
                    </div>

                    <!-- Order Items Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sepatu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="order-items">
                                <!-- Dynamic rows will be appended here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Hidden details container for submitting order details -->
                    <div id="details-container"></div>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success">Ajukan Penjualan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle dynamic item addition -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const productSelect = document.getElementById("product");
            const quantityInput = document.getElementById("quantity");
            const priceInput = document.getElementById("price");
            const noteInput = document.getElementById("note");
            const orderItemsTable = document.getElementById("order-items");
            const detailsContainer = document.getElementById("details-container");

            // Update price field based on selected product
            productSelect.addEventListener("change", function() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const price = selectedOption.getAttribute("data-price");
                priceInput.value = price ? `Rp ${Number(price).toLocaleString()}` : "";
            });

            // Add item to table and details container
            document.getElementById("add-item").addEventListener("click", function() {
                const productId = productSelect.value;
                const productName = productSelect.options[productSelect.selectedIndex].text.split(" - ")[1];
                const price = parseFloat(productSelect.options[productSelect.selectedIndex].getAttribute(
                    "data-price"));
                const quantity = parseInt(quantityInput.value);
                const total = price * quantity;
                const note = noteInput.value;

                if (!productId) {
                    alert("Silakan pilih sepatu terlebih dahulu!");
                    return;
                }

                // Create a new row for the item
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${productName}</td>
                <td>${quantity}</td>
                <td>Rp ${price.toLocaleString()}</td>
                <td>Rp ${total.toLocaleString()}</td>
                <td>${note}</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-item">Hapus</button></td>
            `;

                // Append the row to the table body
                orderItemsTable.appendChild(row);

                // Add hidden inputs for this detail item
                addHiddenInput(`details[${orderItemsTable.rows.length - 1}][product_id]`, productId);
                addHiddenInput(`details[${orderItemsTable.rows.length - 1}][quantity]`, quantity);
                addHiddenInput(`details[${orderItemsTable.rows.length - 1}][price]`, price);
                addHiddenInput(`details[${orderItemsTable.rows.length - 1}][note]`, note);

                // Clear input fields
                quantityInput.value = 1;
                priceInput.value = "";
                noteInput.value = "";

                // Add event listener to the delete button
                row.querySelector(".remove-item").addEventListener("click", function() {
                    row.remove();
                    updateDetailsContainer();
                });
            });

            function addHiddenInput(name, value) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = name;
                input.value = value;
                detailsContainer.appendChild(input);
            }

            function updateDetailsContainer() {
                // Clear existing inputs
                detailsContainer.innerHTML = '';
                // Re-add inputs based on table rows
                Array.from(orderItemsTable.rows).forEach((row, index) => {
                    const cells = row.cells;
                    addHiddenInput(`details[${index}][product_id]`, cells[0].dataset.productId);
                    addHiddenInput(`details[${index}][quantity]`, cells[1].innerText);
                    addHiddenInput(`details[${index}][price]`, cells[2].innerText.replace(/Rp |,/g, ''));
                    addHiddenInput(`details[${index}][note]`, cells[4].innerText);
                });
            }
        });
    </script>
@endsection
