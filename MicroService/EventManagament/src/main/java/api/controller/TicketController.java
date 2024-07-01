package api.controller;


import api.model.Ticket;
import api.repository.TicketRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api")
public class TicketController {

    @Autowired
    TicketRepository TicketRepo;

    @PostMapping("/event/ticket")
    public ResponseEntity<Ticket> themVe(@RequestBody Ticket ve) {

        try {
            

            // Lưu vé vào cơ sở dữ liệu
            Ticket savedTicket = TicketRepo.save(ve);

            // Trả về đối tượng Ticket đã lưu kèm trạng thái 201 CREATED
            return new ResponseEntity<>(savedTicket, HttpStatus.CREATED);
        } catch (Exception e) {
            // Log lỗi (nếu cần thiết)
            // Trả về trạng thái 500 INTERNAL_SERVER_ERROR
            return new ResponseEntity<>(null, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    @GetMapping("/event/Ticket/{maSk}")
    public ResponseEntity<List<Ticket>> getTicketsByEventId(@PathVariable("maSk") String maSk) {
        try
        {
            List<Ticket> Ticketlst = new ArrayList<Ticket>();
            TicketRepo.findBymaSk(maSk).forEach(Ticketlst::add);
            if(Ticketlst.isEmpty())
            {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }

            return new ResponseEntity<>(Ticketlst, HttpStatus.OK);
        }
        catch (Exception e)
        {
            return new ResponseEntity<>(null, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }


    @GetMapping("/event/ticket/{id}")
    public ResponseEntity<Optional<Ticket>> xemChiTietVe(@PathVariable("id") String id) {
        try {
            Optional<Ticket> ticket = TicketRepo.findById(id);

            if (ticket.isEmpty()) {
                return ResponseEntity.notFound().build();
            }

            return ResponseEntity.ok(ticket);
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }
}
