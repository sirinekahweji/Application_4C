package app.gestion.backendSpring.Services;

import java.util.Date;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import app.gestion.backendSpring.Entities.Contact;
import app.gestion.backendSpring.Repositories.ContactRepository;

@Service
public class ContactService {

    @Autowired
    private ContactRepository contactRepository;

    public List<Contact> getAllContacts() {
        return contactRepository.findAll();
    }

    public Contact getContactById(Long id) {
        Optional<Contact> optionalContact = contactRepository.findById(id);
        return optionalContact.orElse(null);
    }

    public Contact createContact(Contact contact) {
        return contactRepository.save(contact);
    }

    public Contact updateContact(Long id, Contact contactDetails) {
        Optional<Contact> optionalContact = contactRepository.findById(id);
        if (!optionalContact.isPresent()) {
            return null;
        }

        Contact contact = optionalContact.get();
        contact.setNom(contactDetails.getNom());
        contact.setPrenom(contactDetails.getPrenom());
        contact.setFonctionnalite(contactDetails.getFonctionnalite());
        contact.setPhone(contactDetails.getPhone());
        contact.setIsResponsable(contactDetails.getIsResponsable());
        contact.setEmail(contactDetails.getEmail());
        contact.setEntreprise(contactDetails.getEntreprise());
        contact.setUpdatedAt(new Date());

        return contactRepository.save(contact);
    }

    public boolean deleteContact(Long id) {
        Optional<Contact> optionalContact = contactRepository.findById(id);
        if (!optionalContact.isPresent()) {
            return false;
        }
        contactRepository.deleteById(id);
        return true;
    }
}
