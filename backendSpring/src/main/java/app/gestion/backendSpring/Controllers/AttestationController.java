package app.gestion.backendSpring.Controllers;

import java.util.Collection;
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

import app.gestion.backendSpring.Entities.Attestation;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Services.AttestationService;

@RestController
@RequestMapping("/attestations")
public class AttestationController {

    @Autowired
    private AttestationService attestationService;

    @GetMapping
    public ResponseEntity<List<Attestation>> getAllAttestations() {
        List<Attestation> attestations = attestationService.getAllAttestations();
        return ResponseEntity.ok(attestations);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Attestation> getAttestationById(@PathVariable Long id) {
        Attestation attestation = attestationService.getAttestationById(id);
        if (attestation == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(attestation, HttpStatus.OK);
    }
    
    @GetMapping("/{id}/users")
    public ResponseEntity<Collection<User>> getUsersByAttestationId(@PathVariable Long id) {
        Collection<User> users = attestationService.getUsersByAttestationId(id);
        if (users == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(users, HttpStatus.OK);
    }
    
    @GetMapping("/type/{type}")
    public ResponseEntity<List<Attestation>> getAttestationsByType(@PathVariable String type) {
        List<Attestation> attestations = attestationService.getAttestationsByType(type);
        return ResponseEntity.ok(attestations);
    }

    @PostMapping
    public ResponseEntity<Attestation> createAttestation(@RequestBody Attestation attestation) {
        Attestation newAttestation = attestationService.createAttestation(attestation);
        return new ResponseEntity<>(newAttestation, HttpStatus.CREATED);
    }

    @PutMapping("/{id}")
    public ResponseEntity<Attestation> updateAttestation(@PathVariable Long id, @RequestBody Attestation attestationDetails) {
        Attestation updatedAttestation = attestationService.updateAttestation(id, attestationDetails);
        if (updatedAttestation == null) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(updatedAttestation, HttpStatus.OK);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteAttestation(@PathVariable Long id) {
        boolean isRemoved = attestationService.deleteAttestation(id);
        if (!isRemoved) {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }
}
