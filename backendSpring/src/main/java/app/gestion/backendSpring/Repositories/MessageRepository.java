package app.gestion.backendSpring.Repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import app.gestion.backendSpring.Entities.Message;

import java.util.List;

public interface MessageRepository extends JpaRepository<Message, Long> {
    List<Message> findByEmmetteurIdInAndRecepteurIdInOrderByIdDesc(List<Long> emmetteurIds, List<Long> recepteurIds);
}
