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

import app.gestion.backendSpring.Entities.Classe;
import app.gestion.backendSpring.Entities.Etudiant;
import app.gestion.backendSpring.Services.ClasseService;

@RestController
@RequestMapping("/classes")
public class ClasseController {

    @Autowired
    private ClasseService classeService;

    @GetMapping
    public ResponseEntity<List<Classe>> getAllClasses() {
        List<Classe> classes = classeService.getAllClasses();
        return ResponseEntity.ok(classes);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Classe> getClasseById(@PathVariable Long id) {
        Classe classe = classeService.getClasseById(id);
        if (classe == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(classe, HttpStatus.OK);
    }

    @PostMapping
    public ResponseEntity<Classe> createClasse(@RequestBody Classe classe) {
        Classe newClasse = classeService.createClasse(classe);
        return new ResponseEntity<>(newClasse, HttpStatus.CREATED);
    }

    @PutMapping("/{id}")
    public ResponseEntity<Classe> updateClasse(@PathVariable Long id, @RequestBody Classe classeDetails) {
        Classe updatedClasse = classeService.updateClasse(id, classeDetails);
        if (updatedClasse == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(updatedClasse, HttpStatus.OK);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteClasse(@PathVariable Long id) {
        boolean isRemoved = classeService.deleteClasse(id);
        if (!isRemoved) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }
    
    @GetMapping("/{id}/etudiants")
    public ResponseEntity<List<Etudiant>> getEtudiantsByClasse(@PathVariable Long id) {
        List<Etudiant> etudiants = classeService.getEtudiantsByClasse(id);
        if (etudiants == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(etudiants, HttpStatus.OK);
    }
    
    @GetMapping("/specialite/{specialiteId}")
    public ResponseEntity<List<Classe>> getClassesBySpecialite(@PathVariable Long specialiteId) {
        List<Classe> classes = classeService.getClassesBySpecialite(specialiteId);
        return new ResponseEntity<>(classes, HttpStatus.OK);
    }
}
