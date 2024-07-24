package jwt;

import java.io.IOException;

import javax.servlet.FilterChain;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Service;
import org.springframework.web.filter.OncePerRequestFilter;

import app.gestion.backendSpring.SpringSecurity.*;
import io.jsonwebtoken.ExpiredJwtException;

import java.io.*;


@Service
public class JwtRequestFiltter extends OncePerRequestFilter {

	@Autowired
	jwtTokenUtil JwtTokenUtil ;
	@Autowired
	UserDetailsServiceImpl UserDetailsServiceImpl;
	
	@Override
	protected void doFilterInternal(HttpServletRequest request, HttpServletResponse response, FilterChain filterChain)
			throws ServletException, IOException {
		String requestHeader=request.getHeader("Authorization");
		    String username = null;
	        String jwtToken = null;
	        if(requestHeader!=null && requestHeader.startsWith("Bearer")) {
	        	jwtToken=requestHeader.substring(7);
	        	try {
	        		username=JwtTokenUtil.getUsernameFromToken(jwtToken);
	        	   } catch (IllegalArgumentException e) {
		                System.out.println("Unable to get JWT Token");
		            } catch (ExpiredJwtException e) {
		                System.out.println("JWT Token has expired");
		            }
	        }else {
	        	 logger.warn("JWT Token does not begin with Bearer String");
	        }
	        
	        if(username!=null && SecurityContextHolder.getContext().getAuthentication()==null) {
	        	UserDetails userDetails=this.UserDetailsServiceImpl.loadUserByUsername(username);
	        	if(JwtTokenUtil.validateToken(jwtToken, userDetails)) {
	        		UsernamePasswordAuthenticationToken  UsernamePasswordAuthenticationToken =new UsernamePasswordAuthenticationToken (userDetails,null,userDetails.getAuthorities());
	        		SecurityContextHolder.getContext().setAuthentication(UsernamePasswordAuthenticationToken);
	        	}
	        }
	        filterChain.doFilter(request, response);
	}
  
}
