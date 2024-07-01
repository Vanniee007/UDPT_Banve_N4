<!-- resources/views/event-details.blade.php -->

@extends('layouts.app')
<style>
    /* Custom CSS styles */
    .ticket-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .quantity-selector {
        display: flex;
        align-items: center;
    }
    .quantity-selector button {
        background-color: #007bff;
        color: #fff;
        border: none;
        /* border-radius: 50%; */
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }
    .quantity-selector input {
        width: 50px;
        text-align: center;
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 5px;
        margin: 0 5px;
    }
    .ticket-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            display: flex; /* Để các ticket-item nằm trên cùng hàng */
            align-items: center; /* Căn giữa nội dung trong ticket-item */
        }
        .ticket-item-content {
            flex: 1; /* Expand ticket-item-content để chiếm hết khoảng trống */
            margin-right: 20px; /* Khoảng cách bên phải giữa ticket-item và total-box */
        }
        .total-box {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #f8f9fa;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    /* z-index: 1000; */
}
</style>
@section('content')
<div class="container">
    @if (isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <h1>{{ $eventData['ten'] }}</h1>
        <p>{{ $eventData['moTa'] }}</p>
        <p><strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($eventData['thoiGian'])->format('D, F j - gA') }}</p>
        <p><strong>Địa chỉ:</strong> {{ $eventData['diaChi'] }}</p>
        <p><strong>Tình trạng:</strong> {{ $eventData['tinhTrang'] }}</p>


        <div class="row">
            <div class="col-md-8">
                <h2>Ticket Prices</h2>
                <ul class="list-unstyled">
                    @if ($ticketData && count($ticketData) > 0)
                        @foreach ($ticketData as $ticket)
                        <li class="ticket-item">
                            <div class="ticket-item-content">
                                <div class="ticket-info">
                                    <span>{{ $ticket['loaiVe'] }}: {{ number_format($ticket['gia'], 0, ',', '.') }} VND</span>

                                    <div class="quantity-selector">
                                        <button class="btn btn-primary btn-minus" onclick="updateQuantity('{{ $ticket['maVe'] }}', -1)">-</button>
                                        <input type="text" id="quantity_{{ $ticket['maVe'] }}" name="quantity_{{ $ticket['maVe'] }}" value="0" readonly class="form-control">
                                        <button class="btn btn-primary btn-plus" onclick="updateQuantity('{{ $ticket['maVe'] }}', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @else
                        <li class="ticket-item">
                            <div class="ticket-item-content">
                                <div class="ticket-info">
                                    <span>Free</span>
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
        <div id="totalBox" class="total-box">
            <h4>Total Amount:</h4>
            <span id="totalAmount">0 VND</span>
        </div>
    @endif
</div>
@endsection
<script>

    // Function to update quantity and calculate total amount
    function updateQuantity(ticketId, change) {
            var quantityInput = document.getElementById('quantity_' + ticketId);
            var currentQuantity = parseInt(quantityInput.value);
            var newQuantity = currentQuantity + change;
            if (newQuantity >= 0) {
                quantityInput.value = newQuantity;
                updateTotalAmount(); // Update total amount when quantity changes
            }
        }

       // Function to update total amount based on selected quantities
// Function to update total amount based on selected quantities
function updateTotalAmount() {
    var totalAmount = 0;
    var ticketData = @json($ticketData); // Get ticket data from Blade template

    if (!ticketData) {
        document.getElementById('totalAmount').textContent = 'Free';
        return;
    }

    ticketData.forEach(ticket => {
        var quantity = parseInt(document.getElementById('quantity_' + ticket.maVe).value);
        totalAmount += quantity * parseFloat(ticket.gia.replace(',', '')); // Convert gia to number
    });

    document.getElementById('totalAmount').textContent = totalAmount.toLocaleString() + ' VND'; // Format total amount
}



        // Initial call to update total amount when page loads
        window.onload = function() {
            updateTotalAmount();
        };
</script>


