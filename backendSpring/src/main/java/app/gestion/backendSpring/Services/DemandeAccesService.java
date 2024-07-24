package app.gestion.backendSpring.Services;

import java.util.Date;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Entities.DemandeAcces;
import app.gestion.backendSpring.Entities.Role;
import app.gestion.backendSpring.Entities.User;
import app.gestion.backendSpring.Repositories.DemandeAccesRepository;
import app.gestion.backendSpring.Repositories.RoleRepository;
import app.gestion.backendSpring.Repositories.UserRepository;

@Service
public class DemandeAccesService {

    @Autowired
    private DemandeAccesRepository demandeAccesRepository;
    
    @Autowired
    private RoleRepository roleRepository;
    
    @Autowired
    private UserRepository userRepository;

    public List<DemandeAcces> getAllDemandeAcces() {
        return demandeAccesRepository.findAll();
    }

    public DemandeAcces getDemandeAccesById(Long id) {
        Optional<DemandeAcces> optionalDemandeAcces = demandeAccesRepository.findById(id);
        return optionalDemandeAcces.orElse(null);
    }

    public DemandeAcces createDemandeAcces(DemandeAcces demandeAcces) {
        return demandeAccesRepository.save(demandeAcces);
    }

    public DemandeAcces updateDemandeAcces(Long id, DemandeAcces demandeAccesDetails) {
        Optional<DemandeAcces> optionalDemandeAcces = demandeAccesRepository.findById(id);
        if (!optionalDemandeAcces.isPresent()) {
            return null;
        }

        DemandeAcces demandeAcces = optionalDemandeAcces.get();
        demandeAcces.setType(demandeAccesDetails.getType());
        demandeAcces.setUser(demandeAccesDetails.getUser());
        demandeAcces.setUpdatedAt(new Date());

        return demandeAccesRepository.save(demandeAcces);
    }

    public boolean deleteDemandeAcces(Long id) {
        Optional<DemandeAcces> optionalDemandeAcces = demandeAccesRepository.findById(id);
        if (!optionalDemandeAcces.isPresent()) {
            return false;
        }
        demandeAccesRepository.deleteById(id);
        return true;
    }
    
    public DemandeAcces acceptDemandeAcces(Long id) {
        Optional<DemandeAcces> demandeAccesOpt = demandeAccesRepository.findById(id);
        if (demandeAccesOpt.isPresent()) {
            DemandeAcces demandeAcces = demandeAccesOpt.get();
            User user = demandeAcces.getUser();
            Role newRole = roleRepository.findByNomRole(demandeAcces.getType());

            if (newRole != null) {
                user.setRole(newRole);
                userRepository.save(user);
                demandeAccesRepository.delete(demandeAcces);
            }

            return demandeAcces;
        }
        return null;
    }
}
