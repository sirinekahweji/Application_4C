package app.gestion.backendSpring.Controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import app.gestion.backendSpring.Services.EtudiantService;

@RestController
@CrossOrigin("http://localhost:8081/")
@RequestMapping("/api/etudiants")
public class EtudiantController {
	
    @Autowired
    private EtudiantService etudiantService;
    @GetMapping("/count")
    public ResponseEntity<Long> countEtudiants() {
        long count = etudiantService.countEtudiants();
        return ResponseEntity.ok(count);
    }

}
