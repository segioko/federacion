package control;

import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
import org.springframework.security.crypto.password.LdapShaPasswordEncoder;

@SuppressWarnings("deprecation")
@Configuration
public class SecurityConfig extends WebSecurityConfigurerAdapter {
	@Value("ldaps://201.245.172.253:636/tcp")
	private String ldapUrls;
	
	@Value("dc=edu,dc=co")
	private String ldapBaseDn;
	
	@Value("cn=Monitor,dc=edu,dc=co")
	private String ldapSecurityPrincipal;
	
	@Value("B-2Z*z+TG-")
	private String ldapPrincipalPassword;
	
	@Value("uid={0}")
	private String ldapUserDnPattern;
	
	@Value("${ldap.enabled}")
	private String ldapEnabled;
	
	@Override
	protected void configure(HttpSecurity http) throws Exception {
        http
        	.authorizeRequests()
        		.antMatchers("/login**").permitAll()
        		.antMatchers("/profile/**").fullyAuthenticated()
            	.antMatchers("/").permitAll()
            	.and()
            .formLogin()
            	.loginPage("/login")
            	.failureUrl("/login?error")
            	.permitAll()
            	.and()
            .logout()
            	.invalidateHttpSession(true)
            	.deleteCookies("JSESSIONID")
            	.permitAll();
	}
	
	
	@Override
	protected void configure(AuthenticationManagerBuilder auth) throws Exception {
		
		if(Boolean.parseBoolean(ldapEnabled)) {
			auth
				.ldapAuthentication()
				.contextSource()
					.url(ldapUrls + ldapBaseDn)
						.managerDn(ldapSecurityPrincipal)
						.managerPassword(ldapPrincipalPassword)
					.and()
						.userDnPatterns(ldapUserDnPattern);
		} else {
	        auth
	        .inMemoryAuthentication()
	            .withUser("user").password("password").roles("USER")
	            .and()
	            .withUser("admin").password("admin").roles("ADMIN");
		}
	}

}