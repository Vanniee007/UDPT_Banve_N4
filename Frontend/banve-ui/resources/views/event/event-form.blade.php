<!-- resources/views/event-form.blade.php -->

@extends('layouts.app')

@section('content')
        <h2>Event Form</h2>
        <form id="eventForm" action="{{ route('event.submit') }}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="ten">Tên Sự Kiện:</label>
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Nhập tên sự kiện">
                </div>
                <div class="form-group">
                    <label for="moTa">Mô Tả:</label>
                    <textarea class="form-control" id="moTa" name="moTa" rows="3" placeholder="Nhập mô tả"></textarea>
                </div>
                <div class="form-group">
                    <label for="thoiLuong">Thời Lượng: (ví dụ: 2 tiếng 30 phút: 2:50)</label>
                    <input type="text" class="form-control" id="thoiLuong" name="thoiLuong" placeholder="Nhập thời lượng">
                </div>
                <div class="form-group">
                    <label for="diaChi">Địa Chỉ:</label>
                    <input type="text" class="form-control" id="diaChi" name="diaChi" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="thoiGian">Thời Gian:</label>
                    <input type="datetime-local" class="form-control" id="thoiGian" name="thoiGian">
                </div>
                <div class="form-group">
                    <label for="tinhTrang">Tình Trạng:</label>
                    <select class="form-control" id="tinhTrang" name="tinhTrang">
                        <option value="Hoạt động">Hoạt động</option>
                        <option value="Đang chuẩn bị">Đang chuẩn bị</option>
                        <option value="Đã kết thúc">Đã kết thúc</option>
                    </select>
                </div>
            <div class="form-group">
                <label for="image">Hình Ảnh (Event Image)</label>
                <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
            </div>

            <!-- Vé thông tin -->
    <div id="ticketFields">
        <!-- Các trường dữ liệu vé sẽ được thêm bởi JavaScript -->
    </div>

    <button type="button" class="btn btn-success" onclick="addTicket()">Thêm vé</button>
            <button type="submit" id ="submitFormButton" class="btn btn-primary">Submit</button>
        </form>

@endsection
<script>
    var ticketCount = 0;

    function addTicket() {
        ticketCount++;
        var ticketFields = document.getElementById('ticketFields');

        var ticketHtml = `
            <div class="ticket-item">
                <h4>Vé ${ticketCount}</h4>
                <div class="form-group">
                    <label for="tickets[${ticketCount}][tenVe]">Tên Vé:</label>
                    <input type="text" class="form-control" id="tenVe${ticketCount}" name="tickets[${ticketCount}][tenVe]" placeholder="Nhập tên vé">
                </div>
                <div class="form-group">
                    <label for="tickets[${ticketCount}][moTaVe]">Mô Tả Vé:</label>
                    <textarea class="form-control" id="moTaVe${ticketCount}" name="tickets[${ticketCount}][moTaVe]" rows="3" placeholder="Nhập mô tả vé"></textarea>
                </div>
                <div class="form-group">
                    <label for="tickets[${ticketCount}][gia]">Giá:</label>
                    <input type="text" class="form-control" id="gia${ticketCount}" name="tickets[${ticketCount}][gia]" placeholder="Nhập giá vé">
                </div>
                <div class="form-group">
                    <label for="tickets[${ticketCount}][loaiVe]">Loại Vé:</label>
                    <input type="text" class="form-control" id="loaiVe${ticketCount}" name="tickets[${ticketCount}][loaiVe]" placeholder="Nhập loại vé">
                </div>
                <div class="form-group">
                    <label for="tickets[${ticketCount}][tongSoVe]">Tổng Số Vé:</label>
                    <input type="number" class="form-control" id="tongSoVe${ticketCount}" name="tickets[${ticketCount}][tongSoVe]" placeholder="Nhập tổng số vé">
                </div>
            </div>
        `;

        ticketFields.insertAdjacentHTML('beforeend', ticketHtml);

    }
    // document.addEventListener('DOMContentLoaded', function() {
    //     var submitFormButton = document.getElementById('submitFormButton');
    //     console.log(submitFormButton); // Verify if the button element is found

    //     if (submitFormButton) {
    //         submitFormButton.addEventListener('click', function(event) {
    //             // Prevent form submission to see console log first
    //             event.preventDefault();

    //             // Log the form data
    //             var formData = new FormData(document.getElementById('eventForm'));
    //             for (var pair of formData.entries()) {
    //                 console.log(pair[0] + ': ' + pair[1]);
    //             }

    //             // Submit the form (uncomment below line to actually submit the form)
    //             // document.getElementById('eventForm').submit();
    //         });
    //     } else {
    //         console.error('Submit button element not found.');
    //     }
    // })
</script>
