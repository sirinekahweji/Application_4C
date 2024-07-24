package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import app.gestion.backendSpring.Entities.Contact;

public interface ContactRepository extends JpaRepository<Contact, Long> {

}
