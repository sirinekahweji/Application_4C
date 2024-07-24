package app.gestion.backendSpring.Controllers;

import java.util.List;
import java.util.Optional;

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

import app.gestion.backendSpring.Entities.Departement;
import app.gestion.backendSpring.Entities.Enseignant;
import app.gestion.backendSpring.Entities.Specialite;
import app.gestion.backendSpring.Services.DepartementService;

@RestController
@RequestMapping("/departements")
public class DepartementController {

    @Autowired
    private DepartementService departementService;

    @GetMapping
    public ResponseEntity<List<Departement>> getAllDepartements() {
        List<Departement> departements = departementService.getAllDepartements();
        return new ResponseEntity<>(departements, HttpStatus.OK);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Departement> getDepartementById(@PathVariable Long id) {
        Optional<Departement> departement = departementService.getDepartementById(id);
        if (departement.isPresent()) {
            return new ResponseEntity<>(departement.get(), HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @PostMapping
    public ResponseEntity<Departement> createDepartement(@RequestBody Departement departement) {
        try {
            Departement newDepartement = departementService.createDepartement(departement);
            return new ResponseEntity<>(newDepartement, HttpStatus.CREATED);
        } catch (Exception e) {
            return new ResponseEntity<>(null, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<Departement> updateDepartement(@PathVariable Long id, @RequestBody Departement departementDetails) {
        Departement updatedDepartement = departementService.updateDepartement(id, departementDetails);
        if (updatedDepartement != null) {
            return new ResponseEntity<>(updatedDepartement, HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteDepartement(@PathVariable Long id) {
        try {
            departementService.deleteDepartement(id);
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/{id}/enseignants")
    public ResponseEntity<List<Enseignant>> getEnseignantsByDepartement(@PathVariable Long id) {
        List<Enseignant> enseignants = departementService.getEnseignantsByDepartement(id);
        if (enseignants == null) {
            return ResponseEntity.notFound().build();
        }
        return ResponseEntity.ok(enseignants);
    }

    @GetMapping("/{id}/specialites")
    public ResponseEntity<List<Specialite>> getSpecialitesByDepartement(@PathVariable Long id) {
        List<Specialite> specialites = departementService.getSpecialitesByDepartement(id);
        if (specialites == null) {
            return ResponseEntity.notFound().build();
        }
        return ResponseEntity.ok(specialites);
    }
}
