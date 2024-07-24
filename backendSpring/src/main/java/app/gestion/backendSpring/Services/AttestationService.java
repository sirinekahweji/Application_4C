package app.gestion.backendSpring.Services;

import java.util.Collection;
import java.util.Date;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Entities.Attestation;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Repositories.AttestationRepository;

@Service
public class AttestationService {

	@Autowired
    private AttestationRepository attestationRepository;

    public List<Attestation> getAllAttestations() {
        return attestationRepository.findAll();
    }

    public Attestation getAttestationById(Long id) {
        Optional<Attestation> optionalAttestation = attestationRepository.findById(id);
        return optionalAttestation.orElse(null);
    }
    
    public List<Attestation> getAttestationsByType(String type) {
        return attestationRepository.findByType(type);
    }
    
    public Collection<User> getUsersByAttestationId(Long id) {
        Optional<Attestation> optionalAttestation = attestationRepository.findById(id);
        if (!optionalAttestation.isPresent()) {
            return null;
        }
        return optionalAttestation.get().getUsers();
    }

    public Attestation createAttestation(Attestation attestation) {
        return attestationRepository.save(attestation);
    }

    public Attestation updateAttestation(Long id, Attestation attestationDetails) {
        Optional<Attestation> optionalAttestation = attestationRepository.findById(id);
        if (!optionalAttestation.isPresent()) {
            return null;
        }

        Attestation attestation = optionalAttestation.get();
        attestation.setNom(attestationDetails.getNom());
        attestation.setType(attestationDetails.getType());
        attestation.setDescription(attestationDetails.getDescription());
        attestation.setImage(attestationDetails.getImage());
        attestation.setUpdatedAt(new Date());

        return attestationRepository.save(attestation);
    }

    public boolean deleteAttestation(Long id) {
        Optional<Attestation> optionalAttestation = attestationRepository.findById(id);
        if (!optionalAttestation.isPresent()) {
            return false;
        }
        attestationRepository.deleteById(id);
        return true;
    }
}
