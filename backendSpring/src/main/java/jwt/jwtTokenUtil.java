package jwt;

import java.io.Serializable;
import java.util.Base64;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;
import java.util.function.Function;

import javax.crypto.SecretKey;

import org.springframework.context.annotation.Bean;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Service;

import io.jsonwebtoken.Claims;
import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.security.Keys;

@Service
public class jwtTokenUtil implements Serializable{
	private static final long serialVersionUID = 1L;

	public static final long JWT_TOKEN_VALIDITY = 5 * 60 * 60;
	
	private final SecretKey secretKey = Keys.secretKeyFor(SignatureAlgorithm.HS512);
	 
	
	 private static String secret="workwise";
	 
	  public <T> T getClaimFromToken(String token, Function<Claims, T> claimsResolver) {
	        final Claims claims = getAllClaimsFromToken(token);
	        return claimsResolver.apply(claims);
	  }
	  
	
	  public Date getExpirationDateFromToken(String token) {
	        return (Date) getClaimFromToken(token,  Claims::getExpiration);
	  }
	    
	 private Claims getAllClaimsFromToken(String token) {
		  return Jwts.parser().setSigningKey(secret.getBytes()).parseClaimsJws(token).getBody();
	  }
	 

	  private Boolean isTokenExpired(String token) {
	        final Date expiration = getExpirationDateFromToken(token);
	        return expiration.before(new Date());
	  }
	  
	  private String doGenerateToken(Map<String, Object> claims, String subject) {
	        return Jwts.builder()
	                .setClaims(claims)
	                .setSubject(subject)
	                .setIssuedAt(new Date(System.currentTimeMillis()))
	                .setExpiration(new Date(System.currentTimeMillis() + JWT_TOKEN_VALIDITY * 1000))
	                .signWith(secretKey)
	                .compact();
	    }


	   public String generateToken(UserDetails userDetails) {
	        Map<String, Object> claims = new HashMap<>();
	        return doGenerateToken(claims, userDetails.getUsername());
	    }
	  
	  public String getUsernameFromToken(String token) {
	        return getClaimFromToken(token, Claims::getSubject);
	   }
	  

	  public Boolean validateToken(String token, UserDetails userDetails) {
	        final String username = getUsernameFromToken(token);
	        return (username.equals(userDetails.getUsername()) && !isTokenExpired(token));
	    }
		  
}
