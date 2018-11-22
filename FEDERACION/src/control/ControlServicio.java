package control;

import model.Servicio;
import java.util.List;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.persistence.Query;

public class ControlServicio {

	private EntityManagerFactory emf;
	private EntityManager em;
	private List<Servicio> _Servicio;
	private Servicio Servicio;

	public ControlServicio() {
		this.emf = Persistence.createEntityManagerFactory("federacion");
		this.em = this.emf.createEntityManager();
		this._Servicio = consultarServicio();
		this.Servicio = new Servicio();
	}

	public List<Servicio> consultarServicio() {
		String jpql = " SELECT * FROM SERVCIO";
		Query query = this.em.createQuery(jpql);
		List<Servicio> _Servicio = query.getResultList();
		return _Servicio;
	}

	public void crearServicio() {
		try {
			this.em.getTransaction().begin();
			this.em.persist(Servicio);
			this.em.getTransaction().commit();
			this.Servicio = new Servicio();
		} catch (Exception e) {
			System.out.println(e);
		}
	}

	public List<Servicio> get_Servicio() {
		return _Servicio;
	}

	public void set_Servicio(List<Servicio> _Servicio) {
		this._Servicio = _Servicio;
	}

	public Servicio getServicio() {
		return Servicio;
	}

	public void setServicio(Servicio Servicio) {
		this.Servicio = Servicio;
	}

}
