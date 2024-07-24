package app.gestion.backendSpring.Services;

import app.gestion.backendSpring.Entities.Message;
import app.gestion.backendSpring.Repositories.MessageRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class MessageService {

    @Autowired
    private MessageRepository messageRepository;

    public List<Message> getChat(Long emmetteurId, Long recepteurId) {
        return messageRepository.findByEmmetteurIdInAndRecepteurIdInOrderByIdDesc(
                List.of(emmetteurId, recepteurId), 
                List.of(emmetteurId, recepteurId)
        );
    }

    public Message createMessage(Message message) {
        return messageRepository.save(message);
    }

    public void deleteMessage(Long id) {
        messageRepository.deleteById(id);
    }
}
