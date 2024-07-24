package app.gestion.backendSpring.Controllers;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import app.gestion.backendSpring.Entities.DemandeAcces;
import app.gestion.backendSpring.Services.DemandeAccesService;

@RestController
@RequestMapping("/demandes-acces")
public class DemandeAccesController {

    @Autowired
    private DemandeAccesService demandeAccesService;

    @GetMapping
    public ResponseEntity<List<DemandeAcces>> getAllDemandeAcces() {
        List<DemandeAcces> demandesAcces = demandeAccesService.getAllDemandeAcces();
        return ResponseEntity.ok(demandesAcces);
    }

    @GetMapping("/{id}")
    public ResponseEntity<DemandeAcces> getDemandeAccesById(@PathVariable Long id) {
        DemandeAcces demandeAcces = demandeAccesService.getDemandeAccesById(id);
        if (demandeAcces == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(demandeAcces, HttpStatus.OK);
    }

    @PostMapping
    public ResponseEntity<DemandeAcces> createDemandeAcces(@RequestBody DemandeAcces demandeAcces) {
        DemandeAcces newDemandeAcces = demandeAccesService.createDemandeAcces(demandeAcces);
        return new ResponseEntity<>(newDemandeAcces, HttpStatus.CREATED);
    }

    @PutMapping("/{id}")
    public ResponseEntity<DemandeAcces> updateDemandeAcces(@PathVariable Long id, @RequestBody DemandeAcces demandeAccesDetails) {
        DemandeAcces updatedDemandeAcces = demandeAccesService.updateDemandeAcces(id, demandeAccesDetails);
        if (updatedDemandeAcces == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(updatedDemandeAcces, HttpStatus.OK);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteDemandeAcces(@PathVariable Long id) {
        boolean isRemoved = demandeAccesService.deleteDemandeAcces(id);
        if (!isRemoved) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }
    
    @PostMapping("/accept/{id}")
    public ResponseEntity<?> acceptDemandeAcces(@PathVariable Long id) {
        DemandeAcces demandeAcces = demandeAccesService.acceptDemandeAcces(id);
        if (demandeAcces == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(demandeAcces, HttpStatus.OK);
    }
}
