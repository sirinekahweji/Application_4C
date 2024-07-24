package app.gestion.backendSpring.Repositories;

import app.gestion.backendSpring.Entities.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

import java.util.Optional;

public interface UserRepository extends JpaRepository<User, Long> {
    
	Optional<User> findByEmail(String email);
	
	@Query(value="select * from user where email=:email",nativeQuery=true)
	User getUserByemail(String email);
}
