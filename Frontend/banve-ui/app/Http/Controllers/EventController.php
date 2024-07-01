<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\alert;
class EventController extends Controller
{
    public function index()
    {
        try {
            // Fetch data from the API
            $response = Http::get('http://localhost:8081/api/event'); // Replace with your actual API URL
            
            if ($response->successful()) {
                $events = $response->json(); // Assuming the API returns a JSON array of events
                // Lọc các sự kiện có tinhTrang là "active"
                // $activeEvents = array_filter($events, function ($event) {
                //     return isset($event['tinhTrang']) && $event['tinhTrang'] === 'Active';
                // });
                $activeEvents = $response->json();
                // Định dạng lại ngày tháng cho mỗi sự kiện
                foreach ($activeEvents as &$event) {
                    if (isset($event['thoiGian'])) {
                        // Chuyển đổi và định dạng lại thời gian sử dụng isoFormat
                        $event['thoiGianFormatted'] = Carbon::parse($event['thoiGian'])->isoFormat('ddd, MMMM Do - hA');
                    } else {
                        $event['thoiGianFormatted'] = null; // Xử lý khi thời gian không tồn tại
                    }
                }
                // Sắp xếp lại các chỉ số mảng sau khi lọc
                $activeEvents = array_values($activeEvents);

                // Phân trang dữ liệu thủ công
                $perPage = 3; // Số lượng sự kiện mỗi trang
                $currentPage = request()->input('page', 1); // Lấy trang hiện tại từ request, mặc định là trang 1
                $startingPoint = ($currentPage - 1) * $perPage;
                $paginatedEvents = array_slice($activeEvents, $startingPoint, $perPage);

                // Tạo LengthAwarePaginator thủ công
                $events = new LengthAwarePaginator(
                    $paginatedEvents,
                    count($activeEvents),
                    $perPage,
                    $currentPage,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
                return view('event.events', compact('events'));
            } else {
                // Handle non-2xx status codes
                return view('event.events')->with('error', 'Failed to fetch data from the API.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., cURL errors)
            return view('event.events')->with('error', 'Error connecting to the API: ' . $e->getMessage());
        }
    }
    
    public function show($id)
    {
        try {
            // Fetch event data from the API
            $eventResponse = Http::get("http://localhost:8081/api/event/{$id}"); // Replace with actual API URL
            $ticketResponse = Http::get("http://localhost:8081/api/event/Ticket/{$id}"); // Replace with actual API URL

            // Check if both responses are successful
            if ($eventResponse->successful() && $ticketResponse->successful()) {
                $eventData = $eventResponse->json();
                $ticketData = $ticketResponse->json();

                // Pass data to the view
                return view('event.event_details', compact('eventData', 'ticketData'));
            } else {
                // Handle error responses
                return view('event.event_details')->with('error', 'Failed to fetch data from the API.');
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., connection issues)
            return view('event.event_details')->with('error', 'Error connecting to the API: ' . $e->getMessage());
        }
    }
    public function showForm()
    {
        // Fetch data from the API
        $response = Http::get('http://localhost:8081/api/event'); // Replace with your actual API URL
        $data = $response->json();
        
        // Pass data to the view
        return view('event.event-form', compact('data'));
    }

    public function submitForm(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'ten' => 'required|max:255',
            'moTa' => 'required',
            'thoiLuong' => 'required',
            'diaChi' => 'required',
            'thoiGian' => 'required|date',
            'tinhTrang' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
            'tickets.*.tenVe' => 'required', // Validate each ticket fields
            'tickets.*.moTaVe' => 'required',
            'tickets.*.gia' => 'required',
            'tickets.*.loaiVe' => 'required',
            'tickets.*.tongSoVe' => 'required|numeric|min:1',
        ]);

        // Upload image file
        // $imagePath = $request->file('image')->store('images/events', 'public');

        // Prepare event data to send to backend API
        $eventData = [
            'ten' => $validated['ten'],
            'moTa' => $validated['moTa'],
            'thoiLuong' => $validated['thoiLuong'],
            'diaChi' => $validated['diaChi'],
            'thoiGian' => $validated['thoiGian'],
            'tinhTrang' => $validated['tinhTrang'],
            // 'imagePath' => $imagePath,
        ];

        // Send POST request to create event
        $response = Http::post('http://localhost:8081/api/event', $eventData);

        if (!$response->successful()) {
            return redirect()->back()->with('error', 'Failed to create event.');
        }

        // Retrieve maSk (event ID) from the response
        $maSk = $response->json()['maSk'];
// Handle tickets if they exist
if (isset($validated['tickets'])) {
    foreach ($validated['tickets'] as $ticketIndex => $ticket) {
        $ticketData = [
            'tenVe' => $ticket['tenVe'],
            'moTa' => $ticket['moTaVe'], // Adjust here to match your form structure
            'gia' => $ticket['gia'],
            'loaiVe' => $ticket['loaiVe'],
            'tongSoVe' => $ticket['tongSoVe'],
            'soVeConLai' => $ticket['tongSoVe'],
            'maSk' => $maSk,
        ];

        // Send POST request to create each ticket
        $ticketResponse = Http::post('http://localhost:8081/api/event/ticket', $ticketData);

        if (!$ticketResponse->successful()) {
            return redirect()->back()->with('error', 'Failed to create ticket: ' . $ticketResponse->body());
        }
    }
}

        return redirect()->back()->with('success', 'Event and tickets created successfully!');

    }
}

