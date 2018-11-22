package control;

import model.Usuario;

import java.io.IOException;
import java.io.Serializable;
import java.util.List;

import javax.faces.context.FacesContext;
import javax.enterprise.context.RequestScoped;
import javax.faces.bean.ManagedBean;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.persistence.Query;
import javax.swing.JOptionPane;

import org.springframework.context.annotation.Configuration;

@ManagedBean
public class ControlUsuario implements Serializable {
	private static final long serialVersionUID = 1L;

	private List<Usuario> _Usuario;
	private EntityManagerFactory emf;
	private EntityManager em;
	private Usuario usuario;

	public ControlUsuario() {
		this.emf = Persistence.createEntityManagerFactory("FEDERACION");
		this.em = this.emf.createEntityManager();
		this._Usuario = consultarUsuario();
		this.usuario = new Usuario();
	}

	public List<Usuario> consultarUsuario() {
		String jpql = "SELECT u FROM Usuario u";
		Query query = this.em.createQuery(jpql);
		List<Usuario> _Usuario = query.getResultList();
		return _Usuario;
	}

	public void loginUsuario() {
		Usuario usu = new Usuario();
		usu.setIdUSUARIO(
				FacesContext.getCurrentInstance().getExternalContext().getRequestParameterMap().get("estudiante"));
		usu.setUNIVERSIDAD_idUNIVERSIDAD(Integer.parseInt(
				FacesContext.getCurrentInstance().getExternalContext().getRequestParameterMap().get("universidad")));
		FacesContext context = FacesContext.getCurrentInstance();
		List<Usuario> _Usuario = null;
		try {
			_Usuario = consultarUsuario();		
		} catch (Exception e) {
			System.out.println(e);
		}
		if (_Usuario != null) {
			for (int a = 0; a < _Usuario.size(); a++) {
				if (usu.getIdUSUARIO().equals(_Usuario.get(a).getIdUSUARIO())
						&& _Usuario.get(a).getUNIVERSIDAD_idUNIVERSIDAD() == usu.getUNIVERSIDAD_idUNIVERSIDAD()) {
					context.getExternalContext().getSessionMap().put("usu", usu);
					try {
						context.getExternalContext().redirect("portada.xhtml");
					} catch (IOException e) {
						e.printStackTrace();
					}
				}
			}
		} else {
			System.out.println("Parametros incorrectos o usuario no registrado");
		}
	}

	public void crearUsuario() {
		try {
			this.em.getTransaction().begin();
			this.em.persist(usuario);
			this.em.getTransaction().commit();
			this.usuario = new Usuario();
		} catch (Exception e) {
			System.out.println(e);
		}
	}

	public List<Usuario> get_Usuario() {
		return _Usuario;
	}

	public void set_Usuario(List<Usuario> _Usuario) {
		this._Usuario = _Usuario;
	}

	public Usuario getUsuario() {
		return usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}

}
