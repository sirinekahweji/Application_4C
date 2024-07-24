package app.gestion.backendSpring;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication(scanBasePackages = {"app.gestion.backendSpring", "jwt"})
public class BackendSpringApplication {

	@Autowired

	public static void main(String[] args) {
		SpringApplication.run(BackendSpringApplication.class, args);
	}

	/**
	 * Callback used to run the bean.
	 *
	 * @param args incoming main method arguments
	 * @throws Exception on error
	 */
}
