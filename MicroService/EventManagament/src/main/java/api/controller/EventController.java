package api.controller;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import api.model.Event;
import api.repository.Eventrepository;

@RestController
@RequestMapping("/api")
public class EventController {

    @Autowired
    Eventrepository repo;

    @PostMapping("/event")
    public ResponseEntity<Event> themSuKien(@RequestBody Event sukien) {
    	
        System.out.println("Received Event: " + sukien.getTen());
        System.out.println("Received Event: " + sukien.getImageData());


        try {
            Event _sukien = repo.save(new Event(
                    sukien.getMaSk(), sukien.getTen(), sukien.getMoTa(), sukien.getThoiLuong(),
                    sukien.getDiaChi(), sukien.getThoiGian(), sukien.getNgayTao(), sukien.getTinhTrang(), sukien.getMaAdSk(),
                    sukien.getImageData()
            ));

            return new ResponseEntity<>(_sukien, HttpStatus.CREATED);
        } catch (Exception e) {
            return new ResponseEntity<>(null, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/event")
    public ResponseEntity<List<Event>> xemDanhSachSuKien() {
        try {
            List<Event> eventList = new ArrayList<>();
            repo.findAll().forEach(eventList::add);

            if (eventList.isEmpty()) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }

            return new ResponseEntity<>(eventList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(null, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/event/{id}")
    public ResponseEntity<Optional<Event>> xemChiTietSuKien(@PathVariable("id") String id) {
        try {
            Optional<Event> event = repo.findById(id);

            if (!event.isPresent()) {
                return ResponseEntity.notFound().build();
            }

            return ResponseEntity.ok(event);
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
        }
    }

    @PutMapping("/event/{id}")
    public ResponseEntity<Event> capNhatSuKien(@PathVariable("id") String id, @RequestBody Event event) {
        Optional<Event> eventData = repo.findById(id);

        if (eventData.isPresent()) {
            Event _event = eventData.get();
            _event.setMoTa(event.getMoTa());
            _event.setThoiLuong(event.getThoiLuong());
            _event.setTinhTrang(event.getTinhTrang());

            return new ResponseEntity<>(repo.save(_event), HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }
}
