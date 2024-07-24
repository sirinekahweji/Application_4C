package app.gestion.backendSpring.Repositories;

import app.gestion.backendSpring.Entities.Role;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

public interface RoleRepository extends JpaRepository<Role, Long> {
    @Query(value = "select * from roles where id:=role_id", nativeQuery = true)
    Role getRoleById(Long role_id);
    Role findByNomRole(String nomRole);
}
