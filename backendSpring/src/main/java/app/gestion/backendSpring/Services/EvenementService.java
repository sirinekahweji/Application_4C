package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Evenement;
import app.gestion.backendSpring.Repositories.EvenementRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.List;

@Service
public class EvenementService {

    @Autowired
    private EvenementRepository evenementRepository;

    public List<Evenement> getAllEvenements() {
        return evenementRepository.findAll();
    }

    public Evenement createEvenement(Evenement evenement) {
        return evenementRepository.save(evenement);
    }

    public Evenement getEvenementById(Long id) {
        return evenementRepository.findById(id).orElse(null);
    }

    public Evenement updateEvenement(Long id, Evenement evenementDetails) {
        Evenement evenement = evenementRepository.findById(id).orElseThrow();
        // Update fields
        evenement.setAffiche(evenementDetails.getAffiche());
        // Update other fields as needed
        return evenementRepository.save(evenement);
    }

    public void deleteEvenement(Long id) {
        evenementRepository.deleteById(id);
    }

    public long countEvenements() {
        return evenementRepository.count();
    }

    public List<Evenement> getEvenementDisponible(LocalDate date) {
        return evenementRepository.findByDateLimiteInscriptionGreaterThanEqual(date);
    }

    public List<Evenement> getEvenementNonDisponible(LocalDate date) {
        return evenementRepository.findByDateLimiteInscriptionLessThan(date);
    }
}
