package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Certificat4C;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Repositories.Certificat4cRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;
import java.util.Optional;

@Service
public class Certificat4cService {

    @Autowired
    private Certificat4cRepository certificat4cRepository;

    public List<Certificat4C> getAllCertificats() {
        return certificat4cRepository.findAll();
    }

    public Certificat4C createCertificat(Certificat4C certificat4C) {
        return certificat4cRepository.save(certificat4C);
    }

    public Certificat4C getCertificatById(Long id) {
        return certificat4cRepository.findById(id).orElse(null);
    }

    public Certificat4C updateCertificat(Long id, Certificat4C certificatDetails) {
        Certificat4C certificat4C = certificat4cRepository.findById(id).orElseThrow();
        certificat4C.setNom(certificatDetails.getNom());
        return certificat4cRepository.save(certificat4C);
    }

    public void deleteCertificat(Long id) {
        certificat4cRepository.deleteById(id);
    }

    public long countCertificats() {
        return certificat4cRepository.count();
    }

    public List<Certificat4C> getCertificat4cDisponible(LocalDate date) {
        return certificat4cRepository.findByDateGreaterThanEqual(date);
    }

    public List<Certificat4C> getCertificat4cNonDisponible(LocalDate date) {
        return certificat4cRepository.findByDateLessThan(date);
    }
    
    public List<Certificat4C> getCertificatsByCategorie(String categorie) {
        return certificat4cRepository.findByCategorie(categorie);
    }
    
    public List<User> getParticipantsByCertificatId(Long id) {
        Optional<Certificat4C> optionalCertificat = certificat4cRepository.findById(id);
        if (!optionalCertificat.isPresent()) {
            return null;
        }
        return (List<User>) optionalCertificat.get().getParticipants();
    }

    public List<User> getPresencesByCertificatId(Long id) {
        Optional<Certificat4C> optionalCertificat = certificat4cRepository.findById(id);
        if (!optionalCertificat.isPresent()) {
            return null;
        }
        return (List<User>) optionalCertificat.get().getPresences();
    }
}
