package app.gestion.backendSpring.Controllers;

import app.gestion.backendSpring.Services.EnseignantService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin("http://localhost:8081/")
@RequestMapping("/api/enseignants")
public class EnseignantController {

	
    @Autowired
    private EnseignantService enseignantService;
    @GetMapping("/count")
    public ResponseEntity<Long> countEnseignants() {
        long count = enseignantService.countEnseignants();
        return ResponseEntity.ok(count);
    }

}
