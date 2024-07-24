package app.gestion.backendSpring.Services;

import java.util.Date;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Entities.Departement;
import app.gestion.backendSpring.Entities.Enseignant;
import app.gestion.backendSpring.Entities.Specialite;
import app.gestion.backendSpring.Repositories.DepartementRepository;
import app.gestion.backendSpring.Repositories.EnseignantRepository;
import app.gestion.backendSpring.Repositories.SpecialiteRepository;

@Service
public class DepartementService {

    @Autowired
    private DepartementRepository departementRepository;
    
    @Autowired
    private EnseignantRepository enseignantRepository;
    
    @Autowired
    private SpecialiteRepository specialiteRepository;

    public List<Departement> getAllDepartements() {
        return departementRepository.findAll();
    }

    public Optional<Departement> getDepartementById(Long id) {
        return departementRepository.findById(id);
    }

    public Departement createDepartement(Departement departement) {
        return departementRepository.save(departement);
    }

    public Departement updateDepartement(Long id, Departement departementDetails) {
        Optional<Departement> departementOptional = departementRepository.findById(id);
        if (departementOptional.isPresent()) {
            Departement departement = departementOptional.get();
            departement.setNom(departementDetails.getNom());
            departement.setAbreviation(departementDetails.getAbreviation());
            departement.setUpdatedAt(new Date());
            return departementRepository.save(departement);
        }
        return null;
    }

    public void deleteDepartement(Long id) {
        departementRepository.deleteById(id);
    }
    
    public List<Enseignant> getEnseignantsByDepartement(Long departementId) {
        Optional<Departement> departement = departementRepository.findById(departementId);
        return departement.map(d -> enseignantRepository.findByDepartement(d)).orElse(null);
    }

    public List<Specialite> getSpecialitesByDepartement(Long departementId) {
        Optional<Departement> departement = departementRepository.findById(departementId);
        return departement.map(d -> specialiteRepository.findByDepartement(d)).orElse(null);
    }
}
